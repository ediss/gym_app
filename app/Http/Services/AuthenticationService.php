<?php
namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;

class AuthenticationService {
    public function redirectLogedInUserBasedOnRole() {

        
        /** 
         * @var \App\Models\User 
         * */

        $user = Auth::user();

        if ($user->hasRole('SuperAdmin')) {
            return redirect()->route('superadmin.coaches');

        }

        if ($user->hasRole('Admin')) {
            return redirect('/admin-dashboard');
        }

        if ($user->hasRole('Gym')) {
            return redirect('/gym-dashboard');
        }

        if ($user->hasRole('Coach')) {
            return redirect()->route('appointments.index');
        }

        if ($user->hasRole('Client')) {
            return redirect('/client-dashboard');
        }
    }
}
