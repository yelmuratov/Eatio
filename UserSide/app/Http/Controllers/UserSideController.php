<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserSideController extends Controller
{
    public function home()
    {
        return view('user.index');
    }
}
