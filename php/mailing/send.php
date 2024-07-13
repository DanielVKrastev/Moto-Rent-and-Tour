<?php 

// Import PHPMailer classes into the global namespace 
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\SMTP; 
use PHPMailer\PHPMailer\Exception; 
 
// Include library files 
require 'PHPMailer/Exception.php'; 
require 'PHPMailer/PHPMailer.php'; 
require 'PHPMailer/SMTP.php'; 

class sendMail{

    public $recipient_email = '';
    public $img_logo = '';
    public $img_moto_1 = '';
    public $img_moto_2 = '';
    
    public function sendMail($title, $mail_text){
        // Create an instance; Pass `true` to enable exceptions 
        $email_to = $this->recipient_email;
        $image_logo = $this->img_logo;
        $image_moto_1 = $this->img_moto_1;
        $image_moto_2 = $this->img_moto_2;

        $mail = new PHPMailer; 
        $mail->CharSet = 'UTF-8';

        // Server settings 
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;    //Enable verbose debug output 
        $mail->isSMTP();                            // Set mailer to use SMTP 
        $mail->Host = 'smtp.gmail.com';           // Specify main and backup SMTP servers 
        $mail->SMTPAuth = true;                     // Enable SMTP authentication 
        $mail->Username = 'dido01bandito@gmail.com';       // SMTP username 
        $mail->Password = 'sphofrdpsrqenplw';         // SMTP password 
        $mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted 
        $mail->Port = 465;                          // TCP port to connect to 
        
        // Sender info 
        $mail->setFrom('moto_krastev@gmail.com', 'moto_krastev'); 
        $mail->addReplyTo('moto_krastev@gmail.com', 'moto_krastev'); 
        
        // Add a recipient 
        $mail->addAddress($email_to); 

        //$mail->addCC('cc@example.com'); 
        //$mail->addBCC('bcc@example.com'); 
        
        // Set email format to HTML 
        $mail->isHTML(true); 
        
        //
        $mail->AddEmbeddedImage($image_logo, "logo_moto_krastev");
        $mail->AddEmbeddedImage($image_moto_1, "image_moto_1");
        $mail->AddEmbeddedImage($image_moto_2, "image_moto_2");
        // Mail subject 
        $mail->Subject = $title;
        
        // Mail body content 
        $bodyContent = $mail_text;
        $mail->Body = $bodyContent; 
        
        // Send email 
        
        if(!$mail->send()) { 
            $_SESSION['mailing'] = "error mailing"; 
            $mail->ErrorInfo; 
        } else { 
            $_SESSION['mailing'] = "success mailing"; 
        }
        
    }
}
?>