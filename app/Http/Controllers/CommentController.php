<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Http\Requests\CommentFormRequest;
use App\Posts;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(CommentFormRequest $request, Posts $post, Comments $comments)
    {
        //on_post, from_user, body
        $input['from_user'] = $request->user()->id;
        $input['on_post'] = $request->input('on_post');
        $input['body'] = $request->input('body');
        $slug = $request->input('slug');
        Comments::create( $input );
        return view('posts.show')->withPost($post)->withComments($comments);;
    }
}
