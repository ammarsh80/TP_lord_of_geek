<?php
include 'APP/controleur/c_monCompte.php';

$nom = '';
$prenom = '';
$rue = '';
$ville = '';
$cp = '';
$mail = '';
?>
<section id="compte">

<h1>Mes informations personnelles</h1>

<table class="table_commandes">
   <thead>
       <tr>
           <th>Pseudo</th>
           <th>Nom</th>
           <th>Prénom</th>
           <th>Adresse</th>
           <th>Ville</th>
           <th>Code postal</th>
           <th>Email</th>
       </tr>
   </thead>
<tbody>

   <?php foreach ($InfoUtilisateur as $key => $commande) : ?>
       <tr>
           <?php foreach ($commande as $value) : ?>
               <td><?= $value ?></td>
           <?php endforeach; ?>
       </tr>
   <?php endforeach; ?>

</tbody>
</table>
<br><hr>
        <form method="POST" action="index.php?uc=administrer&action=changerProfil">
            <fieldset>
                <legend>Modifier les informations de mon compte</legend>
              
                <p>
                    <label for="ville">Adresse</label>
                    <input id="rue" type="text" name="rue" value="<?= $rue ?>" maxlength="90">
                </p>
                <p>
                    <label for="rue">Ville</label>
                    <input id="ville" type="text" name="ville" value="<?= $ville ?>" maxlength="90">
                </p>
                <p>
                    <label for="cp">Code postal</label>
                    <input id="cp" type="text" name="cp" value="<?= $cp ?>" size="5" maxlength="5">
                </p>
                <p>
                    <label for="mail">Email </label>
                    <input id="mail" type="text" name="mail" value="<?= $mail ?>" maxlength="100">
                </p>
                <p>
                    <input type="submit" value="Modifier" name="Valider">
                    <input type="reset" value="Annuler" name="Annuler">
                </p>
        </form>
<br><br>
    <h1>Commandes déjà passées</h1>
         <table class="table_commandes">
            <thead>
                <tr>
                    <th>Numéro de commande</th>
                    <th>Jeu</th>
                    <th>Console</th>
                    <th>État</th>
                    <th>Catégorie</th>
                    <th>Prix</th>
                </tr>
            </thead>
        <tbody>

            <?php foreach ($commandesClient as $key => $commande) : ?>
                <tr>
                    <?php foreach ($commande as $value) : ?>
                        <td><?= $value ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>

        </tbody>
        </table>
</section>