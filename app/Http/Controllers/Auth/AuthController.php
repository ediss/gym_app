<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function showLoginForm()
    {
        return view('web.auth.login');
    }
    public function login(LoginRequest $request)
    {
       $validatedData = $request->validated();


        if (Auth::attempt([
                'email' => $validatedData['email'],
                'password' => $request['password']
            ], $validatedData['remember']
        )) {
            // Authentication successful

            // Redirect the user to their respective dashboard based on their role
            if (Auth::user()->hasRole('SuperAdmin')) {
                return redirect('/superadmin-dashboard');
            }

            if (Auth::user()->hasRole('Admin')) {
                return redirect('/admin-dashboard');
            }

            if (Auth::user()->hasRole('Gym')) {
                return redirect('/gym-dashboard');
            }

            if (Auth::user()->hasRole('Coach')) {
                return redirect()->route('appointments.index');
            }

            if (Auth::user()->hasRole('Client')) {
                return redirect('/client-dashboard');
            }
        }

        // Authentication failed
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
