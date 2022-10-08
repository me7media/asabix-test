<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Interfaces\Repositories\PostRepositoryInterface;
use App\Interfaces\Repositories\TagRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\Response;

class PostTagsController extends Controller
{
    /**
     * @var PostRepositoryInterface
     */
    private PostRepositoryInterface $postRepository;

    /**
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
    public function store($id, Request $request): JsonResponse
    {
        if ($post = $this->postRepository->deleteById($id) && $request->has('data')) {
            $post->tags()->attach(array_values($request->data));
            return $this->emptyJsonResponse(Response::HTTP_CREATED);
        }

        return $this->emptyJsonResponse(Response::HTTP_NOT_FOUND);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        if (($post = $this->postRepository->deleteById($id))
            && ($postTags = $post->tags)) {
            return TagResource::collection($postTags)
                ->toResponse(request())
                ->setStatusCode(Response::HTTP_OK);
        }

        return $this->emptyJsonResponse(Response::HTTP_NOT_FOUND);
    }
}
