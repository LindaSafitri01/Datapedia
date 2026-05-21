<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\FooterItem;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('id');
        View::composer('*', function ($view) {
            $footerSections = FooterItem::where('is_active', true)
                ->orderBy('section', 'asc')
                ->orderBy('sort_order', 'asc')
                ->get()
                ->groupBy('section');

            $view->with('footerSections', $footerSections);
        });
    }
}
