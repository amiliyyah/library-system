<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::define('manage-users', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('manage-master', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('staff', function ($user) {
            return in_array($user->role, ['admin', 'petugas'], true);
        });

        Gate::define('member', function ($user) {
            return $user->role === 'anggota';
        });
    }
}