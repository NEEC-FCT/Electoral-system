<?php
require 'db.php';

$con = mysqli_connect("localhost", "DB_USER",  "DB_PASS", "DB_NAME");
$con->set_charset("utf8mb4");

function generateRandomString($length)
{
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}


function generateToken()
{
  return hash('sha256', generateRandomString(400));
}

function addToDatabase($token, $con)
{
  $stmt = $con->prepare("INSERT INTO `voters`(`token`, `used`) VALUES ( ?, 0 )");
  $stmt->bind_param("s", $token);
  $stmt->execute();
}

function sendEmail($to, $token)
{
  $subject = '[Eleições] Link para a votação';
  $message = '<html><head><title>Votação NEEC</title></head><body><p>Usa este link para poderes votar na lista que desejas: ';
  $message .= '<a href="https://neec-fct.com/Electoral-system/index.php?token=' . $token . '">Link</a></p><br/>';
  $message .= '<p><b>Nota:</b> O link só poderá ser utilizado uma única vez!</p></body></html>';

  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  $headers .= 'From:  geral@neec-fct.com' . "\r\n";
  return mail($to, $subject, $message, $headers);
}


function cleanTokenTable($con)
{
  $stmt = $con->prepare("TRUNCATE TABLE `voters`;");
  $stmt->execute();
}

//This deletes all TOKENS!
cleanTokenTable($con);

$send_counter = 0;
$emails = array('mail1@neec-fct.com', 'mail2@neec-fct.com');
foreach ($emails as &$email) {
  $token = generateToken();
  if (sendEmail($email, $token)) {
    addToDatabase($token, $con);
    //echo "Email enviado para: " . $email . "<br>";
    $send_counter++;
  } else {
    echo "Não foi possível enviar email para: " . $email . "<br>";
  }
}

echo "Foram enviados com sucesso " . $send_counter . " emails.";
