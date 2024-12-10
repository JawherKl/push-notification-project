<?php
namespace App\Service;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class FirebaseService
{
    private $messaging;

    public function __construct()
    {
        // Initialize Firebase with the credentials file
        $this->messaging = (new Factory())
            ->withServiceAccount(__DIR__.'/../config/firebase/firebase_credentials.json')
            ->createMessaging();
    }

    public function sendPushNotification($deviceToken, $title, $body)
    {
        // Create a notification
        $notification = Notification::create($title, $body);

        // Configure the message with web push settings
        $message = CloudMessage::withTarget('token', $deviceToken)
            ->withNotification($notification)
            ->withData([
                'key1' => 'value1', // Custom data (optional)
                'key2' => 'value2',
            ]);

        try {
            $this->messaging->send($message);
        } catch (\Exception $e) {
            throw new \Exception("Error sending push notification: " . $e->getMessage());
        }
    }
}
