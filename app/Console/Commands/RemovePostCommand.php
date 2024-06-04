<?php

namespace App\Console\Commands;

use App\Models\Post\Post;
use Illuminate\Console\Command;

class RemovePostCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hub:remove-post-command {post_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove one post from the database';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Removing post '.$this->argument('post_id').' from the database...');

        $post = Post::query()
            ->where('id', $this->argument('post_id'))
            ->first();

        if ($post === null) {
            $this->error('Post not found');

            return;
        }

        $post->delete();

        $this->info('Done!');
    }
}
