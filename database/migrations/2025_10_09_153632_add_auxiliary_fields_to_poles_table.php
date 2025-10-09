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
        Schema::table('poles', function (Blueprint $table) {
            $table->foreignId('characteristic_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('arm_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('lamp_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('power_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('reactor_id')->nullable()->constrained()->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('poles', function (Blueprint $table) {
            $table->dropConstrainedForeignId('characteristic_id');
            $table->dropConstrainedForeignId('arm_id');
            $table->dropConstrainedForeignId('lamp_id');
            $table->dropConstrainedForeignId('power_id');
            $table->dropConstrainedForeignId('reactor_id');
        });
    }
};
