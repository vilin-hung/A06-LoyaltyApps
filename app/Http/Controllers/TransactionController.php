<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Redeem;
use App\Models\Transaction;
use App\Models\Voucher;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('transactions.index', compact('transactions'));
    }

    // tampilan admin only
    public function adminIndex()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Hanya Admin yang dapat mengakses halaman ini.');
        }

        $transactions = Transaction::with(['user', 'voucher'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('transactions.admin_index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $productId = $request->query('product_id');
        $quantity = $request->query('quantity', 1);
        
        if (!$productId) {
            return redirect()->route('products.index')
                ->with('error', 'Silakan pilih produk terlebih dahulu');
        }

        $product = Product::findOrFail($productId);
        $vouchers = Redeem::where('user_id', auth()->id())
            ->with('voucher')
            ->get()
            ->pluck('voucher');
            
        $subtotalChosen = $product->price * $quantity;

        $user = auth()->user();
        $membershipDiscount = 0;
        $membership = \App\Models\Membership::where('min_transaction', '<=', $user->total_spent)
            ->orderBy('min_transaction', 'desc')
            ->first();
            
        if ($membership) {
            $membershipDiscount = $subtotalChosen * ($membership->discount_percentage / 100);
        }

        $totalFinal = $subtotalChosen - $membershipDiscount;
        if ($totalFinal < 0) $totalFinal = 0;

        return view('transactions.create', compact(
            'product',
            'quantity',
            'vouchers',
            'subtotalChosen',
            'membershipDiscount',
            'totalFinal'
            ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'voucher_id' => 'nullable|exists:vouchers,id'
        ]);
        
        $items = [[
            'product_id' => $request->product_id,
            'quantity' => $request->quantity
        ]];
        
        try {
            $result = TransactionService::processOrder(auth()->id(), $items, $request->voucher_id);

            return redirect()->route('transactions.success')
                ->with('success', 'Pesanan Anda berhasil dibuat!')
                ->with('earnedPoints', $result['points'])
                ->with('transaction_id', $result['transaction']->id);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $transaction = Transaction::with('transactionItems.product')->findOrFail($id);

        return view('transactions.show', compact('transaction'));
    }
  
    public function success()
    {
        return view('transactions.success');
    }
}
