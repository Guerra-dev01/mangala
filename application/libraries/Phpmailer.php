
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Phpmailer
{
    public function __construct()
    {
        log_message('Debug', 'PHPMailer class is loaded.');
    }

    public function load()
    {
        require_once(FCPATH."third_party/phpmailer/PHPMailerAutoload.php");
        $objMail = new PHPMailer\PHPMailer\PHPMailer();
        return $objMail;
    }
}