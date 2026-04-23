<?php

namespace App\Http\Controllers;

use App\Models\SavedPost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavedPostController extends Controller
{
    public function toggle(Post $post)
    {
        $existing = SavedPost::where('user_id', Auth::id())
            ->where('post_id', $post->id)
            ->first();

        if ($existing) {
            $existing->delete();
        } else {
            SavedPost::create([
                'user_id' => Auth::id(),
                'post_id' => $post->id,
            ]);
        }

        return back();
    }

    public function index()
    {
        $saved = SavedPost::where('user_id', Auth::id())
            ->with(['post.user', 'post.hashtags'])
            ->latest()
            ->get();

        return view('saved', compact('saved'));
    }
}