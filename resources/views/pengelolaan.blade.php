@extends('layouts.app')
@section('title', 'Pengelolaan Data')

@section('content')
<div class="max-w-7xl mx-auto mb-16 px-4 md:px-8">

  <div class="text-center mb-10">
    <h2 class="text-3xl font-bold text-orange-600">Pengelolaan Data Pelanggan</h2>
    <p class="text-gray-500 mt-1">Kelola data pelanggan dan paket langganan dengan mudah</p>
  </div>

  <div class="bg-white shadow-lg rounded-2xl p-6 overflow-x-auto">
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
      <div class="flex items-center gap-3">
        <div class="h-10 w-10 bg-orange-100 text-orange-600 rounded-full flex items-center justify-center font-bold">
          {{ strtoupper(substr(session('nama') ?? 'P', 0, 2)) }}
        </div>
        <div>
          <p class="font-semibold text-gray-700">Halo, {{ ucfirst(session('nama') ?? 'Pelanggan') }}</p>
          <p class="text-sm text-gray-500">Selamat mengelola data Anda 🔧</p>
        </div>
      </div>

      <input type="text" id="searchInput" placeholder="🔍 Cari pelanggan..."
        class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-orange-400 outline-none w-full md:w-60">
    </div>

    @php
      $pelanggan = [
        ['Agil', 'Gold – 25 Mbps', 'Aktif', 'Rp 200.000'],
        ['Rauda', 'Platinum – 50 Mbps', 'Aktif', 'Rp 300.000'],
        ['Citra', 'Bronze – 5 Mbps', 'Nonaktif', 'Rp 90.000'],
        ['Dewi', 'Platinum – 50 Mbps', 'Aktif', 'Rp 500.000'],
        ['Eka', 'Diamond – 75 Mbps', 'Aktif', 'Rp 450.000'],
        ['Fajar', 'Silver – 10 Mbps', 'Nonaktif', 'Rp 120.000'],
        ['Gina', 'Gold – 25 Mbps', 'Aktif', 'Rp 200.000'],
        ['Hari', 'Bronze – 5 Mbps', 'Aktif', 'Rp 90.000'],
        ['Indah', 'Platinum – 50 Mbps', 'Nonaktif', 'Rp 300.000'],
        ['Joko', 'Diamond – 75 Mbps', 'Aktif', 'Rp 450.000'],
        ['Karin', 'Enterprise – 100 Mbps', 'Aktif', 'Rp 600.000'],
        ['Lina', 'Silver – 10 Mbps', 'Nonaktif', 'Rp 120.000'],
        ['Mira', 'Gold – 25 Mbps', 'Aktif', 'Rp 200.000'],
        ['Nanda', 'Platinum – 50 Mbps', 'Aktif', 'Rp 300.000'],
        ['Oscar', 'Bronze – 5 Mbps', 'Nonaktif', 'Rp 90.000'],
        ['Putri', 'Platinum – 50 Mbps', 'Aktif', 'Rp 500.000'],
        ['Qori', 'Diamond – 75 Mbps', 'Aktif', 'Rp 450.000'],
        ['Rama', 'Silver – 10 Mbps', 'Nonaktif', 'Rp 120.000'],
        ['Sinta', 'Gold – 25 Mbps', 'Aktif', 'Rp 200.000'],
        ['Tono', 'Bronze – 5 Mbps', 'Aktif', 'Rp 90.000'],
        ['Umar', 'Platinum – 50 Mbps', 'Nonaktif', 'Rp 300.000'],
        ['Vina', 'Diamond – 75 Mbps', 'Aktif', 'Rp 450.000'],
        ['Wawan', 'Enterprise – 100 Mbps', 'Aktif', 'Rp 600.000'],
        ['Xena', 'Silver – 10 Mbps', 'Nonaktif', 'Rp 120.000'],
        ['Yoga', 'Gold – 25 Mbps', 'Aktif', 'Rp 200.000'],
        ['Zara', 'Platinum – 50 Mbps', 'Aktif', 'Rp 300.000'],
        ['Rafi', 'Bronze – 5 Mbps', 'Nonaktif', 'Rp 90.000'],
        ['Laila', 'Platinum – 50 Mbps', 'Aktif', 'Rp 500.000'],
        ['Doni', 'Diamond – 75 Mbps', 'Aktif', 'Rp 450.000'],
        ['Mega', 'Silver – 10 Mbps', 'Nonaktif', 'Rp 120.000'],
        ['Fina', 'Gold – 25 Mbps', 'Aktif', 'Rp 200.000'],
        ['Galih', 'Bronze – 5 Mbps', 'Aktif', 'Rp 90.000'],
        ['Hilda', 'Platinum – 50 Mbps', 'Nonaktif', 'Rp 300.000'],
        ['Iwan', 'Diamond – 75 Mbps', 'Aktif', 'Rp 450.000'],
        ['Jihan', 'Enterprise – 100 Mbps', 'Aktif', 'Rp 600.000'],
        ['Kevin', 'Silver – 10 Mbps', 'Nonaktif', 'Rp 120.000'],
        ['Lisa', 'Gold – 25 Mbps', 'Aktif', 'Rp 200.000'],
        ['Monic', 'Platinum – 50 Mbps', 'Aktif', 'Rp 300.000'],
        ['Niko', 'Bronze – 5 Mbps', 'Nonaktif', 'Rp 90.000'],
        ['Oki', 'Platinum – 50 Mbps', 'Aktif', 'Rp 500.000'],
        ['Pita', 'Diamond – 75 Mbps', 'Aktif', 'Rp 450.000'],
        ['Qila', 'Silver – 10 Mbps', 'Nonaktif', 'Rp 120.000'],
        ['Reno', 'Gold – 25 Mbps', 'Aktif', 'Rp 200.000'],
        ['Sari', 'Bronze – 5 Mbps', 'Aktif', 'Rp 90.000'],
        ['Tegar', 'Platinum – 50 Mbps', 'Nonaktif', 'Rp 300.000'],
        ['Utami', 'Diamond – 75 Mbps', 'Aktif', 'Rp 450.000'],
        ['Via', 'Enterprise – 100 Mbps', 'Aktif', 'Rp 600.000'],
        ['Wira', 'Silver – 10 Mbps', 'Nonaktif', 'Rp 120.000'],
        ['Xeno', 'Gold – 25 Mbps', 'Aktif', 'Rp 200.000'],
        ['Yani', 'Platinum – 50 Mbps', 'Aktif', 'Rp 300.000'],
        ['Zahra', 'Diamond – 75 Mbps', 'Aktif', 'Rp 450.000'],
        ['Andika', 'Enterprise – 100 Mbps', 'Aktif', 'Rp 600.000'],
        ['Bella', 'Silver – 10 Mbps', 'Nonaktif', 'Rp 120.000'],
        ['Cahya', 'Gold – 25 Mbps', 'Aktif', 'Rp 200.000'],
        ['Desta', 'Bronze – 5 Mbps', 'Aktif', 'Rp 90.000'],
        ['Erlangga', 'Platinum – 50 Mbps', 'Nonaktif', 'Rp 300.000'],
        ['Farah', 'Diamond – 75 Mbps', 'Aktif', 'Rp 450.000'],
        ['Guntur', 'Enterprise – 100 Mbps', 'Aktif', 'Rp 600.000'],
        ['Hana', 'Silver – 10 Mbps', 'Nonaktif', 'Rp 120.000'],
        ['Imam', 'Gold – 25 Mbps', 'Aktif', 'Rp 200.000'],
        ['Jani', 'Bronze – 5 Mbps', 'Aktif', 'Rp 90.000'],
        ['Kirana', 'Platinum – 50 Mbps', 'Nonaktif', 'Rp 300.000'],
        ['Lutfi', 'Diamond – 75 Mbps', 'Aktif', 'Rp 450.000'],
        ['Manda', 'Enterprise – 100 Mbps', 'Aktif', 'Rp 600.000'],
        ['Nadia', 'Silver – 10 Mbps', 'Nonaktif', 'Rp 120.000'],
        ['Omar', 'Gold – 25 Mbps', 'Aktif', 'Rp 200.000'],
        ['Putra', 'Bronze – 5 Mbps', 'Aktif', 'Rp 90.000'],
        ['Qiana', 'Platinum – 50 Mbps', 'Nonaktif', 'Rp 300.000'],
        ['Reno', 'Diamond – 75 Mbps', 'Aktif', 'Rp 450.000'],
        ['Salsa', 'Enterprise – 100 Mbps', 'Aktif', 'Rp 600.000'],
        ['Tari', 'Silver – 10 Mbps', 'Nonaktif', 'Rp 120.000'],
        ['Ucup', 'Gold – 25 Mbps', 'Aktif', 'Rp 200.000'],
        ['Vera', 'Bronze – 5 Mbps', 'Aktif', 'Rp 90.000'],
        ['Wahyu', 'Platinum – 50 Mbps', 'Nonaktif', 'Rp 300.000'],
        ['Xavier', 'Diamond – 75 Mbps', 'Aktif', 'Rp 450.000'],
        ['Yola', 'Enterprise – 100 Mbps', 'Aktif', 'Rp 600.000'],
        ['Zidan', 'Silver – 10 Mbps', 'Nonaktif', 'Rp 120.000'],
        ['Alya', 'Gold – 25 Mbps', 'Aktif', 'Rp 200.000'],
        ['Bagas', 'Bronze – 5 Mbps', 'Aktif', 'Rp 90.000'],
        ['Cindy', 'Platinum – 50 Mbps', 'Nonaktif', 'Rp 300.000'],
        ['Dian', 'Diamond – 75 Mbps', 'Aktif', 'Rp 450.000'],
        ['Eko', 'Enterprise – 100 Mbps', 'Aktif', 'Rp 600.000'],
        ['Fitri', 'Silver – 10 Mbps', 'Nonaktif', 'Rp 120.000'],
        ['Galuh', 'Gold – 25 Mbps', 'Aktif', 'Rp 200.000'],
        ['Hafidz', 'Bronze – 5 Mbps', 'Aktif', 'Rp 90.000'],
        ['Indira', 'Platinum – 50 Mbps', 'Nonaktif', 'Rp 300.000'],
        ['Jefri', 'Diamond – 75 Mbps', 'Aktif', 'Rp 450.000'],
        ['Kiki', 'Enterprise – 100 Mbps', 'Aktif', 'Rp 600.000'],
        ['Lani', 'Silver – 10 Mbps', 'Nonaktif', 'Rp 120.000'],
        ['Miko', 'Gold – 25 Mbps', 'Aktif', 'Rp 200.000'],
        ['Nora', 'Bronze – 5 Mbps', 'Aktif', 'Rp 90.000'],
        ['Opan', 'Platinum – 50 Mbps', 'Nonaktif', 'Rp 300.000'],
        ['Puspa', 'Diamond – 75 Mbps', 'Aktif', 'Rp 450.000'],
        ['Qomar', 'Enterprise – 100 Mbps', 'Aktif', 'Rp 600.000'],
        ['Rara', 'Silver – 10 Mbps', 'Nonaktif', 'Rp 120.000'],
        ['Seno', 'Gold – 25 Mbps', 'Aktif', 'Rp 200.000'],
        ['Tariq', 'Bronze – 5 Mbps', 'Aktif', 'Rp 90.000'],
        ['Ulya', 'Platinum – 50 Mbps', 'Nonaktif', 'Rp 300.000'],
        ['Vito', 'Diamond – 75 Mbps', 'Aktif', 'Rp 450.000'],
        ['Winda', 'Enterprise – 100 Mbps', 'Aktif', 'Rp 600.000'],
        ['Xeno', 'Silver – 10 Mbps', 'Nonaktif', 'Rp 120.000'],
        ['Yuda', 'Gold – 25 Mbps', 'Aktif', 'Rp 200.000'],
        ['Zahra', 'Bronze – 5 Mbps', 'Aktif', 'Rp 90.000'],
      ];
    @endphp

    <table id="dataTable" class="w-full border-collapse">
      <thead class="bg-orange-500 text-white text-sm uppercase tracking-wide">
        <tr>
          <th class="py-3 px-4 text-left rounded-tl-lg">No</th>
          <th class="py-3 px-4 text-left">Nama Pelanggan</th>
          <th class="py-3 px-4 text-left">Paket</th>
          <th class="py-3 px-4 text-left">Status</th>
          <th class="py-3 px-4 text-left">Tagihan</th>
          <th class="py-3 px-4 text-left rounded-tr-lg">Aksi</th>
        </tr>
      </thead>
      <tbody class="text-gray-700 text-sm">
        @foreach ($pelanggan as $i => $data)
          <tr class="border-b hover:bg-orange-50 transition">
            <td class="py-3 px-4">{{ $i + 1 }}</td>
            <td class="py-3 px-4">{{ $data[0] }}</td>
            <td class="py-3 px-4">{{ $data[1] }}</td>
            <td class="py-3 px-4">
              @if ($data[2] === 'Aktif')
                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">Aktif</span>
              @else
                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-medium">Nonaktif</span>
              @endif
            </td>
            <td class="py-3 px-4">{{ $data[3] }}</td>
            <td class="py-3 px-4 flex gap-2">
              <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-xs transition">✏️ Edit</button>
              <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-xs transition">🗑️ Hapus</button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <div class="flex justify-center items-center mt-8 gap-4">
      <button id="prevPage" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg shadow-md transition disabled:opacity-40">
        ⬅️ Sebelumnya
      </button>
      <span id="pageInfo" class="text-gray-700 font-semibold"></span>
      <button id="nextPage" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg shadow-md transition disabled:opacity-40">
        Berikutnya ➡️
      </button>
    </div>
  </div>
</div>

<script>
  const rowsPerPage = 10;
  let currentPage = 1;
  const rows = Array.from(document.querySelectorAll('#dataTable tbody tr'));
  const totalPages = Math.ceil(rows.length / rowsPerPage);
  const searchInput = document.getElementById('searchInput');
  const prevBtn = document.getElementById('prevPage');
  const nextBtn = document.getElementById('nextPage');
  const pageInfo = document.getElementById('pageInfo');

  function renderTable() {
    rows.forEach((row, i) => {
      row.style.display = (i >= (currentPage - 1) * rowsPerPage && i < currentPage * rowsPerPage) ? '' : 'none';
    });
    pageInfo.textContent = `Halaman ${currentPage} dari ${totalPages}`;
    prevBtn.disabled = currentPage === 1;
    nextBtn.disabled = currentPage === totalPages;
  }

  prevBtn.addEventListener('click', () => {
    if (currentPage > 1) {
      currentPage--;
      renderTable();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }
  });

  nextBtn.addEventListener('click', () => {
    if (currentPage < totalPages) {
      currentPage++;
      renderTable();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }
  });

  searchInput.addEventListener('input', e => {
    const term = e.target.value.toLowerCase();
    rows.forEach(row => {
      const name = row.children[1].textContent.toLowerCase();
      row.style.display = name.includes(term) ? '' : 'none';
    });
  });

  renderTable();
</script>
@endsection
