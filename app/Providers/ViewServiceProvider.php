<?php

namespace App\Providers;

use App\Models\SectionSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer(['welcome', 'layouts.app', 'about', 'contact', 'service-details', 'team-details', 'portfolio-details', 'event-details'], function ($view) {
            $view->with('sectionSettings', SectionSetting::all()->keyBy('key'));
        });
    }
}
