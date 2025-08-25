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
            $table->string('remote_management_relay')->nullable()->after('height');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('poles', function (Blueprint $table) {
            $table->dropColumn('remote_management_relay');
        });
    }
};
