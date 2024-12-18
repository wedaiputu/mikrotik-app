<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;
use Illuminate\Support\Facades\Auth;

class VoucherController extends Controller
{
    // Menampilkan form untuk membuat voucher
    public function create()
    {
        return view('vouchers.create');
    }

    // Menyimpan voucher yang baru dibuat
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'durasi' => 'required|integer',
            'paket_voucher' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Menyimpan logo yang diupload
        $logoPath = $request->file('logo')->store('public/logos');

        
        $voucher = new Voucher();
        $voucher->name = $request->name;
        $voucher->password = $request->password;
        $voucher->durasi = $request->durasi;
        $voucher->paket_voucher = $request->paket_voucher;
        $voucher->logo = $logoPath;
        $voucher->profile = session('profile'); 
        $voucher->save();

        return redirect()->route('vouchers.create')->with('success', 'Voucher berhasil dibuat!');
    }
}
