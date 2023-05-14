<?php

namespace App\Http\Controllers;

use App\Models\UserDetail;
use App\Http\Requests\StoreUserDetailRequest;
use App\Http\Requests\UpdateUserDetailRequest;

class UserDetailController extends Controller
{
    private $user_details, $users, $subjects;

    public function __construct()
    {
        $this->user_details = \App\Tables\UserDetails::class;
        $this->users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where(['role_id' => [4]]);
        })->pluck('name', 'id');
        $this->subjects = \App\Models\Subject::pluck('nombre_corto', 'id');
        // dd($this->users);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.user_details.index', ['user_details' => $this->user_details, 'users' => $this->users, 'subjects' => $this->subjects]);
    }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserDetailRequest $request)
    {
        //
        // dd($request->all());
        $userDetail = UserDetail::create([
            'user_id' => $request->input('user_id'),
            'salario' => $request->input('salario'),
            'adelantos' => $request->input('adelantos'),
            'rango_horas' => $request->input('hora_entrada') . '-' . $request->input('hora_salida'),
            'dias_laborales' => $request->input('dias_laborales'),
        ]);
        $userDetail->user->subjects()->sync($request->input('materias'));
        return redirect()->route('user_details.index')->with('flash.banner', '[' . $userDetail->created_at . '] El detalle del usuario \'' . $userDetail->user->name . '\' fue añadido!');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserDetail $userDetail)
    {
        //
        $horas = str($userDetail->rango_horas)->split('/[\s-]+/');
        $hora_entrada = $horas[0];
        $hora_salida = $horas[1];
        $userDetail->hora_entrada = $hora_entrada;
        $userDetail->hora_salida = $hora_salida;
        $userDetail->materias = $userDetail->user->subjects->pluck('id');
        // dd($userDetail);
        return view('admin.user_details.show', ['user_detail' => $userDetail, 'users' => $this->users, 'subjects' => $this->subjects]);
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
        $userDetail->salario = $request->input('salario');
        $userDetail->adelantos = $request->input('adelantos');
        $userDetail->rango_horas = $request->input('hora_entrada') . '-' . $request->input('hora_salida');
        $userDetail->dias_laborales = $request->input('dias_laborales');
        $userDetail->save();

        $userDetail->user->subjects()->sync($request->input('materias'));
        return redirect()->route('user_details.index')->with('flash.banner', '[' . $userDetail->updated_at . '] El detalle del usuario \'' . $userDetail->user->name . '\' fue modificado!');
    }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(UserDetail $userDetail)
    // {
    //     //
    // }
}
