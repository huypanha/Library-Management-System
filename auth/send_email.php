<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
require_once '../vendor/autoload.php';
 
class Email {
    private $mail;

    public function __construct(){
        $this->$mail = new PHPMailer(true);
    }

    function sendEmail($recipient, $subject, $body){
        try {
            $this->$mail->isSMTP();
            $this->$mail->Host = 'smtp.gmail.com';
            $this->$mail->SMTPAuth = true;
            $this->$mail->Host = 'smtp.gmail.com';
            $this->$mail->Username = 'loanms629@gmail.com';
            $this->$mail->Password = 'dogh zqzl mhoh bwcl' ;
            $this->$mail->Port = 465;
            $this->$mail->SMTPSecure = "ssl";
        
            //Recipients
            $this->$mail->setFrom('loanms629@gmail.com', 'Library Management System');
            // $this->$mail->addAddress('pisethomchan4242@gmail.com');
            $this->$mail->addAddress($recipient);
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
        
            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');
        
            //Content
            $this->$mail->isHTML(true);
            $this->$mail->Subject = $subject;
            $this->$mail->Body    = $body;
        
            $this->$mail->send();
            $this->$mail->smtpClose();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->$mail->ErrorInfo}";
        }
    }
}

?>