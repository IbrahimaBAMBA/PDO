<?php

class dataBase {
    //L'attribut $pdo sera disponible dans ses enfants
    protected $pdo;
    public function __construct() {
        try {
            // On se connecte à MySQL
            $this->pdo = new PDO('mysql:host=localhost;dbname=HospitalE2N;charset=utf8', 'chloeHospital', 'mdpPDO');
        } catch (Exception $ex) {
            // En cas d'erreur, on affiche un message et on arrête tout
            die('Erreur : ' . $ex->getMessage());
        }
    }

    public function __destruct() {
        $this->pdo = NULL;
}
}
