<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index()
    {
        if (auth()->check() && auth()->user()->role === 'admin') {
            $vouchers = Voucher::latest()->get();
        } else {
            $vouchers = Voucher::where('is_active', true)->latest()->get();
        }
        
        return view('vouchers.index', compact('vouchers'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        return view('vouchers.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|unique:vouchers,name|max:255',
            'code' => 'required|string|unique:vouchers,code|max:50',
            'deskripsi' => 'nullable|string',
            'points_yang_dibutuhkan' => 'required|integer|min:0|max:25',
            'tipe_diskon' => 'required|in:percentage,fixed',
            'nilai_diskon' => 'required|integer|min:0',
            'kuota' => 'required|integer|min:0',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_berakhir' => 'nullable|date|after_or_equal:tanggal_mulai',
        ], [
            'code.unique' => 'Kode sudah ada, silahkan gunakaan kode lain',
            'name.unique' => 'Nama voucher sudah ada, silahkan gunakan nama lain',
        ]);

        $voucherData = [
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->deskripsi,
            'points_required' => $request->points_yang_dibutuhkan,
            'discount_type' => $request->tipe_diskon,
            'discount_value' => $request->nilai_diskon,
            'quota' => $request->kuota,
            'start_date' => $request->tanggal_mulai,
            'end_date' => $request->tanggal_berakhir,
            'is_active' => $request->has('status'),
        ];

        Voucher::create($voucherData);

        return redirect()->route('vouchers.index')->with('success', 'Voucher berhasil ditambahkan!');
    }

    public function show(Voucher $voucher)
    {
        return view('vouchers.show', compact('voucher'));
    }

    public function edit(Voucher $voucher)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        return view('vouchers.edit', compact('voucher'));
    }

    public function update(Request $request, Voucher $voucher)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255|unique:vouchers,name,' . $voucher->id,
            'code' => 'required|string|max:50|unique:vouchers,code,' . $voucher->id,
            'deskripsi' => 'nullable|string',
            'points_yang_dibutuhkan' => 'required|integer|min:0|max:25',
            'tipe_diskon' => 'required|in:percentage,fixed',
            'nilai_diskon' => 'required|integer|min:0',
            'kuota' => 'required|integer|min:0',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_berakhir' => 'nullable|date|after_or_equal:tanggal_mulai',
        ],[
            'code.unique' => 'Kode sudah ada, silahkan gunakan kode lain',
            'name.unique' => 'Nama voucher sudah ada, silahkan gunakan nama lain',
        ]);

        $voucherData = [
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->deskripsi,
            'points_required' => $request->points_yang_dibutuhkan,
            'discount_type' => $request->tipe_diskon,
            'discount_value' => $request->nilai_diskon,
            'quota' => $request->kuota,
            'start_date' => $request->tanggal_mulai,
            'end_date' => $request->tanggal_berakhir,
            'is_active' => $request->has('status'),
        ];

        $voucher->update($voucherData);

        return redirect()->route('vouchers.index')->with('success', 'Voucher berhasil diperbarui!');
    }

    public function destroy(Voucher $voucher)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        $voucher->delete();
        return redirect()->route('vouchers.index')->with('success', 'Voucher berhasil dihapus!');
    }
}