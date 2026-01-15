<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 50);
            $table->string('birth_place', 30);
            $table->date('birth_date');
            $table->enum('gender', ['male', 'female']);
            $table->string('address');
            $table->string('phone', 20);
            $table->string('email', 100);
            $table->string('position', 50);
            $table->string('file_path')->nullable();
            $table->boolean('status')->default(true);
            $table->foreignId('updated_by')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
