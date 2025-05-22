<?php
namespace App\Services;

use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\FirebaseException;

class FirebaseService
{
    protected $database;

    public function __construct()
    {
        $credentials = config('firebase.credentials');
        $databaseUrl = config('firebase.database.url');

        if (!$credentials) {
            throw new \Exception('Firebase credentials not found in configuration');
        }

        if (!$databaseUrl) {
            throw new \Exception('Firebase database URL not found in configuration');
        }

        $factory = (new Factory)
            ->withServiceAccount($credentials)
            ->withDatabaseUri($databaseUrl);

        $this->database = $factory->createDatabase();
    }

    public function pushMessageToConversation($studentId, $messageData)
    {
        try {
            $newMessage = $this->database
                ->getReference("conversations/{$studentId}/messages")
                ->push($messageData);
            return $newMessage->getKey();
        } catch (FirebaseException $e) {
            Log::error('Failed to push message to Firebase: ' . $e->getMessage());
            throw $e;
        }
    }
}