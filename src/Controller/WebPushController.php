<?php
// src/Controller/WebPushController.php

namespace App\Controller;

use App\Service\WebPushService;
use App\Service\FirebaseService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\AsController;
use Symfony\Component\HttpFoundation\Response;

class WebPushController extends AbstractController
{
    private $webPushService;
    private $firebaseService;

    public function __construct(WebPushService $webPushService, FirebaseService $firebaseService)
    {
        $this->webPushService = $webPushService;
        $this->firebaseService = $firebaseService;
    }

    /**
     * @Route("/subscribe", methods={"POST"})
     */
    public function subscribe(Request $request): JsonResponse
    {
        $token = $request->get('token');
        // Save token in the database (implement saving logic here)
        // Send confirmation or error response
        return $this->json(['status' => 'success']);
    }

    /**
     * @Route("/send-webpush", methods={"POST"})
     */
    public function sendNotification(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['subscription'])) {
            return new JsonResponse(['error' => 'No subscription data provided'], 400);
        }

        $subscription = $data['subscription'];
        $title = $data['title'] ?? 'Default Title';
        $message = $data['message'] ?? 'Default Message';

        try {
            $this->webPushService->sendNotification($title, $message, $subscription);
            return new JsonResponse(['status' => 'Notification sent successfully']);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }


    /**
     * @Route("/send-firebase-notification", name="send-firebase-notification", methods={"POST"})
     */
    public function sendFireBaseNotification(Request $request)
    {
        $title = $request->get('title');
        $body = $request->get('body');
        $deviceToken = 'BBw6MQRDaW1QyA82jtQLbV3-TmrxlBdBKT8VEwkhSjJxdQx1Gx0PRg7bhZvVgJFQdwBbWKs4OmXOueZ75a731Ro'; // Get token from DB

        // Call FirebaseService to send the notification
        $this->firebaseService->sendPushNotification($deviceToken, $title, $body);

        return $this->json(['status' => 'Notification Sent']);
    }
    
    /**
     * @Route("/base", name="base", methods={"POST"})
     */
    public function base(): Response
    {
        return $this->render('base.html.twig');
    }
}
