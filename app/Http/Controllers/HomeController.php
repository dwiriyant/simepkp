<?php

namespace App\Http\Controllers;

use Auth;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::user() === null)
            redirect(route('login'));
        if(Auth::user()->can('isSuperAdmin')) {
            return redirect(route('super-admin.dashboard'));
        } else if(Auth::user()->can('isHeadOfficeAdmin')) {
            return redirect(route('head-office-admin.dashboard'));
        } else if(Auth::user()->can('isBranchOfficeAdmin')) {
            return redirect(route('branch-office-admin.dashboard'));
        } else if(Auth::user()->can('isBranchManager')) {
            return redirect(route('branch-manager.dashboard'));
        } else if(Auth::user()->can('isSupervisor')) {
            return redirect(route('supervisor.dashboard'));
        } else if(Auth::user()->can('isCreditManager')) {
            return redirect(route('credit-manager.dashboard'));
        } else if(Auth::user()->can('isCreditCollection')) {
            return redirect(route('credit-collection.dashboard'));
        } else if(Auth::user()->can('isSuperRole')) {
            return redirect(route('super-role.dashboard'));
        } else {
            Auth::logout();
            return redirect(route('login'));
        }    
    }


}
