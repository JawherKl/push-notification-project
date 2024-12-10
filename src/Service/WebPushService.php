<?php

namespace App\Service;

use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class WebPushService
{
    private $webPush;
    private $vapidPublicKey;
    private $vapidPrivateKey;

    public function __construct(string $vapidPublicKey, string $vapidPrivateKey)
    {
        $this->vapidPublicKey = $vapidPublicKey;
        $this->vapidPrivateKey = $vapidPrivateKey;
        $this->webPush = new WebPush([
            'VAPID' => [
                'publicKey' => $this->vapidPublicKey,
                'privateKey' => $this->vapidPrivateKey,
                'subject' => 'mailto:kalleljawher4@gmail.com', // Your email here
            ],
        ]);
    }

    public function sendNotification(string $title, string $message, string $subscription): void
    {
        $subscription = Subscription::create(json_decode($subscription, true));

        // Queue the notification
        $this->webPush->queueNotification($subscription, json_encode([
            'title' => $title,
            'message' => $message,
        ]));

        // Send the notification to the browser
        $this->webPush->flush();
    }
}
