<?php

namespace App\Repository;

use App\Interfaces\Repositories\PostRepositoryInterface;
use App\Models\Language;
use App\Models\Post;
use App\Models\PostTranslation;

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
        if (!isset($postDetails['data'])) return;
        $data = $postDetails['data'];
        if (empty($data)) return;

        $post = Post::create();

        if (count($data) != count($data, 1)) {
            foreach ($data as $item) {
                $this->createPostTranslation($item, $post);
            }
        } else {
            $this->createPostTranslation($data, $post);
        }

        return $post->load('postTranslations');
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

    /**
     * @param mixed $item
     * @param $post
     * @return void
     */
    public function createPostTranslation(array $item, $post): void
    {
        //todo validation
        if ($lang = Language::where('prefix', @$item['locale'])->first()) {
            PostTranslation::create([
                'post_id' => $post->id,
                'language_id' => $lang->id,
                'title' => $item['title'],
                'description' => $item['description'],
                'content' => $item['content'],
            ]);
        }
    }
}
