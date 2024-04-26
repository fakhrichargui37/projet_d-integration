<?php require_once "controllerUserData.php"; ?>
<?php 
$CIN = $_SESSION['CIN'];
if($CIN == false){
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
    <title>Code Verification</title>
</head>
<body>
    <div class="wrapper">
        <div class="form-box" >
            <div class="login-container" id="login">
                <form action="user-otp.php" method="POST" autocomplete="off">
                    <div class="top">
                        <header>Enter your validation <Code></Code></header>
                     </div>
                    <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="input-box">
                        <input class="input-field" type="number" name="otp" placeholder="Enter verification code" required>
                        <i class="bx bx-user"></i>
                    </div>
                    <div class="input-box">
                        <input class="submit" type="submit" name="check" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>