<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserDeviceTokenRepository")
 */
class UserDeviceToken
{
    // Store the device token and user-related information
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $token;

    // Other user-related fields (user_id, device type, etc.)

    // Getters and setters
}
