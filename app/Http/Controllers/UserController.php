<?php

namespace App\Http\Controllers;

use App\filters\UserFilter;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(UserFilter $filter)
    {
        return api()->data('users' , User::filter($filter)->paginate(\request('size') ?? 30 ))->build();
    }

    public function view(User $model)
    {
        $model->load(['roles' , 'permissions']);
        return api()->data('model' , $model)->build();
    }

    public function store(Request $request)
    {
        $request->validate([
           'name' => ['required'],
           'last_name' => ['required'],
           'email' => ['required' , 'email' , 'unique:users'],
           'password' => ['required'],
        ]);

        /** @var User $model */
        $model = User::query()->create([
           'name' => $request->get('name'),
           'last_name' => $request->get('last_name'),
           'email' => $request->get('email'),
           'password' => Hash::make($request->get('password')),
        ]);

        $model->syncRoles($request->get('roles'));
        $model->syncPermissions($request->get('permissions'));

        return api()->data('model' , $model)->build("User was successfully created");
    }

    public function update(Request $request , User $model)
    {
        $request->validate([
            'name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required' , 'email' , 'unique:users,email,'.$model->id],
        ]);

        $model->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
        ]);

        $model->syncRoles($request->get('roles'));
        $model->syncPermissions($request->get('permissions'));

        return api()->data('model' , $model)->build("User was successfully updated");
    }

    public function activate(User $model)
    {
        $model->update([
            'status' =>  true
        ]);

        $model->load(['roles' , 'permissions']);
        return api()->data('model' , $model)->build("User was successfully activated");
    }

    public function deactivate(User $model)
    {
        $model->update([
            'status' =>  false
        ]);

        $model->load(['roles' , 'permissions']);
        return api()->data('model' , $model)->build("User was successfully deactivate");
    }
}
