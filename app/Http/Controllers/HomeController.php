<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\NavigationModel;
use App\Models\PostModel;
use App\Models\CommentModel;
use App\Models\GalleryModel;
use App\Models\PollModel;

class HomeController extends Controller
{
    private $data;

    public function __construct(){
        $this->data['nav_links'] = NavigationModel::orderBy('priority', 'asc')->get();
    }

    public function showIndexPage() {
        $posts = new PostModel();
        $this->data['posts'] = $posts->getAllWithAuthor();
        return view('pages.home',  $this->data);
    }

    public function showLoginPage() {
        return view('pages.login',  $this->data);
    }

    public function showRegisterPage() {
        return view('pages.register',  $this->data);
    }

    public function showGalleryPage() {
        $this->data['images'] = GalleryModel::where('featured', 1)->get();
        return view('pages.gallery',  $this->data);
    }

    public function showSinglePost($id) {
        $this->data['singlePost'] = PostModel::find($id);
        $this->data['comments']   = (new CommentModel())->getCommentsByPostWithAuthor($id);
    
        return view('pages.singlepost', $this->data);
    }


    public function showAuthorPage() {
        return view('pages.author', $this->data);
    }

    public function showSurveryPage(){
        $this->data['results'] = (new PollModel())->getPollResults();
        $this->data['poll'] = (new PollModel())->getActivePoll();
        return view('pages.poll', $this->data);
    }

    public function showAdminPanel() {
        return view('pages.admin.welcome');
    }
}

