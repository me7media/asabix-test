<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Interfaces\Repositories\PostRepositoryInterface;
use App\Repository\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{

    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param PostRepository $postRepository
     * @return Response
     */
    public function index()
    {
        return $this->postRepository->getAll();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return Response
     */
    public function store(PostRequest $request)
    {
        if ($post = $this->postRepository->create($request->validated())) {
            return response([
                'data' => $post
            ], 201);
        }

        return response([
            'data' => []
        ], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param PostRepository $postRepository
     * @return PostResource|Response
     */
    public function show($id)
    {


        if ($post = $this->postRepository->getById($id)) {
            return new PostResource($post);
        }

        return response([
            'data' => []
        ], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param PostRepository $postRepository
     * @return Response
     */
    public function destroy($id)
    {
        return $this->postRepository->deleteById($id);
    }
}
