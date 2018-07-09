<?php
include 'models/dataBase.php';
include 'models/patients.php';
include 'controllers/ajout-patientController.php';
include 'header.php';
?>
<div class="row">
    <div class="center-block">
        <a href="liste-patients.php" class="indexLink btn btn-outline-info btn-lg">
            <div class="col-lg-12 text-center">
                <i class="fa fa-list-ul fa-4x" aria-hidden="true"></i>
                <p>Voir la liste des patients</p>
            </div>
        </a>
    </div>
    <div class="card border-primary mb-3 center-block">
        <div class="card-header"><h4 class="card-title text-center">Formulaire d'inscription du patient</h4></div>
        <p class="redMessage">Tous les champs sont obligatoires</p>
        <!--    DEBUT FORMULAIRE      -->
        <?php foreach ($formError as $error) { ?>
            <div class="offset-lg-3 col-lg-6 alert alert-dismissible alert-danger text-center">
                <p><?= $error; ?></p>
            </div>
        <?php } ?>
        <form method="POST" action="#">
            <!--    NOM     -->
            <div class="col-lg-6">
                <label for="lastname" class="pull-right">Nom</label>
            </div>
            <div class="col-lg-6">
                <input class="pull-left" type="text" name="lastname" placeholder="Dupont" value="<?= $patients->lastname ?>"/>
                <p class="regex pull-left"><?= isset($formError['lastname']) ? $formError['lastname'] : '' ?></p>
            </div>
            <!--    PRENOM      -->
            <div class="col-lg-6">
                <label for="firstname" class="pull-right">Prénom</label>
            </div>
            <div class="col-lg-6">
                <input class="pull-left" type="text" name="firstname" placeholder="Xavier" value="<?= $patients->firstname ?>"/>
                <p class="regex pull-left"><?= isset($formError['firstname']) ? $formError['firstname'] : '' ?></p>
            </div>
            <!--    DATE DE NAISSANCE      -->
            <div class="col-lg-6">
                <label for="birthdate" class="pull-right">Date de naissance</label>
            </div>
            <div class="col-lg-6">
                <input class="pull-left" type="date" name="birthdate" placeholder="01/01/2001" value="<?= $patients->birthdate ?>"/>
                <p class="regex pull-left"><?= isset($formError['birthdate']) ? $formError['birthdate'] : '' ?></p>
            </div>
            <!--    TELEPHONE      -->
            <div class="col-lg-6">
                <label for="phone" class="pull-right">Numéro de téléphone</label>
            </div>
            <div class="col-lg-6">
                <input class="pull-left" type="tel" name="phone" placeholder="0612345678" value="<?= $patients->phone ?>"/>
                <p class="regex pull-left"><?= isset($formError['phone']) ? $formError['phone'] : '' ?></p>
            </div>
            <!--    EMAIL      -->
            <div class="col-lg-6">
                <label for="mail" class="pull-right">Adresse Email</label>
            </div>
            <div class="col-lg-6">
                <input class="pull-left" type="email" name="mail" placeholder="xavier.dupont@mail.com" value="<?= $patients->mail ?>"/>
                <p class="regex pull-left"><?= isset($formError['mail']) ? $formError['mail'] : '' ?></p>
            </div>
            <!--    BOUTON      -->
            <input name="submit" class="offset-lg-5 col-lg-2 btn btn-outline-info" type="submit" value="Valider"/>
        </form>
        <?php if ($insertSuccess) { ?>
            <div class="offset-lg-4 col-lg-4 alert alert-dismissible alert-success text-center">
                <p>Les données ont bien été transmise</p>
            </div>
        <?php } ?>
    </div>
</div>


<?php
include 'footer.php';
?>