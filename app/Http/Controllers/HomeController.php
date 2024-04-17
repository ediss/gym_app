<?php

namespace App\Http\Controllers;

use App\Http\Services\AuthenticationService;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(AuthenticationService $service) {
        if(Auth::check()) {
            return $service->redirectLogedInUserBasedOnRole();
        }else {
            return redirect("/login");
        }
    }
}
