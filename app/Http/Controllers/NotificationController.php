<?php
// app/Http/Controllers/NotificationController.php

namespace App\Http\Controllers;

use App\Services\NotificationService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    protected $service;

    public function __construct(NotificationService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $user = auth()->user();
    
        // Kiểm tra user hiện tại là ai
        // logger('Auth user', ['id' => $user->id, 'type' => get_class($user)]);
    
        // Kiểm tra có bao nhiêu thông báo
        // logger('Notifications count', ['count' => $user->notifications->count()]);
    
        $userId = $request->user()->id;
        return response()->json($this->service->getUserNotifications($userId));
    }

    public function markRead($id)
    {
        $this->service->markRead($id);
        return response()->json(['message' => 'Marked as read']);
    }
}
