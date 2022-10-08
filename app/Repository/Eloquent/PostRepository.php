<?php

namespace App\Repository\Eloquent;

use App\Interfaces\Repositories\PostRepositoryInterface;
use App\Models\Language;
use App\Models\Post;
use App\Models\PostTranslation;

class PostRepository implements PostRepositoryInterface
{
    const PAGE_ITEMS_NUMBER = 10;

    public function __construct()
    {
        config()->set('database.connections.mysql.strict', false);
    }

    public function getAll()
    {
        return Post::paginate(self::PAGE_ITEMS_NUMBER);
    }

    public function getById($postId)
    {
        return Post::find($postId);
    }

    /*
     * ['data' => ['ua' => [...post_translation_data], ]]
     */
    public function create(array $postDetails)
    {
        return $this->createOrUpdatePost($postDetails);
    }

    /*
     * ['data' => ['ua' => [...post_translation_data], ]]
     */
    public function update($postId, array $newDetails)
    {
        return $this->createOrUpdatePost($newDetails, $postId);
    }

    public function deleteById($postId)
    {
        if ($post = Post::find($postId)) {
            return $post->delete();
        }
        return 0;
    }


    /**
     * @param array $postDetails
     * @param int|null $postId
     * @return Post
     */
    public function createOrUpdatePost(array $postDetails, int $postId = null): Post
    {
        $data = $postDetails['data'];

        $post = Post::find($postId);

        if (!$post) {
            $post = Post::create();
        }

        foreach ($data as $locale => $item) {
            if ($lang = Language::where('prefix', $locale)->orWhere('locale', $locale)->first()) {
                $this->createOrUpdatePostTranslation($item, $lang, $post);
            }
        }
        return $post;
    }


    /**
     * @param mixed $item
     * @param $post
     * @return void
     */
    public function createOrUpdatePostTranslation(array $item, Language $lang, $post): void
    {
        PostTranslation::updateOrCreate([
            'post_id' => $post->id,
            'language_id' => $lang->id
        ], [
            'title' => $item['title'],
            'description' => $item['description'],
            'content' => $item['content'],
        ]);
    }
}
