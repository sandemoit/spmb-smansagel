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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('no_pendaftaran');
            $table->integer('user_id');
            $table->string('nama_siswa');
            $table->string('nisn')->unique()->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->string('agama')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('sekolah_asal')->nullable();
            $table->year('tahun_lulus')->nullable();
            $table->string('nik_kk')->nullable();

            $table->string('foto_3x4')->nullable();
            $table->string('upload_kk')->nullable();

            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->decimal('jarak_kesekolah', 12, 2)->nullable();

            $table->foreignId('jalur_pendaftaran_id')->nullable();

            $table->string('status')->default('tidak_lenkgap');

            // Orang tua
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->decimal('penghasilan_ayah', 12, 2)->nullable();
            $table->decimal('penghasilan_ibu', 12, 2)->nullable();

            $table->integer('is_complete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
