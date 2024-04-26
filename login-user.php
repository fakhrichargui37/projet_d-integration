<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="src/css/style1.css">
    <link rel="stylesheet" href="src/css/fontawesome-free-6.5.1-web/css/fontawesome.css">
    <link href="src/css/fontawesome-free-6.5.1-web/css/brands.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="src/css/fontawesome-free-6.5.1-web/css/solid.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <title>Login & Registration</title>
</head>
<body>
 <div class="wrapper">
    <nav class="nav">
        <div class="nav-logo">
            <p></p>
        </div>
        <div class="nav-menu" id="navMenu">
            <ul>
                <li><a href="#" class="link active"></a></li>
                <li><a href="#" class="link"></a></li>
                <li><a href="#" class="link"></a></li>
                <li><a href="#" class="link"></a></li>
            </ul>
        </div>
        <div class="nav-button">
            <button class="btn white-btn" id="loginBtn" onclick="login()">Se connecter</button>
            <button class="btn" id="registerBtn" onclick="register()">S'inscrire</button>
        </div>
        <div class="nav-menu-btn">
            <i class="bx bx-menu" onclick="myMenuFunction()"></i>
        </div>
    </nav>

<!----------------------------- Form box ----------------------------------->
    <div class="form-box">
        
        <!------------------- login form -------------------------->
        <div class="login-container" id="login">
            <div class="top">
                <header>Gestion-PFE<p id="demo"></p></header>
            </div>
            <?php if(count($errors) > 0): ?>
        <div class="alert alert-danger text-center">
            <?php foreach($errors as $showerror): ?>
                <?php echo $showerror; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
            <div class="input-box">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="">
                    <input type="number" class="input-field" name="CIN" placeholder="CIN" required value="<?php echo $CIN ?>">
                    <i class="fas fa-id-card"></i>
            </div>
            <div class="input-box">
                    <input type="password" class="input-field" id="password1" name="password" placeholder="Password" required>
                    <i class="bx bx-lock-alt"></i>
                    <i class="bi bi-eye-slash" id="togglePassword"></i>
            </div>
            <div class="input-box">
                    <input type="submit" class="submit" value="Se connecter" name="login">
                </form>
            </div>
            <div class="two-col">
                <div class="two">
                    <label><a type="button" id="forgotBtn" onclick="forgot()">Mot de passe oublié?</a></label>
                </div>
            </div>
        </div>

        <!------------------- registration form -------------------------->
        <div class="register-container" id="register">
            <div class="top">
                <header>S'inscrire</header>
            </div>
            <?php if(isset($errors) && !empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach($errors as $showerror): ?>
                <li><?php echo $showerror; ?></li>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
            <div class="two-forms">
                <div class="input-box">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="">
                        <input type="text" class="input-field" name="name" placeholder="nom et pernom">
                        <i class="bx bx-user"></i>
                </div>
                <div class="input-box">
                        <input type="text" class="input-field" name="CIN" placeholder="CIN">
                        <i class="fas fa-id-card"></i>
                </div>
            </div>
            <div class="input-box">
                    <input type="text" class="input-field" name="email" placeholder="Email">
                    <i class="bx bx-envelope"></i>
            </div>
            <div class="input-box">
                    <input type="password" class="input-field" id="password2" name="password" placeholder="mot de passe">
                    <i class="bx bx-lock-alt"></i>
            </div>
            <div class="input-box">
                    <input type="password" class="input-field" name="cpassword" placeholder="verify mot de passe">
                    <i class="fab fa-cloudversify"></i>
                </div>
            <div class="input-box">
                    <input type="submit" class="submit" value="Registre" name="signup">
                </form>
            </div>
        </div>
         <!------------------- Forgot password -------------------------->
    <div class="forgot-container" id="forgot">
        <header>Forgot Password</header>
        <?php if(isset($errors) && count($errors) > 0): ?>
        <div class="alert alert-danger text-center">
            <?php foreach($errors as $i): ?>
                <?php echo $i; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="">
         <div class="input-box">
            <input  class="input-field" type="email" name="email" placeholder="Enter email address" required value="<?php echo $email ?>">
            <i class="bx bx-user"></i>
        </div>
        <div class="input-box">
            <input type="submit" class="submit" name="check-email" value="Continue">
        </div>
    </div>
    </div>
</div>


<script>
   
   function myMenuFunction() {
    var i = document.getElementById("navMenu");

    if(i.className === "nav-menu") {
        i.className += " responsive";
    } else {
        i.className = "nav-menu";
    }
   }
 
</script>

<script>

    var a = document.getElementById("loginBtn");
    var b = document.getElementById("registerBtn");
    var x = document.getElementById("login");
    var y = document.getElementById("register");
    var w = document.getElementById("forgot");
    var z = document.getElementById("forgotBtn")
    

    function login() {
        x.style.left = "5px";
        y.style.left = "+520px";
        w.style.left = "+520px";
        a.className += " white-btn";
        b.className = "btn";
        x.style.opacity = 1;
        y.style.opacity = 0;
    }

    function register() {
        x.style.left = "510px";
        w.style.left = "520px";
        y.style.left = "5px";
        a.className = "btn";
        b.className += " white-btn";
        x.style.opacity = 0;
        y.style.opacity = 1;
    }
    function forgot() {
        x.style.left = "510px";
        w.style.left = "5px";
        y.style.left = "510px";
        a.className = "btn";
        b.className = "btn";
        x.style.opacity = 0;
        y.style.opacity = 0;
    }
    
</script>
<script>
    const d = new Date();
    let year = d.getFullYear();
    let lastYear = year - 1;
    document.getElementById("demo").innerHTML = "Année : " + lastYear + "/" + year;  
</script>
<script>
    const togglePassword = document.querySelector("#togglePassword");
    const password1 = document.querySelector("#password1"); // Change id to password1

    togglePassword.addEventListener("click", function () {
    // toggle the type attribute
    const type = password1.getAttribute("type") === "password" ? "text" : "password"; // Change id to password1
    password1.setAttribute("type", type);
    
    // toggle the icon
    this.classList.toggle("bi-eye");
});
</script>
</body>
</html>
