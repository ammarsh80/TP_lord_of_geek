<section id="visite">
    <aside id="categories">

        <a href="index.php?uc=visite&action=voirAll">
            <div id=voirAll>Voir tous les jeux
            </div>
        </a>
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
                    <?php
                      while ((!isset($_GET["categorie"])) && (!isset($_POST["etat"]))) { ?>
                        <a href="index.php?uc=visite&idexemplaire=<?= $idexemplaire ?>&action=ajouterAuPanier">
                            <img src="public/images/mettrepanier.png" title="Ajouter au panier" class="add" />
                        </a>
                    <?php
                    break;
                    }
                    while (isset($_GET["categorie"])) { ?>
                        <a href="index.php?uc=visite&idexemplaire=<?= $idexemplaire ?>&action=ajouterAuPanierCat&categorie=<?= filter_var($_GET["categorie"]) ?>">
                            <img src="public/images/mettrepanier.png" title="Ajouter au panier" class="add" />
                        </a>

                    <?php
                        break;
                    }
                    while (isset($_POST["etat"])) { ?>
                        <a href="index.php?uc=visite&idexemplaire=<?= $idexemplaire ?>&action=ajouterAuPanierEtat&etat=<?= filter_input(INPUT_POST, 'etat') ?>">
                            <img src="public/images/mettrepanier.png" title="Ajouter au panier" class="add" />
                        </a>
                    <?php
                        break;
                    }
                  
                    ?>

                </p>
            </article>
        <?php
        }
        ?>
    </section>



</section>