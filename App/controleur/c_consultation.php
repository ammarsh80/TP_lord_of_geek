<?php
include 'App/modele/M_categorie.php';
include 'App/modele/M_exemplaire.php';

/**
 * Controleur pour la consultation des exemplaires
 * @author Loic LOG
 */
switch ($action) {
    case 'voirJeux':
        $categorie = filter_input(INPUT_GET, 'categorie');
        $lesJeux = M_Exemplaire::trouveLesJeuxDeCategorie($categorie);
        break;
    case 'voirJeuxConsole':
        $console = filter_input(INPUT_GET, 'console');
        $lesJeux = M_Exemplaire::trouveLesJeuxDeConsole($console);
        break;
    case 'ajouterAuPanier':
        $idexemplaire = filter_input(INPUT_GET, 'idexemplaire');
        if (!ajouterAuPanier($idexemplaire)) {
            afficheErreurs(["Ce jeu est déjà dans le panier !!"]);
        } else {
            afficheMessage("Ce jeu a été ajouté");
        }
        $lesJeux = M_Exemplaire::trouverAllJeux();
        break;
    case "ajouterAuPanierCat":
        $idexemplaire = filter_input(INPUT_GET, 'idexemplaire');
        if (!ajouterAuPanier($idexemplaire)) {
            afficheErreurs(["Ce jeu est déjà dans le panier !!"]);
        } else {
            afficheMessage("Ce jeu a été ajouté");
        }
        $categorie = filter_input(INPUT_GET, 'categorie');
        $lesJeux = M_Exemplaire::trouveLesJeuxDeCategorie($categorie);
        break;
    case "ajouterAuPanierCon":
        $idexemplaire = filter_input(INPUT_GET, 'idexemplaire');
        if (!ajouterAuPanier($idexemplaire)) {
            afficheErreurs(["Ce jeu est déjà dans le panier !!"]);
        } else {
            afficheMessage("Ce jeu a été ajouté");
        }
        $console = filter_input(INPUT_GET, 'console');
        $lesJeux = M_Exemplaire::trouveLesJeuxDeConsole($console);
        break;
    case "ajouterAuPanierEtat":
        $idexemplaire = filter_input(INPUT_GET, 'idexemplaire');
        if (!ajouterAuPanier($idexemplaire)) {
            afficheErreurs(["Ce jeu est déjà dans le panier !!"]);
        } else {
            afficheMessage("Ce jeu a été ajouté");
        }
        // $etat = filter_input(INPUT_POST, 'etat');
        /* Normlement je dois mettre INPUT_POST, sauf que si je fais ça je perd l'affichage des jeux selon état une fois je rajoute un article dans le panier!!  */
        $etat = filter_input(INPUT_GET, 'etat'); 
        $lesJeux = M_Exemplaire::trouverLesEtat($etat);
        break;
    case 'ajouterAuPanierDepuisAccueil':
        $idexemplaire = filter_input(INPUT_GET, 'idexemplaire');
        if (!ajouterAuPanier($idexemplaire)) {
            afficheErreurs(["Ce jeu est déjà dans le panier !!"]);
        } else {
            afficheMessage("Ce jeu a été ajouté");
        }
        $lesJeux = M_Exemplaire::trouverAllJeux();
        break;
    case 'voirAll':
        $voirTousLesJeux = filter_input(INPUT_GET, 'voirAll');
        $lesJeux = M_Exemplaire::trouverAllJeux();

        break;
    case 'selonEtat':
        $etat = filter_input(INPUT_POST, 'etat');
        $lesJeux = M_Exemplaire::trouverLesEtat($etat);
        break;
    default:
        $lesJeux = [];
        break;
}

$lesCategories = M_Categorie::trouveLesCategories();
$lesConsoles = M_Categorie::trouveLesConsoles();
