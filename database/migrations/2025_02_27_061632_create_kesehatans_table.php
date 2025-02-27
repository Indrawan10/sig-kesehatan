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
        Schema::create('kesehatans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tempat');
            $table->enum('jenis_fasilitas', ['rumah sakit', 'klinik', 'apotek', 'puskesmas'])->default('rumah sakit');
            $table->string('jam_operasional');
            $table->text('deskripsi');
            $table->string('alamat');
            $table->string('nomor_hp', 15);
            $table->decimal('latitude', 10, 8);  // menyimpan nilai latitude
            $table->decimal('longitude', 11, 8); // menyimpan nilai longitude
            $table->enum('marker_color', ['red', 'blue', 'green', 'orange'])->default('red');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kesehatans');
    }
};
