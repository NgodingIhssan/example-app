<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarcodeController extends Controller
{
    public function generate($kode)
    {
        // Logic generate barcode berdasarkan $kode
        return view('barcode.show', compact('kode'));
    }
}

