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
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id')->primary()->autoIncrement();
            $table->string('username');
            $table->string('name')->nullable();;
            $table->string('email')->nullable();;
            $table->string('password');
            $table->text('bio')->nullable();
            $table->enum('role', ['admin', 'kasir']);
            $table->enum('is_active' , ['admin', 'kasir'])->default('Y');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};