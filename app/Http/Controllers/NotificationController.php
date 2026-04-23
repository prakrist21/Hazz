<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->with('actor')
            ->latest()
            ->get();

        // Mark all as read
        Notification::where('user_id', Auth::id())
            ->where('read', false)
            ->update(['read' => true]);

        return view('notifications', compact('notifications'));
    }
}