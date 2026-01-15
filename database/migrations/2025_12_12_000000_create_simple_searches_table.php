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
        Schema::create('simple_searches', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->longText('pekerjaan');
            $table->string('client', 100);
            $table->decimal('nilai', 15, 2)->default(0);
            $table->string('status', 50);
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('tanggal');
            $table->index('client');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simple_searches');
    }
};
