<aside id="sidebar"
  class="fixed md:static inset-y-0 left-0 w-64 bg-gradient-to-b from-orange-500 to-orange-600 text-white transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-50 shadow-lg">
  
  <div class="flex items-center justify-between p-5 border-b border-orange-400">
    <h2 class="text-lg font-bold">☀️ MatahariWiFi</h2>
    <button class="md:hidden text-white text-2xl" onclick="toggleSidebar()">×</button>
  </div>

  <div class="p-4 text-center border-b border-orange-400">
    <p class="text-sm opacity-90">Selamat datang,</p>
    <p class="font-semibold text-lg">{{ ucfirst(session('nama')) }}</p>
    <p class="text-xs opacity-75 mt-1 italic">
      {{ session('role') === 'admin' ? 'Admin' : 'Pelanggan' }}
    </p>
  </div>

  <nav class="mt-6 flex flex-col space-y-2 px-4">
    <a href="{{ route('dashboard') }}"
      class="flex items-center gap-3 px-4 py-2 rounded-lg transition 
      hover:bg-orange-700 {{ request()->is('dashboard') ? 'bg-orange-700 font-semibold' : '' }}">
      🏠 <span>Dashboard</span>
    </a>

    @if (session('role') === 'admin')
    <a href="{{ route('pengelolaan') }}"
      class="flex items-center gap-3 px-4 py-2 rounded-lg transition 
      hover:bg-orange-700 {{ request()->is('pengelolaan') ? 'bg-orange-700 font-semibold' : '' }}">
      ⚙️ <span>Pengelolaan</span>
    </a>
    @endif

    <a href="{{ route('paket') }}" 
      class="flex items-center gap-3 px-4 py-2 rounded-lg transition 
      {{ Request::is('paket') ? 'bg-orange-700 font-semibold' : 'hover:bg-orange-700' }}">
      📦 <span>Paket Internet</span>
    </a>

    <a href="{{ route('profile') }}"
      class="flex items-center gap-3 px-4 py-2 rounded-lg transition 
      hover:bg-orange-700 {{ request()->is('profile') ? 'bg-orange-700 font-semibold' : '' }}">
      👤 <span>Profil</span>
    </a>
  </nav>

  <div class="absolute bottom-6 left-0 w-full px-4">
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit"
        class="w-full bg-white text-orange-600 font-semibold py-2 rounded-lg hover:bg-orange-100 transition">
        🚪 Logout
      </button>
    </form>
  </div>
</aside>

<script>
  function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('-translate-x-full');
  }
</script>
