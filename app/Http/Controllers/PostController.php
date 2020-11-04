<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Models\Posts;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostFormRequest;

class PostController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
       //fetch 5 posts from database which are active and latest
       $posts = Posts::where('active',1)->orderBy('created_at','desc')->paginate(5);
       //page heading
       $title = 'Latest Posts';
       //return home.blade.php template from resources/views folder
       return view('home')->withPosts($posts)->withTitle($title);
    }
}
