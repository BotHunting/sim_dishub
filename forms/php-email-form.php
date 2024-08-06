<?php

class PHP_Email_Form
{
    public $to;
    public $from_name;
    public $from_email;
    public $subject;
    public $message;
    public $headers;

    public $ajax;
    public $error_message;

    public function __construct()
    {
        $this->ajax = false;
        $this->error_message = '';
    }

    public function add_message($message, $name = '')
    {
        if ($name == '') {
            $this->message = $message;
        } else {
            $this->message .= "\n\n$name: $message";
        }
    }

    public function send()
    {
        $this->headers = "From: $this->from_name <$this->from_email>";

        if (mail($this->to, $this->subject, $this->message, $this->headers)) {
            return 'OK';
        } else {
            return 'Error';
        }
    }
}

?>
