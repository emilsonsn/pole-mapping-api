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
            $table->string('pole_relay')
                ->nullable()
                ->after('remote_management_relay_path');
            $table->string('pole_image')
                ->nullable()
                ->after('pole_relay');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('poles', function (Blueprint $table) {
            $table->dropColumn('pole_relay');
            $table->dropColumn('pole_image');
        });
    }
};
