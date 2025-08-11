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
        Schema::create('poles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->string('address');
            $table->string('neighborhood');
            $table->string('city');
            $table->foreignId('type_id')->constrained('types');
            $table->decimal('height', 5, 2);
            $table->foreignId('paving_id')->constrained('pavings');
            $table->foreignId('position_id')->constrained('positions');
            $table->foreignId('network_type_id')->constrained('network_types');
            $table->foreignId('connection_type_id')->constrained('connection_types');
            $table->foreignId('transformer_id')->constrained('transformers');
            $table->foreignId('access_id')->constrained('accesses');
            $table->integer('luminaire_quantity');
            $table->string('qrcode')->unique();
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poles');
    }
};
