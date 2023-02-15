
<section id="creationCommande">
<?php

if (isset($_SESSION["id"])) { 
?>

    <form method="POST" action="index.php?uc=commander&action=confirmerCommande">
        <fieldset>
            <legend>Commande</legend>
            <p>
                <label for="nom"> Nom *</label>
                <input id="nom" type="text" name="nom" value="<?= $InfoUtilisateurPourCommander['0']['nom'] ?>" size="30" maxlength="45">
            </p>
            <p>
                <label for="prenom">Prénom*</label>
                <input id="prenom" type="text" name="prenom" value="<?= $InfoUtilisateurPourCommander['0']['prenom'] ?>" size="30" maxlength="45">
            </p>
            <p>
                <label for="rue">rue*</label>
                <input id="rue" type="text" name="rue" value="<?= $InfoUtilisateurPourCommander['0']['adresse'] ?>" size="30" maxlength="45">
            </p>
            <p>
                <label for="cp">code postal* </label>
                <input id="cp" type="text" name="cp" value="<?= $InfoUtilisateurPourCommander['0']['cp'] ?>" size="10" maxlength="10">
            </p>
            <p>
                <label for="ville">ville* </label>
                <input id="ville" type="text" name="ville"  value="<?= $InfoUtilisateurPourCommander['0']['nom_ville'] ?>" size="50" maxlength="50">
            </p>
            <p>
                <label for="mail">mail* </label>
                <input id="email" type="text"  name="email" value="<?= $InfoUtilisateurPourCommander['0']['email'] ?>" size ="50" maxlength="25">
            </p> 
            <p>
                <input type="submit" value="Valider" name="valider">
                <input type="reset" value="Annuler" name="annuler"> 
            </p>
    </form>
    <?php
    }

    if (!isset($_SESSION["id"])) { 
        header('Location: index.php?uc=inscription&action=demandeInscription');
    }
        ?>
</section>






