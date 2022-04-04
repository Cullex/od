<?php

namespace App\Http\Controllers;

use App\filters\UserFilter;
use App\User;
use Illuminate\Http\Request;

class AccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(UserFilter $filter)
    {
        $users = User::filter($filter)->paginate(10);
        return api()->data('users', $users)->build();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $model
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(User $model)
    {
        $user = User::query()->where(['id' => $model->id])->first();
        return api()->data('user', $user)->build();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, User $model)
    {
        $request->validate([
            'status' => ['required'],
            'accessLevel' => ['required'],
        ]);

        $model = User::query()->where(['id' => $model->id])->update([
            'status' => $request->get('status'),
            'accessLevel' => $request->get('accessLevel'),
        ]);
        return api()->data('model', $model)->build('role updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
