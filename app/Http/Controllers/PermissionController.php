<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    public function index() {
        return view('admin.permissions.index', ['permissions' => Permission::all()]);
    }

    public function store() {
        request()->validate([
            'name' => ['required']
        ]);

        Permission::create([
            'name' => Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-')
        ]);

        return back();
    }

    public function edit(Permission $permission) {
        return view('admin.permissions.edit', ['permission' => $permission]);
    }

    public function update(Permission $permission) {
        request()->validate([
            'name' => ['required']
        ]);
        $permission->name = Str::ucfirst(request('name'));
        $permission->slug = Str::of(Str::lower(request('name')))->slug('-');

        if ($permission->isClean('name')) {
            session()->flash('message', 'you didn not change anything!');
        } else {
            $permission->save();
            session()->flash('message', 'the permission is updated!');
        }
        return back();
    }

    public function destroy(Permission $permission) {
        $permission->delete();
        return back();
    }
}
