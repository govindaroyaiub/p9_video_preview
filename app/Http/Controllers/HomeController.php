<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\MainProject;
use App\SubProject;
use App\Comments;
use App\Sizes;

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
        $user_list = User::get();
        return view('home', compact('user_list'));
    }

    public function project()
    {
        return view('project');
    }

    public function project_add()
    {
        return view('add_project');
    }

    public function client()
    {
        return view('client_list');
    }

    public function client_add()
    {
        dd('client_add');
    }

    public function sizes()
    {
        return view('sizes');
    }
}
