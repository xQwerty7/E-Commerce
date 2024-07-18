<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Login $event)
    {
        $role = Auth::user()->role;

        switch ($role) {
            case 'superadmin':
                $redirectTo = '/superadmin/dashboard';
                break;
            case 'admin':
                $redirectTo = '/admin/dashboard';
                break;
            default:
                $redirectTo = '/dashboard';
                break;
        }

        session(['url.intended' => $redirectTo]);
    }
}
