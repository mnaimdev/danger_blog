<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;



use Illuminate\Http\Request;

class RoleController extends Controller
{

    function role()
    {
        $permissions = Permission::all();
        return view('admin.role.role', [
            'permissions' => $permissions,
        ]);
    }

    function permission_store(Request $request)
    {
        Permission::create([
            'name' => $request->permission_name
        ]);
        return back();
    }

    function role_store(Request $request)
    {
        $role = Role::create([
            'name' => $request->role_name
        ]);
        $role->givePermissionTo($request->permission);

        return back();
    }
}
