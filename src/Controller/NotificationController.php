<?php

namespace App\Controller;

use App\Service\PushNotificationService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\AsController;
use App\Entity\Notification;
use Doctrine\ORM\EntityManagerInterface;

class NotificationController extends AbstractController
{
    private $pushNotificationService;

    public function __construct(PushNotificationService $pushNotificationService)
    {
        $this->pushNotificationService = $pushNotificationService;
    }

    /**
     * @Route("/send-notification", methods={"POST"})
     */
    public function send(EntityManagerInterface $em): JsonResponse
    {
        try {
            // Save notification to the database
            $notification = new Notification();
            $notification->setTitle("Hello from Hub Score!");
            $notification->setMessage("This is a test notification sent from Symfony.");
            $notification->setCreatedAt(new \DateTime());   
            
            $em->persist($notification);
            $em->flush();

            $this->pushNotificationService->sendNotification(
                'Hello from Hub Score!',
                'This is a test notification sent from Symfony.'
            );

            return new JsonResponse(['status' => 'Notification sent successfully!']);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }
    
    /**
     * @Route("/get-notifications", methods={"GET"})
     */
    public function getNotifications(EntityManagerInterface $em): JsonResponse
    {
        $repository = $em->getRepository(Notification::class);

        // Fetch only unread notifications
        $notifications = $repository->findBy(['isRead' => false], ['createdAt' => 'DESC']);

        // Prepare response
        $response = array_map(function (Notification $notification) {
            return [
                'id' => $notification->getId(),
                'title' => $notification->getTitle(),
                'message' => $notification->getMessage(),
                'createdAt' => $notification->getCreatedAt()->format('Y-m-d H:i:s'),
            ];
        }, $notifications);

        // Mark notifications as read
        foreach ($notifications as $notification) {
            $notification->setIsRead(true);
        }
        $em->flush();

        return new JsonResponse($response);
    }
}
