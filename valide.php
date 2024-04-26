<?php
require "Gestionfiche.php"; 
$up = new Gestionutilasteur2();
if(isset($_POST['valide'])) { 
    try{
    $email1 = $_POST['email1'];
    $email2 = $_POST['email2'];
    $CIN = $_POST['CIN'];
    $to=$email1 . ',' . $email2;
    $subject = "PFE";
    $message = "PFE et valide";
    $sender = "From: fakhri.chargui37@gmail.com";
    mail($to, $subject, $message, $sender);
    $up->updateEtat($CIN);
}
catch(Exception $e){
    echo "error";
}
}
?>