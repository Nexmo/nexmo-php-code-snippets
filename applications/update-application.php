<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
$client = new \Nexmo\Client(new \Nexmo\Client\Credentials\Container($basic));

try {
    $application = $client->applications()->get(MESSAGES_APPLICATION_ID);
    $application->setName('New Name2');
    $application->getVoiceConfig()->setWebhook(
        Nexmo\Application\VoiceConfig::ANSWER,
        new Nexmo\Application\Webhook('http://test.domain/webhook/voice')
    );
    $application = $client->applications()->update($application);

    echo $application->getId() . PHP_EOL;
    echo $application->getName() . PHP_EOL;
} catch (\InvalidArgumentException $e) {
    echo $e->getMessage() . PHP_EOL;
}