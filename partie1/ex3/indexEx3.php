<?php
include '../../header.php';
include 'queryEx3.php';
?>
<h1>Exercice 3</h1>
<div class="consigne">
    <p><span>Consigne : </span></p>
    <p>Afficher les 20 premiers clients.</p>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date de naissance</th>
            <th>Carte</th>
            <th>Numéro de carte</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($customersList AS $customers) { ?>
            <tr>
                <td><?= $customers['id']; ?></td>
                <td><?= $customers['lastName']; ?></td>
                <td><?= $customers['firstName']; ?></td>
                <td><?= $customers['birthDate']; ?></td>
                <td><?= $customers['card']; ?></td>
                <td><?= $customers['cardNumber']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php
include '../../footer.php';
?>