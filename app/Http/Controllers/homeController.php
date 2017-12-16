<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class homeController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Auth::user('name');

        $user['id'] = $data['id'];
        $user['email'] = $data['email'];
        $user['weixin'] = $data['weixin'];
        $user['grade'] = $data['grade'];

        return view('server.index', ['data' => $user]);
    }

    public function quit()
    {
        Auth::logout();

        return view('auth/login');
    }
}
