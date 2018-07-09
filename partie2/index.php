
<?php
include 'header.php';
?>
<!--CONSIGNES
Depuis l'index doivent etre accessibles les pages ajout-patient et ajout-rendezvous-->
<div class="row">
    <h1>Bienvenue sur l'Hopital E2N</h1>
    <div class="row">
        <div class="center-block">
            <a href="ajout-patient.php" class="indexLink">
                <div class="col-lg-5 buttonCube">
                    <i class="fa fa-user-plus fa-4x" aria-hidden="true"></i>
                    <p>Inscrire un patient</p>
                </div>
            </a>
        </div>
        <div class="center-block">
            <a href="ajout-rendezvous.php" class="indexLink">
            <div class="buttonCube col-lg-offset-2 col-lg-5">
                <i class="fa fa-calendar-o fa-4x" aria-hidden="true"></i>
                <p class="center-block">Enregistrer un rendez-vous</p>
            </div>
        </a>
        </div>
        
    </div>
</div>

<?php
include 'footer.php';
?>