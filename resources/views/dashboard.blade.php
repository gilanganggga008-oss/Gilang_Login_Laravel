<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- MATIKAN CACHE BROWSER -->
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="0">

  <title>Inventaris TIK - Diskominfo</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Cinzel:wght@600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

  <style>
    :root {
      --bg-dark: #0f0a1c;
      --card-bg: #1a122e;
      --card-bg-hover: #23193d;
      --input-bg: #140d24;
      --primary-purple: #8b5cf6;
      --border-subtle: rgba(139, 92, 246, 0.15);
      --border-accent: rgba(245, 158, 11, 0.3);
      --accent-gold: #f59e0b;
      --text-muted: #a78bfa;
    }

    body { 
      font-family: 'Plus Jakarta Sans', sans-serif; 
      background-color: var(--bg-dark);
      color: #f3e8ff;
    }

    .font-luxury { font-family: 'Cinzel', serif; }

    .glass-header {
      background: rgba(26, 18, 46, 0.85);
      backdrop-filter: blur(12px);
      border-bottom: 1px solid var(--border-subtle);
    }

    .hero-banner {
      background: linear-gradient(135deg, #2e1065 0%, #1e1b4b 100%);
      border: 1px solid var(--border-accent);
    }

    .logout-btn {
      background: rgba(139, 92, 246, 0.1);
      border: 1px solid var(--border-subtle);
      color: #ddd6fe;
      transition: all 0.2s ease;
    }

    .logout-btn:hover {
      background: rgba(225, 29, 72, 0.2);
      border-color: rgba(225, 29, 72, 0.4);
      color: #fecdd3;
    }

    .nav-tab-active {
      background: #7c3aed;
      color: #ffffff;
      font-weight: 600;
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .nav-tab-inactive {
      color: var(--text-muted);
    }

    .nav-tab-inactive:hover {
      background: rgba(139, 92, 246, 0.15);
      color: #f3e8ff;
    }

    .royal-card {
      background: var(--card-bg);
      border: 1px solid var(--border-subtle);
      transition: border-color 0.2s ease, transform 0.2s ease;
    }

    .royal-card:hover {
      border-color: rgba(139, 92, 246, 0.35);
      transform: translateY(-2px);
    }
  </style>
</head>
<body class="min-h-screen flex flex-col">

  <!-- TOPBAR / HEADER NAVIGATION -->
  <header class="glass-header sticky top-0 z-40 px-6 py-3.5">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
      
      <div class="flex items-center space-x-8">
        <div class="flex items-center space-x-3">
          <div class="w-10 h-10 bg-purple-900/60 rounded-xl flex items-center justify-center text-white text-xl border border-amber-500/30">
            🏛️
          </div>
          <div>
            <h1 class="font-luxury font-bold text-sm tracking-wider text-amber-400 leading-tight">DISKOMINFO</h1>
            <p class="text-[10px] text-purple-300/80 font-semibold tracking-widest uppercase">Inventaris TIK</p>
          </div>
        </div>

        <nav class="hidden md:flex items-center space-x-2 text-xs">
          <button id="nav-dashboard" onclick="gantiTab('dashboard')" class="nav-tab-active px-4 py-2 rounded-lg transition-all cursor-pointer flex items-center space-x-2">
            <span class="material-symbols-outlined text-base">dashboard</span>
            <span>Dashboard</span>
          </button>

          <button id="nav-barang" onclick="gantiTab('barang')" class="nav-tab-inactive px-4 py-2 rounded-lg transition-all cursor-pointer flex items-center space-x-2">
            <span class="material-symbols-outlined text-base">inventory_2</span>
            <span>Daftar Barang</span>
          </button>
        </nav>
      </div>

      <div class="flex items-center space-x-4">
        <div class="flex items-center space-x-3 border-r border-purple-800/40 pr-4">
          <div class="w-8 h-8 rounded-lg bg-purple-800/80 font-bold flex items-center justify-center text-xs text-amber-300 border border-purple-600/30">
            {{ strtoupper(substr(Auth::user()->username ?? 'U', 0, 2)) }}
          </div>
          <div class="text-xs hidden sm:block">
            <p class="font-semibold text-purple-100 truncate max-w-[120px]">{{ Auth::user()->username ?? 'User' }}</p>
            <p class="text-[10px] text-amber-400/90 font-medium">Petugas Inventaris</p>
          </div>
        </div>

        <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Apakah Anda yakin ingin keluar dari sistem?')">
          @csrf
          <button type="submit" class="logout-btn py-1.5 px-3 rounded-lg font-semibold text-xs flex items-center space-x-1.5 cursor-pointer">
            <span class="material-symbols-outlined text-sm">logout</span>
            <span class="hidden sm:inline">Keluar</span>
          </button>
        </form>
      </div>

    </div>
  </header>

  <!-- KONTEN UTAMA -->
  <main class="flex-1 max-w-7xl w-full mx-auto p-6 md:p-8 space-y-6">

    @if (session('success'))
      <div class="bg-emerald-950/60 border border-emerald-500/40 p-3.5 rounded-xl flex items-center space-x-3">
        <span class="material-symbols-outlined text-emerald-400 text-lg">check_circle</span>
        <p class="text-xs font-medium text-emerald-200">{{ session('success') }}</p>
      </div>
    @endif

    <!-- ==================== TAB 1: DASHBOARD ==================== -->
    <div id="section-dashboard" class="space-y-6">
      <div class="hero-banner rounded-2xl p-6 md:p-8 text-white relative overflow-hidden flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
        <div class="space-y-2 z-10 max-w-2xl">
          <span class="inline-flex items-center gap-1.5 px-3 py-0.5 bg-amber-400/10 border border-amber-400/20 rounded-full text-[10px] font-semibold tracking-wider uppercase text-amber-300">
            <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span> Panel Utama
          </span>
          <h3 class="font-luxury text-2xl md:text-3xl font-bold tracking-tight text-purple-50">
            Selamat Datang, {{ Auth::user()->username ?? 'User' }}
          </h3>
          <p class="text-xs text-purple-200/70 leading-relaxed">Kelola dan pantau status seluruh aset TIK Diskominfo dalam satu panel terintegrasi.</p>
        </div>
        
        <div class="hidden md:flex w-16 h-16 bg-purple-950/60 rounded-xl items-center justify-center text-3xl border border-amber-400/20 z-10">
          🏛️
        </div>
      </div>

      <!-- Kartu Statistik -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="royal-card p-5 rounded-xl flex items-center justify-between">
          <div class="space-y-1">
            <p class="text-[10px] font-bold text-amber-400 uppercase tracking-wider">Total Perangkat</p>
            <h4 class="text-2xl font-bold text-white">{{ number_format($totalUnit ?? 0) }} <span class="text-xs font-normal text-purple-300">Unit</span></h4>
            <p class="text-[10px] text-purple-300/60 font-medium">{{ $totalJenis ?? 0 }} Jenis Barang</p>
          </div>
          <div class="w-10 h-10 rounded-lg bg-purple-900/40 text-amber-400 flex items-center justify-center border border-purple-700/30">
            <span class="material-symbols-outlined text-xl">devices</span>
          </div>
        </div>

        <div class="royal-card p-5 rounded-xl flex items-center justify-between">
          <div class="space-y-1">
            <p class="text-[10px] font-bold text-emerald-400 uppercase tracking-wider">Kondisi Baik</p>
            <h4 class="text-2xl font-bold text-emerald-400">{{ number_format($totalBaik ?? 0) }} <span class="text-xs font-normal text-purple-300">Unit</span></h4>
            <p class="text-[10px] text-emerald-300/60 font-medium">Siap Operasional</p>
          </div>
          <div class="w-10 h-10 rounded-lg bg-emerald-950/40 text-emerald-400 flex items-center justify-center border border-emerald-500/20">
            <span class="material-symbols-outlined text-xl">check_circle</span>
          </div>
        </div>

        <div class="royal-card p-5 rounded-xl flex items-center justify-between">
          <div class="space-y-1">
            <p class="text-[10px] font-bold text-rose-400 uppercase tracking-wider">Perangkat Rusak</p>
            <h4 class="text-2xl font-bold text-rose-400">{{ number_format($totalRusak ?? 0) }} <span class="text-xs font-normal text-purple-300">Unit</span></h4>
            <p class="text-[10px] text-rose-300/60 font-medium">Perlu Perbaikan</p>
          </div>
          <div class="w-10 h-10 rounded-lg bg-rose-950/40 text-rose-400 flex items-center justify-center border border-rose-500/20">
            <span class="material-symbols-outlined text-xl">build</span>
          </div>
        </div>

        <div class="royal-card p-5 rounded-xl flex items-center justify-between">
          <div class="space-y-1">
            <p class="text-[10px] font-bold text-amber-400 uppercase tracking-wider">Total Nilai Aset</p>
            <h4 class="text-lg font-bold text-amber-300">Rp {{ number_format($totalNilaiInventaris ?? 0, 0, ',', '.') }}</h4>
            <p class="text-[10px] text-purple-300/60 font-medium">Valuasi Inventaris</p>
          </div>
          <div class="w-10 h-10 rounded-lg bg-amber-950/30 text-amber-400 flex items-center justify-center border border-amber-500/20">
            <span class="material-symbols-outlined text-xl">payments</span>
          </div>
        </div>
      </div>
    </div>

    <!-- ==================== TAB 2: DAFTAR BARANG (CRUD) ==================== -->
    <div id="section-barang" class="hidden space-y-4">
      <div class="royal-card rounded-2xl p-5 md:p-6 space-y-5">
        
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
          <form method="GET" action="{{ route('dashboard') }}" class="flex flex-wrap items-center gap-2.5 w-full lg:w-auto">
            
            <div class="relative flex-1 sm:w-64">
              <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari barang, merek, lokasi..." 
                class="w-full pl-9 pr-3 py-2 text-xs rounded-lg border border-purple-800/40 focus:outline-none focus:border-purple-500 bg-[#140d24] text-purple-100 placeholder-purple-400/60">
              <span class="material-symbols-outlined absolute left-2.5 top-2 text-purple-400/70 text-base">search</span>
            </div>

            <select name="kategori" class="text-xs py-2 px-3 rounded-lg border border-purple-800/40 focus:outline-none focus:border-purple-500 bg-[#140d24] text-purple-100">
              <option value="" class="bg-[#140d24] text-white">Semua Kategori</option>
              @foreach ($daftarKategori as $kat)
                <option value="{{ $kat }}" class="bg-[#140d24] text-white" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
              @endforeach
            </select>

            <select name="kondisi" class="text-xs py-2 px-3 rounded-lg border border-purple-800/40 focus:outline-none focus:border-purple-500 bg-[#140d24] text-purple-100">
              <option value="" class="bg-[#140d24] text-white">Semua Kondisi</option>
              <option value="Baik" class="bg-[#140d24] text-white" {{ request('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
              <option value="Rusak Ringan" class="bg-[#140d24] text-white" {{ request('kondisi') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
              <option value="Rusak Berat" class="bg-[#140d24] text-white" {{ request('kondisi') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
            </select>

            <button type="submit" class="bg-purple-700 hover:bg-purple-600 text-white text-xs font-semibold px-4 py-2 rounded-lg transition-all cursor-pointer">Filter</button>
            
            @if(request()->anyFilled(['search', 'kategori', 'kondisi']))
              <a href="{{ route('dashboard') }}" class="text-xs text-amber-400 hover:underline font-semibold px-1">Reset</a>
            @endif
          </form>

          <button onclick="bukaModalTambah()" class="bg-purple-600 hover:bg-purple-500 text-white text-xs font-semibold px-4 py-2 rounded-lg flex items-center justify-center gap-1.5 border border-purple-400/30 transition-all cursor-pointer flex-shrink-0">
            <span class="material-symbols-outlined text-base">add</span>
            <span>Tambah Perangkat</span>
          </button>
        </div>

        <!-- Tabel Data CRUD -->
        <div class="overflow-x-auto border border-purple-800/30 rounded-xl bg-[#140d24]/50">
          <table class="w-full text-left text-xs text-purple-100">
            <thead class="bg-purple-950/60 uppercase tracking-wider text-[10px] text-amber-400 border-b border-purple-800/40 font-bold">
              <tr>
                <th class="p-3.5 pl-5">Perangkat</th>
                <th class="p-3.5">Kategori</th>
                <th class="p-3.5">Merek</th>
                <th class="p-3.5">Jumlah</th>
                <th class="p-3.5">Harga / Unit</th>
                <th class="p-3.5">Kondisi</th>
                <th class="p-3.5">Lokasi</th>
                <th class="p-3.5">Tahun</th>
                <th class="p-3.5 pr-5 text-center">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-purple-900/30">
              @forelse ($perangkats as $item)
                <tr class="hover:bg-purple-900/20 transition-all">
                  <td class="p-3.5 pl-5 font-semibold text-white">{{ $item->nama_perangkat }}</td>
                  <td class="p-3.5 text-purple-200/80">{{ $item->kategori }}</td>
                  <td class="p-3.5 text-purple-200/80">{{ $item->merek }}</td>
                  <td class="p-3.5 font-semibold text-amber-300">{{ number_format($item->jumlah) }} Unit</td>
                  <td class="p-3.5 text-purple-200/80">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                  
                  <td class="p-3.5">
                    @if ($item->kondisi == 'Baik')
                      <span class="inline-flex items-center px-2.5 py-0.5 bg-emerald-950/60 text-emerald-400 border border-emerald-500/30 rounded-md font-semibold text-[10px] whitespace-nowrap">
                        Baik
                      </span>
                    @elseif ($item->kondisi == 'Rusak Ringan')
                      <span class="inline-flex items-center px-2.5 py-0.5 bg-amber-950/60 text-amber-400 border border-amber-500/30 rounded-md font-semibold text-[10px] whitespace-nowrap">
                        Rusak Ringan
                      </span>
                    @else
                      <span class="inline-flex items-center px-2.5 py-0.5 bg-rose-950/60 text-rose-400 border border-rose-500/30 rounded-md font-semibold text-[10px] whitespace-nowrap">
                        Rusak Berat
                      </span>
                    @endif
                  </td>

                  <td class="p-3.5 text-purple-200/80">{{ $item->lokasi_penyimpanan }}</td>
                  <td class="p-3.5 text-purple-200/80">{{ $item->tahun_pengadaan }}</td>
                  <td class="p-3.5 pr-5">
                    <div class="flex items-center justify-center gap-1.5">
                      <button onclick='bukaModalDetail(@json($item))' class="p-1.5 bg-purple-900/40 text-purple-300 hover:text-white rounded-md cursor-pointer transition-colors border border-purple-700/30" title="Detail">
                        <span class="material-symbols-outlined text-base">visibility</span>
                      </button>
                      <button onclick='bukaModalEdit(@json($item))' class="p-1.5 bg-amber-950/40 text-amber-400 hover:text-white rounded-md cursor-pointer transition-colors border border-amber-500/20" title="Edit">
                        <span class="material-symbols-outlined text-base">edit</span>
                      </button>
                      <form action="{{ route('perangkat.delete', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data perangkat ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-1.5 bg-rose-950/40 text-rose-400 hover:text-white rounded-md cursor-pointer transition-colors border border-rose-500/20" title="Hapus">
                          <span class="material-symbols-outlined text-base">delete</span>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="9" class="text-center py-8 text-purple-400/70">Belum ada data perangkat TIK ditemukan.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <div class="pt-2">
          {{ $perangkats->links() }}
        </div>
      </div>
    </div>

  </main>

  <!-- MODAL FORM (TAMBAH / EDIT) -->
  <div id="modalForm" class="fixed inset-0 bg-black/70 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
    <div class="bg-[#1a122e] border border-purple-800/40 w-full max-w-xl rounded-2xl shadow-xl overflow-hidden">
      <div class="p-5 border-b border-purple-800/40 flex items-center justify-between bg-purple-950/40">
        <h3 id="modalTitle" class="font-luxury font-bold text-base text-amber-400">Tambah Perangkat TIK</h3>
        <button onclick="tutupModal('modalForm')" class="text-purple-400 hover:text-white cursor-pointer text-lg font-bold">✕</button>
      </div>

      <form id="formPerangkat" method="POST" action="{{ route('perangkat.store') }}" class="p-5 space-y-4">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3.5 text-xs">
          <div>
            <label class="font-semibold text-purple-200">Nama Perangkat *</label>
            <input type="text" name="nama_perangkat" id="in_nama" required class="w-full p-2.5 mt-1 border border-purple-800/40 rounded-lg focus:border-purple-500 outline-none bg-[#140d24] text-purple-100">
          </div>
          <div>
            <label class="font-semibold text-purple-200">Kategori *</label>
            <select name="kategori" id="in_kategori" required class="w-full p-2.5 mt-1 border border-purple-800/40 rounded-lg focus:border-purple-500 outline-none bg-[#140d24] text-purple-100">
              @foreach ($daftarKategori as $kat)
                <option value="{{ $kat }}" class="bg-[#140d24] text-white">{{ $kat }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <label class="font-semibold text-purple-200">Merek *</label>
            <input type="text" name="merek" id="in_merek" required class="w-full p-2.5 mt-1 border border-purple-800/40 rounded-lg focus:border-purple-500 outline-none bg-[#140d24] text-purple-100">
          </div>
          <div>
            <label class="font-semibold text-purple-200">Jumlah Unit * (Maks. 1.000.000)</label>
            <input type="number" name="jumlah" id="in_jumlah" min="1" max="1000000" value="1" required class="w-full p-2.5 mt-1 border border-purple-800/40 rounded-lg focus:border-purple-500 outline-none bg-[#140d24] text-purple-100">
          </div>
          <div>
            <label class="font-semibold text-purple-200">Harga Satuan (Rp) *</label>
            <input type="number" name="harga_satuan" id="in_harga" min="0" max="10000000000" value="0" required class="w-full p-2.5 mt-1 border border-purple-800/40 rounded-lg focus:border-purple-500 outline-none bg-[#140d24] text-purple-100">
          </div>
          <div>
            <label class="font-semibold text-purple-200">Lokasi Penyimpanan *</label>
            <input type="text" name="lokasi_penyimpanan" id="in_lokasi" required class="w-full p-2.5 mt-1 border border-purple-800/40 rounded-lg focus:border-purple-500 outline-none bg-[#140d24] text-purple-100">
          </div>
          <div>
            <label class="font-semibold text-purple-200">Kondisi *</label>
            <select name="kondisi" id="in_kondisi" required class="w-full p-2.5 mt-1 border border-purple-800/40 rounded-lg focus:border-purple-500 outline-none bg-[#140d24] text-purple-100">
              <option value="Baik" class="bg-[#140d24] text-white">Baik</option>
              <option value="Rusak Ringan" class="bg-[#140d24] text-white">Rusak Ringan</option>
              <option value="Rusak Berat" class="bg-[#140d24] text-white">Rusak Berat</option>
            </select>
          </div>
          <div>
            <label class="font-semibold text-purple-200">Tahun Pengadaan *</label>
            <input type="number" name="tahun_pengadaan" id="in_tahun" value="{{ date('Y') }}" min="2000" max="{{ date('Y')+1 }}" required class="w-full p-2.5 mt-1 border border-purple-800/40 rounded-lg focus:border-purple-500 outline-none bg-[#140d24] text-purple-100">
          </div>
          <div class="md:col-span-2">
            <label class="font-semibold text-purple-200">Keterangan / Spesifikasi</label>
            <textarea name="keterangan" id="in_keterangan" rows="2" class="w-full p-2.5 mt-1 border border-purple-800/40 rounded-lg focus:border-purple-500 outline-none bg-[#140d24] text-purple-100"></textarea>
          </div>
        </div>

        <div class="flex items-center justify-end gap-2.5 pt-3 border-t border-purple-800/40">
          <button type="button" onclick="tutupModal('modalForm')" class="px-4 py-2 text-xs font-semibold text-purple-300 hover:bg-purple-900/30 rounded-lg cursor-pointer">Batal</button>
          <button type="submit" class="px-5 py-2 text-xs font-semibold bg-purple-600 hover:bg-purple-500 text-white rounded-lg cursor-pointer transition-all">Simpan Data</button>
        </div>
      </form>
    </div>
  </div>

  <!-- MODAL DETAIL -->
  <div id="modalDetail" class="fixed inset-0 bg-black/70 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
    <div class="bg-[#1a122e] border border-purple-800/40 w-full max-w-md rounded-2xl shadow-xl overflow-hidden">
      <div class="p-5 bg-purple-950/60 text-white flex items-center justify-between border-b border-purple-800/40">
        <div>
          <p id="det_id" class="text-[9px] uppercase font-bold tracking-wider text-amber-400"></p>
          <h3 id="det_nama" class="font-luxury text-lg font-bold text-white"></h3>
        </div>
        <button onclick="tutupModal('modalDetail')" class="text-purple-300 hover:text-white cursor-pointer text-lg font-bold">✕</button>
      </div>
      <div class="p-5 grid grid-cols-2 gap-3.5 text-xs">
        <div>
          <span class="text-purple-400/80 font-medium">Kategori:</span>
          <p id="det_kategori" class="font-semibold text-purple-100 text-xs mt-0.5"></p>
        </div>
        <div>
          <span class="text-purple-400/80 font-medium">Merek:</span>
          <p id="det_merek" class="font-semibold text-purple-100 text-xs mt-0.5"></p>
        </div>
        <div>
          <span class="text-purple-400/80 font-medium">Jumlah Unit:</span>
          <p id="det_jumlah" class="font-semibold text-amber-300 text-xs mt-0.5"></p>
        </div>
        <div>
          <span class="text-purple-400/80 font-medium">Kondisi:</span>
          <p id="det_kondisi" class="font-semibold text-xs mt-0.5"></p>
        </div>
        <div>
          <span class="text-purple-400/80 font-medium">Harga Satuan:</span>
          <p id="det_harga" class="font-semibold text-purple-100 text-xs mt-0.5"></p>
        </div>
        <div>
          <span class="text-purple-400/80 font-medium">Tahun Pengadaan:</span>
          <p id="det_tahun" class="font-semibold text-purple-100 text-xs mt-0.5"></p>
        </div>
        <div class="col-span-2">
          <span class="text-purple-400/80 font-medium">Lokasi Penyimpanan:</span>
          <p id="det_lokasi" class="font-semibold text-purple-100 text-xs mt-0.5"></p>
        </div>
        <div class="col-span-2">
          <span class="text-purple-400/80 font-medium">Keterangan:</span>
          <p id="det_keterangan" class="mt-1 p-3 bg-[#140d24] rounded-lg text-purple-200/90 border border-purple-800/30 leading-relaxed text-xs"></p>
        </div>
      </div>
    </div>
  </div>

  <script>
    history.pushState(null, null, location.href);
    window.onpopstate = function () { history.pushState(null, null, location.href); };

    function gantiTab(tab) {
      const secDashboard = document.getElementById('section-dashboard');
      const secBarang = document.getElementById('section-barang');
      const navDashboard = document.getElementById('nav-dashboard');
      const navBarang = document.getElementById('nav-barang');

      if (tab === 'barang') {
        secDashboard.classList.add('hidden');
        secBarang.classList.remove('hidden');
        navDashboard.className = 'nav-tab-inactive px-4 py-2 rounded-lg transition-all cursor-pointer flex items-center space-x-2';
        navBarang.className = 'nav-tab-active px-4 py-2 rounded-lg transition-all cursor-pointer flex items-center space-x-2';
      } else {
        secBarang.classList.add('hidden');
        secDashboard.classList.remove('hidden');
        navBarang.className = 'nav-tab-inactive px-4 py-2 rounded-lg transition-all cursor-pointer flex items-center space-x-2';
        navDashboard.className = 'nav-tab-active px-4 py-2 rounded-lg transition-all cursor-pointer flex items-center space-x-2';
      }
    }

    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('search') || urlParams.has('kategori') || urlParams.has('kondisi')) {
      gantiTab('barang');
    } else {
      gantiTab('dashboard');
    }

    function tutupModal(id) {
      document.getElementById(id).classList.add('hidden');
    }

    function bukaModalTambah() {
      document.getElementById('modalTitle').innerText = 'Tambah Perangkat TIK';
      document.getElementById('formPerangkat').action = "{{ route('perangkat.store') }}";
      document.getElementById('in_nama').value = '';
      document.getElementById('in_merek').value = '';
      document.getElementById('in_jumlah').value = '1';
      document.getElementById('in_harga').value = '0';
      document.getElementById('in_lokasi').value = '';
      document.getElementById('in_keterangan').value = '';
      document.getElementById('modalForm').classList.remove('hidden');
    }

    function bukaModalEdit(data) {
      document.getElementById('modalTitle').innerText = 'Edit Data Perangkat TIK';
      document.getElementById('formPerangkat').action = '/perangkat/update/' + data.id;
      document.getElementById('in_nama').value = data.nama_perangkat;
      document.getElementById('in_kategori').value = data.kategori;
      document.getElementById('in_merek').value = data.merek;
      document.getElementById('in_jumlah').value = data.jumlah;
      document.getElementById('in_harga').value = data.harga_satuan;
      document.getElementById('in_lokasi').value = data.lokasi_penyimpanan;
      document.getElementById('in_kondisi').value = data.kondisi;
      document.getElementById('in_tahun').value = data.tahun_pengadaan;
      document.getElementById('in_keterangan').value = data.keterangan || '';
      document.getElementById('modalForm').classList.remove('hidden');
    }

    function bukaModalDetail(data) {
      document.getElementById('det_id').innerText = 'ID Perangkat #' + data.id;
      document.getElementById('det_nama').innerText = data.nama_perangkat;
      document.getElementById('det_kategori').innerText = data.kategori;
      document.getElementById('det_merek').innerText = data.merek;
      document.getElementById('det_jumlah').innerText = Number(data.jumlah).toLocaleString('id-ID') + ' Unit';
      document.getElementById('det_kondisi').innerText = data.kondisi;
      document.getElementById('det_harga').innerText = 'Rp ' + Number(data.harga_satuan).toLocaleString('id-ID');
      document.getElementById('det_tahun').innerText = data.tahun_pengadaan;
      document.getElementById('det_lokasi').innerText = data.lokasi_penyimpanan;
      document.getElementById('det_keterangan').innerText = data.keterangan || 'Tidak ada keterangan.';
      document.getElementById('modalDetail').classList.remove('hidden');
    }
  </script>

</body>
</html>