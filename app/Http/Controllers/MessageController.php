<?php
namespace App\Http\Controllers;

use App\Models\Message;
use App\Services\FirebaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    protected $firebaseService;

    public function __construct(FirebaseService $firebaseService)
    {
        $this->firebaseService = $firebaseService;
    }

    // Gửi tin nhắn từ sinh viên
    public function sendMessage(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $studentId = Auth::id();
        if (!$studentId) {
            return response()->json(['status' => false, 'message' => 'Unauthenticated'], 401);
        }

        $messageData = [
            'sender' => 'student',
            'student_id' => $studentId,
            'content' => $request->content,
            'created_at' => now()->toDateTimeString(),
        ];

        try {
            $this->firebaseService->pushMessageToConversation($studentId, $messageData);
            Log::info('Message pushed to Firebase', ['student_id' => $studentId]);
        } catch (\Exception $e) {
            Log::error('Failed to push message to Firebase: ' . $e->getMessage());
            return response()->json(['status' => false, 'message' => 'Failed to send message to Firebase'], 500);
        }

        return response()->json(['status' => true, 'message' => 'Message sent successfully']);
    }

    // Gửi tin nhắn từ admin đến sinh viên
    public function replyToStudent(Request $request)
    {
        $request->validate([
            'student_id' => 'required|integer',
            'content' => 'required|string|max:1000',
        ]);

        $adminId = Auth::id(); // ID của admin (cần xác thực admin)
        if (!$adminId) {
            return response()->json(['status' => false, 'message' => 'Unauthenticated'], 401);
        }

        $messageData = [
            'sender' => 'admin',
            'student_id' => $request->student_id,
            'content' => $request->content,
            'created_at' => now()->toDateTimeString(),
        ];

        try {
            $this->firebaseService->pushMessageToConversation($request->student_id, $messageData);
            Log::info('Reply sent to student', ['student_id' => $request->student_id]);
        } catch (\Exception $e) {
            Log::error('Failed to send reply to student: ' . $e->getMessage());
            return response()->json(['status' => false, 'message' => 'Failed to send reply to student'], 500);
        }

        return response()->json(['status' => true, 'message' => 'Reply sent successfully']);
    }
}