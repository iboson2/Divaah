<?

      $mailto="mailhostingserver@gmail.com";  //Enter recipient email address here

       $subject = "Test Email";

       $from="admin@divaah.com";          //Your valid email address here

       $message_body = "This is a test email from Webmaster.";

       mail($mailto,$subject,$message_body,"From:".$from);

       echo "Your email has been sent successfully";

?>
