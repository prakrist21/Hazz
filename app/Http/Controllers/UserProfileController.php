<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function show(User $user)
    {
        $posts = $user->posts()
            ->with(['hashtags'])
            ->latest()
            ->get();

        $isOwner = Auth::id() === $user->id;

        return view('profile.show', compact('user', 'posts', 'isOwner'));
    }
}