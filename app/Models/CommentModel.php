<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CommentModel extends Model
{
 
    public $timestamps = false;
    protected $table = "comments";

    public function __construct() {
        date_default_timezone_set('Europe/Belgrade');
    }
    public function author() {
        return $this->hasOne('App\Models\UserModel', 'id', 'user_id');
    }


    public function addComment($params) {
        $post_id = intval($params['post_id']);
        $text    = strval($params['text']);

        $comment = new CommentModel();
        $comment->user_id       = session('user')[0]->id;
        $comment->post_id       = $post_id;
        $comment->comment_text  = $text;
        $comment->posted_at     = time();

        try{
            $comment->save();
            $ar['comment'] = $comment;
            $ar['author']  = $comment->author;

            return $ar;
        }
        catch(QueryException $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with("error", "An server error has occurred, please try again later.");
        }
        
    }

    public function getCommentsByPostWithAuthor($id) {
        return DB::table('comments')
                   ->join('posts', 'comments.post_id', 'posts.id')
                   ->join('users', 'comments.user_id', 'users.id')
                   ->where('comments.post_id', $id)
                   ->select('comments.comment_text', 'comments.posted_at', 'users.username')
                   ->orderBy('posted_at', 'desc')
                   ->paginate('5');
    }

    public function getAll() {
        return DB::table('comments')
        ->join('posts', 'comments.post_id', 'posts.id')
        ->join('users', 'comments.user_id', 'users.id')
        ->select('comments.comment_text', 'comments.posted_at', 'users.username', 'posts.title', 'comments.id')
        ->get();
    }


}
