<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Tables\Users;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    private $users, $roles;
    public function __construct()
    {
        $this->users = Users::class;
        $this->roles = Role::pluck('name', 'id');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('pages.users.index', ['users' => $this->users, 'roles' => $this->roles]);
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
    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
        return redirect()->route('users.index')->with('flash.banner', '[' . $user->created_at . '] El usuario fue creado: ' . $user->name)->with('flash.bannerStyle', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
        return view('pages.users.show', ['user' => $user, 'roles' => $this->roles]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(User $user)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $request->input('password') !== null ? $user->password = bcrypt($request->input('password')) : null;
        $user->save();
        $user->roles()->sync($request->input('roles'));
        return redirect()->route('users.index')->with('flash.banner', '[' . $user->updated_at . '] El usuario fue modificado: ' . $user->name)->with('flash.bannerStyle', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
        $user->delete();
        return redirect()->route('users.index')->with('flash.banner', '[' . $user->deleted_at . '] El usuario fue eliminado: ' . $user->name)->with('flash.bannerStyle', 'danger');
    }
}
