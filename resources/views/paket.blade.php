@extends('layouts.app')
@section('title', 'Daftar Paket Internet')

@section('content')
<div class="max-w-6xl mx-auto mb-16 px-4 md:px-8">

  <div class="text-center mb-10">
    <h2 class="text-3xl font-bold text-orange-600">🌞 Daftar Paket Internet</h2>
    <p class="text-gray-500 mt-2">
      {{ session('role') === 'admin' ? 'Kelola paket dan ubah detail harga di bawah ini' : 'Pilih paket terbaik untuk kebutuhan internet Anda' }}
    </p>
  </div>

  <div class="flex justify-center mb-8">
    <div class="bg-orange-100 rounded-full h-24 w-24 flex items-center justify-center text-orange-700 text-3xl font-bold shadow-inner">
      {{ strtoupper(substr(session('nama') ?? 'P', 0, 2)) }}
    </div>
  </div>

  <div class="flex justify-center mb-10">
    <p class="text-gray-700 text-lg font-medium">
      Hai, <span class="text-orange-600">{{ ucfirst(session('nama') ?? 'Pelanggan') }}</span>!  
      Yuk {{ session('role') === 'admin' ? 'kelola paket internet pelanggan' : 'pilih paket terbaik dari' }} <strong>MatahariWiFi</strong> ☀️
    </p>
  </div>

  <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
    @php
      $paketList = [
        ['Bronze', '5 Mbps', 'Rp 90.000', ['Gratis Instalasi', 'Dukungan 24/7', 'Cocok untuk kebutuhan dasar']],
        ['Silver', '10 Mbps', 'Rp 120.000', ['Gratis Instalasi', 'Dukungan 24/7', 'Cocok untuk rumah tangga kecil']],
        ['Gold', '25 Mbps', 'Rp 200.000', ['Gratis Modem WiFi', 'Prioritas Dukungan', 'Kecepatan stabil hingga 25 Mbps']],
        ['Platinum', '50 Mbps', 'Rp 300.000', ['IP Static (Opsional)', 'Layanan Cloud', 'Direkomendasikan untuk bisnis kecil']],
        ['Diamond', '75 Mbps', 'Rp 450.000', ['Modem & Router Premium', 'SLA Jaminan 99.9%', 'Direkomendasikan untuk kantor']],
        ['Enterprise', '100 Mbps', 'Rp 600.000', ['Dedicated Bandwidth', 'IP Static + VPN Support', 'Layanan Prioritas Perusahaan']]
      ];
    @endphp

    @foreach ($paketList as $index => $paket)
    <div class="bg-white shadow-md rounded-2xl p-6 text-center hover:shadow-xl hover:-translate-y-1 transition-all relative">
      @if ($index === 2)
      <span class="absolute top-2 right-4 bg-orange-500 text-white text-xs font-semibold px-3 py-0.5 rounded-full shadow-sm">
        Populer
      </span>
      @endif

      <h4 class="text-xl font-semibold text-gray-800">Paket {{ $paket[0] }}</h4>
      <p class="text-sm text-gray-500 mb-2">Download/Upload {{ $paket[1] }}</p>
      <p class="text-2xl font-bold text-orange-600 mb-3">{{ $paket[2] }}</p>

      <ul class="text-gray-600 text-sm text-left space-y-1 mb-4">
        @foreach ($paket[3] as $fitur)
          <li>✅ {{ $fitur }}</li>
        @endforeach
      </ul>

      @if (session('role') === 'admin')
        <button class="bg-orange-100 text-orange-600 font-semibold px-5 py-2 rounded-lg shadow-sm hover:bg-orange-200 transition">
          ✏️ Edit Paket
        </button>
      @else
        <button class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-5 py-2 rounded-lg shadow-md transition-all hover:scale-[1.03]">
          Pilih Paket Ini
        </button>
      @endif
    </div>
    @endforeach
  </div>

  <p class="text-center text-gray-500 mt-10">
    💬 Butuh rekomendasi paket terbaik?  
    <a href="#" class="text-orange-600 hover:underline font-medium">Chat Admin Kami</a>.
  </p>

</div>
@endsection
