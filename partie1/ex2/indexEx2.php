<?php
include 'queryEx2.php';
include '../../header.php';
?>
<h1>Exercice 2</h1>
<div class="consigne">
    <p><span>Consigne : </span></p>
    <p>Afficher tous les types de spectacles possibles.</p>
</div>
<select id="showTypes" name="showTypes">
    <option value="" name="choice">Types de spectacles</option>
    <?php foreach ($customersList AS $customers) { ?>
    <option value="<?= $customers['id']; ?>"><?= $customers['type']; ?></option>
    <?php } ?>
</select>

<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Types de spectacle</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($customersList AS $customers) { ?>
            <tr>
                <td><?= $customers['id']; ?></td>
                <td><?= $customers['type']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php
include '../../footer.php';
?>