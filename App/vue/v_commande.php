
<section id="creationCommande">
    <form method="POST" action="index.php?uc=commander&action=confirmerCommande">
        <fieldset>
            <legend>Commande</legend>
            <p>
                <label for="nom">Nom *</label>
                <input id="nom" type="text" name="nom" value="<?= $nom ?>" size="30" maxlength="45">
            </p>
            <p>
                <label for="prenom">Prénom*</label>
                <input id="prenom" type="text" name="prenom" value="<?= $prenom ?>" size="30" maxlength="45">
            </p>
            <p>
                <label for="rue">rue*</label>
                <input id="rue" type="text" name="rue" value="<?= $rue ?>" size="30" maxlength="45">
            </p>
            <p>
                <label for="cp">code postal* </label>
                <input id="cp" type="text" name="cp" value="<?= $cp ?>" size="10" maxlength="10">
            </p>
            <p>
                <label for="ville">ville* </label>
                <input id="ville" type="text" name="ville"  value="<?= $ville ?>" size="50" maxlength="50">
            </p>
            <p>
                <label for="mail">mail* </label>
                <input id="email" type="text"  name="email" value="<?= $mail ?>" size ="50" maxlength="25">
            </p> 
            <p>
                <input type="submit" value="Valider" name="valider">
                <input type="reset" value="Annuler" name="annuler"> 
            </p>
    </form>
</section>





