<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        if(auth()->check() && auth()->user()->role == 'admin') {
            return redirect()->route('admin.index');
        }

        return view('user.index');
    }

    public function admin()
    {
        return view('admin.index');
    }
}
