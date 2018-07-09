<?php

class appointments extends dataBase {

    public $id = 0;
    public $dateHour = '01/01/1900 00:00';
    public $idPatients = 0;
    public $idDelete = 0;

    public function __construct() {
        //on appelle le construct du parent (soit la class dataBase)
        parent::__construct();
    }

    //méthode qui permet d'inserer les valeurs du formulaire dans la table
    public function addAppointment() {
        $query = 'INSERT INTO `appointments` (`dateHour`, `idPatients`) VALUES (:dateHour, :idPatients);';
        //On prépare la requête sql qui insert les champs sélectionnés, les valeurs de type :lastname sont des marqueurs nominatifs
        $insertNewAppointment = $this->pdo->prepare($query);
        $insertNewAppointment->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $insertNewAppointment->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        //Si l'insertion s'est correctement déroulée, on retourne true car execute() est un booléen
        return $insertNewAppointment->execute();
    }

    /**
     * getAppointmentsList permet d'afficher la liste des RDV
     * @return type
     */
    public function getAppointmentsList() {
        $appointmentsList = array();
        //On prépare la requête sql qui insert les champs sélectionnés, les valeurs de type :lastname sont des marqueurs nominatifs
        $query = 'SELECT `appointments`.`id`, DATE_FORMAT(`dateHour`, "%d/%m/%Y") AS `date`, DATE_FORMAT(`dateHour`, "%H:%i") AS `hour`, `patients`.`lastname`, `patients`.`firstname` FROM `appointments` LEFT JOIN `patients` ON `appointments`.`idPatients` = `patients`.`id` ORDER BY `patients`.`lastname`;';
        $appointmentsListResult = $this->pdo->query($query);

        if (is_object($appointmentsListResult)) {
            $appointmentsList = $appointmentsListResult->fetchAll(PDO::FETCH_OBJ);
        }
        return $appointmentsList;
    }

    public function getAppointmentById() {
        $query = 'SELECT DATE_FORMAT(`dateHour`, "%Y-%m-%d") AS `date`, DATE_FORMAT(`dateHour`, "%H:%i") AS `hour`, `idPatients` FROM `appointments` WHERE `id` = :id';
        $appointmentResult = $this->pdo->prepare($query);
        $appointmentResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        $appointmentResult->execute();
        return $appointmentResult->fetch(PDO::FETCH_OBJ);
    }

    /**
     * getRDVInfo() permet de récupérer les infos des RDV
     * @return type
     */
    public function getRDVInfo() {
        $query = 'SELECT `appointments`.`id`, DATE_FORMAT(`dateHour`, "%Y-%m-%d") AS `date`, DATE_FORMAT(`dateHour`, "%H:%i") AS `hour`, `appointments`.`idPatients`, `patients`.`lastname`, `patients`.`firstname` FROM `appointments` LEFT JOIN `patients` ON `appointments`.`idPatients` = `patients`.`id` WHERE `appointments`.`id` = :id;';
        $RDVInfoSelect = $this->pdo->prepare($query);
        $RDVInfoSelect->bindValue(':id', $this->id, PDO::PARAM_INT);
        $RDVInfoSelect->execute();
        if (is_object($RDVInfoSelect)) {
            $RDVInfo = $RDVInfoSelect->fetch(PDO::FETCH_OBJ);
        }
        return $RDVInfo;
    }

    /**
     * modifyRDV() permet de modifier les données d'un RDV
     * @return bool
     */
    public function modifyRDV() {
        $query = 'UPDATE `appointments` SET `dateHour` = :dateHour, `idPatients` = :idPatients WHERE `id` = :id;';
        $modifyRDVInfo = $this->pdo->prepare($query);
        $modifyRDVInfo->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $modifyRDVInfo->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        $modifyRDVInfo->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $modifyRDVInfo->execute();
    }
    /**
     * Afficher tous les RDV du patients
     * @return type
     */
    public function listAppointmentsByIdPatient() {
        $listAppointments = array();
        $query = 'SELECT `id`, DATE_FORMAT(`dateHour`, "%d/%m/%Y") AS `date`,DATE_FORMAT(`dateHour`, "%H:%i") AS `hour` FROM `appointments` WHERE `idPatients` = :idPatients;';
        $listAppointmentsById = $this->pdo->prepare($query);
        $listAppointmentsById->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        $listAppointmentsById->execute();
        if (is_object($listAppointmentsById)) {
            $listAppointments = $listAppointmentsById->fetchAll(PDO::FETCH_OBJ);
        }
        return $listAppointments;
    }

    /**
     * removeRDV() permet de supprimer un RDV
     * @return bool
     */
    public function removeRDV() {
        $query = 'DELETE FROM `appointments` WHERE `id` = :id';
        $removeRdvSelect = $this->pdo->prepare($query);
        $removeRdvSelect->bindValue(':id', $this->idDelete, PDO::PARAM_INT);
        return $removeRdvSelect->execute();
    }

    public function checkFreeAppointment() {
        $query = 'SELECT COUNT(*) AS `takenAppointment` FROM `appointments` WHERE `dateHour` = :dateHour AND `idPatients` = :idPatients';
        $freeAppointment = $this->pdo->prepare($query);
        $freeAppointment->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $freeAppointment->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        if ($freeAppointment->execute()) {
            $freeAppointmentCheck = $freeAppointment->fetch(PDO::FETCH_OBJ);
        } else {
            $freeAppointmentCheck = false;
        }
        return $freeAppointmentCheck;
    }

    public function __destruct() {
        parent::__destruct();
    }

}
