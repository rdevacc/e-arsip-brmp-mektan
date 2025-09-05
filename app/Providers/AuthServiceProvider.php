<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        /**
         * Gate untuk akses menu khusus Super Admin
         */
        Gate::define('super-admin', function ($user) {
            return $user->role->name === 'SuperAdmin';
        });

        /**
         * Gate untuk akses menu khusus Pimpinan
         */
        Gate::define('pimpinan', function ($user) {
            return $user->role->name === 'Pimpinan';
        });

        /**
         * Gate untuk akses menu khusus Pengguna
         */
        Gate::define('pengguna', function ($user) {
            return $user->role->name === 'Pengguna';
        });

        /**
         * Gate untuk Cek akses create arsip: Super Admin bisa semua, user lain hanya arsip miliknya
         */
        Gate::define('create-archive', function ($user) {
            return $user->role->name === 'SuperAdmin' || $user->role->name === "Pengguna";
        });

        /**
         * Gate untuk Cek akses edit arsip: Super Admin bisa semua, user lain hanya arsip miliknya
         */
        Gate::define('edit-archive', function ($user, $archive) {
            return $user->role->name === 'SuperAdmin' || $archive->user->id === $user->id;
        });

    }
}
