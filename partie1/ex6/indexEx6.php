<?php
include 'queryEx6.php';
include '../../header.php';
?>
<h1>Exercice 6</h1>
<div class="consigne">
    <p><span>Consigne : </span></p>
    <p>Afficher le titre de tous les spectacles ainsi que l'artiste, la date et l'heure.</p>
    <p>Trier les titres par ordre alphabétique.</p>
    <p>Afficher les résultat comme ceci : "Spectacle par artiste, le date à heure".</p>
</div>

<?php foreach ($customersList AS $customers) { ?>
    <div class="col-lg-12">
        <p><?= $customers['title'] . ' par ' . $customers['performer'] . ', le ' . $customers['date'] . ' à ' . $customers['startTime'] . '.' ?></p>
    </div>
    <?php
}
?>

<?php
include '../../footer.php';
?>