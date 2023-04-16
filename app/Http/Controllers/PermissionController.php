<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Tables\Permissions;

class PermissionController extends Controller
{
    private $permissions;
    public function __construct()
    {
        $this->permissions = Permissions::class;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.permissions.index', ['permissions' => $this->permissions]);
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
        $permission = Permission::create(['name' => $request->input('name')]);
        return redirect()->route('permissions.index')->with('flash.banner', '[' . $permission->created_at . '] El permiso fue creado: ' . $permission->name)->with('flash.bannerStyle', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
        return view('pages.permissions.show', ['permission' => $permission]);
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
    // public function update(UpdateRoleRequest $request, Permission $role)
    // {
    //     //
    //     // $role->name = $request->input('name');
    //     // $role->save();
    //     return redirect()->route('roles.index')->with('flash.banner', '[' . $role->updated_at . '] El rol fue modificado: ' . $role->name)->with('flash.bannerStyle', 'success');
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        //
    }
}
