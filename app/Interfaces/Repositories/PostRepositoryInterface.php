<?php

namespace App\Interfaces\Repositories;

interface PostRepositoryInterface
{
    public function getAll();
    public function getById($postId);
    public function create(array $postDetails);
    public function update($postId, array $newDetails);
    public function deleteById($postId);
}
