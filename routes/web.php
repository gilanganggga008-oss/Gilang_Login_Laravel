<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;

// Direct halaman awal ke login
Route::get('/', function () {
    return redirect('login');
});

// Route Login & Auth (Dengan Anti-Cache agar tidak bisa di-BACK dari Dashboard)
Route::get('/login', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return response()
        ->view('login')
        ->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
        ->header('Pragma', 'no-cache')
        ->header('Expires', 'Sun, 02 Jan 1990 00:00:00 GMT');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Area Dashboard & CRUD Inventaris (Anti-Cache & Proteksi Auth)
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function (Request $request) {
        $query = DB::table('perangkat_tiks');

        // Filter Pencarian
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('nama_perangkat', 'like', "%{$s}%")
                  ->orWhere('merek', 'like', "%{$s}%")
                  ->orWhere('lokasi_penyimpanan', 'like', "%{$s}%");
            });
        }

        // Filter Kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Filter Kondisi
        if ($request->filled('kondisi')) {
            $query->where('kondisi', $request->kondisi);
        }

        $perangkats = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();

        // Statistik Dashboard
        $totalUnit = DB::table('perangkat_tiks')->sum('jumlah');
        $totalJenis = DB::table('perangkat_tiks')->count();
        $totalBaik = DB::table('perangkat_tiks')->where('kondisi', 'Baik')->sum('jumlah');
        $totalRusak = DB::table('perangkat_tiks')->whereIn('kondisi', ['Rusak Ringan', 'Rusak Berat'])->sum('jumlah');
        $totalNilaiInventaris = DB::table('perangkat_tiks')->sum(DB::raw('jumlah * harga_satuan'));

        $daftarKategori = [
            'Laptop', 'Komputer', 'Monitor', 'Printer', 
            'Router', 'Switch', 'Access Point', 'Server', 
            'Proyektor', 'Kamera', 'Lainnya'
        ];

        return response()
            ->view('dashboard', compact(
                'perangkats', 'totalUnit', 'totalJenis', 'totalBaik', 
                'totalRusak', 'totalNilaiInventaris', 'daftarKategori'
            ))
            ->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sun, 02 Jan 1990 00:00:00 GMT');
    })->name('dashboard');

    // Simpan Perangkat Baru (Max 1.000.000 Unit)
    Route::post('/perangkat/simpan', function (Request $request) {
        $data = $request->validate([
            'nama_perangkat'     => 'required|string|max:255',
            'kategori'           => 'required|string',
            'merek'              => 'required|string|max:100',
            'jumlah'             => 'required|integer|min:1|max:1000000',
            'harga_satuan'       => 'required|numeric|min:0|max:10000000000',
            'lokasi_penyimpanan' => 'required|string|max:255',
            'kondisi'            => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'tahun_pengadaan'    => 'required|digits:4|integer',
            'keterangan'         => 'nullable|string',
        ]);
        $data['created_at'] = now();
        $data['updated_at'] = now();

        DB::table('perangkat_tiks')->insert($data);
        return redirect()->route('dashboard')->with('success', 'Perangkat TIK berhasil ditambahkan!');
    })->name('perangkat.store');

    // Update Perangkat (Max 1.000.000 Unit)
    Route::post('/perangkat/update/{id}', function (Request $request, $id) {
        $data = $request->validate([
            'nama_perangkat'     => 'required|string|max:255',
            'kategori'           => 'required|string',
            'merek'              => 'required|string|max:100',
            'jumlah'             => 'required|integer|min:1|max:1000000',
            'harga_satuan'       => 'required|numeric|min:0|max:10000000000',
            'lokasi_penyimpanan' => 'required|string|max:255',
            'kondisi'            => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'tahun_pengadaan'    => 'required|digits:4|integer',
            'keterangan'         => 'nullable|string',
        ]);
        $data['updated_at'] = now();

        DB::table('perangkat_tiks')->where('id', $id)->update($data);
        return redirect()->route('dashboard')->with('success', 'Data perangkat berhasil diperbarui!');
    })->name('perangkat.update');

    // Hapus Perangkat
    Route::delete('/perangkat/hapus/{id}', function ($id) {
        DB::table('perangkat_tiks')->where('id', $id)->delete();
        return redirect()->route('dashboard')->with('success', 'Data perangkat berhasil dihapus!');
    })->name('perangkat.delete');

});