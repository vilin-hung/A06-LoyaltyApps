<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
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
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('transactions.order', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
        
        $items = [['product_id' => $request->product_id, 'quantity' => $request->quantity]];
        
        try {
            $result = TransactionService::processOrder(auth()->id(), $items);
            return redirect()->route('transactions.success')
                ->with('earnedPoints', $result['points'])
                ->with('discountNominal', 0);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMesssage());
        }
    // }
    //     $user = Auth::user();        
    //     $product = Product::findOrFail($request->product_id);
    //     $subtotal = $product->price * $request->quantity;

    //     // Mengambil persentase diskon dari tier user (0, 5, atau 10)
    //     $discountPercentage = $user->membership->discount_percentage;
    //     $discountNominal = $subtotal * ($discountPercentage / 100);
    //     $finalAmount = $subtotal - $discountNominal;    

    //     // cek saldo user
    //     if ($user->saldo < $finalAmount) {
    //         return back()->with('error', 'Saldo tidak mencukupi.');
    //     }

    //     // Menghitung poin, ambil multiplier berdasarkan tier user saat ini
    //     $multiplier = $user->membership->point_multiplier; 
    //     $basePoints = floor($finalAmount / 30000);
    //     $earnedPoints = $basePoints * $multiplier;

    //     // simpan transaksi
    //     $transaction = new Transaction();
    //     $transaction->user_id = $user->id; 
    //     $transaction->total_amount = $finalAmount;
    //     $transaction->points_earned = $earnedPoints;
    //     $transaction->save();
        
    //     // update user
    //     $user->saldo -= $finalAmount;
    //     $user->total_spent += $finalAmount; 
    //     $user->points += $earnedPoints;

    //     // update membership (naik tier atau tidak)
    //     if ($user->total_spent >= 800000) {
    //         $user->membership_id = 3; // Tier membership diupdate ke Platinum
    //     } elseif ($user->total_spent >= 300000) {
    //         $user->membership_id = 2; // Tier membership diupdate ke Gold
    //     } else {
    //         $user->membership_id = 1; // Tier membership tetap di Silver
    //     }

    //     $user->save();
    //     return redirect()->route('transactions.success')
    //         ->with('earnedPoints', $earnedPoints)
    //         ->with('discountNominal', $discountNominal);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    // Menampilkan riwayat transaksi user
    public function history()
    {
        $transactions = Transaction::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('transactions.history', compact('transactions'));
    }
  
    public function success()
    {
        if (!session()->has('earnedPoints')) {
            return redirect()->route('transactions.history');
        }
        return view('transactions.success');
    }
}
