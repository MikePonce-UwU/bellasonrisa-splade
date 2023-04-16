<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Tables\Roles;

class RoleController extends Controller
{
    private $roles, $permissions;
    public function __construct()
    {
        $this->roles = Roles::class;
        $this->permissions = Permission::pluck('name', 'id');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.roles.index', ['roles' => $this->roles, 'permissions' => $this->permissions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //

    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        //
        $role = Role::create(['name' => $request->input('name')]);
        $role->permissions()->sync($request->input('permissions'));
        return redirect()->route('roles.index')->with('flash.banner', '[' . $role->created_at . '] El rol fue creado: ' . $role->name)->with('flash.bannerStyle', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
        return view('admin.roles.show', ['role' => $role, 'permissions' => $this->permissions]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Role $role)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        //
        // $role->name = $request->input('name');
        // $role->save();
        $role->permissions()->sync($request->input('permissions'));
        return redirect()->route('roles.index')->with('flash.banner', '[' . $role->updated_at . '] El rol fue modificado: ' . $role->name)->with('flash.bannerStyle', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }
}
