<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
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
        return view('dashboard.roles.index', [
            'roles' => Role::with('permissions')->orderBy('id', 'desc')->paginate(10),
            'rolesCount' => Role::count(),
            'permissions' => Permission::all()
        ]);
    }

    /**
    * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
      * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles|string|max:100',
            'permissions' => 'filled|array'
        ]);

        $role = Role::create([
            'name' => $request->input('name'),
            'guard_name' => 'web'
        ]);

        if ($request->has('permissions')) {
            $role->givePermissionTo($request->input('permissions'));
        }

        return redirect()->route('dashboard.roles.index')->with('success', 'Role created.');
    }

    /**
     * Display the specified resource.
     * 
     * @param  \Spatie\Permission\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('dashboard.roles.show', [
            'role' => $role,
            'permissions' => $role->permissions()->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param  \Spatie\Permission\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('dashboard.roles.edit', [
            'role' => $role,
            'permissions' => Permission::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \Spatie\Permission\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100'
        ]);
        $role->update([$request->except(['permissions', 'guard_name'])]);

        $role->syncPermissions($request->input('permissions'));

        return redirect()->route('dashboard.roles.index')->with('success', 'Role updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Spatie\Permission\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('dashboard.roles.index')->with('success', 'Role deleted.');
    }
}
