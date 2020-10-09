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
        $total_projects = MainProject::get()->count();
        $total_videos = SubProject::get()->count();
        $total_comments = Comments::get()->count();
        return view('home', compact('user_list', 'total_projects', 'total_videos', 'total_comments'));
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
        $size_list = Sizes::orderBy('width', 'DESC')->get();
        return view('sizes', compact('size_list'));
    }

    public function size_add()
    {
        return view('add_size');
    }

    public function size_add_post(Request $request)
    {
        $size_detials = [
            'name' => $request->size_name,
            'width' => $request->width,
            'height' => $request->height,
            'front_width' => $request->front_width,
            'front_height' => $request->front_height
        ];
        
        Sizes::insert($size_detials);
        return redirect('/sizes')->with('success', 'Size Added Successfully!');
    }

    public function size_delete($id)
    {
        $size_info = Sizes::where('id', $id)->first();
        Sizes::where('id', $id)->delete();
        return redirect('/sizes')->with('danger', $size_info['name'].' ('.$size_info['width'].'X'.$size_info['height'].')'.' has been deleted!');
    }
}
