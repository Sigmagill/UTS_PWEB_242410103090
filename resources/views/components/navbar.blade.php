<nav class="bg-white shadow-md px-6 py-3 flex justify-between items-center sticky top-0 z-40">
  <div class="flex items-center space-x-3">
    <button class="text-orange-600 text-2xl md:hidden" onclick="toggleSidebar()">☰</button>
    <h1 class="text-xl font-bold text-orange-600">☀️ MatahariWiFi</h1>
  </div>

  <div class="hidden md:flex items-center space-x-6">
    <p class="text-gray-700">👋 Halo, <span class="font-semibold text-orange-600">{{ ucfirst(session('nama')) }}</span>
    </p>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
    </form>
  </div>
</nav>