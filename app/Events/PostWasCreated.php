<?php

namespace App\Events;

use App\Post;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PostWasCreated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $post;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('posts');
    }

    public function broadcastWith()
    {
        return [
            'post' => array_merge($this->post->toArray(), [
                //'likedByCurrentUser' => $this->post->likedByCurrentUser,
                'canBeLikedByCurrentUser' => true,
                'user' => $this->post->user
            ])
        ];
    }
}