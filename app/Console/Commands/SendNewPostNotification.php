<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Notifications\PostPublishedNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;

class SendNewPostNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-new-post-notification';

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
        $twentyFourHourAgo = Carbon::now()->subDay();

        $posts = Post::where('created_at', '>=', $twentyFourHourAgo)
            ->get()
            ->each(function ($post) {
                $subscribers = $post->website->subscribers;
                $emails = $subscribers->pluck('email');
        
                Notification::route('mail', $emails)
                    ->notify(new PostPublishedNotification($post));
            });
    }
}
