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
        Schema::table('profile_infos', function (Blueprint $table) {
            $table->string('stat_clients')->nullable()->default('232');
            $table->string('stat_projects')->nullable()->default('521');
            $table->string('stat_hours')->nullable()->default('1453');
            $table->string('stat_workers')->nullable()->default('32');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profile_infos', function (Blueprint $table) {
            $table->dropColumn(['stat_clients', 'stat_projects', 'stat_hours', 'stat_workers']);
        });
    }
};
