<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PostModel extends Model
{

    public $timestamps = false;
    protected $table = "posts";

    public function getAllWithAuthor() {
        return DB::table('posts')
                 ->join('users', 'users.id', '=', 'posts.user_id')
                 ->select('users.username', 'posts.id', 'posts.created', 'posts.title')
                 ->paginate(4);
    }

    public function getAll() {
        return DB::table('posts')
                ->join('users', 'users.id', '=', 'posts.user_id')
                ->select('users.username', 'posts.id', 'posts.created', 'posts.title', 'posts.text', 'posts.cover_image')
                ->get();
    }
}