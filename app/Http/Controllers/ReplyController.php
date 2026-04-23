<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|max:280',
        ]);

        $reply = Reply::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
            'content' => $request->content,
        ]);

        $post->increment('replies_count');

        // Notify post owner
        if ($post->user_id !== Auth::id()) {
            \App\Models\Notification::create([
                'user_id' => $post->user_id,
                'actor_id' => Auth::id(),
                'type' => 'reply',
                'notifiable_id' => $post->id,
                'notifiable_type' => \App\Models\Post::class,
            ]);
        }

        return back();
    }

    public function destroy(Reply $reply)
    {
        if ($reply->user_id !== Auth::id()) {
            abort(403);
        }
        $reply->post->decrement('replies_count');
        $reply->delete();

        return back();
    }
}