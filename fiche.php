<?php
    class Fiche{
    private $Etudian1;
    private $GrapeEtudia1;
    private $email1;
    private $Etudian2;
    private $GrapeEtudia2;
    private $email2;
    private $titre;
    private $Encadreur;
    private $Entrepise;
    private $Encadreur_entrepise;
    private $Fiche_PFE;
    private $CIN;
    private $CIN2;
    public function __construct($Etudian1,$GrapeEtudia1,$email1,$Etudian2,$GrapeEtudia2,$email2,$titre,$Encadreur,$Entrepise,$Encadreur_entrepise,$Fiche_PFE,$CIN,$CIN2){
        $this->Etudian1=$Etudian1;
        $this->GrapeEtudia1=$GrapeEtudia1;
        $this->email1=$email1;
        $this->Etudian2=$Etudian2;
        $this->GrapeEtudia2=$GrapeEtudia2;
        $this->email2=$email2;
        $this->titre=$titre;
        $this->Encadreur=$Encadreur;
        $this->Entrepise=$Entrepise;
        $this->Encadreur_entrepise=$Encadreur_entrepise;
        $this->Fiche_PFE=$Fiche_PFE;
        $this->CIN=$CIN;
        $this->CIN2=$CIN2;
    }

    /**
     * Get the value of Etudian1
     */
    public function getEtudian1() {
        return $this->Etudian1;
    }

    /**
     * Set the value of Etudian1
     */
    public function setEtudian1($Etudian1): self {
        $this->Etudian1 = $Etudian1;
        return $this;
    }

    /**
     * Get the value of GrapeEtudia1
     */
    public function getGrapeEtudia1() {
        return $this->GrapeEtudia1;
    }

    /**
     * Set the value of GrapeEtudia1
     */
    public function setGrapeEtudia1($GrapeEtudia1): self {
        $this->GrapeEtudia1 = $GrapeEtudia1;
        return $this;
    }

    

    /**
     * Get the value of Etudian2
     */
    public function getEtudian2() {
        return $this->Etudian2;
    }

    /**
     * Set the value of Etudian2
     */
    public function setEtudian2($Etudian2): self {
        $this->Etudian2 = $Etudian2;
        return $this;
    }

    /**
     * Get the value of GrapeEtudia2
     */
    public function getGrapeEtudia2() {
        return $this->GrapeEtudia2;
    }

    /**
     * Set the value of GrapeEtudia2
     */
    public function setGrapeEtudia2($GrapeEtudia2): self {
        $this->GrapeEtudia2 = $GrapeEtudia2;
        return $this;
    }

    /**
     * Get the value of email2
     */
    public function getEmail2() {
        return $this->email2;
    }

    /**
     * Set the value of email2
     */
    public function setEmail2($email2): self {
        $this->email2 = $email2;
        return $this;
    }

    /**
     * Get the value of titre
     */
    public function getTitre() {
        return $this->titre;
    }

    /**
     * Set the value of titre
     */
    public function setTitre($titre): self {
        $this->titre = $titre;
        return $this;
    }

    /**
     * Get the value of Encadreur
     */
    public function getEncadreur() {
        return $this->Encadreur;
    }

    /**
     * Set the value of Encadreur
     */
    public function setEncadreur($Encadreur): self {
        $this->Encadreur = $Encadreur;
        return $this;
    }

    /**
     * Get the value of Entrepise
     */
    public function getEntrepise() {
        return $this->Entrepise;
    }

    /**
     * Set the value of Entrepise
     */
    public function setEntrepise($Entrepise): self {
        $this->Entrepise = $Entrepise;
        return $this;
    }

    /**
     * Get the value of Encadreur_entrepise
     */
    public function getEncadreurEntrepise() {
        return $this->Encadreur_entrepise;
    }

    /**
     * Set the value of Encadreur_entrepise
     */
    public function setEncadreurEntrepise($Encadreur_entrepise): self {
        $this->Encadreur_entrepise = $Encadreur_entrepise;
        return $this;
    }

    /**
     * Get the value of Fiche_PFE
     */
    public function getFichePFE() {
        return $this->Fiche_PFE;
    }

    /**
     * Set the value of Fiche_PFE
     */
    public function setFichePFE($Fiche_PFE): self {
        $this->Fiche_PFE = $Fiche_PFE;
        return $this;
    }

    

    /**
     * Get the value of CIN
     */
    public function getCIN() {
        return $this->CIN;
    }

    /**
     * Set the value of CIN
     */
    public function setCIN($CIN): self {
        $this->CIN = $CIN;
        return $this;
    }

    /**
     * Get the value of email1
     */
    public function getEmail1() {
        return $this->email1;
    }

    /**
     * Set the value of email1
     */
    public function setEmail1($email1): self {
        $this->email1 = $email1;
        return $this;
    }

    /**
     * Get the value of CIN2
     */
    public function getCIN2() {
        return $this->CIN2;
    }

    /**
     * Set the value of CIN2
     */
    public function setCIN2($CIN2): self {
        $this->CIN2 = $CIN2;
        return $this;
    }

    /**
     * Get the value of etat
     */
    
}
?>