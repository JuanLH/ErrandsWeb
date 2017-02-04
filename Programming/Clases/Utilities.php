<?php
class Utilities{

	public static function getConnection()
	{
		include_once "Db.php";
		$db = new DbPDO("sqlsrv", "localhost", "1433", "luis", "root", "showntop");
		return $db;
	}

  public static function sendEmail ($toAddress,$fromAddress,$password,$subject,$content,$yourName)
	{
      $db = Utilities::getConnection();
      $userData = $db->thereAreUser($toAddress);

      if(!$userData===false){
          /**
          * This example shows settings to use when sending via Google's Gmail servers.
          */

         //SMTP needs accurate times, and the PHP time zone MUST be set
         //This should be done in your php.ini, but this is how to do it if you don't have access to that
         date_default_timezone_set('Etc/UTC');

         require 'PHPMailer/PHPMailerAutoload.php';
         //Create a new PHPMailer instance
         $mail = new PHPMailer;
         //Tell PHPMailer to use SMTP
         $mail->isSMTP();
         //Enable SMTP debugging
         // 0 = off (for production use)
         // 1 = client messages
         // 2 = client and server messages
         $mail->SMTPDebug = 0;
         //Ask for HTML-friendly debug output
         $mail->Debugoutput = 'html';
         //Set the hostname of the mail server
         $mail->Host = 'smtp.gmail.com';
         // use
         // $mail->Host = gethostbyname('smtp.gmail.com');
         // if your network does not support SMTP over IPv6

         //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
         $mail->Port = 587;

         //Set the encryption system to use - ssl (deprecated) or tls
         $mail->SMTPSecure = 'tls';

         //Whether to use SMTP authentication
         $mail->SMTPAuth = true;

         //Username to use for SMTP authentication - use full email address for gmail
         $mail->Username = $fromAddress;

         //Password to use for SMTP authentication
         $mail->Password = $password;

         //Set who the message is to be sent from
         $mail->setFrom($fromAddress, $yourName);

         //Set an alternative reply-to address
         //$mail->addReplyTo('example'@gmail.com', 'First Last');

				 //Set who the message is to be sent to
         $mail->addAddress($toAddress, $userData[0]['nombre']);

         //Set the subject line
         $mail->Subject = $subject;

         //Read an HTML message body from an external file, convert referenced images to embedded,
         //convert HTML into a basic plain-text alternative body

         //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
         $mail->msgHTML($content);
         //Replace the plain text body with one created manually
         $mail->AltBody = 'This is a plain-text message body';

         //Attach an image file
         //$mail->addAttachment('images/phpmailer_mini.png');

         //send the message, check for errors
         if (!$mail->send()) {
             echo "Mailer Error: " . $mail->ErrorInfo;
         } else {
            // echo  "Message sent!";
             return "Le Hemos Enviado un Correo (Verifique por favor)";
         }


      }
      else{
          return "No hay usuarios con este correo";
      }
  }



?>
