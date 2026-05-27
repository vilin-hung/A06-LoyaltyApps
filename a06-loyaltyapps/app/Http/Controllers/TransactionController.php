<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi agar total_amount wajib diisi
        $request->validate([
            'total_amount' => 'required|numeric|min:1'
        ]);

        // Mengambil data user yang sedang login
        $user = Auth::user();
        // Total belanja awal user sebelum diskon
        $subtotal = $request->total_amount;
        // Mengambil persentase diskon dari tier user (0, 5, atau 10)
        $discountPercentage = $user->membership->discount_percentage;
        $discountNominal = $subtotal * ($discountPercentage / 100);
        $finalAmount = $subtotal - $discountNominal;    

        $transaction = new Transaction();
        $transaction->user_id = Auth::id(); // Menyimpan ID user yang login
        $transaction->total_amount = $finalAmount;
        $transaction->save();
        
        // Mengambil nilai pengali (multiplier) berdasarkan tier user saat ini
        $multiplier = $user->membership->point_multiplier; 
        $basePoints = floor($finalAmount / 30000);
        $earnedPoints = $basePoints * $multiplier;

        // Tambahkan poin dan total belanjaan ke tabel user
        $user->current_points += $earnedPoints;
        $user->total_spent += $finalAmount; 

        // Mengecek apakah user dapat naik tier setelah transaksi
        if ($user->total_spent >= 800000) {
            $user->membership_id = 3; // Tier membership diupdate ke Platinum
        } elseif ($user->total_spent >= 300000) {
            $user->membership_id = 2; // Tier membership diupdate ke Gold
        } else {
            $user->membership_id = 1; // Tier membership tetap di Silver
        }

        $user->save();
        return redirect()->back()->with('success', 'Transaksi berhasil! Anda mendapatkan ' . $earnedPoints . ' poin.');
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
}
