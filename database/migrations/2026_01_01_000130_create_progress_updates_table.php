<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('progress_updates', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('aspirasi_id')->constrained('aspirasis')->cascadeOnDelete();
            $table->unsignedTinyInteger('progress_persen');
            $table->text('catatan');
            $table->foreignId('admin_id')->nullable()->constrained('admins')->nullOnDelete();
            $table->timestamps();

            $table->index(['aspirasi_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progress_updates');
    }
};
