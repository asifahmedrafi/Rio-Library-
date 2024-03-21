<?php
//    $res = mysqli_query($link, "select * from tbl_users where id=$id");
//    while($row = mysqli_fetch_array($res)){
//        $email      = $row['email']; 
//    }
    
    require "PHPMailer/PHPMailerAutoload.php";

    $mail = new PHPMailer;
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'rafiahmed221@gmail.com';             // SMTP username
    $mail->Password = 'app-password';                 // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom('rafiahmed221@gmail.com', 'mamun');
    $mail->addAddress('rahadhasan1004@gmail.com');            // Add a recipient
    $mail->addReplyTo('rafiahmed221@gmail.com');

    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';


    if(!$mail->send()) {
        echo 'Message could not be sent.';
    } else {
        echo 'Message has been sent';
    }
?>
