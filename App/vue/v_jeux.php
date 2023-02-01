<section id="visite">
    <aside id="categories">
        <ul>
            <?php
            foreach ($lesCategories as $uneCategorie) {
                $idCategorie = $uneCategorie['id_categorie'];
                $libCategorie = $uneCategorie['nom'];
            ?>
                <li>
                    <a href=index.php?uc=visite&categorie=<?php echo $idCategorie ?>&action=voirJeux><?php echo $libCategorie ?></a>
                </li>
            <?php
            }
            ?>
        </ul>

        <a href="index.php?uc=visite&action=voirAll">
            <div id=voirAll>Voir tous les jeux
            </div>
        </a>


        <div id="voir_etat">

            Voir les jeux selon l'etat:
            <form action="index.php?uc=visite&action=selonEtat&etat=" method="POST">
                <select name="etat" id="etat">
                    <option value="">--Afficher les jeux selon état--</option>
                    <option value="bon">Bon</option>
                    <option value="moyen">Moyen</option>
                    <option value="mauvais">Mauvais</option>
                    <br>
                    <input type="submit" value="OK">


            </form>


        </div>
    </aside>

    <section id="jeux">
        <?php
        foreach ($lesJeux as $unJeu) {
            $idexemplaire = $unJeu['id_exemplaire'];
            $description = $unJeu['description'];
            $prix = $unJeu['prix'];
            $image = $unJeu['image'];
            $etat = $unJeu['etat'];

        ?>
            <article id="article_voirAll">
                <img src="public/images/jeux/<?= $image ?>" alt="Image de <?= $description; ?>" class="article_voirAll" />
                <p><?= $description ?></p>
                <p><?= ' En ' . $etat . " état " ?></p>

                <p><?= "Prix : " . $prix . " Euros<br>" ?>
                    <a href="index.php?uc=visite&categorie=<?= $categorie ?>&idexemplaire=<?= $idexemplaire ?>&action=ajouterAuPanier">
                        <img src="public/images/mettrepanier.png" title="Ajouter au panier" class="add" />
                    </a>
                </p>
            </article>
        <?php
        }
        ?>
    </section>



</section>