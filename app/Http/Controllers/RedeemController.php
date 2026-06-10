<?php

namespace App\Http\Controllers;

use App\Models\Redeem;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedeemController extends Controller
{
    public function index()
    {
        $redeems = Redeem::where('user_id', Auth::id())->get();

        return view('redeem.index', compact('redeems'));
    }

    public function create()
    {
        $vouchers = Voucher::where('is_active', true)
            ->where('quota', '>' ,0)
            ->get();

        return view('redeem.create', compact('vouchers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'voucher_id' => 'required|exists:vouchers,id',
        ]);

        $user = Auth::user();
        $voucher = Voucher::find($request->voucher_id);

        if(!$voucher->is_active) {
            return back()->with('error', 'Voucher tidak aktif');
        }
        
        if ($user->points < $voucher->points_required) {
            return back()->with('error', 'Poin tidak cukup');
        }


        if ($voucher->quota <= 0) {
            return back()->with('error', 'Voucher habis');
        }

        Redeem::create([
            'user_id' => $user->id,
            'voucher_id' => $voucher->id,
            'points_spent' => $voucher->points_required,
        ]);

        $user->points -= $voucher->points_required;
        $user->save();

        $voucher->quota -= 1;
        $voucher->save();

        return redirect()
            ->route('redeems.index')
            ->with('success', 'Voucher berhasil ditukarkan');
    }

    public function show(Redeem $redeem)
    {
        return view('redeem.show', compact('redeem'));
    }

    public function edit(Redeem $redeem)
    {
        $vouchers = Voucher::all();

        return view('redeem.edit', compact('redeem', 'vouchers'));
    }

    public function update(Request $request, Redeem $redeem)
    {
        $request->validate([
            'voucher_id' => 'required|exists:vouchers,id',
        ]);

        $redeem->update([
            'voucher_id' => $request->voucher_id,
        ]);

        return redirect()->route('redeems.index');
    }

    public function destroy(Redeem $redeem)
    {
        $redeem->delete();

        return redirect()->route('redeems.index');
    }
}