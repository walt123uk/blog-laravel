<?php

namespace App\Http\Controllers;

use App\Posts;
use App\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    /**
     * profile for user
     * @param User $user
     */
    public function show(User $user)
    {
        $data['user'] = $user;
        if (!$data['user'])
            return redirect('/');
        if ($user && $data['user']->id == $user->id) {
            $data['author'] = true;
        } else {
            $data['author'] = null;
        }
        $data['comments_count'] = $data['user']->comments->count();
        $data['posts_count'] = $data['user']->posts->count();
        $data['posts_active_count'] = $data['user']->posts->where('active', '1')->count();
        $data['posts_draft_count'] = $data['posts_count'] - $data['posts_active_count'];
        $data['latest_posts'] = $data['user']->posts->where('active', '1')->take(5);
        $data['latest_comments'] = $data['user']->comments->take(5);

        return view('admin.profile', $data);
    }


}
