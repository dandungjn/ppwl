<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('acronym', 100);
            $table->text('address');
            $table->string('phone', 15);
            $table->string('tax_number', 25);
            $table->string('leader_name', 255);
            $table->string('logo_header')->nullable();
            $table->string('logo_stamp')->nullable();
            $table->string('logo_signature')->nullable();
            $table->string('tax_status', 10);
            $table->foreignId('bank_id')->constrained('banks');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
