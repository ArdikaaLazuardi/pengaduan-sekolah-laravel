<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aspirasis', function (Blueprint $table): void {
            $table->id();
            $table->string('nis', 20);
            $table->foreignId('kategori_id')->constrained('kategoris')->cascadeOnDelete();
            $table->string('lokasi', 100);
            $table->text('ket');
            $table->enum('status', ['Menunggu', 'Proses', 'Selesai'])->default('Menunggu');
            $table->text('feedback')->nullable();
            $table->unsignedTinyInteger('progress_persen')->default(0);
            $table->foreignId('admin_id')->nullable()->constrained('admins')->nullOnDelete();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();

            $table->foreign('nis')->references('nis')->on('siswas')->cascadeOnDelete();
            $table->index(['created_at', 'status']);
            $table->index(['nis', 'kategori_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aspirasis');
    }
};
