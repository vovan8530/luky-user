<?php

namespace App\Providers;

use App\Http\Middleware\NewRedirectIfAuthenticatedMiddleware;
use App\Models\User;
use App\Policies\UserPolicy;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->instance(RedirectIfAuthenticated::class, new NewRedirectIfAuthenticatedMiddleware());
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(User::class, UserPolicy::class);
    }
}
