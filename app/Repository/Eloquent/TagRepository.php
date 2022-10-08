<?php

namespace App\Repository\Eloquent;

use App\Interfaces\Repositories\TagRepositoryInterface;
use App\Models\Tag;

class TagRepository implements TagRepositoryInterface
{

    const PAGE_ITEMS_NUMBER = 10;

    /**
     * @return mixed
     */
    public function getAll()
    {
        return Tag::paginate(self::PAGE_ITEMS_NUMBER);
    }

    /**
     * @param $tagId
     * @return mixed
     */
    public function getById($tagId): Tag
    {
        return Tag::find($tagId);
    }

    /**
     * @param array $tagDetails
     * @return Tag
     */
    public function create(array $tagDetails): Tag
    {
        return $this->createOrUpdateTag($tagDetails);
    }

    /**
     * @param $tagId
     * @param array $newDetails
     * @return Tag
     */
    public function update($tagId, array $newDetails): Tag
    {
        return $this->createOrUpdateTag($newDetails, $tagId);
    }

    /**
     * @param $tagId
     * @return int
     */
    public function deleteById($tagId): int
    {
        if ($tag = Tag::find($tagId)) {
            return $tag->delete();
        }
        return 0;
    }

    /**
     * @param array $tagDetails
     * @param int|null $tagId
     * @return Tag
     */
    public function createOrUpdateTag(array $tagDetails, int $tagId = null): Tag
    {
        $tag = Tag::find($tagId);

        if (!$tag) {
            $tag = Tag::create($tagDetails['data']);
        }

        return $tag;
    }
}
