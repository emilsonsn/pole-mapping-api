<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PHPUnit\Event\Application\Finished;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('maintenances', function (Blueprint $table) {
            $table->string('conclusion_photo_path')
                ->after('photo_path')
                ->nullable();
            $table->enum('status', ['PENDING', 'FINISHED'])
                ->after('conclusion_photo_path')
                ->default('PENDING');            
            $table->text('description')
                ->after('status')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('maintenances', function (Blueprint $table) {
            $table->dropColumn('conclusion_photo_path');
            $table->dropColumn('status');
            $table->dropColumn('description');
        });
    }
};
