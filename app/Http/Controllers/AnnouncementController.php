<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AnnouncementService;
use App\Services\ClassService;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Events\AnnouncementCreated;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class AnnouncementController extends Controller
{
    protected $announcementService;
    protected $classService;

    public function __construct(AnnouncementService $announcementService, ClassService $classService)
    {
        $this->announcementService = $announcementService;
        $this->classService = $classService;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'priority' => 'required|in:low,medium,high',
            'target_type' => 'required|in:all,class',
            'target_id' => 'nullable|integer'
        ]);

        $validated['created_by'] = auth('api')->id() ?? 3;

        $announcement = $this->announcementService->createAnnouncement($validated);

        $users = collect();

        if ($validated['target_type'] === 'all') {
            $users = User::where('role', 'student')->pluck('id');
        } elseif ($validated['target_type'] === 'class' && $validated['target_id']) {
            $users = DB::table('class_user')
                ->where('class_id', $validated['target_id'])
                ->pluck('student_id');
        }

        if ($users->isNotEmpty()) {
            $announcement->users()->attach($users);
            $userIds = $users->toArray();
            broadcast(new AnnouncementCreated($announcement, $userIds))->toOthers();
        }

        return response()->json([
            'status' => true,
            'message' => 'Announcement created',
            'data' => $announcement
        ]);
    }

    public function index()
    {
        $announcements = $this->announcementService->getAnnouncementsForAdmin();
        return response()->json($announcements);
    }

    public function deleteAnnouncement($id)
    {
        $result = $this->announcementService->deleteAnnouncementById($id);

        if (!$result) {
            return response()->json([
                'status' => false,
                'message' => 'Announcement not found or could not be deleted'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Successfully deleted announcement!',
            'data' => $result
        ]);
    }

    public function getByUser($userId)
    {
        $announcements = $this->announcementService->getAnnouncementsByUser($userId);
        return response()->json([
            'status' => true,
            'data' => $announcements
        ]);
    }

}
