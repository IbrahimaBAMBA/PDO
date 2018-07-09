<?php

class clients {

    public $id = 0;
    public $lastName = '';
    public $firstName = '';
    public $birthDate = '01/01/2001';
    public $card = false;
    public $cardNumber = 0;
    private $pdo;

    public function __construct() {
        try {
            // On instancie un objet PDO. Le host est l'adresse locale sur laquelle on se connecte. dbname correspond au nom de la base de données.
            $this->pdo = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'chloecolyseum', 'mdpPDO');
        } catch (Exception $ex) { // On attrape l'exception, qui est une erreur de PHP
            // Die arrête le script PHP en cas d'erreur et affiche ce qu'on lui met en paramètre
            die('Erreur : ' . $ex->getMessage());
        }
    }
    /**
     * Cette méthode permet de récupérer la liste des clients
     * @return array
     */
    public function getClientList(){
        $query = 'SELECT `id`, `lastName`, `firstName`, DATE_FORMAT(`birthDate`,"%d/%m/%Y") AS `birthDate`, FLOOR( DATEDIFF( NOW(), `birthDate`) / 365) AS `age`, `card`, `cardNumber` FROM `clients`;';
        $clientResult = $this->pdo->query($query);
        //On vérifie que $clientResult est un objet avec is_object 
        //renvoie true si c'est un objet 
        if(is_object($clientResult)){
            return $clientResult->fetchAll(PDO::FETCH_OBJ);
            //sinon on renvoi un tableau vide
        }else{
            return array();
        }
    }
    /**
     * Cette méthode permet de récupérer la liste des 20 premiers clients
     * @return array
     */
    public function getTwentyFirstClient(){
        $clientList = array();
        $query = 'SELECT `id`, `lastName`, `firstName`, DATE_FORMAT(`birthDate`,"%d/%m/%Y") AS `birthDate`, FLOOR( DATEDIFF( NOW(), `birthDate`) / 365) AS `age`, `card`, `cardNumber` FROM `clients` LIMIT 20;';
        $clientResult = $this->pdo->query($query);
        //On vérifie que $clientResult est un objet avec is_object 
        //renvoie true si c'est un objet 
        if(is_object($clientResult)){
            $clientList = $clientResult->fetchAll(PDO::FETCH_OBJ);
        }
            return $clientList;
    }

    public function __destruct() {
        
    }

}
