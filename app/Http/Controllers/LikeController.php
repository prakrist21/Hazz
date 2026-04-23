<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggle(Post $post)
    {
        $existing = Like::where('user_id', Auth::id())
            ->where('post_id', $post->id)
            ->first();

        if ($existing) {
            $existing->delete();
            $post->decrement('likes_count');
        } else {
            Like::create([
                'user_id' => Auth::id(),
                'post_id' => $post->id,
            ]);
            $post->increment('likes_count');

            // Notify post owner
            if ($post->user_id !== Auth::id()) {
                \App\Models\Notification::create([
                    'user_id' => $post->user_id,
                    'actor_id' => Auth::id(),
                    'type' => 'like',
                    'notifiable_id' => $post->id,
                    'notifiable_type' => \App\Models\Post::class,
                ]);
            }
        }

        return back();
    }
}