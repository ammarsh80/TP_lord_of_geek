<section>
    <img src="public/images/panier.gif"	alt="Panier" title="panier"/>
    <?php
    foreach ($lesJeuxDuPanier as $unJeu) {
        $idexemplaire = $unJeu['id_exemplaire'];
        $description = $unJeu['description'];
        $etat = $unJeu['etat'];
        $image = $unJeu['image'];
        $prix = $unJeu['prix'];
        ?>
        <p>
            <img src="public/images/jeux/<?php echo $image ?>" alt=image width=100 height=100 />
            <?php
            echo "<br>";
            echo $description."<br>" ." état: ".$etat. " ($prix Euros)";
            ?>	
            <a href="index.php?uc=panier&jeu=<?php echo $idexemplaire ?>&action=supprimerUnJeu" onclick="return confirm('Voulez-vous vraiment retirer ce jeu ?');">
                <img src="public/images/retirerpanier.png" TITLE="Retirer du panier" >
            </a>
        </p>
        <?php
    }
    ?>
    <br>
    <a href=index.php?uc=commander&action=passerCommande>
        <img src="public/images/commander.jpg" title="Passer commande" >
    </a>
</section>
