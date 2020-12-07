<?php


namespace App\Repositories;


use App\Posts;

class PostRepository implements PostRepositoryInterface {

    /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function active_five()
    {
        return Posts::where('active', 1)->orderBy('created_at', 'desc')->paginate(5);
    }

    /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($post)
    {
        Posts::destroy($post->id);
    }

    /**
     * Updates a post.
     *
     * @param int
     * @param array
     */
    public function update($post, array $post_data)
    {
        Posts::find($post->id)->update($post_data);
    }
}
