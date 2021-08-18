<?php

namespace App\Services;

/**
 * Message
 */
class Message
{
	private $message = [];
    /**
     * @param string $message
     * @param array $data
     */
	public function __construct(string $message, array $data = [])
	{
		$this->message['message'] = $message;
		$this->message['errors']  = $data;
	}

    /**
     *
     * @return void
     */
	public function getMessage()
	{
		return $this->message;
	}
}