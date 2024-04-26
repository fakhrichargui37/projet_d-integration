<?php
require_once "Connexion.php";
require_once "fiche.php";
class Gestionutilasteur2{
    protected $pdo;
    protected $table="fiche";
    public function __construct(){
        $obj=new Connexion();
        $this->pdo = $obj->getConnexion();

    }
    public function insertFiche(Fiche $u) {
        $sql = "INSERT INTO {$this->table} VALUES (
                    '{$u->getEtudian1()}',
                    '{$u->getGrapeEtudia1()}',
                    '{$u->getEmail1()}',
                    '{$u->getEtudian2()}',
                    '{$u->getGrapeEtudia2()}',
                    '{$u->getEmail2()}',
                    '{$u->getTitre()}',
                    '{$u->getEncadreur()}',
                    '{$u->getEntrepise()}',
                    '{$u->getEncadreurEntrepise()}',
                    '{$u->getFichePFE()}',
                    '{$u->getCIN()}',
                    '{$u->getCIN2()}',
                    null
                )";
        $res = $this->pdo->exec($sql);
        return $res;
    }
    
    
    public function obtenirEtudian($CIN) {
        $sql = "select cin,cin2 from {$this->table} where cin=$CIN or CIN2=$CIN";
        $res = $this->pdo->query($sql);
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtenirEtudian_CIN($CINetud) {
        $sql = "SELECT * FROM {$this->table} WHERE cin = :CINetud";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(':CINetud' => $CINetud));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    public function obtenirEtudianemail($email2){
        $sql = "SELECT CIN FROM usertable WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':email' => $email2]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['CIN'] : '';
    }
    public function SupprimerUser($CIN){
        $sql="DELETE from {$this->table} WHERE cin=$CIN or cin2=$CIN";
        $res=$this->pdo->exec($sql);
        return $res;
    }
    public function AffEtudian(){
        $sql="SELECT titre,Etudian1,GrapeEtudia1,Etudian2,GrapeEtudia2,etat,CIN FROM {$this->table}";
        $res=$this->pdo->query($sql);
        return $res->fetchAll(PDO::FETCH_NUM);
    }
    public function updateFiche(Fiche $u) {
        $sql = "UPDATE {$this->table} SET
            Etudian2 = '{$u->getEtudian2()}',
            GrapeEtudia2 = '{$u->getGrapeEtudia2()}',
            Email2 = '{$u->getEmail2()}',
            Titre = '{$u->getTitre()}',
            Encadreur = '{$u->getEncadreur()}',
            Entrepise = '{$u->getEntrepise()}',
            Encadreur_entrepise = '{$u->getEncadreurEntrepise()}',
            Fiche_PFE = '{$u->getFichePFE()}',
            etat=null 
                WHERE CIN = '{$u->getCIN()}' OR CIN2 = '{$u->getCIN()}'";
        $res = $this->pdo->exec($sql);
        return $res;
    }
    public function updateEtat($cin_etet){
        $sql="UPDATE fiche SET etat='valide'
        WHERE cin=$cin_etet";
         $res = $this->pdo->exec($sql);
         return $res;
    }
    public function updateEtat2($cin_etet){
        $sql="UPDATE fiche SET etat='refuser'
        WHERE cin=$cin_etet";
         $res = $this->pdo->exec($sql);
         return $res;
    }
    public function classEtudian(){
        $sql="SELECT * FROM classe ";
        $res=$this->pdo->query($sql);
        return $res->fetchAll(PDO::FETCH_NUM);
    }
    public function affens(){
        $sql="SELECT CIN,name FROM usertable where usertype	='enseignant'";
        $res=$this->pdo->query($sql);
        return $res->fetchAll(PDO::FETCH_NUM);
    }
}
?>