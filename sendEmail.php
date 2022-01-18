<?php
//Pour l'envoie de l'email
use PHPMailer\PHPMailer\PHPMailer;
if(isset($_POST['name']) && isset($_Post['email'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    include_once('mail/PHPMailer.php');
    include_once('mail/SMTP.php');
    include_once('mail/Exception.php');

    $mail = new PHPMailer();

    //smtp settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'odilecoutiez@gmail.com';
    $mail->Password = 'alexandre2@';
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';

    //Email settings
    $mail->isHTML(true);
    $mail->setForm($email, $name);
    $mail->addAddress('odilecoutiez@gmail.com');
    $mail->Subject = ($email ($phone));
    $mail->Body = $message;
    
    if($mail->send()){
        $status = 'success';
        $response = 'Email is sent!';
    } else{
        $status = 'failed';
        $response = 'Something is wrong: <br>' . $mail->ErrorInfo;
    }

    exit(json_encode(array('status' => $status, 'response' => $response)));
    
}