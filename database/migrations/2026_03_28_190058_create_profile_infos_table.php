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
        Schema::create('profile_infos', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('logo')->nullable();
            $table->string('hero_title');
            $table->text('hero_subtitle')->nullable();
            $table->text('about_text')->nullable();
            $table->string('about_image')->nullable();
            $table->string('hero_bg')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            
            // Social Links
            $table->string('facebook_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->text('google_map_url')->nullable();

            // Mission & Vision
            $table->text('mission_statement')->nullable();
            $table->text('vision_statement')->nullable();

            // Stats
            $table->string('stat_clients')->nullable()->default('232');
            $table->string('stat_projects')->nullable()->default('521');
            $table->string('stat_hours')->nullable()->default('1453');
            $table->string('stat_workers')->nullable()->default('32');

            // Topbar Settings
            $table->string('topbar_address')->nullable();
            $table->string('topbar_phone')->nullable();
            $table->boolean('show_topbar_contact')->default(true);
            $table->boolean('show_topbar_social')->default(true);

            // SEO & Footer
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('footer_text')->nullable();
            $table->text('footer_description')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_infos');
    }
};
