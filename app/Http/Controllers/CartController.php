<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Redeem;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cartItems = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();
    
        $myVouchers = Redeem::where('user_id', auth()->id())
            ->with('voucher')
            ->get()
            ->pluck('voucher');

        $checkedIds = $request->query('cart_ids') ?? $request->input('cart_ids') ?? [];
        $selectedVoucherId = $request->input('voucher_id');

        $subtotalChosen = 0;
        $voucherDiscount = 0;
        $membershipDiscount = 0;

        if (is_array($checkedIds) && count($checkedIds) > 0) {
            $itemsTerpilih = Cart::whereIn('id', $checkedIds)->with('product')->get();
            foreach ($itemsTerpilih as $item) {
                $subtotalChosen += $item->product->price * $item->quantity;
            }

            $user = auth()->user();
            $membership = \App\Models\Membership::where('min_transaction', '<=', $user->total_spent)
                ->orderBy('min_transaction', 'desc')
                ->first();
                
            if ($membership) {
                $membershipDiscount = $subtotalChosen * ($membership->discount_percentage / 100);
            }

            // Hitung potongan voucher
            if ($selectedVoucherId) {
                $v = \App\Models\Voucher::find($selectedVoucherId);
                if ($v) {
                    $voucherDiscount = $v->discount_amount;
                }
            }
        }

    $totalFinal = $subtotalChosen - $membershipDiscount - $voucherDiscount;
    if ($totalFinal < 0) $totalFinal = 0;
        return view('carts.index', compact(
            'cartItems', 
            'myVouchers', 
            'subtotalChosen', 
            'membershipDiscount', 
            'voucherDiscount', 
            'totalFinal',
            'checkedIds',
            'selectedVoucherId'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = \App\Models\Product::all();
        return view('carts.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:' . $product->stock,
        ],[
            'quantity.max' => 'Jumlah yang dimasukkan melebihi stok yang tersedia (' . $product->stock . ' pcs).'
        ]);

        // Jika stock product 0, gagal add to cart
        if ($product->stock <= 0) {
            return redirect()->back()->with('error', 'Maaf, stok produk kosong :(');
        }

        $cart = Cart::where('user_id', auth()->id())
                    ->where('product_id', $request->product_id)
                    ->first();

        // Jika stock tidak mencukupi
        if ($cart && ($cart->quantity + $request->quantity) > $product->stock) {
            return redirect()->back()
                ->with('error', 'Stok produk tidak mencukupi!');
        }

        if ($cart) {
            // Jika sudah ada, update quantity
            $cart->quantity += $request->quantity;
            $cart->save();
        } else {
            // Jika belum, buat baru
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()
            ->back()
            ->with('success_html', 'Produk ditambahkan ke keranjang.
            <a href="'
                . route('carts.index')
                . '" style="text-decoration: underline; font-weight: bold;">Lihat Keranjang
            </a>'
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        return view('carts.show', compact('cart'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        if ($cart->user_id !== auth()->id()) {
            abort(403);
        }

        return view('carts.edit', compact('cart'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        if ($cart->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart->quantity = $request->quantity;
        $cart->save();

        return redirect()->route('carts.index')->with('success', 'Jumlah diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        if ($cart->user_id !== auth()->id()) {
            abort(403);
        }
        $cart->delete();
        return redirect()->route('carts.index')->with('success', 'Item dihapus dari keranjang.');
    }

    // Checkout: mengubah item pilihan di cart menjadi transaksi
    public function checkout(Request $request)
    {
        // checkbox produk untuk checkout
        $cartIds = $request->input('cart_ids', []);
        if (empty($cartIds)) {
            return redirect()->route('carts.index')->with('error', 'Pilih minimal satu produk untuk check out.');
        }

        $cartItems = Cart::where('user_id', auth()->id())
            ->whereIn('id', $cartIds)
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('carts.index')->with('error', 'Keranjang kosong.');
        }

        $items = $cartItems->map(function ($cart) {
            return ['product_id' => $cart->product_id, 'quantity' => $cart->quantity];
        })->toArray();

        try {
            $voucherId = $request->input('voucher_id') ?: null;

            $result = TransactionService::processOrder(auth()->id(), $items, $voucherId);

            // Setelah transaksi sukses, hapus cart
            Cart::where('user_id', auth()->id())
                ->whereIn('id', $cartIds)
                ->delete();

            return redirect()->route('transactions.success')
                ->with('success', "Checkout berhasil!")
                ->with('earnedPoints', $result['points'] ?? 0)
                ->with('transaction_id', $result['transaction']->id);

        } catch (\Exception $e) {
            return redirect()->route('carts.index')->with('error', $e->getMessage());
        }
    }
}