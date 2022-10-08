<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Http\Resources\TagResource;
use App\Interfaces\Repositories\TagRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TagController extends Controller
{

    private TagRepositoryInterface $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        if ($tags = $this->tagRepository->getAll()) {
            return TagResource::collection($tags)
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
     * @param TagRequest $request
     * @return JsonResponse
     */
    public function store(TagRequest $request): JsonResponse
    {
        if ($tag = $this->tagRepository->create($request->validated())) {
            return TagResource::make($tag)
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
        if ($tag = $this->tagRepository->getById($id)) {
            return TagResource::make($tag)
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
        return $this->emptyJsonResponse(Response::HTTP_NOT_FOUND);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TagRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(TagRequest $request, $id)
    {
        if ($tag = $this->tagRepository->update($id, $request->validated())) {

            return TagResource::make($tag)
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
    public function destroy($id)
    {
        if ($this->tagRepository->deleteById($id)) {
            return $this->emptyJsonResponse(Response::HTTP_NO_CONTENT);
        }
        return $this->emptyJsonResponse(Response::HTTP_NOT_FOUND);
    }

}
