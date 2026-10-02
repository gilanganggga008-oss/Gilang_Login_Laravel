<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('perangkat_tiks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perangkat');
            $table->string('kategori');
            $table->string('merek');
            $table->integer('jumlah')->default(1);
            $table->decimal('harga_satuan', 15, 2)->default(0);
            $table->string('lokasi_penyimpanan');
            $table->enum('kondisi', ['Baik', 'Rusak Ringan', 'Rusak Berat'])->default('Baik');
            $table->year('tahun_pengadaan');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perangkat_tiks');
    }
};