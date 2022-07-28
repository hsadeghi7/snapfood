<?php

namespace App\Http\Controllers;

// use App\Models\Role;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        $roles = Role::all();

        return view('admin.roles.index', compact('permissions', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();

        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $permissions = Permission::select('name')->get()->toArray();
        $role = Role::create(['name' => $request->name, 'guard_name' => 'web']);

        foreach ($request->permission as  $permission) {
            foreach ($permissions as  $value) {

                if ($value['name'] == $permission) {
                    $permission = Permission::where('name', $value['name'])->first();
                    if (!empty($permission)) {
                        $permission->assignRole($role);
                    }
                }
            }
        }
        return redirect('admin/roles')->with('message', 'Role created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        dd($role);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $users = User::role($role->name)->get();
        foreach ($users as $user) {
            $user->delete();
        }
        $permission = Permission::where('name', $role->name)->first();
        $role->revokePermissionTo($permission);
        $role->delete();

        return redirect('admin/roles')->with('message', 'Role deleted successfully');
    }
}
