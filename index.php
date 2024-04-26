<?php require_once "controllerUserData.php"; 
require_once "AfficheEtudian.php";
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
        $etat=$fetch_info['usertype'];
        if( $etat!="Enseignant"){
          header('Location: login-user.php');
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="src/css/style2.css">
  <link rel="stylesheet" href="src/css/style3.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <title>enseignants panel</title>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
<script>
  let email1="";
  let email2="";
  let id="";
  let CIN="";
  function setid(nb){
    id=nb;
    
    $.ajax({
      'url':`trouver_par_CIN.php?CIN=${id}`,
      'type':"get",
      success: function(data) {
        var xdata=data.toString().replace("  "," ").split("|")
        var d=[];
        for(var i=0;i<xdata.length;i++){
          if((i+1)%2==0){
            d.push(xdata[i])
          }
        }
        console.log(d);
        email1=d[2];
        email2=d[5];
        cin=d[11];
        document.getElementById("btn1").onclick=function (){v(email1,email2)}
        document.getElementById("btn3").onclick=function (){r(email1,email2)}

        document.getElementById("ss").innerHTML=`
        <table class="appointments">
          <tr>
            <td >Etudian1:</td>
            <td>${d[0]}</td>
          </tr>
          <tr>
            <td>GrapeEtudia1:</td>
            <td>${d[1]}</td>
          </tr>
          <tr>
            <td>email1:</td>
            <td>${d[2]}</td>
          </tr>
          <tr>
            <td>Etudian2:</td>
            <td>${d[3]}</td>
          </tr>
          <tr>
            <td>GrapeEtudia2:</td>
            <td>${d[4]}</td>
          </tr>
          <tr>
            <td>email2:</td>
            <td>${d[5]}</td>
          </tr>
          <tr>
            <td>titre:</td>
            <td>${d[6]}</td>
          </tr>
          <tr>
            <td>Encadreur:</td>
            <td>${d[7]}</td>
          </tr>
          <tr>
            <td>Entrepise:</td>
            <td>${d[8]}</td>
          </tr>
          <tr>
            <td>Encadreur_entrepise:</td>
            <td>${d[9]}</td>
          </tr>
          <tr>
            <td>Fiche_PFE:</td>
            <td><a href="uploads/${d[10]}" class="btn btn-primary" download>download</td></a>
          </tr>
        </table>`
      },
      error: function(xhr, status, error) {
        console.log(error);
      }
    });
  }
  function v(email1,email2,cin){
    $.ajax({
      'url':`valide.php?CIN=${id}`,
      'type':"post",
      'data':{
          "email1":email1,
          "email2":email2,
          "CIN":id,
          "valide":"bt",
          

      },
      success: function(data) {
        console.log(data)
      },
      error:function (xhr,status,error){
        console.log(error)
      }});
  }
  function r(CIN){
    $.ajax({
      'url':`refuser.php?CIN=${id}`,
      'type':"post",
      'data':{
          "email1":email1,
          "email2":email2,
          "message":document.getElementById("msg").value,
          "CIN":id,
          "Refuser":"bt",
          

      },
      success: function(data) {
        console.log("done",data)
      },
      error:function (xhr,status,error){
        console.log("error",error)
      }});
  }
</script>
</head>

<body>
  <nav class="nav">
    <div class="nav-button">
    <button class="btn white-btn" id="logoutBtn" style="color: white;" onclick="logout()">Logout</button>       
    </div>
</nav>
  <div class="container">
      <div class="heading">
        <h2> <center>Liste des applications PFE </center></h2>
        <hr>
      </div>
      <table class="table" id="example">
        <thead>
          <tr class="table-success" id="example">
            <td >titre</td>
            <td >Etud1</td>
            <td>classe</td>
            <td>Etud2</td>
            <td>classe</td>
            <td>etat</td>
            <td>Actions</td>
          </tr>
        </thead>
        <tbody>
        <?php
        foreach ($lesEtudians as $i) {
            echo "<tr>
            <td>$i[0]</td>
            <td>$i[1]</td>
            <td>$i[2]</td>
            <td>$i[3]</td>
            <td>$i[4]</td>
            <td>$i[5]</td>
            <td>    
            <i style='cursor:pointer' class='far fa-eye' data-toggle='modal' data-target='#exampleModal' onclick='setid($i[6])' ></i>
            </td>
          </tr>"; 
        }
        ?>
        </tbody>
      </table>
    </div>
  </div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Liste</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div id="modalContent">
      <div style="margin-left: -86px;" id="ss"></div>
      </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" id="btn2" class="btn btn-danger " data-dismiss="modal" data-toggle='modal' data-target='#exampleModal2'>refuse</button>
        <button type="button" id="btn1"  class="btn btn-success" data-dismiss="modal">valide</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="exampleModal2" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div id="modalContent">
      <div  id=""><textarea class="form-control" id="msg" rows="4"></textarea>
    </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btn3"  class="btn btn-primary" data-dismiss="modal">envoyer</button>
      </div>
    </div>
  </div>
</div>
<script>
  function logout() {
    // Perform logout actions, such as redirecting to logout-user.php
    window.location.href = 'logout-user.php';
  }
</script>

</body>

</html>

  