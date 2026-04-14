<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileInfo extends Model
{
    protected $fillable = [
        'company_name', 'logo', 'hero_title', 'hero_subtitle', 
        'about_text', 'about_image', 'hero_bg', 'address', 'phone', 'email', 
        'facebook_url', 'linkedin_url', 'instagram_url',
        'meta_title', 'meta_description', 'meta_keywords', 'footer_text'
    ];
}
