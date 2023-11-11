<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Coach;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function getCoaches() {
        $coaches = Coach::all();

        dd($coaches);
    }
}
