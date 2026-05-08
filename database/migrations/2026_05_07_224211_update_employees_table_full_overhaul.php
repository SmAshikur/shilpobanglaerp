<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            // Make basic_salary nullable
            $table->decimal('basic_salary', 15, 2)->nullable()->default(null)->change();
            // Add soft delete
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->decimal('basic_salary', 15, 2)->default(0)->change();
        });
    }
};
