<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table): void {
            $table->string('nis', 20)->primary();
            $table->string('nama', 100);
            $table->string('kelas', 20);
            $table->rememberToken();
            $table->timestamps();

            $table->index('kelas');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
