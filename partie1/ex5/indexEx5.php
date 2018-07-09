<?php
include 'queryEx5.php';
include '../../header.php';
?>
<h1>Exercice 5</h1>
<div class="consigne">
    <p><span>Consigne : </span></p>
    <p>Afficher uniquement le nom et le prénom de tous les clients dont le nom commence par la lettre "M". Les afficher comme ceci :</p>
    <p><span>Nom :</span> Nom du client</p>
    <p><span>Prénom :</span> Prénom du client</p>
    <p>Trier les noms par ordre alphabétique.</p>
</div>
<div class="row ">

    <?php foreach ($customersList AS $customers) { ?>
        <div class="col-lg-12 separate">
            <p><span>Nom : </span><?= $customers['lastName']; ?></p>
            <p><span>Prénom : </span><?= $customers['firstName']; ?></p>
        </div>
        <?php
    }
    ?>
</div>
<?php
include '../../footer.php';
?>