@extends('layouts.app')
@section('title', 'Profil Pengguna')

@section('content')
@php
  $role = session('role') ?? (strtolower(session('nama')) === 'admin' ? 'admin' : 'pelanggan');
@endphp

<div class="max-w-5xl mx-auto px-6 mb-16">

  <div class="text-center mb-10">
    <h2 class="text-3xl font-bold text-orange-600">Profil {{ ucfirst($role) }}</h2>
    <p class="text-gray-600 mt-1">
      {{ $role === 'admin' ? 'Kelola sistem pelanggan dan pantau data jaringan' : 'Informasi akun MatahariWiFi kamu 🌞' }}
    </p>
  </div>

  <div class="bg-gradient-to-br from-orange-50 to-pink-50 shadow-lg rounded-2xl p-8 relative overflow-hidden border border-orange-100">
    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-orange-500 via-pink-500 to-red-400"></div>

    <div class="flex flex-col md:flex-row items-center gap-8">
      <div class="relative">
        <div class="h-32 w-32 rounded-full bg-gradient-to-tr from-orange-400 to-pink-500 flex items-center justify-center text-white text-5xl font-bold shadow-lg">
          {{ strtoupper(substr(session('nama') ?? 'P', 0, 1)) }}
        </div>
        @if($role === 'pelanggan')
          <button class="absolute bottom-2 right-2 bg-white text-orange-600 rounded-full p-2 shadow hover:bg-orange-50 transition">
            📷
          </button>
        @endif
      </div>

      <div class="flex-1 space-y-3">
        <h3 class="text-2xl font-semibold text-gray-800">{{ ucfirst(session('nama') ?? 'Pelanggan') }}</h3>
        <p class="text-gray-600">📧 {{ strtolower(session('nama') ?? 'user') }}@matahariwifi.id</p>
        <p class="text-gray-600">👤 Role:
          <span class="font-semibold {{ $role === 'admin' ? 'text-red-500' : 'text-orange-600' }}">
            {{ ucfirst($role) }}
          </span>
        </p>
        <p class="text-gray-600">📶 Status: 
          <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-semibold">Aktif</span>
        </p>

        <div class="flex gap-3 mt-4 flex-wrap">
          <button id="editBtn" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-5 py-2 rounded-lg shadow-md transition">
            ✏️ Edit Profil
          </button>

          @if($role === 'admin')
            <a href="{{ route('pengelolaan') }}" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-5 py-2 rounded-lg shadow-md transition">
              ⚙️ Kelola Data
            </a>
          @endif
        </div>
      </div>
    </div>
  </div>

  @if($role === 'admin')
    <div class="grid md:grid-cols-3 gap-6 mt-10">
      <div class="bg-white border border-orange-100 p-6 rounded-xl shadow hover:shadow-lg transition text-center">
        <h4 class="text-lg font-semibold text-gray-700 mb-1">👥 Total Pelanggan</h4>
        <p class="text-3xl font-bold text-orange-600">132</p>
      </div>

      <div class="bg-white border border-green-100 p-6 rounded-xl shadow hover:shadow-lg transition text-center">
        <h4 class="text-lg font-semibold text-gray-700 mb-1">✅ Aktif</h4>
        <p class="text-3xl font-bold text-green-600">92</p>
      </div>

      <div class="bg-white border border-red-100 p-6 rounded-xl shadow hover:shadow-lg transition text-center">
        <h4 class="text-lg font-semibold text-gray-700 mb-1">🚫 Nonaktif</h4>
        <p class="text-3xl font-bold text-red-500">40</p>
      </div>
    </div>

    <div class="bg-white rounded-2xl shadow-lg p-6 mt-10 border border-orange-100">
      <h4 class="text-xl font-semibold text-gray-800 mb-4">📊 Statistik Jaringan</h4>
      <canvas id="adminChart" height="100"></canvas>
    </div>
  @else
    <div class="grid md:grid-cols-2 gap-6 mt-10">
      <div class="bg-white border border-orange-100 p-6 rounded-xl shadow hover:shadow-lg transition">
        <h4 class="text-lg font-semibold text-gray-700 mb-2">📦 Paket Internet</h4>
        <p class="text-gray-600">Gold – 25 Mbps</p>
        <p class="text-gray-600">Tagihan Bulanan: <span class="font-semibold text-orange-600">Rp 200.000</span></p>
      </div>

      <div class="bg-white border border-orange-100 p-6 rounded-xl shadow hover:shadow-lg transition">
        <h4 class="text-lg font-semibold text-gray-700 mb-2">🕒 Aktivitas Terakhir</h4>
        <p class="text-gray-600">Login terakhir: <span id="lastLogin" class="font-semibold"></span></p>
        <p class="text-gray-600">Status akun: <span class="text-green-600 font-semibold">Aman ✅</span></p>
      </div>
    </div>
  @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const el = document.getElementById('lastLogin');
  if (el) el.textContent = new Date().toLocaleString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' });

  const ctx = document.getElementById('adminChart');
  if (ctx) {
    new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['Bronze', 'Silver', 'Gold', 'Platinum', 'Diamond', 'Enterprise'],
        datasets: [{
          data: [20, 25, 30, 25, 15, 10],
          backgroundColor: ['#fdba74','#fbbf24','#f59e0b','#34d399','#60a5fa','#a78bfa'],
          borderWidth: 2,
          borderColor: '#fff'
        }]
      },
      options: {
        plugins: {
          legend: { position: 'bottom', labels: { color: '#374151' } }
        },
        cutout: '70%'
      }
    });
  }

  document.getElementById('editBtn').addEventListener('click', () => {
    alert('Fitur edit profil sedang dalam pengembangan ✨');
  });
</script>
@endsection
