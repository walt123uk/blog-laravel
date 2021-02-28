<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserProfile extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * profile for user
     * @param User $user
     */
    public function __invoke(User $user)
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
        $data['total_users'] = DB::table('users')
            ->select(DB::raw('name, count(*) as user_count'))
            ->where('name', '<>', '')
            ->groupBy('name')
            ->get();
        return view('admin.profile', $data);
    }
}
