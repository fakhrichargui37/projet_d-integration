<?php
require "Gestionfiche.php"; 
$up = new Gestionutilasteur2();
if(isset($_POST['s2'])) { 
    $CIN = $_POST['CIN'];
    $res = $up->SupprimerUser($CIN);
    if($res){
        header("location: home.php?etat=3");
        exit(); 
    }
    else{
        header("location: home.php?etat=4");
        exit(); 
    }
}
?>