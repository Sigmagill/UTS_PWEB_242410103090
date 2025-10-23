<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | MatahariWiFi ☀️</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    @keyframes pulse {
      0%, 100% { transform: scale(1); opacity: 1; }
      50% { transform: scale(1.05); opacity: 0.9; }
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-orange-100 via-white to-orange-50">

  <div id="loginBox" class="bg-white/80 backdrop-blur-md rounded-2xl shadow-2xl p-10 w-[90%] max-w-md text-center opacity-0 translate-y-5 transition-all duration-700">
    <div class="flex justify-center mb-6">
      <div class="relative">
        <div class="absolute inset-0 bg-orange-200 rounded-full blur-xl opacity-60 animate-pulse"></div>
        <svg class="relative z-10 w-20 h-20 text-orange-500 animate-spin-slow" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
            d="M12 4v2m0 12v2m8-8h2M4 12H2m15.36-6.36l1.42 1.42M6.22 17.78l-1.42 1.42m0-12.72l1.42 1.42m12.72 12.72l-1.42-1.42"/>
        </svg>
      </div>
    </div>
    <h2 class="text-2xl font-bold text-orange-600 mb-2">Selamat Datang di</h2>
    <h1 class="text-3xl font-extrabold text-gray-800 mb-6">MatahariWiFi ☀️</h1>

    @if(session('error'))
      <div class="bg-red-100 text-red-600 text-sm p-3 rounded-lg mb-4">
        {{ session('error') }}
      </div>
    @endif

    <form method="POST" action="{{ route('doLogin') }}" onsubmit="return handleLogin(event)">
      @csrf
      <div class="mb-4 text-left">
        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Nama Pelanggan</label>
        <input type="text" id="username" name="username" placeholder="Masukkan nama Anda..."
               required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none transition">
      </div>

      <div class="relative mb-4 text-left">
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input type="password" id="password" name="password" placeholder="••••••••"
               required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none transition">
        <button type="button" id="togglePassword" class="absolute right-3 top-9 text-gray-500 hover:text-orange-500">
          👁️
        </button>
      </div>

      <button id="loginBtn" type="submit" 
              class="w-full mt-3 bg-orange-500 hover:bg-orange-600 text-white py-2 rounded-lg font-semibold shadow-md transition-all transform hover:scale-[1.02]">
        🔐 Masuk
      </button>
    </form>

    <p class="text-gray-500 text-sm mt-6">
      Tetap terkoneksi bersama <strong class="text-orange-600">MatahariWiFi</strong> 🌞
    </p>
  </div>

  <script>
    window.addEventListener('load', () => {
      const box = document.getElementById('loginBox');
      setTimeout(() => {
        box.classList.remove('opacity-0', 'translate-y-5');
        box.classList.add('opacity-100', 'translate-y-0');
      }, 300);
    });

    function handleLogin(e) {
      e.preventDefault();
      const btn = document.getElementById('loginBtn');
      btn.disabled = true;
      btn.innerHTML = '⏳ Sedang Memproses...';
      btn.classList.add('animate-pulse');
      setTimeout(() => e.target.submit(), 1200);
      return false;
    }

    document.querySelectorAll('.animate-spin-slow').forEach(el => {
      el.style.animation = 'spin 5s linear infinite';
    });

    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');
    togglePassword.addEventListener('click', () => {
      const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordField.setAttribute('type', type);
      togglePassword.textContent = type === 'password' ? '👁️' : '🙈';
    });
  </script>
</body>
</html>
