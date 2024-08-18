<?php

namespace Tests\Unit\Kafka;

use App\Brokers\Kafka\Message\Message;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

class ProducerMessageTest extends TestCase
{
    public function testConstructorAndGetters()
    {
        $topicName = 'test-topic';
        $headers = ['header1' => 'value1', 'header2' => 'value2'];
        $additionalHeaders = ['header3' => 'value3'];
        $body = ['key' => 'value'];
        $key = 'test-key';

        $message = new Message();
        $message
            ->onTopic($topicName)
            ->withBody($body)
            ->withKey($key)
            ->withHeaders($headers)
            ->withHeader('header3', $additionalHeaders['header3']);

        $this->assertEquals($topicName, $message->getTopicName());
        $this->assertEquals($headers + $additionalHeaders, $message->getHeaders());
        $this->assertEquals($body, $message->getBody());
        $this->assertEquals($key, $message->getKey());
        assertEquals(RD_KAFKA_PARTITION_UA, $message->getPartition());
    }
}
