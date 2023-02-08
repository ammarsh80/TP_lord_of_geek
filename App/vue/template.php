<?php

?>

<!DOCTYPE html>
<!--
Prototype de Lord Of Geek (LOG)
-->
<html>

<head>
    <title>Lord Of Geek 2022</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/cssGeneral.css" rel="stylesheet" type="text/css">
    <meta charset="UTF-8">
</head>

<body>
    <header>

        <!-- Images En-tête -->
        <img src="public/images/logo.png" alt="Logo Lord Of Geek" />
        <!--  Menu haut-->
        <nav id="menu">
            <ul>
                <li><a href="index.php?uc=accueil&action=voirAll"> Accueil </a></li>
                <li><a href="index.php?uc=visite&action=voirAll"> Voir le catalogue de jeux </a></li>
                <li><a href="index.php?uc=panier&action=voirPanier"> Voir son panier </a></li>
                <li><a href="index.php?uc=inscription&action=demandeInscription"> S'inscrire</a></li>
                <li><a href="index.php?uc=compte"> Mon compte </a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section id="identification">
            <div id="div_connexion">
                <form action="index.php?uc=administrer" method="post">
                    <div> <label for="identifiant">Identifiant (votre pseudo):</label>
                        <input type="text" name="identifiant" value="" />
                        <label for="mot_de_passe" id="label_psw">Mot de passe :</label>
                        <input type="password" name="mot_de_passe" id="input_psw" value="" />
                    </div>
                    <input type="submit" name="connexion" id="connexion" value="Connexion" />
                    
                </form>
            </div>
            <form action="index.php?uc=deconnexion" method="post">
                <input type="submit" name="deconnexion" id="input_deconnexion" value="Déconnexion" />
            </form>
        </section>

        <?php
        // Controleur de vues
        // Selon le cas d'utilisation, j'inclus un controleur ou simplement une vue
        switch ($uc) {
            case 'accueil':
                include 'App/vue/v_accueil.php';
                break;
            case 'visite':
                include("App/vue/v_jeux.php");
                break;
            case 'panier':
                include("App/vue/v_panier.php");
                break;
            case 'commander':
                include("App/vue/v_commande.php");
                break;
            case 'compte':
                include("App/vue/v_compte.php");
                break;
            case 'inscription':
                include("App/vue/v_inscription.php");
                break;
            default:
                break;
        }
        ?>
    </main>
</body>

</html>