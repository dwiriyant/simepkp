<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Show the customer list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // echo auth()->user()->unreadNotifications;
        return view('customer.index');
    }

    public function edit()
    {
        // echo auth()->user()->unreadNotifications;
        return view('customer.edit');
    }
}
