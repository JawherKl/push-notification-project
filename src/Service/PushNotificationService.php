<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class PushNotificationService
{
    private $httpClient;
    private $gotifyUrl;
    private $gotifyToken;

    public function __construct(HttpClientInterface $httpClient, string $gotifyUrl, string $gotifyToken)
    {
        $this->httpClient = $httpClient;
        $this->gotifyUrl = $gotifyUrl;
        $this->gotifyToken = $gotifyToken;
    }

    public function sendNotification(string $title, string $message): void
    {
        $response = $this->httpClient->request('POST', $this->gotifyUrl, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->gotifyToken,
            ],
            'json' => [
                'title' => $title,
                'message' => $message,
                'priority' => 5,
            ],
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Failed to send notification: ' . $response->getContent(false));
        }
    }
}
