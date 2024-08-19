<?php

namespace App\Interfaces\Broker;

interface ProducerInterface
{
    public function sendMessage(MessageInterface $message);
}
