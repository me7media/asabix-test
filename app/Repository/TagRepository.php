<?php

namespace App\Repository;

use App\Interfaces\Repositories\TagRepositoryInterface;
use App\Models\Tag;

class TagRepository implements TagRepositoryInterface
{

    const PAGE_ITEMS_NUMBER = 10;

    public function getAll()
    {
        return Tag::paginate(self::PAGE_ITEMS_NUMBER);
    }

    public function getById($tagId)
    {
        return Tag::find($tagId);
    }

    public function create(array $tagDetails)
    {
        // TODO: Implement create() method.
    }

    public function update($tagId, array $newDetails)
    {
        // TODO: Implement update() method.
    }

    public function deleteById($tagId)
    {
        if ($tag = Tag::find($tagId)) {
            $tag->delete();
        }
        return 0;
    }

    public function deleteAll()
    {
        // TODO: Implement deleteAll() method.
    }
}
