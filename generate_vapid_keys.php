<?php

require 'vendor/autoload.php'; // Ensure this path is correct

use Minishlink\WebPush\VAPID;

$keys = VAPID::createVapidKeys();

echo 'Public Key: ' . $keys['publicKey'] . PHP_EOL;
echo 'Private Key: ' . $keys['privateKey'] . PHP_EOL;
