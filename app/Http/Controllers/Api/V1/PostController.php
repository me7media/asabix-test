<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Interfaces\Repositories\PostRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{

    /**
     * @var PostRepositoryInterface
     */
    private PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {

        if ($posts = $this->postRepository->getAll()) {
            return PostResource::collection($posts)
                ->toResponse(request())
                ->setStatusCode(Response::HTTP_OK);
        }
        return $this->emptyJsonResponse(Response::HTTP_NOT_FOUND);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return JsonResponse
     */
    public function create(): JsonResponse
    {
        return $this->emptyJsonResponse(Response::HTTP_BAD_REQUEST);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return JsonResponse
     */
    public function store(PostRequest $request): JsonResponse
    {
        if ($post = $this->postRepository->create($request->validated())) {
            return PostResource::make($post)
                ->toResponse($request)
                ->setStatusCode(Response::HTTP_CREATED);
        }

        return $this->emptyJsonResponse(Response::HTTP_BAD_REQUEST);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        if ($post = $this->postRepository->getById($id)) {
            return PostResource::make($post)
                ->toResponse(request())
                ->setStatusCode(Response::HTTP_OK);
        }

        return $this->emptyJsonResponse(Response::HTTP_NOT_FOUND);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function edit($id): JsonResponse
    {
        return $this->emptyJsonResponse(Response::HTTP_BAD_REQUEST);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(PostRequest $request, $id): JsonResponse
    {
        if ($post = $this->postRepository->update($id, $request->validated())) {

            return PostResource::make($post)
                ->toResponse($request)
                ->setStatusCode(Response::HTTP_ACCEPTED);
        }

        return $this->emptyJsonResponse(Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        if ($this->postRepository->deleteById($id)) {
            return $this->emptyJsonResponse(Response::HTTP_NO_CONTENT);
        }
        return $this->emptyJsonResponse(Response::HTTP_NOT_FOUND);
    }

    /**
     * @param int $statusCode
     * @return JsonResponse
     */
    public function emptyJsonResponse(int $statusCode): JsonResponse
    {
        return response()->json([
            'data' => []
        ], $statusCode);
    }
}
