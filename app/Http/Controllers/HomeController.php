<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
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
        $user_list = User::orderBy('name', 'ASC')->get();
        $total_projects = MainProject::get()->count();
        $total_videos = SubProject::get()->count();
        $total_comments = Comments::get()->count();
        $video_sizes = SubProject::select('size')->get();
        $total_size = array();

        foreach($video_sizes as $video)
        {
            $size_text = $video->size;
            $size_number = trim($size_text," MB");

            array_push($total_size, floatval($size_number));
        }

        $total_size = array_sum($total_size);
        if($total_size <= 1024)
        {
            $total_number = round($total_size, 2).' MB';
        }
        if($total_size > 1024 && $total_size <= 2048)
        {
            $total_number = round($total_size/1024,2).' GB';
        }
        return view('home', compact('user_list', 'total_projects', 'total_videos', 'total_comments', 'total_number'));
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
        $pro_name = $request->project_name;
        $project_name = str_replace(" ","_", $request->project_name);
        $main_project = new MainProject;
        $main_project->name = $pro_name;
        $main_project->client_name = $request->client_name;
        $main_project->logo_id = $request->logo_id;
        $main_project->color = $request->color;
        $main_project->is_logo = 1;
        $main_project->is_footer = 1;
        $main_project->save();

        $request->validate([
            'poster' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'video' => 'required',
        ]);

        $size_info = Sizes::where('id', $request->size_id)->first();
        $sub_project_name = $project_name.'_'.$size_info['width'].'x'.$size_info['height'];

        if($request->has('poster'))
        {
            $poster_name = $sub_project_name.'_'.time().'.'.$request->poster->extension();
            $request->poster->move(public_path('poster_images'), $poster_name);
        }
        else
        {
            $poster_name = NULL;
        }

        $video_name = $sub_project_name.'_'.time().'.'.$request->video->extension();
        $request->video->move(public_path('banner_videos'), $video_name);

        $sub_project = new SubProject;
        $sub_project->name = $sub_project_name;
        $sub_project->title = $request->title;
        $sub_project->project_id = $main_project->id;
        $sub_project->size_id = $request->size_id;
        $sub_project->codec = $request->codec;
        $sub_project->aspect_ratio = $request->aspect_ratio;
        $sub_project->fps = $request->fps;
        $sub_project->size = $request->size;
        $sub_project->poster_path = $poster_name;
        $sub_project->video_path = $video_name;
        $sub_project->save();

        return redirect('/project/view/'.$main_project->id);
    }

    public function project_edit($id)
    {
        $logo_list = Logo::get();
        $size_list = Sizes::orderBy('width', 'DESC')->get();
        $project_info = MainProject::where('id', $id)->first();
        return view('edit_project', compact('logo_list', 'size_list', 'project_info', 'id'));
    }

    public function project_edit_post(Request $request, $id)
    {
        $main_project_id = $id;
        $pro_name = $request->project_name;
        $project_name = str_replace(" ","_", $request->project_name);
        $sub_projects = SubProject::where('project_id', $main_project_id)->get();

        $main_project_details = [
            'name' => $pro_name,
            'client_name' => $request->client_name,
            'logo_id' => $request->logo_id,
            'color' => $request->color,
            'is_logo' => $request->is_logo,
            'is_footer' => $request->is_footer
        ];

        MainProject::where('id', $main_project_id)->update($main_project_details);

        foreach($sub_projects as $sub_project)
        {
            $size_info = Sizes::where('id', $sub_project['size_id'])->first();

            $old_sub_project_name = $sub_project->name;
            $old_poster_path = $sub_project->poster_path;
            $old_video_path = $sub_project->video_path;

            $new_sub_project_name = $project_name.'_'.$size_info['width'].'x'.$size_info['height'];

            if($old_poster_path != NULL)
            {
                $rest_poster_path = trim($old_poster_path, $old_sub_project_name);
                $new_poster_path = $new_sub_project_name.'_'.$rest_poster_path;
            }
            else
            {
                $new_poster_path = NULL;
            }

            $rest_video_path = trim($old_video_path, $old_sub_project_name);
            $new_video_path = $new_sub_project_name.'_'.$rest_video_path;
            rename('poster_images/'.$old_poster_path, 'poster_images/'.$new_poster_path);
            rename('banner_videos/'.$old_video_path, 'banner_videos/'.$new_video_path);

            $new_sub_details = [
                'name' => $new_sub_project_name,
                'poster_path' => $new_poster_path,
                'video_path' => $new_video_path
            ];

            SubProject::where('id', $sub_project->id)->update($new_sub_details);
        }
        return redirect('/project')->with('success', $project_name.' has been updated!');
    }

    public function project_addon($id)
    {
        $main_project_id = $id;
        $logo_list = Logo::get();
        $size_list = Sizes::orderBy('width', 'DESC')->get();
        return view('project_addon', compact('logo_list', 'size_list', 'main_project_id'));
    }

    public function project_addon_post(Request $request, $id)
    {
        $main_project_id = $id;
        $project_info = MainProject::where('id', $main_project_id)->first();
        $size_info = Sizes::where('id', $request->size_id)->first();
        $sub_project_name = $project_info['name'].'_'.$size_info['width'].'x'.$size_info['height'];

        $request->validate([
            'poster' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'video' => 'required',
        ]);

        if($request->has('poster'))
        {
            $poster_name = $sub_project_name.'_'.time().'.'.$request->poster->extension();
            $request->poster->move(public_path('poster_images'), $poster_name);
        }
        else
        {
            $poster_name = NULL;
        }

        $video_name = $sub_project_name.'_'.time().'.'.$request->video->extension();
        $request->video->move(public_path('banner_videos'), $video_name);

        $sub_project = new SubProject;
        $sub_project->name = $sub_project_name;
        $sub_project->title = $request->title;
        $sub_project->project_id = $main_project_id;
        $sub_project->size_id = $request->size_id;
        $sub_project->codec = $request->codec;
        $sub_project->aspect_ratio = $request->aspect_ratio;
        $sub_project->fps = $request->fps;
        $sub_project->size = $request->size;
        $sub_project->poster_path = $poster_name;
        $sub_project->video_path = $video_name;
        $sub_project->save();

        return redirect('/project/view/'.$main_project_id);
    }

    public function video_edit($id)
    {
        $sub_project_id = $id;
        $sub_project_info = SubProject::where('id', $id)->first();
        $size_list = Sizes::orderBy('width', 'DESC')->get();
        return view('video_edit', compact('sub_project_info', 'size_list', 'sub_project_id'));
    }

    public function video_edit_post(Request $request, $id)
    {
        $sub_project_id = $id;
        $sub_project_info = SubProject::where('id', $id)->first();
        $size_info = Sizes::where('id', $request->size_id)->first();
        $main_project_info = MainProject::where('id', $sub_project_info['project_id'])->first();
        $sub_project_name = $main_project_info['name'].'_'.$size_info['width'].'x'.$size_info['height'];


        if($request->poster != NULL && $request->video != NULL)
        {
            if($sub_project_info['poster_path'] == NULL)
            {
                $poster_name = $sub_project_name.'_'.time().'.'.$request->poster->extension();
                $request->poster->move(public_path('poster_images'), $poster_name);
            }
            else
            {
                $poster_path = public_path('poster_images/').$sub_project_info['poster_path'];
                if (file_exists($poster_path)) {
                    @unlink($poster_path);
                }
                //then add the new one
                $poster_name = $sub_project_name.'_'.time().'.'.$request->poster->extension();
                $request->poster->move(public_path('poster_images'), $poster_name);
            }
            $video_path = public_path('banner_videos/').$sub_project_info['video_path'];
            if (file_exists($video_path)) {
                @unlink($video_path);
            }
            $video_name = $sub_project_name.'_'.time().'.'.$request->video->extension();
            $request->video->move(public_path('banner_videos'), $video_name);
        }
        else if($request->poster == NULL && $request->video != NULL)
        {
            $poster_name = NULL;
            $video_path = public_path('banner_videos/').$sub_project_info['video_path'];
            if (file_exists($video_path)) {
                @unlink($video_path);
            }
            $video_name = $sub_project_name.'_'.time().'.'.$request->video->extension();
            $request->video->move(public_path('banner_videos'), $video_name);
        }
        else if($request->poster != NULL && $request->video == NULL)
        {
            $video_name = $sub_project_info['video_path'];
            if($sub_project_info['poster_path'] == NULL)
            {
                $poster_name = $sub_project_name.'_'.time().'.'.$request->poster->extension();
                $request->poster->move(public_path('poster_images'), $poster_name);
            }
            else
            {
                $poster_path = public_path('poster_images/').$sub_project_info['poster_path'];
                if (file_exists($poster_path)) {
                    @unlink($poster_path);
                }
                //then add the new one
                $poster_name = $sub_project_name.'_'.time().'.'.$request->poster->extension();
                $request->poster->move(public_path('poster_images'), $poster_name);
            }
        }
        else
        {
            $poster_name = $sub_project_info['poster_path'];
            $video_name = $sub_project_info['video_path'];
        }

        $sub_project_details = [
            'name' => $sub_project_name,
            'title' => $request->title,
            'codec' => $request->codec,
            'aspect_ratio' => $request->aspect_ratio,
            'fps' => $request->fps,
            'size' => $request->size,
            'poster_path' => $poster_name,
            'video_path' => $video_name
        ];

        SubProject::where('id', $sub_project_id)->update($sub_project_details);
        return redirect('/project/view/'.$main_project_info['id']);

    }

    public function video_delete($id)
    {
        $sub_project_info = SubProject::where('id', $id)->first();

        if($sub_project_info['poster_path'] != NULL)
        {
            $poster_path = public_path('poster_images/').$sub_project_info['poster_path'];
            if (file_exists($poster_path)) {
                @unlink($poster_path);
            }
        }

        $video_path = public_path('banner_videos/').$sub_project_info['video_path'];
        if (file_exists($video_path)) {
            @unlink($video_path);
        }
        SubProject::where('id', $id)->delete();

        return redirect('/project/view/'.$sub_project_info['project_id']);
    }

    public function project_delete($id)
    {
        $main_project_info = MainProject::where('id', $id)->first();

        $sub_project_info = SubProject::where('project_id', $id)->get();
        foreach($sub_project_info as $sub_project)
        {
            if($sub_project->poster_path != NULL)
            {
                $poster_path = public_path('poster_images/').$sub_project->poster_path;
                if (file_exists($poster_path)) {
                    @unlink($poster_path);
                }
            }
            $video_path = public_path('banner_videos/').$sub_project->video_path;
            if (file_exists($video_path)) {
                @unlink($video_path);
            }

            SubProject::where('id', $sub_project->id)->delete();
        }
        MainProject::where('id', $id)->delete();

        return redirect('/project')->with('danger', $main_project_info['name'].' been deleted along with assets!');
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

        $imageName = $request->company_name.'_'.time().'.'.$request->logo_file->extension();
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
        $size->save();

        return redirect('/sizes')->with('success', 'Size Added Successfully!');
    }

    public function size_delete($id)
    {
        $size_info = Sizes::where('id', $id)->first();
        Sizes::where('id', $id)->delete();
        return redirect('/sizes')->with('danger', $size_info['name'].' ('.$size_info['width'].'X'.$size_info['height'].')'.' has been deleted!');
    }

    public function add_user()
    {
        if(Auth::user()->is_admin == 1)
        {
            return view('add_user');
        }
        else
        {
            return redirect('/')->with('danger', 'Sorry You do not have Admin Privileges!');
        }
    }

    public function add_user_post(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->is_admin = $request->is_admin;
        $user->password = Hash::make('password');
        $user->save();

        return redirect('/home')->with('create-user', 'User: '.$request->name.' '.'Email: '.$request->email.' '.'Password: password, has been created!');
    }

    public function change_password()
    {
        return view('change_password');
    }

    public function change_password_post(Request $request)
    {
        $user_id = Auth::user()->id;

        $current_password = $request->current_password;
        $new_password = $request->new_password;
        $repeat_password = $request->repeat_password;

        if (Hash::check($current_password, Auth::user()->password)) 
        {
            if($new_password == $repeat_password)
            {
                User::where('id', Auth::user()->id)->update(['password' => Hash::make($new_password)]);
                Auth::logout();
                return redirect('/login')->with('info-password', 'Password has been changed. Please login again. Thank you!');
            }
            else
            {
                return back()->with('danger', 'New Password and Repeat Password do not match! You high?');
            }
        }
        else
        {
            return back()->with('info', 'Current Password is not matched! Are you high?');
        }    
    }

    public function edit_user($id)
    {
        $user_info = User::where('id', $id)->first();
        return view('user_edit', compact('user_info', 'id'));
    }

    public function edit_user_post(Request $request, $id)
    {
        $user_info = [
            'name' => $request->name,
            'email' => $request->email,
            'is_admin' => $request->is_admin
        ];
        User::where('id', $id)->update($user_info);
        return back()->with('user-update-success', 'User updated!');
    }

    public function delete_user($id)
    {
        User::where('id', $id)->delete();
        return redirect('/')->with('delete-user', 'User has been deleted');
    }

    public function change_mail_status(Request $request)
    {
        User::where('id', $request->id)->update(['is_send_mail' => $request->status]);
        if($request->status == 1)
        {
            return 'true';
        }
        else
        {
            return 'false';
        }
    }
}
