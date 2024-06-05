<?php

namespace App\Http\Controllers\Api;

use App\Actions\Post\CreatePostAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Post\CreatePostRequest;
use App\Http\Requests\Api\Post\FilterPostRequest;
use App\Http\Resources\Api\Post\ShowPostResource;
use App\Models\Post\Post;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostController extends Controller
{
    /**
     * All the posts list, limited to 5
     *
     * @return AnonymousResourceCollection
     */
    public function index(
        FilterPostRequest $request
    ) {
        return ShowPostResource::collection(
            Post::query()
                ->filter($request->validated())
                ->paginate(5)
        );
    }

    /**
     * Created new post.
     */
    public function create(
        CreatePostRequest $request,
        CreatePostAction $action
    ) {
        return ShowPostResource::make($action($request->validated(), auth()->user()));
    }

    /**
     * Open a post
     *
     * @return ShowPostResource
     */
    public function show(
        Post $post
    ) {
        return ShowPostResource::make($post);
    }
}
