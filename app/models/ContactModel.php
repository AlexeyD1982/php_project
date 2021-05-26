<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class ContactModel
{
    private $name;
    private $email;
    private $age;
    private $message;

    public function setData($name, $email, $age, $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->age = $age;
        $this->message = $message;
    }

    public function validForm()
    {
        if (strlen($this->name) < 3) {
            return "Имя слишком короткое";
        } elseif (strlen($this->email) < 3) {
              return 'Email слишком короткий';
        } elseif (!is_numeric($this->age) || $this->age <= 0 || $this->age > 90) {
            return 'Вы ввели не возраст';
        } elseif (strlen($this->message) < 10) {
            return 'Сообщение слишком короткое';
        }

        return 'Верно';

    }

    public function mail()
    {

        $mail = new PHPMailer(true);

        $mail->setLanguage('ru', 'vendor/phpmailer/phpmailer/language/');

        try {

            $mail->SMTPDebug = SMTP::DEBUG_OFF;                         //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->CharSet = "UTF-8";
            $mail->Host       = 'smtp.mail.ru';                         //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'alexd999@list.ru';                     //SMTP username
            $mail->Password   = 'VYBZDG46cSm5sw4k2pXN';                 //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
//            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption;
            $mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('alexd999@list.ru','Mail sender');
            $mail->addReplyTo($this->email, $this->name);
            $mail->addAddress( 'alexd999@list.ru','mail recipient');     //Add a recipient

            //Content

            $mail->Subject = 'Сообщение с сайта от ' . $this->email;
            $mail->Body    = "Имя: " .$this->name . " Возраст: " . $this->age . " Сообщение: " . $this->message;

            $success = $mail->send();
            if ($success) {
                return 'Сообщение успешно отправлено';
            }

        } catch (Exception $e) {
            return "Сообщение не может быть отправлено. Ошибка: {$mail->ErrorInfo}";
        }
    }
}
