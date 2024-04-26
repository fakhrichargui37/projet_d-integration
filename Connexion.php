<?php
class Connexion{
    public function getConnexion(){
        $dsn = "mysql:host=localhost;dbname=pro";
        $username = "root";
        $password = "";
        $connexion = new PDO($dsn,$username,$password);
        return $connexion;
    }
}
?>