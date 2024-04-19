<?php

namespace App\Http\Controllers;

use App\Http\Services\AuthenticationService;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(AuthenticationService $service) {
        if(Auth::check()) {
            return $service->redirectLoggedInUserBasedOnRole();
        }else {
            return redirect("/login");
        }

        
    }
}
