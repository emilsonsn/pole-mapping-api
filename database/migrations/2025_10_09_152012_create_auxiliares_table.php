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
        Schema::create('characteristics', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('value')->nullable();
            $table->timestamps();
        });

        Schema::create('arms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('value')->nullable();
            $table->timestamps();
        });

        Schema::create('lamps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('value')->nullable();
            $table->timestamps();
        });

        Schema::create('powers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('value')->nullable();
            $table->timestamps();
        });

        Schema::create('reactors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('value')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('characteristics');
        Schema::dropIfExists('arms');
        Schema::dropIfExists('lamps');
        Schema::dropIfExists('powers');
        Schema::dropIfExists('reactors');
    }
};
