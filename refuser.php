<?php
require "Gestionfiche.php"; 
$up = new Gestionutilasteur2();
if(isset($_POST['Refuser'])) { 
    try{
    $email1 = $_POST['email1'];
    $email2 = $_POST['email2'];
    $message = $_POST['message'];
    $CIN = $_POST['CIN'];
    $to=$email1 . ',' . $email2;
    $subject = "PFE";
    $sender = "From: fakhri.chargui37@gmail.com";
    mail($to, $subject, $message, $sender);
    $up->updateEtat2($CIN);
}
catch(Exception $e){
    echo "error";
}    
}
?>