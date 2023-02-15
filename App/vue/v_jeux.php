<section id="visite">
    <aside id="categories">

        <a href="index.php?uc=visite&action=voirAll" class="voirAll">
            <div id=voirAll>Voir tous les jeux
            </div>
        </a>
        <p>Voir les jeux par catégorie:</p>
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
        <p>Voir les jeux par console:</p>
        <ul>
            <?php
            foreach ($lesConsoles as $uneConsole) {
                $idConsole = $uneConsole['id_console'];
                $libConsole = $uneConsole['nom_console'];
            ?>
                <li>
                    <a href=index.php?uc=visite&console=<?php echo $idConsole ?>&action=voirJeuxConsole><?php echo $libConsole ?></a>
                </li>
            <?php
            }
            ?>
        </ul>

        <div id="voir_etat">

            <label for="etat">Voir les jeux selon l'etat:</label>
            <form action="index.php?uc=visite&action=selonEtat" method="POST">
                <select name="etat" id="etat">
                    <option value="">--Choisir état--</option>
                    <option value="bon">Bon</option>
                    <option value="moyen">Moyen</option>
                    <option value="mauvais">Mauvais</option>
                </select>
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
            $console = $unJeu['nom_console'];
        ?>
            <article id="article_voirAll">
                <img src="public/images/jeux/<?= $image ?>" id="img_voirAll" alt="Image de <?= $description; ?>"/>
                <p>Sur la console <?= $console ?></p>
                <p><?= $description ?></p>
                <p><?= ' En ' . $etat . " état " ?></p>

                <p><?= "Prix : " . $prix . " Euros<br>" ?>
                    <?php
                    if ((!isset($_GET["categorie"])) && (!isset($_POST["etat"])) && (!isset($_GET["console"]))) { ?>
                        <a href="index.php?uc=visite&idexemplaire=<?= $idexemplaire ?>&action=ajouterAuPanier">
                            <img src="public/images/mettrepanier.png" title="Ajouter au panier" class="add" />
                        </a>

                    <?php
                    }
                    if (isset($_GET["categorie"])) { ?>
                        <a href="index.php?uc=visite&idexemplaire=<?= $idexemplaire ?>&action=ajouterAuPanierCat&categorie=<?= filter_input(INPUT_GET, "categorie") ?>">
                            <img src="public/images/mettrepanier.png" title="Ajouter au panier" class="add" />
                        </a>

                    <?php
                    }
                    if (isset($_POST["etat"])) { ?>
                        <a href="index.php?uc=visite&idexemplaire=<?= $idexemplaire ?>&action=ajouterAuPanierEtat&etat=<?= filter_input(INPUT_POST, "etat") ?>">
                            <img src="public/images/mettrepanier.png" title="Ajouter au panier" class="add" />
                        </a>
                    <?php
                    }
                    if (isset($_GET["console"])) { ?>
                        <a href="index.php?uc=visite&idexemplaire=<?= $idexemplaire ?>&action=ajouterAuPanierCon&console=<?= filter_input(INPUT_GET, "console") ?>">
                            <img src="public/images/mettrepanier.png" title="Ajouter au panier" class="add" />
                        </a>
                    <?php
                    }
                    ?>
                </p>
            </article>
        <?php
        }
        ?>
    </section>
</section>