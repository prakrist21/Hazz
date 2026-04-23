<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Hashtag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'hashtags'])
            ->latest()
            ->get();

        $trending = Hashtag::orderBy('usage_count', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact('posts', 'trending'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|max:280',
        ]);

        $post = Post::create([
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        // Extract and save hashtags
        preg_match_all('/#(\w+)/', $request->content, $matches);
        foreach ($matches[1] as $tag) {
            $hashtag = Hashtag::firstOrCreate(
                ['name' => strtolower($tag)],
            );
            $hashtag->increment('usage_count');
            $post->hashtags()->attach($hashtag->id);
        }

        return redirect()->route('dashboard');
    }

    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }
        $post->delete();
        return redirect()->route('dashboard');
    }
}