<?php

namespace App\Providers;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Models\ContactMessage;

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
        Paginator::useBootstrap();
        View::composer('layouts.admin', function ($view) {
            $messages = ContactMessage::latest()->take(3)->get();
            $view->with('messages', $messages);
        });



        View::composer('*', function ($view) {
            $user = Auth::guard('admin')->user();
            $permissionsArray = [];

            if ($user) {
                $roles = $user->roles;
                foreach ($roles as $role) {
                    foreach ($role->permissions as $permission) {
                        $permissionsArray[$permission->name][] = $role->name;
                    }
                }
            }

            $view->with('permissionsArray', $permissionsArray);
        });


    }
}
