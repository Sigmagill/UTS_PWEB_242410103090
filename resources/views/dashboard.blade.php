@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
@php
  $role = session('role') ?? (strtolower(session('nama')) === 'admin' ? 'admin' : 'pelanggan');
@endphp

@if ($role === 'admin')
  <div class="max-w-7xl mx-auto px-6 mb-16">
    <div class="text-center mb-10">
      <h2 class="text-3xl font-bold text-orange-600">☀️ Dashboard Admin</h2>
      <p class="text-gray-500 mt-1">Selamat datang kembali, <strong>{{ ucfirst(session('nama')) }}</strong> 👋</p>
    </div>

    <div class="grid md:grid-cols-4 gap-6 mb-10">
      <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition">
        <p class="text-gray-600 mb-2">👥 Total Pelanggan</p>
        <h3 class="text-3xl font-bold text-orange-600">{{ $totalPelanggan ?? 120 }}</h3>
      </div>
      <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition">
        <p class="text-gray-600 mb-2">💡 Paket Aktif</p>
        <h3 class="text-3xl font-bold text-green-500">{{ $paketAktif ?? 6 }}</h3>
      </div>
      <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition">
        <p class="text-gray-600 mb-2">💰 Pendapatan Bulan Ini</p>
        <h3 class="text-3xl font-bold text-orange-500">{{ $pendapatan ?? 'Rp 20.610.000' }}</h3>
      </div>
      <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition">
        <p class="text-gray-600 mb-2">🛠️ Tiket Laporan</p>
        <h3 class="text-3xl font-bold text-red-500">{{ $tiket ?? '3 Pending' }}</h3>
      </div>
    </div>

    <div class="grid md:grid-cols-2 gap-8">
      <div class="bg-white rounded-2xl shadow-lg p-6">
        <h4 class="text-lg font-semibold text-gray-700 mb-3">📈 Pertumbuhan Pelanggan (6 Bulan)</h4>
        <canvas id="growthChart" height="120"></canvas>
      </div>
      <div class="bg-white rounded-2xl shadow-lg p-6">
        <h4 class="text-lg font-semibold text-gray-700 mb-3">💹 Pendapatan per Paket</h4>
        <canvas id="incomeChart" height="120"></canvas>
      </div>
    </div>

    <div class="bg-white rounded-2xl shadow-lg p-6 mt-10">
      <h4 class="text-lg font-semibold text-gray-700 mb-4">🧾 Daftar Pelanggan Aktif</h4>
      <table class="w-full border-collapse">
        <thead class="bg-orange-500 text-white text-sm uppercase">
          <tr>
            <th class="py-3 px-4 text-left">Nama</th>
            <th class="py-3 px-4 text-left">Paket</th>
            <th class="py-3 px-4 text-left">Status</th>
            <th class="py-3 px-4 text-left">Tagihan</th>
          </tr>
        </thead>
        <tbody class="text-gray-700 text-sm">
          <tr class="border-b hover:bg-orange-50">
            <td class="py-3 px-4">Agil</td>
            <td class="py-3 px-4">Gold – 25 Mbps</td>
            <td class="py-3 px-4"><span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">Aktif</span></td>
            <td class="py-3 px-4">Rp 200.000</td>
          </tr>
          <tr class="border-b hover:bg-orange-50">
            <td class="py-3 px-4">Rauda</td>
            <td class="py-3 px-4">Platinum – 50 Mbps</td>
            <td class="py-3 px-4"><span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">Aktif</span></td>
            <td class="py-3 px-4">Rp 300.000</td>
          </tr>
          <tr class="hover:bg-orange-50">
            <td class="py-3 px-4">Eka</td>
            <td class="py-3 px-4">Diamond – 75 Mbps</td>
            <td class="py-3 px-4"><span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">Aktif</span></td>
            <td class="py-3 px-4">Rp 450.000</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

@else
  <div class="text-center mb-8">
    <h2 class="text-2xl font-bold text-orange-600">Halo, {{ ucfirst(session('nama') ?? 'Pelanggan') }} 👋</h2>
    <p class="text-gray-600 mt-1">Selamat datang di portal pelanggan <strong>MatahariWiFi</strong>.</p>
  </div>

  <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-md p-6 mb-8 text-center hover:shadow-lg transition">
    <h3 class="text-lg font-semibold text-gray-700 mb-2">Status Langganan Anda</h3>
    <p class="text-2xl font-bold text-orange-600 mb-3">Paket Gold - 25 Mbps</p>
    <span class="bg-green-500 text-white px-4 py-1 rounded-full text-sm font-medium">AKTIF</span>
    <p class="text-gray-500 mt-3 text-sm">Pembayaran berikutnya pada <strong>25 November 2025</strong></p>
  </div>

  <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
    <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition">
      <h4 class="text-gray-800 font-semibold mb-2">Tagihan Bulan Ini</h4>
      <p class="text-2xl font-bold text-orange-600 mb-3">Rp 200.000</p>
      <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm">LUNAS</span>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition">
      <h4 class="text-gray-800 font-semibold mb-2">Dukungan Teknis</h4>
      <p class="text-gray-600 text-sm mb-3">Mengalami gangguan? Jangan ragu hubungi kami.</p>
      <a href="#" class="inline-flex items-center bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm transition">
        💬 Chat Admin Sekarang
      </a>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition">
      <h4 class="text-gray-800 font-semibold mb-2">Tingkatkan Kecepatan</h4>
      <p class="text-gray-600 text-sm mb-3">Lihat paket lain untuk koneksi lebih cepat.</p>
      <a href="{{ route('paket') }}" class="text-orange-600 hover:underline font-medium text-sm">
        🔍 Lihat Semua Paket
      </a>
    </div>
  </div>

  <p class="text-center text-gray-500 mt-10 text-sm">
    Terima kasih telah menggunakan layanan <strong>MatahariWiFi</strong> ☀️  
    Semoga koneksi Anda selalu cepat dan stabil!
  </p>
@endif

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const role = "{{ $role }}";
  if (role === 'admin') {
    const growthCtx = document.getElementById('growthChart').getContext('2d');
    new Chart(growthCtx, {
      type: 'line',
      data: {
        labels: ['Mei','Jun','Jul','Agu','Sep','Okt'],
        datasets: [{
          data:[60,75,90,105,115,120],
          borderColor:'#f97316',
          backgroundColor:'rgba(249,115,22,0.15)',
          fill:true, borderWidth:3, tension:0.4
        }]
      },
      options:{plugins:{legend:{display:false}},scales:{y:{beginAtZero:true}}}
    });

    const incomeCtx = document.getElementById('incomeChart').getContext('2d');
    new Chart(incomeCtx, {
      type:'bar',
      data:{
        labels:['Bronze','Silver','Gold','Platinum','Diamond','Enterprise'],
        datasets:[{
          data:[810000,1200000,2400000,3000000,4500000,6000000],
          backgroundColor:['#fdba74','#d1d5db','#f97316','#34d399','#60a5fa','#a78bfa']
        }]
      },
      options:{plugins:{legend:{display:false}},scales:{y:{beginAtZero:true}}}
    });
  }
</script>
@endsection
