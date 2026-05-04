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
            $table->text('mission_statement')->nullable();
            $table->text('vision_statement')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profile_infos', function (Blueprint $table) {
            $table->dropColumn(['mission_statement', 'vision_statement']);
        });
    }
};
