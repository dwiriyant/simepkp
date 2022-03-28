<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class ChangePasswordController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Request $request)
    {
        return view('change-password', [
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        Auth::user()->update($validated);
        $request->session()->flash('success', 'Password berhasil diperbarui!');
        return redirect()->back();
    }

}
