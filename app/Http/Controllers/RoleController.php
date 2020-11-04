<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index() {
        $roles = Role::all();
        return view('admin.roles.index', ['roles' => $roles]);
    }

    public function store() {
        request()->validate([
            'name' => ['required']
        ]);
        $name = request('name');
        Role::create([
            'name' => Str::ucfirst($name),
            'slug' => Str::of(Str::lower($name))->slug('-')
        ]);

        return back();
    }

    public function edit(Role $role) {
        return view('admin.roles.edit', ['role' => $role, 'permissions' => Permission::all()]);
    }

    public function update(Role $role) {
        request()->validate([
            'name' => ['required']
        ]);
        $role->name = Str::ucfirst(request('name'));
        $role->slug = Str::of(Str::lower(request('name')))->slug('-');

        if ($role->isClean('name')) {
            session()->flash('message', 'you didn not change anything!');
        } else {
            $role->save();
            session()->flash('message', 'the role is updated!');
        }
        return back();
    }

    public function attach_permission(Role $role) {
        $role->permissions()->attach(request('permission'));
        return back();
    }

    public function detach_permission(Role $role) {
        $role->permissions()->detach(request('permission'));
        return back();
    }

    public function destroy(Role $role) {
        $role->delete();
        session()->flash('message', 'role ' . $role->name . ' was deleted!');
        return back();
    }
}
