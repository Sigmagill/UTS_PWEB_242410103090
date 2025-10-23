<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title') | MatahariWiFi ☀️</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background: linear-gradient(135deg, #f8fafc 0%, #eef2ff 100%);
      font-family: 'Poppins', sans-serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    .card {
      @apply bg-white rounded-xl shadow-lg p-6 transition-transform duration-300 hover:shadow-xl hover:scale-[1.02];
    }
  </style>
</head>
<body class="flex flex-col min-h-screen text-gray-800">
  @if (!Request::is('/') && !Request::is('login'))
    @include('components.navbar')
  @endif

  <div class="flex flex-grow">
    @if (!Request::is('/') && !Request::is('login'))
      @include('components.sidebar')
    @endif

    <main class="flex-1 p-8 md:p-10 overflow-y-auto">
      <div id="page-content" class="opacity-0 translate-y-3 transition-all duration-500 ease-out">
        @yield('content')
      </div>
    </main>
  </div>

  @include('components.footer')

  <script>
    window.addEventListener('load', () => {
      const el = document.getElementById('page-content');
      el.classList.remove('opacity-0', 'translate-y-3');
      el.classList.add('opacity-100', 'translate-y-0');
    });
  </script>
</body>
</html>
