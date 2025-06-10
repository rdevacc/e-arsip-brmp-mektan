<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::get(['id', 'name']);

        return view('apps.role.index', compact('roles'));
    }

    public function create(){
        return view('apps.role.create');
    }

    public function store(Request $request){
         $validated = $request->validate([
             'name' => 'required'
         ],[
            'name.required' => 'Nama Role field is required!',
         ]
        );

        Role::create($validated);

        return redirect()->route('role.index')->with('success', 'Data Role Baru Berhasil Ditambahkan');

    }

    public function edit(Role $role){

        return view('apps.role.edit', compact('role'));
    }

    public function update(Request $request, Role $role){
         $validated = $request->validate([
             'name' => 'required'
         ],[
            'name.required' => 'Nama Role field is required!',
         ]
        );

        Role::where('id', $role->id)->update($validated);

        return redirect()->route('role.index')->with('success', 'Data Role Berhasil Diupdate');
    }

    public function destroy(Role $role){
        // Destroy data by id
        Role::destroy($role->id);

        return redirect()->route('role.index')->with('success', 'Data Role Berhasil Dihapus');
    }
}