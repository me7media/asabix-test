<?php

namespace App\Interfaces\Repositories;

interface TagRepositoryInterface
{
    public function getAll();
    public function getById($tagId);
    public function create(array $tagDetails);
    public function update($tagId, array $newDetails);
    public function deleteById($tagId);
    public function deleteAll();
}
