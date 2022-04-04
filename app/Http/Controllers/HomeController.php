<?php

namespace App\Http\Controllers;

use App\Complaint;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /** @var User $user */
        $user = auth()->user();
        $p = $user->getAllPermissions();
        $user = $user->toArray();
        $user['permissions'] = $p;
        return view('home' , [
            'user' => $user
        ]);
    }

    public function dashboard()
    {
        return null;

    }


}
