<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function toggle(User $user)
    {
        if ($user->id === Auth::id()) {
            return back();
        }

        $existing = Follow::where('follower_id', Auth::id())
            ->where('following_id', $user->id)
            ->first();

        if ($existing) {
            $existing->delete();
        } else {
            Follow::create([
                'follower_id' => Auth::id(),
                'following_id' => $user->id,
            ]);

            // Notify the user
            Notification::create([
                'user_id' => $user->id,
                'actor_id' => Auth::id(),
                'type' => 'follow',
                'notifiable_id' => Auth::id(),
                'notifiable_type' => User::class,
            ]);
        }

        return back();
    }
}