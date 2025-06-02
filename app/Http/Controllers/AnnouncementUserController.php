<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AnnouncementUserService;

class AnnouncementUserController extends Controller
{
    protected $announcementUserService;

    public function __construct(AnnouncementUserService $service)
    {
        $this->announcementUserService = $service;
    }

    public function create($annnouncementId, $userId)
    {
        
    }

    public function markAsRead(Request $request)
    {
        $request->validate([
            'announcement_id' => 'required|integer|exists:announcements,id',
        ]);

        $this->announcementUserService->markAsRead($request->announcement_id, $request->user_id);

        return response()->json([
            'status' => true,
            'message' => 'Marked as read'
        ]);
    }

    public function hasRead(Request $request)
    {
        $request->validate([
            'announcement_id' => 'required|integer|exists:announcements,id',
        ]);

        $userId = auth('api')->id();
        $read = $this->announcementUserService->checkIfRead($request->announcement_id, $userId);

        return response()->json([
            'read' => $read
        ]);
    }
}
