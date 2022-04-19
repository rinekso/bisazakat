<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index() {
        $permissions = Permission::all();

        return view('admin.permissions.index', compact('permissions'));
    }

    public function create() {

        $roles = Role::all();
        return view('admin.permissions.create', compact('roles'));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name'=>'required|max:40',
        ]);

        $permission = new Permission();
        $permission->name = $request->get('name');
        $permission->save();

        if ($request->roles != null) {
            foreach ($request->roles as $key=>$value) {
                $role = Role::find($value);
                $role->permissions()->attach($permission);
            }
        }

        return redirect()->route('admin.permissions.index')->withSuccess(trans('app.success_store'));
    }

    public function show() {

    }

    public function edit(Permission $permission) {
        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission) {
        $this->validate($request, [
            'name'=>'required',
        ]);

        $permission->name = $request->get('name');
        $permission->save();

        return redirect()->route('admin.permissions.index')
            ->withSuccess('Permission '. $permission->name.' berhasil diupdate!');
    }
}
