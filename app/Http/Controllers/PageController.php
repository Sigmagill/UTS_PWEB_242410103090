<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function login() {
        return view('login');
    }

    public function doLogin(Request $request) {
        $username = $request->input('username');
        return redirect()->route('dashboard', ['username' => $username]);
    }

    public function dashboard(Request $request) {
        $username = $request->query('username', 'Pelanggan');
        $data = [
            'username' => $username,
            'paket' => 'Paket Silver - 30 Mbps',
            'status' => 'AKTIF',
            'tagihan' => 250000,
            'jatuh_tempo' => '25 November 2025'
        ];
        return view('dashboard', $data);
    }

    public function profile(Request $request) {
        $username = $request->query('username', 'Pelanggan');
        return view('profile', compact('username'));
    }
}
