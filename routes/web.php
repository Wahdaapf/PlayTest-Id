<?php

use Illuminate\Support\Facades\Route;

use App\Models\Paket;

Route::get('/', function () {
    $pakets = Paket::where('aktif', true)->orderBy('price', 'asc')->get();
    return view('welcome', compact('pakets'));
});

