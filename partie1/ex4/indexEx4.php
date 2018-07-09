<?php
include '../../header.php';
include 'queryEx4.php';
?>
<h1>Exercice 4</h1>
<div class="consigne">
    <p><span>Consigne : </span></p>
    <p>N'afficher que les clients possédant une carte de fidélité.</p>
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