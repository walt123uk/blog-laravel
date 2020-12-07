<?php

namespace App\Repositories;

interface PostRepositoryInterface
{
    /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function active_five();

    /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($post_id);

    /**
     * Updates a post.
     *
     * @param int
     * @param array
     */
    public function update($post_id, array $post_data);
}
