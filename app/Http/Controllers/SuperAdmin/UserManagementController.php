<?php

namespace App\Http\Controllers\SuperAdmin;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Branch;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('superAdmin.userManagement.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $branches = Branch::all();
        return view('superAdmin.userManagement.create', [
            'roles' => $roles,
            'branches' => $branches,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'role_id' => 'required|exists:App\Models\Role,id',
            'branch_id' => 'nullable|exists:App\Models\Branch,id',
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);
        if($validated['role_id'] == 1 || $validated['role_id'] == 2 || $validated['role_id'] == 3) {
            unset($validated['branch_id']);
        }
        User::create($validated);
        $request->session()->flash('success', 'User : '.$validated['name'].' berhasil ditambahkan!');
        return redirect(route('super-admin.user-management.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($school)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user_management)
    {
        $roles = Role::all();
        $branches = Branch::all();
        return view('superAdmin.userManagement.edit', [
            'user' => $user_management,
            'roles' => $roles,
            'branches' => $branches,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user_management)
    {
        $validated = $request->validate([
            'role_id' => 'required|exists:App\Models\Role,id',
            'branch_id' => 'nullable|exists:App\Models\Branch,id',
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$user_management->id,
            'password' => 'nullable|confirmed|min:8',
        ]);
        if($validated['role_id'] == 1 || $validated['role_id'] == 2 || $validated['role_id'] == 3) {
            unset($validated['branch_id']);
        }
        if(!$validated['password']) {
            unset($validated['password']);
        }
        $user_management->fill($validated);
        $user_management->save();
        $request->session()->flash('success', 'User : '.$user_management['name'].' berhasil diubah!');
        return redirect(route('super-admin.user-management.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user_management)
    {
        $user_management->delete();
        $request->session()->flash('success', 'User : '.$user_management['name'].' berhasil diubah!');
        return redirect(route('super-admin.user-management.index'));
    }
}
