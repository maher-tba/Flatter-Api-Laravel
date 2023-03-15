<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Role;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Pagination\Paginator;
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
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Paginator::useBootstrap();
        Gate::define('admin-access',function ($user){
            return $user->is_admin == Role::IS_ADMIN;
        });

        Gate::define('user-access',function ($user){
            return $user->role_id == Role::IS_USER;
        });

//        Gate::define('users-update',function ($user){
//            return $user->hasRole(['admin','author']);
//        });

        //
    }
}
