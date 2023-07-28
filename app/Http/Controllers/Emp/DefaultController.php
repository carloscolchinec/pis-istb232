<?php

namespace App\Http\Controllers\Emp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DefaultController extends Controller
{
    public function dashboard() 
    {
        return view('user.dashboard.index');
    }
}
