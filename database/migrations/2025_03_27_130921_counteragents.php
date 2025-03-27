<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Uuid;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('counteragents', function (Blueprint $table) {
            $table->uuid('id');
            $table->integer('user_id');
            $table->string('inn',20);
            $table->string('name',80);
            $table->string('address',300)->nullable();
            $table->string('ogrn',80)->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counteragents');
    }
};
