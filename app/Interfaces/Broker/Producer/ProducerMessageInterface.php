<?php

namespace App\Interfaces\Broker\Producer;

use App\Interfaces\Broker\MessageInterface;

interface ProducerMessageInterface extends MessageInterface
{
    public function withKey(?string $key): ProducerMessageInterface;

    public function withBody(mixed $body): ProducerMessageInterface;

    public function onTopic(string $topic): ProducerMessageInterface;

    public function withHeaders(array $headers = []):  ProducerMessageInterface;

    public function withHeader(string $key, string|int|float $value): ProducerMessageInterface;
}
