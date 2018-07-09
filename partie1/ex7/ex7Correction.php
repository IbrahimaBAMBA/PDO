<?php
include 'queryEx7.php';
include '../../header.php';
?>
<h1>Exercice 7 Correction</h1>
<div class="consigne">
    <p><span>Consigne : </span></p>
    <p>Afficher tous les clients comme ceci :</p>
    <p><span>Nom : </span>Nom de famille du client</p> 
    <p><span>Prénom : </span>Prénom du client</p> 
    <p><span>Date de naissance : </span>Date de naissance du client</p>
    <p><span>Carte de fidélité : </span>Oui (Si le client en possède une) ou Non (s'il n'en possède pas)</p>
    <p><span>Numéro de carte : </span>Numéro de la carte fidélité du client s'il en possède une.</p>
</div>
<?php foreach ($customersList AS $customers) { ?>
    <div class="col-lg-12 separate">
        <p><span>Nom du client : </span><?= $customers['lastName'] ?></p>
        <p><span>Prénom du client : </span><?= $customers['firstName'] ?></p>
        <p><span>Date de naissance : </span><?= $customers['birthDate'] ?></p>
        <p><span>Carte de fidelité : </span><?= $customers['card'] ?></p>
            <?php
            if($customers['cardNumber'] != NULL){
            ?>
        <p><span>Numéro de carte : </span><?= $customers['cardNumber'] ?></p>
            <?php } ?>
    </div>
    <?php
}
?>

<?php
include '../../footer.php';
?>