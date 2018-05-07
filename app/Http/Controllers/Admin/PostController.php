<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\Models\PostModel;

class PostController extends Controller
{
    public function index(){
        return view('pages.admin.posts', ['posts' => (new PostModel)->getAll()]);
    }

    public function create(){

    }

    public function store(){

    }

    public function delete($id){
        try{
            if(PostModel::destroy($id)){
                //Brisanje i svih komentara vezanih za post
                return redirect()->back()->with('success', 'Post Deleted');
            }
        }   
        catch(QueryException $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Error while deleting post please try again later');
        }
        
    }

    public function update($id){

    }
}
