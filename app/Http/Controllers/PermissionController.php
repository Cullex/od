<?php

namespace App\Http\Controllers;

use App\filters\PermissionFilter;
use App\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(PermissionFilter $filter)
    {
        return api()->data('permissions' , Permission::filter($filter)->paginate(\request('size')))->build();
    }
}
