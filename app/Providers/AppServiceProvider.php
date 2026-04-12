<?php

namespace App\Providers;

use App\View\Composers\SidebarComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // The SidebarComposer runs every time the Inertia root view (app.blade.php)
        // is rendered, injecting $sidebarMenu into the view so HandleInertiaRequests
        // can forward it as a shared Inertia prop.
        View::composer('app', SidebarComposer::class);
    }
}
