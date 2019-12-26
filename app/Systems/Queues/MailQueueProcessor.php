<?php

require __DIR__ .'/../../../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use App\Systems\Mail;

class MailQueueProcessor{

	public function run()
	{
		$connection = new AMQPStreamConnection(\App\Config\Env::RABBITMQ_HOST, \App\Config\Env::RABBITMQ_PORT, \App\Config\Env::RABBITMQ_USERNAME, \App\Config\Env::RABBITMQ_PASSWORD);

		$channel = $connection->channel();

		$channel->queue_declare('task_queue_mail', false, true, false, false);

		echo " [*] Waiting for messages. To exit press CTRL+C\n";

		$callback = function ($msg) {

			echo " [x] Received Signal \r\n";
			//Write Task Logic here
			
			$recipientEmail = $msg->body;
			$recipientFullName = "Kay Odole";
			$subject = "This is a KayPHP Demo Email";
			$body = file_get_contents('app/views/email/demo.php');

			Mail::sendEmail($recipientEmail, $recipientFullName, $subject, $body);
		   
			sleep(20);
		    //After task has been concluded
		    echo " [x] Done \r\n";

		    $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
		};

		$channel->basic_qos(null, 1, null);
		$channel->basic_consume('task_queue_mail', '', false, false, false, false, $callback);

		while ($channel->is_consuming()) {
		    $channel->wait();
		}

		$channel->close();
		$connection->close();
	}
}

( new MailQueueProcessor())->run();