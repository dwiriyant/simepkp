<?php

namespace App\Http\Controllers\SuperAdmin;

use Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Branch;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branchs = Branch::all();
        return view('superAdmin.branch.index', [
            'branchs' => $branchs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superAdmin.branch.create');
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
            'code' => 'required|string',
            'name' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'province' => 'required|string',
        ]);
        Branch::create($validated);
        $request->session()->flash('success', 'Cabang : '.$validated['name'].' berhasil ditambahkan!');
        return redirect(route(Auth::user()->Role->code.'.branch.index'));
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
    public function edit(Branch $branch)
    {
        return view('superAdmin.branch.edit', [
            'branch' => $branch,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
        $validated = $request->validate([
            'code' => 'required|string',
            'name' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'province' => 'required|string',
        ]);
        $branch->fill($validated);
        $branch->save();
        $request->session()->flash('success', 'Cabang : '.$branch['name'].' berhasil diubah!');
        return redirect(route(Auth::user()->Role->code.'.branch.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Branch $branch)
    {
        $branch->delete();
        $request->session()->flash('success', 'Cabang : '.$branch['name'].' berhasil diubah!');
        return redirect(route(Auth::user()->Role->code.'.branch.index'));
    }
}
