<?php

// Message.php
// Constructs the message for Mailer using PHPMailer
// This way, if we use a different mailer, we only have to modify this class.

namespace Logan\Mail;

class Message
{
	
	protected $mailer;

	public function __construct($mailer)
	{
		$this->mailer = $mailer;

	}

	public function to($address)
	{
		$this->mailer->addAddress($address);
		// Add name later?
		// $mailer->addAddress($address, 'Joe User');
		// Must modify send block in register.php to include name if so
	}

	public function subject($subject)
	{
		$this->mailer->Subject = $subject;
	}

	public function body($body)
	{
		$this->mailer->Body = $body;
		// HTML vs. Plaintext?
		// $mailer->AltBody = 'This is the body in plain text for non-HTML mail clients';
	}

}