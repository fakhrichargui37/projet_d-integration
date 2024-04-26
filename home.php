<?php require_once "controllerUserData.php";
      require_once "class.php"; 
?>
<?php 
$CIN = $_SESSION['CIN'];
$password = $_SESSION['password'];
if($CIN != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE CIN = '$CIN'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: reset-code.php');
            }
        }else{
            header('Location: user-otp.php');
        }
    }
}else{
    header('Location: login-user.php');
}
?>

<!DOCTYPE html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
    <link rel="stylesheet" href="src/css/fontawesome-free-6.5.1-web/css/fontawesome.css">
    <link href="src/css/fontawesome-free-6.5.1-web/css/solid.css" rel="stylesheet">
    <title>Inscription</title>
  </head>
  
  <body class="container bg-light">
    <nav class="navbar">
      <h4>Bienvenue <?php echo $fetch_info['name'] ?></h4>
      <button type="button" class="btn btn-primary btn-block col-lg-2"  id="logoutBtn" onclick="logout()">Logout</button>
    </nav>
    <!-- Start Header form -->
    <div class="container">
    <div class="text-center pt-5">
      <h2>Inscription de PFE</h2>
      <p id="demo"></p>
    </div>
    <?php
if (isset($_GET['etat'])) {
  $etat = $_GET['etat'];
  switch ($etat) {
      case '1':
          echo "<div class='alert alert-success alert-dismissible'>
          <i class='fa-solid fa-check'></i>
            <strong>inséré!</strong> avec succées
          </div>";;
      break;
      case '2':
          echo "<div class='alert alert-primary alert-dismissible'>
          <i class='fa-solid fa-rotate'></i>
          <strong>modifié!</strong> avec succées
          </div>";
      break;
      case '3':
        echo "<div class='alert alert-danger alert-dismissible'>
        <i class='fa-solid fa-xmark'></i>
        <strong>supprimer!</strong> avec succées
        </div>";
       break;
       case '4':
        echo "<div class='alert alert-warning alert-dismissible'>
        <i class='fa-solid fa-triangle-exclamation'></i>
        <strong>Etudian !</strong> inexistent
        </div>";
       break;
  }
}
?>
    <div class="card">
      <div class="card-body">
        <form id="bookingForm" action="Addfiche.php" method="post" class="needs-validation" novalidate autocomplete="off" enctype="multipart/form-data">
          <div class="form-group">
            <label for="inputName">nom et prénom</label>
            <input type="text" class="form-control" id="inputName" name="Etudian1" placeholder="Etudian1" required />
            <small class="form-text text-muted">Veuillez remplir votre nom</small>
          </div>
           <div class="form-group col-md-4">
            <label>GrapeEtudia1</label>
            <div class="d-flex flex-row justify-content-between align-items-center">
              <select class="form-control mr-1" id="GrapeEtudia1" name="GrapeEtudia1" required>
                <option value="" disabled selected>Sélectionner le classe</option>
                <?php
                      foreach ($lesclass as $i) {
                        echo"<option value='$i[0]'>$i[0]</option>";
                      }
                ?>
              </select>
            </div>
          </div>
           <div class="form-group">
            <label for="inputName">Email</label>
            <input type="email" class="form-control" id="inputName" name="email1" placeholder="Email Etudian1" required />
            <small class="form-text text-muted">Veuillez remplir votre eamil</small>
          </div>
          <div class="form-group">
            <input type="hidden" id="inputName" name="CIN" value="<?php echo $CIN ?>" >
          </div>
           <div class="form-group">
            <label for="inputName">nom et prénom</label>
            <input type="text" class="form-control" id="inputName" name="Etudian2" placeholder="Etudian2" />
            <small class="form-text text-muted">Veuillez remplir votre binome</small>
          </div>
            <div class="form-group col-md-4">
                <label>GrapeEtudia2</label>
                <div class="d-flex flex-row justify-content-between align-items-center">
                  <select class="form-control mr-1" id="GrapeEtudia2" name="GrapeEtudia2" >
                    <option value="" disabled selected>Sélectionner le classe</option>
                    <?php
                      foreach ($lesclass as $i) {
                        echo"<option value='$i[0]'>$i[0]</option>";
                      }
                    ?>
                  </select>
                </div>
              </div>
           <div class="form-group">
            <label for="inputName">Email</label>
            <input type="email" class="form-control" id="email2" name="email2" placeholder="Email Etudian2"  />
            <small class="form-text text-muted">Veuillez remplir votre binome eamil</small>
          </div>
          <div class="form-group">
            <label for="textAreaRemark">Titre du Projer</label>
            <textarea class="form-control" name="titre" id="titre" rows="2" placeholder="Veuillez remplir votre Titre Projer  ..." required></textarea>
            <small class="form-text text-muted">Veuillez remplir votre Titre du Projer</small>
          </div>
          <div class="form-group">
            <label for="inputName">nom et pernom de Encadreur</label>
            <input type="text" class="form-control" id="inputName" name="Encadreur" placeholder="Encadreur-ISET" />
            <small class="form-text text-muted">Veuillez remplir votre Encadere-ISET</small>
          </div>
          <div class="form-group">
            <label for="inputName">nom Entrepise</label>
            <input type="text" class="form-control" id="inputName" name="Entrepise" placeholder="Entrepise" required/>
            <small class="form-text text-muted">Veuillez remplir votre Nom Entrepise</small>
          </div>
          <div class="form-group">
            <label for="inputName">nom et pernom de Encadreur-entrepise</label>
            <input type="text" class="form-control" id="inputName" name="Encadreur_entrepise" placeholder="Encadreur-entrepise"/>
            <small class="form-text text-muted">Veuillez remplir votre Nom Encadreur-entrepise</small>
          </div>
          <div class="form-group">
          <label for="file" class="form-label">Select file</label>
				  <input type="file" class="form-control" name="file" id = "file">
            <small class="form-text text-muted">Veuillez remplir Fiche_PFE</small>
          </div>
              <button class="btn btn-primary btn-block col-lg-2" type="submit" name="s">Envoye</button>
        </form> 
      </div>
      <div style="position: relative; right: -870px;top:-63px;">
          <form action="deletefichie.php" method="POST">
              <input type="hidden" name="CIN" value="<?php echo $CIN ?>">
              <button class="btn btn-danger btn-block col-lg-2" type="submit" name="s2">Supprimer</button>
          </form>
        </div>
      </div>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="index.js"></script>
    <script>
        var textarea = document.getElementById('titre');
        textarea.addEventListener('input', function () {
            var value = this.value;
            var newValue = value.charAt(0).toUpperCase() + value.slice(1);
            this.value = newValue;
        });
    </script>
<script>
  function logout() {
    // Perform logout actions, such as redirecting to logout-user.php
    window.location.href = 'logout-user.php';
  }
</script>
  </body>
  </html>
  