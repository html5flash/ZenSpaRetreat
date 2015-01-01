<?php
  //print_r($_POST);

 $to = "michelle@zensparetreat.com";//$_POST['email'];
 $to2 = "satyamedia3@gmail.com";//$_POST['email'];
 $subject = "A query received from visitor";

  $headers .= 'From: '.$_POST['name'].' <'.$_POST['email'].'>' . "\r\n";
 $headers.='Content-type: text/html; charset=iso-8859-1';

 $body = "<table cellpadding='5' cellspacing='5'>";
 $body .= "<tr><td align='right'>First Name</td><td>".$_POST['name']."</td></tr>";
$body .= "<tr><td align='right'>Last Name</td><td>".$_POST['company']."</td></tr>";
 $body .= "<tr><td align='right'>Email Address</td><td>".$_POST['email']."</td></tr>";
 $body .= "<tr><td align='right'>Contact Number</td><td>".$_POST['phone']."</td></tr>";
 $body .= "<tr><td align='right'>Massage</td><td>".$_POST['comments']."</td></tr>"; 
 $body .= "</table>";
 
 $mail=mail($to2, $subject, $body, $headers);
 if($mail)
 {
  echo "&mailsent=1";
 }
 else
 {
  echo "&mailsent=0";
 }
 $mail=mail($to, $subject, $body, $headers);

?>