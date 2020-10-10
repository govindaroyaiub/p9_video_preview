<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\MainProject;
use App\SubProject;
use App\Comments;
use App\Sizes;
use App\Logo;

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
        $project_list = MainProject::orderBy('created_at', 'DESC')->get();
        return view('project', compact('project_list'));
    }

    public function project_add()
    {
        $logo_list = Logo::get();
        $size_list = Sizes::orderBy('width', 'DESC')->get();
        return view('add_project', compact('logo_list', 'size_list'));
    }

    public function project_add_post(Request $request)
    {
        $main_project = new MainProject;
        $main_project->name = $request->project_name;
        $main_project->client_name = $request->client_name;
        $main_project->logo_id = $request->logo_id;
        $main_project->color = $request->color;
        $main_project->is_logo = 1;
        $main_project->is_footer = 1;
        $main_project->save();

        $request->validate([
            'poster' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $poster_name = $request->project_name.time().'.'.$request->poster->extension();  
        $request->poster->move(public_path('poster_images'), $poster_name);

        $video_name = $request->project_name.time().'.'.$request->video->extension();  
        $request->video->move(public_path('banner_videos'), $video_name);

        $size_info = Sizes::where('id', $request->size_id)->first();
        $sub_project = new SubProject;
        $sub_project->name = $request->project_name.'_'.$size_info['width'].'x'.$size_info['height'];
        $sub_project->project_id = $main_project->id;
        $sub_project->size_id = $request->size_id;
        $sub_project->codec = $request->codec;
        $sub_project->aspect_ratio = $request->aspect_ratio;
        $sub_project->fps = $request->fps;
        $sub_project->size = $request->size;
        $sub_project->poster_path = $poster_name;
        $sub_project->video_path = $video_name;
        $sub_project->save();
    }

    public function client()
    {
        $logo_list = Logo::get();
        return view('client_list', compact('logo_list'));
    }

    public function client_add()
    {
        return view('add_logo');
    }

    public function logo_add_post(Request $request)
    {
        $request->validate([
            'logo_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $imageName = $request->company_name.time().'.'.$request->logo_file->extension();  
        $request->logo_file->move(public_path('logo_images'), $imageName);

        $logo = new Logo;
        $logo->name = $request->company_name;
        $logo->path = $imageName;
        $logo->save();

        return redirect('/logo')->with('success', 'Logo for '.$request->company_name.' has been uploaded!');
    }

    public function logo_delete($id)
    {
        $logo_info = Logo::where('id', $id)->first();
        Logo::where('id', $id)->delete();

        $image_path = public_path('logo_images/').$logo_info['path']; 
        if (file_exists($image_path)) {
            @unlink($image_path);
        }
        return redirect('/logo')->with('danger', $logo_info['name'].' logo has been deleted!');
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
        $size = New Sizes;
        $size->name = $request->size_name;
        $size->width = $request->width;
        $size->height = $request->height;
        $size->front_width = $request->front_width;
        $size->front_height = $request->front_height;
        $size->save();
        
        return redirect('/sizes')->with('success', 'Size Added Successfully!');
    }

    public function size_delete($id)
    {
        $size_info = Sizes::where('id', $id)->first();
        Sizes::where('id', $id)->delete();
        return redirect('/sizes')->with('danger', $size_info['name'].' ('.$size_info['width'].'X'.$size_info['height'].')'.' has been deleted!');
    }
}
