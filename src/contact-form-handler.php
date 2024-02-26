<?php
$response = 'error';
$myemail = 'contact@karyapravah.com';//<-----Put Your email address here.
if(!empty($_POST['contact_full_name'])  || 
   !empty($_POST['contact_email']) || 
   !empty($_POST['contact_message']))
{
    $name = $_POST['contact_full_name']; 
    $email_address = $_POST['contact_email']; 
    $phone = $_POST['contact_phone']; 
    $message = $_POST['contact_message']; 

    $to = $myemail;
    $email_subject = "Contact form submission: $name";
    $email_body = "You have received a new message. ".
    " Here are the details:\n Name: $name \n ".
    "Email: $email_address\n Phone: $phone\n Message \n $message";
    $headers = "From: $myemail\n";
    $headers .= "Reply-To: $email_address";
    $headers .= 'Cc: asif.kilwani@gmail.com' . "\r\n";
    mail('contact@karyapravah.com',$email_subject,$email_body,$headers);
    $response = "success";    
}

echo($response);

?>