<?php
include 'models/clients.php';
include 'controllers/indexController.php';
include '../header.php';
?>

<h1>Correction de l'exercice</h1>
<div class="consigne">
    <p><span>Consigne : </span></p>
    <p>Afficher tous les clients.</p>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date de naissance</th>
            <th>Age</th>
            <th>Carte</th>
            <th>Numéro de carte</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clientsList AS $customers) { ?>
            <tr>
                <td><?= $customers->id; ?></td>
                <td><?= $customers->lastName; ?></td>
                <td><?= $customers->firstName; ?></td>
                <td><?= $customers->birthDate; ?></td>
                <td><?= $customers->age; ?></td>
                <td><?= $customers->card; ?></td>
                <td><?= $customers->cardNumber; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

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
            <th>Age</th>
            <th>Carte</th>
            <th>Numéro de carte</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clientTwentyList AS $customers) { ?>
            <tr>
                <td><?= $customers->id; ?></td>
                <td><?= $customers->lastName; ?></td>
                <td><?= $customers->firstName; ?></td>
                <td><?= $customers->birthDate; ?></td>
                <td><?= $customers->age; ?></td>
                <td><?= $customers->card; ?></td>
                <td><?= $customers->cardNumber; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="script.js"></script>
</body>
</html>
