<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
        $vouchers = Voucher::all();

        return view('transactions.create', compact('product', 'quantity', 'vouchers'));
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
                ->with('earnedPoints', $result['points'])
                ->with('success', 'Pesanan Anda berhasil dibuat!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        if($transaction->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('transactions.order', compact('transaction'));
    }
  
    public function success()
    {
        if (!session()->has('earnedPoints')) {
            return redirect()->route('transactions.index');
        }
        return view('transactions.success');
    }
}
