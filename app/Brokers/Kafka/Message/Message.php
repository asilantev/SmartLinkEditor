<?php

namespace App\Brokers\Kafka\Message;

use App\Interfaces\Broker\Producer\ProducerMessageInterface;

class Message extends AbstractMessage implements ProducerMessageInterface
{
    public function withHeaders(array $headers = []): ProducerMessageInterface
    {
        $this->headers = $headers;
        return $this;
    }

    public function onTopic(string $topic): ProducerMessageInterface
    {
        $this->topicName = $topic;
        return $this;
    }
    public function withKey(?string $key): ProducerMessageInterface
    {
        $this->key = $key;
        return $this;
    }

    public function withBody(mixed $body): ProducerMessageInterface
    {
        $this->body = $body;
        return $this;
    }

    public function withHeader(string $key, string|int|float $value): ProducerMessageInterface
    {
        $this->headers[$key] = $value;
        return $this;
    }
}
