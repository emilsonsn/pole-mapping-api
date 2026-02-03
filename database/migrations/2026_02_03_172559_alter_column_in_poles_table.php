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
            $table->dropColumn('pole_relay');
            $table->string('number')
                ->nullable()
                ->after('address');
            $table->unsignedBigInteger('relay_id')
                ->nullable()
                ->after('remote_management_relay_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('poles', function (Blueprint $table) {
            $table->dropColumn('relay_id');
            $table->dropColumn('number');                
            $table->string('pole_relay')
                ->nullable()
                ->after('remote_management_relay_path');
        });
    }
};
