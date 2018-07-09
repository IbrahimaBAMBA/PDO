<?php

class patients extends dataBase {

    public $id = 0;
    public $lastname = '';
    public $firstname = '';
    public $birthdate = '01/01/1900';
    public $phone = '0000000000';
    public $mail = '';

    public function __construct() {
        //on appelle le construct du parent (soit la class dataBase)
        parent::__construct();
    }

    //méthode qui permet d'inserer les valeurs du formulaire dans la table
    public function addPatient() {
        //On prépare la requête sql qui insert les champs sélectionnés, les valeurs de type :lastname sont des marqueurs nominatifs
        $query = 'INSERT INTO `patients` (`lastname`, `firstname`, `birthdate`, `phone`, `mail`) VALUES (:lastname, :firstname, :birthdate, :phone, :mail);';
        $responseRequeste = $this->pdo->prepare($query);
        $responseRequeste->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $responseRequeste->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $responseRequeste->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $responseRequeste->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $responseRequeste->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        //Si l'insertion s'est correctement déroulée, on retourne true car execute() est un booléen
        return $responseRequeste->execute();
    }

    public function getPatientList() {
        $patientsList = array();
        //On prépare la requête sql qui insert les champs sélectionnés, les valeurs de type :lastname sont des marqueurs nominatifs
        $query = 'SELECT `id`, `lastname`, `firstname`, DATE_FORMAT(`birthdate`,"%d/%m/%Y") AS `birthdate`, `phone`, `mail` FROM patients ORDER BY `lastname`;';
        $patientResult = $this->pdo->query($query);
        //Si l'insertion s'est correctement déroulée, on retourne true car execute() est un booléen
        if (is_object($patientResult)) {
            $patientsList = $patientResult->fetchAll(PDO::FETCH_OBJ);
        }
        return $patientsList;
    }

    public function getPatientInfo() {
        $query = 'SELECT `id`, `lastname`, `firstname`, `birthdate`, `phone`, `mail` FROM `patients` WHERE `id` = :id;';
        $patientInfoSelect = $this->pdo->prepare($query);
        $patientInfoSelect->bindValue(':id', $this->id, PDO::PARAM_INT);
        $patientInfoSelect->execute();
        if (is_object($patientInfoSelect)) {
            $patientInfo = $patientInfoSelect->fetch(PDO::FETCH_OBJ);
        }
        return $patientInfo;
    }

    public function modifyPatient() {
        //On prépare la requête sql qui insert les champs sélectionnés, les valeurs de type :lastname sont des marqueurs nominatifs
        $query = 'UPDATE `patients` SET `lastname` = :lastname, `firstname` = :firstname, `birthdate` = :birthdate, `phone` = :phone, `mail` = :mail WHERE `id` = :id';
        $modifyPatientInfo = $this->pdo->prepare($query);
        $modifyPatientInfo->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $modifyPatientInfo->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $modifyPatientInfo->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $modifyPatientInfo->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $modifyPatientInfo->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $modifyPatientInfo->bindValue(':id', $this->id, PDO::PARAM_INT);
        //Si l'insertion s'est correctement déroulée, on retourne true car execute() est un booléen
        return $modifyPatientInfo->execute();
    }

    public function patientRemove() {
        //Permet d'attraper une erreur avec le catch.
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            //On démarre la transaction, toujours mettre la table enfant avant la table parente pour éviter les soucis de suppression.
            $this->pdo->beginTransaction();
            $queryAppointment = 'DELETE FROM `appointments` WHERE `idPatients` = :idPatients';
            $deleteAppointmentResult = $this->pdo->prepare($queryAppointment);
            $deleteAppointmentResult->bindValue(':idPatients', $this->id, PDO::PARAM_INT);
            $deleteAppointmentResult->execute();
            $queryPatient = 'DELETE FROM `patients` WHERE `id` = :id';
            $deletePatientResult = $this->pdo->prepare($queryPatient);
            $deletePatientResult->bindValue(':id', $this->id, PDO::PARAM_INT);
            $deletePatientResult->execute();
            //On valide la transaction.
            $this->pdo->commit();
        } catch (Exception $ex) {
            //Si une erreur survient, on annule les changements.
            $this->pdo->rollBack();
            echo 'Erreur : ' . $ex->getMessage();
        }
    }

//    public function patientRemove(){
//        $query = 'DELETE FROM `patients` WHERE `id` = :id';
//        $removePatientSelect = $this->pdo->prepare($query);
//        $removePatientSelect->bindValue(':id', $this->id, PDO::PARAM_INT);
//        return $removePatientSelect->execute();
//    }
    public function searchPatient($search) {
        $searchPatientResult = array();
        $query = 'SELECT `id`, `lastname`, `firstname`, `birthdate`, `phone`, `mail` FROM `patients` WHERE `lastname` LIKE :search OR `firstname` LIKE :search';
        $searchPatient = $this->pdo->prepare($query);
        $searchPatient->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        if ($searchPatient->execute()) {
            $searchPatientResult = $searchPatient->fetchAll(PDO::FETCH_OBJ);
        }
        return $searchPatientResult;
    }

    /**
     * Pagination
     * @return type
     */
    public function getPatientListPagination($offset) {
        //On prépare la requête sql qui insert les champs sélectionnés, les valeurs de type :lastname sont des marqueurs nominatifs
        $query = 'SELECT `id`, `lastname`, `firstname`, DATE_FORMAT(`birthdate`,"%d/%m/%Y") AS `birthdate`, `phone`, `mail` FROM patients ORDER BY `lastname` LIMIT 5 OFFSET :offset';
        $patientResult = $this->pdo->prepare($query);
        $patientResult->bindValue(':offset', $offset, PDO::PARAM_INT);
        //Si l'insertion s'est correctement déroulée, on retourne true car execute() est un booléen
        if ($patientResult->execute()) {
            $patientsList = $patientResult->fetchAll(PDO::FETCH_OBJ);
        } else {
            $patientsList = false;
        }
        return $patientsList;
    }

    /**
     * Récupérer le nombre de patient
     */
    public function countPatient() {
        $query = 'SELECT COUNT(`id`) AS `numberOfPatient` FROM `patients`;';
        $patientCount = $this->pdo->query($query);
        $patientCountResult = $patientCount->fetch(PDO::FETCH_OBJ);
        return $patientCountResult;
    }

    /**
     * Méthode destruct
     */
    public function __destruct() {
        parent::__destruct();
    }

}
