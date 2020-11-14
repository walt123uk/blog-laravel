<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Http\Requests\CommentFormRequest;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(CommentFormRequest $request)
    {
        //on_post, from_user, body
        $input['from_user'] = $request->user()->id;
        $input['on_post'] = $request->input('on_post');
        $input['body'] = $request->input('body');
        $slug = $request->input('slug');
        Comments::create( $input );
        return redirect($slug)->with('message', 'Comment published');
    }
}
