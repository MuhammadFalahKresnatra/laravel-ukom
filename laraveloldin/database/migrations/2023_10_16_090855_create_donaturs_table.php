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
        Schema::create('donaturs', function (Blueprint $table) {
            $table->id();
            $table->integer('idprogram');
            $table->string('nominal');
            $table->string('pembayaran');
            $table->string('dukungan')->nullable();
            $table->string('nama');
            $table->string('asalkota');
            $table->string('telp');
            $table->string('email');
            $table->string('doa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donaturs');
    }
};
