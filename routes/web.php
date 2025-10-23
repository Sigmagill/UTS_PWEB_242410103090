<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    if (session('nama')) {
        return redirect()->route('dashboard');
    }
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {
    $nama = trim($request->input('username'));

    if (empty($nama)) {
        return back()->withErrors(['username' => 'Nama tidak boleh kosong']);
    }

    $role = ($nama === 'admin') ? 'admin' : 'pelanggan';

    session([
        'nama' => $nama,
        'role' => $role
    ]);

    return redirect()->route('dashboard');
})->name('doLogin');

Route::get('/dashboard', function () {
    if (!session('nama')) {
        return redirect()->route('login');
    }

    $nama = session('nama');
    $role = session('role');

    return view('dashboard', compact('nama', 'role'));
})->name('dashboard');

Route::get('/pengelolaan', function () {
    if (!session('nama')) {
        return redirect()->route('login');
    }

    if (session('role') !== 'admin') {
        return redirect()->route('dashboard');
    }

    $nama = session('nama');
    return view('pengelolaan', compact('nama'));
})->name('pengelolaan');

Route::get('/profile', function () {
    if (!session('nama')) {
        return redirect()->route('login');
    }

    $nama = session('nama');
    $role = session('role');

    return view('profile', compact('nama', 'role'));
})->name('profile');

Route::get('/paket', function () {
    if (!session('nama')) {
        return redirect()->route('login');
    }

    $nama = session('nama');
    $role = session('role');

    return view('paket', compact('nama', 'role'));
})->name('paket');

Route::post('/logout', function () {
    session()->flush();
    return redirect()->route('login');
})->name('logout');
