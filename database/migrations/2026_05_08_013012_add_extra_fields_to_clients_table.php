<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('industry')->nullable()->after('address');
            $table->string('website')->nullable()->after('industry');
            $table->string('status')->default('active')->after('website'); // active, inactive, prospect
            $table->text('note')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn(['industry', 'website', 'status', 'note']);
        });
    }
};
