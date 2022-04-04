<?php

namespace App\Http\Controllers;

use App\filters\RoleFilter;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(RoleFilter $filter)
    {
        return api()->data('roles' , Role::filter($filter)->paginate(\request('size')))->build();
    }

    public function store(Request $request)
    {
        $request->validate([
           'name' => ['required' ,'unique:roles,name'],
           'permissions' => ['required'],
        ]);

        /** @var Role $model */
        $model = Role::query()->create([
            'name' => $request->get('name')
        ]);

        $model->syncPermissions($request->get('permissions'));

        return api()->data('model' , $model)->build('Role was created successfully');
    }

    public function update(Request $request , Role $model)
    {
        $request->validate([
            'name' => ['required' , 'unique:roles,name,'.$model->id],
            'permissions' => ['required'],
        ]);

        $model->update([
            'name' => $request->get('name')
        ]);

        $model->syncPermissions($request->get('permissions'));

        return api()->data('model' , $model)->build('Role was updated successfully');
    }

    public function view(Role $model)
    {
        $model->load(['permissions']);
        return api()->data('model' , $model)->build();
    }

}
