<?php require_once "controllerUserData.php"; ?>
<?php 
$email = $_SESSION['email'];
if($email == false){
  header('Location: login-user.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="src/css/style1.css">
    <title>Create a New Password</title>
</head>
<body>
    <div class="wrapper">
        <div class="form-box" >
            <div class="login-container" id="login">
                <form action="new-password.php" method="POST" autocomplete="off">
                    <div class="top">
                        <header>Enter your validation <Code></Code></header>
                    </div>
<?php
if(isset($_SESSION['info']) || count($errors) > 0){
    ?>
    <div class="alert text-center <?php echo isset($_SESSION['info']) ? 'alert-danger' : 'alert-success'; ?>">
        <?php
        if(isset($_SESSION['info'])){
            echo $_SESSION['info'];
        }
        foreach($errors as $showerror){
            echo $showerror;
        }
        ?>
    </div>
    <?php
}
?>

                    
                     <div class="input-box">
                        <input class="input-field" type="password" name="password" placeholder="Create new password" required>
                        <i class="bx bx-lock-alt"></i>
                    </div>
                    <div class="input-box">
                        <input class="input-field" type="password" name="cpassword" placeholder="Confirm your password" required>
                        <i class="bx bx-lock-alt"></i>
                    </div>
                    <div class="input-box">
                        <input class="submit" type="submit" name="change-password" value="Change">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>