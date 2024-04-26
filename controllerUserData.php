<?php 
session_start();
require "connection.php";
$email = "";
$name = "";
$errors = array();

//if user signup button
if(isset($_POST['signup'])){
    $CIN = mysqli_real_escape_string($con, $_POST['CIN']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    if($password !== $cpassword){
        $errors['password'] = "Confirmez que le mot de passe ne correspond pas!";
    }
    
    $CIN_check = "SELECT * FROM usertable WHERE CIN = $CIN or email='$email'";
    $res = mysqli_query($con, $CIN_check);
    if(mysqli_num_rows($res) > 0){
        $errors['CIN'] = "Le CIN or email que vous avez saisi existe déjà !";
    }
    if(count($errors) === 0){
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $status = "notverified";
        $insert_data = "INSERT INTO usertable (CIN, email, password, code, status,name,usertype)
                        values($CIN, '$email', '$encpass', '$code', '$status','$name','Etudian')";
        $data_check = mysqli_query($con, $insert_data);
        if($data_check){
            $subject = "Email Verification Code";
            $message = "Your verification code is $code";
            $sender = "From: fakhri.chargui37@gmail.com";
            if(mail($email, $subject, $message, $sender)){
                $info = "Nous avons envoyé un code de vérification à votre adresse e-mail - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header('location: user-otp.php');
                exit();
            }else{
                $errors1['otp-error'] = "Échec lors de l'envoi du code!";
            }
        }else{
            $errors1['db-error'] = "Échec lors de l'insertion des données dans la base de données!";
        }
    } 

}
    //if user click verification code submit button
    if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE usertable SET code = $code, status = '$status' WHERE code = $fetch_code";
            $update_res = mysqli_query($con, $update_otp);
            if($update_res){
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                header('location: home.php');
                exit();
            }else{
                $errors['otp-error'] = "Échec lors de la mise à jour du code !";
            }
        }else{
            $errors['otp-error'] = "Vous avez entré un code incorrect!";
        }
    }

    //if user click login button
    if(isset($_POST['login'])){
        $CIN = mysqli_real_escape_string($con, $_POST['CIN']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $check_CIN = "SELECT * FROM usertable WHERE CIN = '$CIN'";
        $res = mysqli_query($con, $check_CIN);
        if(mysqli_num_rows($res) > 0){
            $fetch = mysqli_fetch_assoc($res);
            $fetch_pass = $fetch['password'];
            if(password_verify($password, $fetch_pass)){
                $_SESSION['CIN'] = $CIN;
                $status = $fetch['status'];
                $email=$fetch['email'];
                $usertype=$fetch['usertype'];
                if($status == 'verified' && $usertype=="Etudian"){
                  $_SESSION['CIN'] = $CIN;
                  $_SESSION['password'] = $password;
                    header('location: home.php');
                }elseif($usertype=="Enseignant"){
                    $_SESSION['CIN'] = $CIN;
                    $_SESSION['password'] = $password;
                    header('location: index.php');
                }elseif($usertype=="Admin"){
                    $_SESSION['CIN'] = $CIN;
                    $_SESSION['password'] = $password;
                    header('location: addens.php');
                }
                else{
                    $info = "It's look like you haven't still verify your email - $email";
                    $_SESSION['info'] = $info;
                    header('location: user-otp.php');
                }
            }else{
                $errors['email'] = "CIN ou mot de passe incorrect!";
            }
        }else{
            $errors['email'] = "On dirait que vous n'êtes pas inscrire! Cliquez sur le lien du bas pour vous inscrire.";
        }
    }
    
    //if user click continue button in forgot password form with email
    if(isset($_POST['check-email'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $check_email = "SELECT * FROM usertable WHERE email='$email'";
        $run_sql = mysqli_query($con, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE usertable SET code = $code WHERE email = '$email'";
            $run_query =  mysqli_query($con, $insert_code);
            if($run_query){
                $subject = "Password Reset Code";
                $message = "Your password reset code is $code";
                $sender = "From: fakhri.chargui37@gmail.com";
                if(mail($email, $subject, $message, $sender)){
                    $info = "Nous avons envoyé un OTP de réinitialisation de mot de passe à votre adresse e-mail- $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: reset-code.php');
                    exit();
                }else{
                    $errors['otp-error'] = "Échec lors de l'envoi du code!";
                }
            }else{
                $errors['db-error'] = "Quelque chose s'est mal passé!";
            }
        }else{
            $errors['email'] = "Cette adresse email n'existe pas !";
        }
    }


    //if user click check reset otp button
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Veuillez créer un nouveau mot de passe que vous n'utilisez sur aucun autre site.";
            $_SESSION['info'] = $info;
            header('location: new-password.php');
            exit();
        }else{
            $errors['otp-error'] = "Vous avez entré un code incorrect!";
        }
    }

    //if user click change password button
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
        if($password !== $cpassword){
            $errors['password'] = "Confirm password not matched!";
        }else{
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $update_pass = "UPDATE usertable SET code = $code, password = '$encpass' WHERE email = '$email'";
            $run_query = mysqli_query($con, $update_pass);
            if($run_query){
                $info = "Votre mot de passe a changé. Vous pouvez maintenant vous connecter avec votre nouveau mot de passe.";
                $_SESSION['info'] = $info;
                header('Location: password-changed.php');
            }else{
                $errors['db-error'] = "Échec de la modification de votre mot de passe!";
            }
        }
    }
    
   //if login now button click
    if(isset($_POST['login-now'])){
        header('Location: login-user.php');
    }
    
?>