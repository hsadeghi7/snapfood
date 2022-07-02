<?php

namespace App\Providers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        //TODO اضافه کردن پالیسی ها در اینجا
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::define('admin', function (User $user) {
        //     return $user->is_admin;
        // });
        // Gate::define('seller', function (User $user) {
        //     return $user->role == 'seller';
        // });
    }
}
