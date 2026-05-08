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
            $table->string('topbar_address')->nullable();
            $table->string('topbar_phone')->nullable();
            $table->boolean('show_topbar_contact')->default(true);
            $table->boolean('show_topbar_social')->default(true);
        });
    }

    public function down(): void
    {
        Schema::table('profile_infos', function (Blueprint $table) {
            $table->dropColumn(['topbar_address', 'topbar_phone', 'show_topbar_contact', 'show_topbar_social']);
        });
    }
};
