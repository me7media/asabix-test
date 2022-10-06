<?php

namespace App\Repository;

use App\Interfaces\Repositories\PostRepositoryInterface;
use App\Models\Post;

class PostRepository implements PostRepositoryInterface
{
    const PAGE_ITEMS_NUMBER = 10;

    public function getAll()
    {
        return Post::with('postTranslations')
            ->paginate(self::PAGE_ITEMS_NUMBER);
    }

    public function getById($postId)
    {
        return Post::with('postTranslations')
            ->find($postId);
    }

    public function create(array $postDetails)
    {
        // TODO: Implement create() method.
    }

    public function update($postId, array $newDetails)
    {
        // TODO: Implement update() method.
    }

    public function deleteById($postId)
    {
        if ($post = Post::find($postId)) {
            $post->delete();
        }
        return 0;
    }

    public function deleteAll()
    {
        // TODO: Implement deleteAll() method.
    }
}
