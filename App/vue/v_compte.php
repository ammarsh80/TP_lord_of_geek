<!-- <p style="text-align: center;">
    <img src="./public/images/a_venir.png" width="500px" hight="auto">
</p> -->
<?php
$nom = '';
$prenom = '';
$rue = '';
$ville = '';
$cp = '';
$mail = '';
?>
<section id="compte">


    <?php
    if (!empty($commandesClient)) : ?>
        <p>Mes jeux achetés</p>
        <table class="commandes" style="border-collapse: collapse; border: 1px solid red;">
            <thead>
                <tr>
                    <th>Numéro de commande</th>
                    <th>Jeu</th>
                    <th>Version</th>
                    <th>Console</th>
                    <th>État</th>
                    <th>Catégorie</th>
                    <th>Prix</th>
                </tr>
            </thead>
        <?php endif; ?>

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
        <br><br>
        <form method="POST" action="index.php?uc=compte&action=changerProfil">
            <fieldset>
                <legend>Modifier les informations de mon compte</legend>
                <p>
                    <label for="nom">Nom</label>
                    <input id="nom" type="text" name="nom" value="<?= $client['nom'] ?>" maxlength="45">
                </p>
                <p>
                    <label for="prenom">Prenom</label>
                    <input id="prenom" type="text" name="prenom" value="<?= $client['prenom'] ?>" maxlength="45">
                </p>
                <p>
                    <label for="ville">Rue</label>
                    <input id="rue" type="text" name="rue" value="<?= $client['adresse_rue'] ?>" maxlength="90">
                </p>
                <p>
                    <label for="cp">Code postal</label>
                    <input id="cp" type="text" name="cp" value="<?= $client['cp'] ?>" size="5" maxlength="5">
                </p>
                <p>
                    <label for="rue">Ville</label>
                    <input id="ville" type="text" name="ville" value="<?= $client['ville'] ?>" maxlength="90">
                </p>
                <p>
                    <label for="mail">Email </label>
                    <input id="mail" type="text" name="mail" value="<?= $client['mail'] ?>" maxlength="100">
                </p>
                <p>
                    <input type="submit" value="Modifier" name="Valider">
                    <input type="reset" value="Annuler" name="Annuler">
                </p>
        </form>
</section>