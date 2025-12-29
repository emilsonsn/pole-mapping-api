<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Grammars\RenameColumn;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('poles', function (Blueprint $table) {
            $table->removeColumn('remote_management_relay');
            $table->string('remote_management_relay_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('poles', function (Blueprint $table) {
            $table->removeColumn('remote_management_relay_path');
            $table->string('remote_management_relay')->nullable();
        });
    }
};
