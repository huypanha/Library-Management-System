<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
require_once '../vendor/autoload.php';
 
class Email {
    // private $mail;

    // public function __construct(){
    //     $this->$mail = new PHPMailer(true);
    // }

    function sendEmail($recipient, $subject, $body){
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Host = 'smtp.gmail.com';
            $mail->Username = 'loanms629@gmail.com';
            $mail->Password = 'dogh zqzl mhoh bwcl' ;
            $mail->Port = 465;
            $mail->SMTPSecure = "ssl";
        
            //Recipients
            $mail->setFrom('loanms629@gmail.com', 'Library Management System');
            // $mail->addAddress('pisethomchan4242@gmail.com');
            $mail->addAddress($recipient);
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
        
            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');
        
            //Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;
        
            $mail->send();
            $mail->smtpClose();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

?>