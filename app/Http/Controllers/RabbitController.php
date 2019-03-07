<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Enqueue\AmqpLib\AmqpConnectionFactory;
use Enqueue\AmqpTools\RabbitMqDlxDelayStrategy;

class RabbitController extends Controller
{
    public function rabbit()
    {
//        $context = (new AmqpConnectionFactory('amqp://mkwmvpgy:t_RcOgdrlRq0Tq1sR9WjkFm0anI6IAG8@bullfrog.rmq.cloudamqp.com/mkwmvpgy'))->createContext();

        $context = (new AmqpConnectionFactory(env("AMQP_URL")))->createContext();
        $queue = $context->createQueue('foo');
        $queue->setArgument('x-max-priority', 10);
        $context->declareQueue($queue);

        $context->createProducer()
            ->setPriority(2)
            ->setTimeToLive(60000)
//                        ->setDeliveryDelay(5000)  --delay nije podrzan
            ->send($queue, $context->createMessage('hello!'));
    }

    public function rabbitDelay()
    {
        $context = (new AmqpConnectionFactory(env("AMQP_URL")))->createContext();
        $context->setDelayStrategy(new RabbitMqDlxDelayStrategy());
        // or (requre the delay plugin)
        // $context->setDelayStrategy(new RabbitMqDelayPluginDelayStrategy());
        $context->createProducer()
            ->setDeliveryDelay(15000) // 5 sec
            ->send($context->createQueue('foo'), $context->createMessage('Hello!'))
        ;
    }
}
