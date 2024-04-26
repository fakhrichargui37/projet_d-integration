<?php
require_once "controllerUserData.php";

$CIN = $_SESSION['CIN'];
$password = $_SESSION['password'];

if ($CIN != false && $password != false) {
    $sql = "SELECT * FROM usertable WHERE CIN = '$CIN'";
    $run_Sql = mysqli_query($con, $sql);

    if ($run_Sql) {
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];

        if ($status == "verified") {
            if ($code != 0) {
                header('Location: reset-code.php');
                exit; // Add exit after header redirect
            }
        } else {
            header('Location: user-otp.php');
            exit; // Add exit after header redirect
        }
    }
} else {
    header('Location: login-user.php');
    exit; // Add exit after header redirect
}
?>

<?php
require_once "Gestionfiche.php";

if (isset($_GET['CIN'])) {
    $up = new Gestionutilasteur2;
    $CINetud = $_GET['CIN'];

    try {
        $Etud = $up->obtenirEtudian_CIN($CINetud);
    } catch (PDOException $e) {
        echo "An error occurred while fetching student information: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
</head>

<body>
    <?php foreach ($Etud as $i) { ?>
        <div>
            <?php echo "|{$i['Etudian1']}|"; ?>
            <?php echo "|{$i['GrapeEtudia1']}|"; ?>
            <?php echo "|{$i['email1']}|"; ?>
            <?php echo "|{$i['Etudian2']}|"; ?>
            <?php echo "|{$i['GrapeEtudia2']}|"; ?>
            <?php echo "|{$i['email2']}|"; ?>
            <?php echo "|{$i['titre']}|"; ?>
            <?php echo "|{$i['Encadreur']}|"; ?>
            <?php echo "|{$i['Entrepise']}|"; ?>
            <?php echo "|{$i['Encadreur_entrepise']}|"; ?>
            <?php $file_path = "uploads/" . $i['filename']; ?>
            <?php echo "|{$i['Fiche_PFE']}|"; ?>
        </div>
    <?php } ?>
</body>

</html>
