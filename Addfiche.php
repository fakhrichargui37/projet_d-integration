<?php
require "Gestionfiche.php"; 

$up = new Gestionutilasteur2(); 

if(isset($_POST['s'])) { 
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $target_dir = "uploads/"; // Change this to the desired directory for uploaded files
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = array( "pdf");
        if (!in_array($file_type, $allowed_types)) {
            echo "Sorry, only JPG, JPEG, PNG, GIF, and PDF files are allowed.";
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            $Etudian1 = $_POST['Etudian1'];
            $GrapeEtudia1 = $_POST['GrapeEtudia1'] ;
            $email1 = $_POST['email1'] ;
            $Etudian2 = $_POST['Etudian2'] ;
            $GrapeEtudia2 = $_POST['GrapeEtudia2'] ;
            $email2 = $_POST['email2'] ;
            $titre = $_POST['titre'] ;
            $Encadreur = $_POST['Encadreur'] ;
            $Entrepise = $_POST['Entrepise'] ;
            $Encadreur_entrepise = $_POST['Encadreur_entrepise'] ;
            $filename = $_FILES["file"]["name"];
            $CIN = $_POST['CIN'] ;
            $CIN2 = $up->obtenirEtudianemail($email2);

                if ($up-> obtenirEtudian($CIN)) {
                    $u = new Fiche($Etudian1, $GrapeEtudia1, $email1, $Etudian2, $GrapeEtudia2, $email2, $titre, $Encadreur, $Entrepise, $Encadreur_entrepise, $filename, $CIN, $CIN2);
                    $res2 = $up->updateFiche($u);
                    
                } else {
                    $u = new Fiche($Etudian1, $GrapeEtudia1, $email1, $Etudian2, $GrapeEtudia2, $email2, $titre, $Encadreur, $Entrepise, $Encadreur_entrepise, $filename, $CIN, $CIN2);
                    $res1 = $up->insertFiche($u);
                }

                if($res1) {
                    header("location: home.php?etat=1");
                    exit(); 
                } elseif($res2) {
                    header("location: home.php?etat=2");
                    exit();
                }
        }
    }
}
}
?>

