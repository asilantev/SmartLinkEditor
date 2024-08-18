<?php

namespace App\Brokers\Kafka\Facades;

use App\Interfaces\Broker\MessageInterface;
use App\Interfaces\Broker\ProducerInterface;
use Junges\Kafka\Contracts\ProducerMessage;
use Junges\Kafka\Facades\Kafka;

class Producer implements ProducerInterface
{
    public function sendMessage(MessageInterface $message): void
    {
        $message = $this->createMessage($message);

        Kafka::publish()
            ->onTopic($message->getTopicName())
            ->withMessage($message)
            ->send();
    }

    private function createMessage(MessageInterface $message): ProducerMessage
    {
        /** @var ProducerMessage $kafkaMessage */
        $kafkaMessage = app(ProducerMessage::class);
        $kafkaMessage
            ->onTopic($message->getTopicName())
            ->withBody($message->getBody())
            ->withHeaders($message->getHeaders())
            ->withKey($message->getKey())
        ;

        return $kafkaMessage;
    }
}
