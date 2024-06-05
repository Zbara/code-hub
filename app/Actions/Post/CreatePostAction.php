<?php

namespace App\Actions\Post;

use App\Models\Post\Post;
use App\Models\User;

class CreatePostAction
{
    public function __invoke(
        array $data,
        User $user
    ) {
        return Post::create([
            'user_id' => $user->id,
            'title' => $data['title'],
            'content' => $data['content'],
            'slug' => generateSlug(Post::class, $data['title']),
        ]);
    }
}
