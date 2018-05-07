<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CommentModel;
use Illuminate\Database\QueryException;
use App\Models\UserModel;
use App\Models\PostModel;

class CommentController extends Controller
{
    public function index(){
        return view('pages.admin.comment.comments', 
                    ['comments' => (new CommentModel)->getAll()]);
    }

    public function create(){
        return view('pages.admin.comment.comment_create',
        ['users' => UserModel::all()],
        ['posts' => PostModel::all() ]);
    }

    public function store(Request $request){
        if($request->has('btnCreate')) {
            $request->validate(
                [
                    'post_id' => 'required',
                    'author'  => 'required',
                    'text'    => 'required',
                ]
            );

            $comment = new CommentModel();
            $comment->user_id = $request->get('author');
            $comment->post_id = $request->get('post_id');
            $comment->comment_text = $request->get('text');
            $comment->posted_at = time();

            try {
                $comment->save();
                return redirect()->back()->with('success', 'Comment successfully created');
            }

            catch(QueryException $e) {
                \Log::error($e->getMessage());
                return redirect()->back()->with('error', 'Error while creating comment please try again later');
            }
          }
    }

    public function delete($id){
        try{
            if(CommentModel::destroy($id)){
                
                return redirect()->back()->with('success', 'Comment Deleted');
            }
        }   
        catch(QueryException $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Error while deleting comment please try again later');
        }
        
    }

    public function edit($id) {
        $data['users'] = UserModel::all();
        $data['posts'] = PostModel::all();
        $data['comment'] = CommentModel::find($id);
        return view('pages.admin.comment.comment_edit', $data);
    
    }

    public function update(Request $request){
        if($request->has('btnEdit')) {
            $request->validate(
                [
                    'post_id'   => 'required',
                    'author'    => 'required',
                    'text'      => 'required',
                    'comment_id'=> 'required',
                ]
            );

            $comment = CommentModel::find($request->get('comment_id'));
            $comment->user_id = $request->get('author');
            $comment->post_id = $request->get('post_id');
            $comment->comment_text = $request->get('text');

            try {
                $comment->save();
                return redirect()->back()->with('success', 'Comment successfully updated');
            }

            catch(QueryException $e) {
                \Log::error($e->getMessage());
                return redirect()->back()->with('error', 'Error while updating comment please try again later');
            }
          }
    }
}
