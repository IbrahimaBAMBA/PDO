<?php
include 'queryEx7.php';
include '../../header.php';
?>
<h1>Exercice 7</h1>
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
        <p><span>Carte de fidelité : </span>
            <?php
            // Si les données de la colonne card sont = à 1 
            if ($customers['card'] == 1) {
                //on affiche oui
                echo 'Oui';
                //sinon
            } else {
                //on affiche non
                echo 'Non';
            }
            ?>
        </p>
        <p><span>Numéro de carte : </span>
            <?php
            //  Si les données de la colonne card sont = à 1
            if ($customers['card'] == 1) {
                //on affiche le numéro de la carte
                echo $customers['cardNumber'];
                //sinon 
            } else {
                //on affiche ce message
                echo 'Pas de carte de fidélité';
            }
            ?>
        </p>
    </div>
    <?php
}
?>

<?php
include '../../footer.php';
?>