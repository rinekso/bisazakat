<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
                'name' => 'required|unique:roles|max:10',
                'permissions' => 'required',
            ]
        );

        $role = new Role();
        $role->name = $request->name;
        $role->save();

        if ($request->permissions <> '') {
            $role->permissions()->attach($request->get('permissions'));
        }

        return redirect()->route('admin.roles.index')->withSuccess('success', 'Role berhasil ditambahkan');
    }

    public function show()
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|max:10|unique:roles,name,' . $id,
            'permissions' => 'required',
        ]);

        $input = $request->except(['permissions']);
        $role->fill($input)->save();
        if ($request->permissions <> '') {
            $role->permissions()->sync($request->permissions);
        }
        return redirect()->route('admin.roles.index')->with('success', 'Role berhasil diubah');
    }
}
