<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\MainProject;
use App\SubProject;
use App\Comments;
use App\Sizes;
use App\Logo;
use \App\Mail\SendMail;

class ProjectConTroller extends Controller
{
    public function project_view($id)
    {
        $main_project_id = $id;
        $main_project_info = MainProject::join('logo', 'main_project.logo_id', 'logo.id')
                                        ->select(
                                            'main_project.name as name',
                                            'main_project.client_name',
                                            'main_project.logo_id',
                                            'main_project.color',
                                            'main_project.is_logo',
                                            'main_project.is_footer',
                                            'logo.name as logo_name',
                                            'logo.path' 
                                        )
                                        ->where('main_project.id', $main_project_id)
                                        ->first();

        $sub_project_info = SubProject::join('sizes', 'sub_project.size_id', 'sizes.id')
                                        ->select(
                                            'sub_project.id',
                                            'sub_project.name as sub_name',
                                            'sub_project.title',
                                            'sub_project.codec',
                                            'sub_project.aspect_ratio',
                                            'sub_project.fps',
                                            'sub_project.size',
                                            'sub_project.poster_path',
                                            'sub_project.video_path',
                                            'sizes.name as size_name',
                                            'sizes.width',
                                            'sizes.height'
                                        )
                                        ->where('project_id', $main_project_id)
                                        ->orderBy('sizes.width', 'DESC')
                                        ->get();

        $comments = Comments::where('project_id', $main_project_id)->orderBy('created_at', 'DESC')->get();
        $comments_count = Comments::where('project_id', $main_project_id)->get()->count();

        return view('index-main', compact(
            'main_project_info',
            'sub_project_info',
            'comments',
            'comments_count',
            'main_project_id'
        ));
    }

    public function store_comments(Request $request, $id)
    {
        $project_id = $id;
        $project_info = MainProject::where('id', $id)->first();
        $project_name = str_replace("_"," ", $project_info['name']);

        $comment = new Comments;
        $comment->project_id = $project_id;
        $comment->comment = $request->comment;
        $comment->save();

        $details = [
            'title' => $project_name,
            'comment' => $request->comment,
            'id' => $project_id
        ];

        $to = array('govinda@planetnine.com', 'ebnsina@planetnine.com', 'maarten@planetnine.com', 'rohit@planetnine.com');

        \Mail::to($to)->send(new SendMail($details));
    }

    public function get_comments($id)
    {
        $result = Comments::where('project_id', $id)->orderBy('created_at', 'DESC')->get();
        $result_count = Comments::where('project_id', $id)->get()->count();
        if($result_count > 0)
        {
            foreach($result as $row)
            {
                echo '<textarea cols="5" rows="3" class="w-full bg-gray-300 border border-gray-600 focus:outline-none rounded-lg" readonly>'.$row->comment.'</textarea>';
            }
        }
    }
}
