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
        Schema::create('program_donasis', function (Blueprint $table) {
            $table->id();
            $table->integer('program');
            $table->string('namainstansi');
            $table->string('telp');
            $table->string('email');
            $table->string('image');
            $table->string('namaprogram');
            $table->string('maksimaldonasi');
            $table->string('rincian');
            $table->string('namayayasan');
            $table->string('tujuandonasi');
            $table->string('alamat');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_donasis');
    }
};
