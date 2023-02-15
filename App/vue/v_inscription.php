<section id="form_inscription">

    <h1>Veuillez vous connecter en renseignant correctement votre pseudo et votre mot de passe </h1>
    <p>Si vous n'êtes pas encore inscrit, veuillez renseigner le formulaire d'inscription avant de vous connectez</p>

    <form method="POST" action="index.php?uc=inscription&action=confirmerInscription">

        <fieldset>
            <legend>S'inscrire</legend>
            <p>
                <label for="nom">Nom *</label>
                <input id="nom" type="text" name="nom" value="<?= $nom ?>" size="30" maxlength="45">
            </p>
            <p>
                <label for="prenom">Prénom*</label>
                <input id="prenom" type="text" name="prenom" value="<?= $prenom ?>" size="30" maxlength="45">
            </p>
            <p>
                <label for="prenom">Pseudo*</label>
                <input id="pseudo" type="text" name="pseudo" value="<?= $pseudo ?>" size="30" maxlength="45">
            </p>
            <p>
                <label for="prenom">Mot de passe*</label>
                <input id="psw" type="text" name="psw" value="<?= $psw ?>" size="30" maxlength="45">
            </p>
            <br>
            <p>
                <label for="rue">Rue*</label>
                <input id="rue" type="text" name="rue" value="<?= $rue ?>" size="30" maxlength="45">
            </p>
            <p>
                <label for="cp">Code postal* </label>
                <input id="cp" type="text" name="cp" value="<?= $cp ?>" size="10" maxlength="10">
            </p>
            <br>
            <p>
                <label for="ville">Ville* </label>
                <input id="ville" type="text" name="ville"  value="<?= $ville ?>" size="50" maxlength="50">
            </p>
            <p>
                <label for="mail">E-mail* </label>
                <input id="email" type="text"  name="email" value="<?= $mail ?>" size ="50" maxlength="25">
            </p> 
            <p>
                <input type="submit" value="Valider" name="valider">
                <input type="reset" value="Annuler" name="annuler"> 
            </p>
    </form>
</section>