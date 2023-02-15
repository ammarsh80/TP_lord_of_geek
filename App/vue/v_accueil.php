<section>
    <h1>
        Lord Of Geek
    </h1>
    <h2>
        le prince des jeux sur internet
    </h2>

</section>
<section id="section_jeux_acceuil">
    <?php


    foreach ($lesJeux as $unJeu) {
        $idexemplaire = $unJeu['id_exemplaire'];
        $description = $unJeu['description'];
        $etat = $unJeu['etat'];
        $prix = $unJeu['prix'];
        $image = $unJeu['image'];
        $console = $unJeu['nom_console'];
    ?>
        <article id="jeux_acceuil">
            <img src="public/images/jeux/<?= $image ?>" alt="Image de <?= $description; ?>" />
            <p>Sur la console <?= $console ?></p>
            <p><?= $description ?></p>
            <p><?= ' En ' . $etat . " état " ?></p>
            <p><?= "Prix : " . $prix . " Euros" ?>
                <a href="index.php?uc=accueil&idexemplaire=<?php echo $idexemplaire ?> &action=ajouterAuPanierDepuisAccueil">
                    <img src="public/images/mettrepanier.png" title="Ajouter au panier" class="add" />
                </a>
            </p>
        </article>
    <?php
    }
    ?>
</section>