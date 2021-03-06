<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Posts;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostFormRequest;
use Spatie\Tags\Tag;

class PostController extends Controller
{
    protected $post;

    /**
     * PostController constructor.
     *
     * @param PostRepositoryInterface $post
     */
    public function __construct(PostRepositoryInterface $post)
    {
        $this->post = $post;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //fetch 5 posts from database which are active and latest
        $data = [
            'posts' => $this->post->active_five(),
            'active_posts' => Posts::active()->orderBy('created_at')->get()
        ];
        dd($data['active_posts']);
        //page heading
        $title = 'Latest Posts';
        //return home.blade.php template from resources/views folder
        return view('home', $data)->withTitle($title);
    }
    public function create(Request $request)
    {
        return view('posts.create');
    }
    public function store(PostFormRequest $request)
    {
        $post = new Posts();
        $post->title = $request->get('title');
        $post->body = $request->get('body');
        $post->slug = Str::slug($post->title);

        $duplicate = Posts::where('slug', $post->slug)->first();
        if ($duplicate) {
            $post->title .= '_1';
            $post->slug .= '_1';
        }
        $post->author_id = $request->user()->id;
        if ($request->has('save')) {
            $post->active = 0;
            $message = 'Post saved successfully';
        } else {
            $post->active = 1;
            $message = 'Post published successfully';
        }
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $post->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }
        $post->save();
        return redirect('post/' . $post->id)->withMessage($message);
    }
    public function show(Posts $post)
    {
        if (!$post) {
            return redirect('/')->withErrors('requested page not found');
        }
        $comments = $post->comments;
        return view('posts.show')->withPost($post)->withComments($comments);
    }
    public function edit(Request $request, Posts $post)
    {
        $tags = $post->tags()->get();
        $tagsAll = Tag::get();
        if ($post && ($request->user()->id == $post->author_id || $request->user()->can('edit posts')))
            return view('posts.edit', compact('post','tags', 'tagsAll'));
        return redirect('/')->withErrors('you have not sufficient permissions');
    }
    public function update(Request $request, Posts $post)
    {
        if ($post && ($post->author_id == $request->user()->id || $request->user()->can('edit posts'))) {
            $title = $request->input('title');
            $slug = Str::slug($title);
            $duplicate = Posts::where('slug', $slug)->first();
            if ($duplicate) {
                if ($duplicate->id != $post->id) {
                    return redirect('edit/' . $post->slug)->withErrors('Title already exists.')->withInput();
                } else {
                    $post->slug = $slug;
                }
            }

            $post->title = $title;
            $post->body = $request->input('body');

            if ($request->has('save')) {
                $post->active = 0;
                $message = 'Post saved successfully';
                $landing = 'post/' . $post->id;
            } else {
                $post->active = 1;
                $message = 'Post updated successfully';
                $landing = 'post/' . $post->id;
            }
            $post->save();
            $post->syncTags($request->input('tags'));
            return redirect($landing)->withMessage($message);
        } else {
            return redirect('/')->withErrors('you have not sufficient permissions');
        }
    }
    /*
  * Delete of a particular post
  *
  * @param Posts $post
  * @return view
  */
    public function destroy(Request $request, Posts $post)
    {
        if ($post && ($post->author_id == $request->user()->id || $request->user()->can('delete posts'))) {
            $this->post->delete($post);
            $data['message'] = 'Post deleted Successfully';
        } else {
            $data['errors'] = 'Invalid Operation. You have not sufficient permissions';
        }
        return redirect('/')->with($data);
    }
}
