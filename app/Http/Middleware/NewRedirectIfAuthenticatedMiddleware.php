<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class NewRedirectIfAuthenticatedMiddleware extends RedirectIfAuthenticated
{
    /**
     * Get the default URI the user should be redirected to when they are authenticated.
     */
    protected function defaultRedirectUri(): string
    {
//        foreach (['admin.index', 'page-a', 'home'] as $uri) {
            if (Auth::user()->isAdministrator()) {
                return route('admin.index');
            }
                return Auth::user()->link_page_a;
//        }

        $routes = Route::getRoutes()->get('GET');

        foreach (['page-a', 'home'] as $uri) {
            if (isset($routes[$uri])) {
                return '/'.$uri;
            }
        }

        return '/';
    }

}
