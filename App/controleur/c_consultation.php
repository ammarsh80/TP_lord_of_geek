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
    case 'ajouterAuPanier':
        $idexemplaire = filter_input(INPUT_GET, 'idexemplaire');
        // $categorie = filter_input(INPUT_GET, 'categorie');
        if (!ajouterAuPanier($idexemplaire)) {
            afficheErreurs(["Ce jeu est déjà dans le panier !!"]);
        } else {
            afficheMessage("Ce jeu a été ajouté");
        }
        $lesJeux = M_Exemplaire::trouverAllJeux();
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
