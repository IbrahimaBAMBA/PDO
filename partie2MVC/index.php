<?php
include 'header.php';
?>

<h1>Bienvenue sur l'Hopital E2N</h1>
<div class="row">
    <div class="offset-lg-2 col-lg-3">
        <a href="ajout-patient.php" class="indexLink btn btn-outline-info btn-lg">
            <div class="col-lg-12 text-center">
                <i class="fa fa-user-plus fa-4x" aria-hidden="true"></i>
                <p>Inscrire un patient</p>
            </div>
        </a>
    </div>
<div class="offset-lg-2 col-lg-3">
    <a href="ajout-rendezvous.php" class="indexLink btn btn-outline-info btn-lg">
        <div class="col-lg-12 text-center">
            <i class="fa fa-calendar-o fa-4x" aria-hidden="true"></i>
            <p>Ajouter un nouveau RDV</p>
        </div>
    </a>
</div>
</div>
<?php
include 'footer.php';
?>