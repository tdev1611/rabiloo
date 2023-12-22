<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;

class PublishScheduledPosts extends Command
{


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:publish-scheduled-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $post = new Post;
        $scheduledPosts = $post->getScheduledPosts();

        foreach ($scheduledPosts as $scheduledPost) {
            $scheduledPost->update(['is_published' => 2]);
        }
        $this->info('posts successfully.');
    }
}
