<?php

namespace App\Observers;

use App\Enums\PostStatusEnum;
use App\Models\Post;
use App\Models\Subscriber;
use App\Notifications\PostPublishedNotification;
use Illuminate\Support\Facades\Notification;

class PostObserver
{
    public function updated(Post $post): void
    {
        $subscribers = $post->website->subscribers;

        if ($subscribers->isNotEmpty()) {
            Notification::route('mail', $subscribers->pluck('email'))
                ->notify(new PostPublishedNotification($post));
        }
    }
}
