<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use Illuminate\Support\Facades\Log;
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

         // $message = ' loggin';
         Log::info($scheduledPosts);

         foreach ($scheduledPosts as $scheduledPost) {
             $scheduledPost->is_published = 2;
             $scheduledPost->save();
 
             // $message1 = ' loggin123123123123';
             // Log::info($message1);
         }
    }
}
