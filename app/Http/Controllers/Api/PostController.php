<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Post\FilterPostRequest;
use App\Http\Resources\Api\Post\ShowPostResource;
use App\Models\Post\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostController extends Controller
{
    /**
     * All the posts list, limited to 5
     *
     * @param FilterPostRequest $request
     * @return AnonymousResourceCollection
     */
    public function index(
        FilterPostRequest $request
    )
    {
        return ShowPostResource::collection(
            Post::query()
                ->filter($request->validated())
                ->paginate(5)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Open a post
     *
     * @param Post $post
     * @return ShowPostResource
     */
    public function show(Post $post)
    {
        return ShowPostResource::make($post);
    }
}
