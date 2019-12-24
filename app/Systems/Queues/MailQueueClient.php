<?php

namespace App\Systems\Queues;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class MailQueueClient {

	public static function attach(string $email)
	{
		$connection = new AMQPStreamConnection(\App\Config\Env::RABBITMQ_HOST, \App\Config\Env::RABBITMQ_PORT, \App\Config\Env::RABBITMQ_USERNAME, \App\Config\Env::RABBITMQ_PASSWORD);

		$channel = $connection->channel();

		$channel->queue_declare('task_queue_mail', false, true, false, false);

		$data = $email;

		$msg = new AMQPMessage(
		    $data,[ 'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT ]
		);

		$channel->basic_publish($msg, '', 'task_queue_mail');

		$channel->close();
		
		$connection->close();
	}

}