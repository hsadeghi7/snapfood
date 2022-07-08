<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Food;
use App\Models\Role;
use App\Models\User;
use App\Models\Address;
use App\Models\Restaurant;
use App\Policies\CartPolicy;
use App\Policies\FoodPolicy;
use App\Policies\UserPolicy;
use App\Policies\RestaurantPolicy;
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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Restaurant::class => RestaurantPolicy::class,
        // Role::class => RolePolicy::class,
        Coupon::class => CouponPolicy::class,
        Address::class => AddressPolicy::class,
        User::class => UserPolicy::class,
        Food::class => FoodPolicy::class,
        Cart::class => CartPolicy::class,


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
