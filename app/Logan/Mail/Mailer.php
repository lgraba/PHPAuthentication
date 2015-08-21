<?php

// Mailer.php
// A class to send notification emails to the user

namespace Logan\Mail;

class Mailer
{

	protected $view;
	protected $mailer;

	public function __construct($view, $mailer)
	{
		$this->view = $view;
		$this->mailer = $mailer;
	}

	public function send($template, $data, $callback)
	{
		$message = new Message($this->mailer);

		// Append data to the view
		$this->view->appendData($data);
		// Render template for body of email
		$message->body($this->view->render($template));
		// call_user_func? Look this up
		call_user_func($callback, $message);

		// Send email
		$this->mailer->send();
	}

}