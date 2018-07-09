<?php
//On instancie l'objet clients
$clients = new clients();
//On appelle la methode getCLientList
$clientsList = $clients->getClientList();
$clientTwentyList = $clients->getTwentyFirstClient();
?>