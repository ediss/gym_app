<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Services\AuthenticationService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function showLoginForm()
    {
        return view('web.auth.login');
    }

    public function login(LoginRequest $request, AuthenticationService $service)
    {
        $validatedData = $request->validated();

        if (Auth::attempt([
            'email' => $validatedData['email'],
            'password' => $request['password'],
        ], $validatedData['remember']
        )) {
            // Authentication successful

            return $service->redirectLogedInUserBasedOnRole();
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
