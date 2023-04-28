<?php

namespace App\Http\Controllers;

use App\Models\UserDetail;
use App\Http\Requests\StoreUserDetailRequest;
use App\Http\Requests\UpdateUserDetailRequest;

class UserDetailController extends Controller
{
    private $user_details, $users;

    public function __construct()
    {
        $this->user_details = \App\Tables\UserDetails::class;
        $this->users = \App\Models\User::whereDoesntHave('roles', function($q){
            return $q->where(['role_id' => [1, 2, 3, 5, 6, 7]]);
        })->pluck('name', 'id');
        // dd($this->users);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.user_details.index', ['user_details' => $this->user_details]);
    }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(StoreUserDetailRequest $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     */
    public function show(UserDetail $userDetail)
    {
        //
        return view('admin.user_details.show', ['user_detail' => $userDetail, 'users' => $this->users]);

    }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(UserDetail $userDetail)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserDetailRequest $request, UserDetail $userDetail)
    {
        //
        dd($request->all());
    }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(UserDetail $userDetail)
    // {
    //     //
    // }
}
