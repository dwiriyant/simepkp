<?php

namespace App\Http\Controllers;

use Auth;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::user() === null)
            redirect(route('login'));
        switch (Auth::user()->Role->code) {
            case 'super-admin':
                return redirect(route('super-admin.home'));
                break;
            
            default:
                Auth::logout();
                return redirect(route('login'));
        }
    }


}
