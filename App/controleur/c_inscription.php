<?php

include 'App/modele/M_commande.php';

/**
 * Controleur pour les inscriptions
 * @author AS
 */
switch ($action) {
    case 'demandeInscription':
        // $n = nbJeuxDuPanier();
        // if ($n > 0) 
        {
            $nom = '';
            $prenom = '';
            $pseudo = '';
            $psw = '';
            $rue = '';
            $ville = '';
            $cp = '';
            $mail = '';
        } 
        // else {
        //     afficheMessage("Panier vide !!");
        //     $uc = '';
        // }
        break;
    case 'confirmerInscription':
        $nom = filter_input(INPUT_POST, 'nom');
        $prenom = filter_input(INPUT_POST, 'prenom');
        $rue = filter_input(INPUT_POST, 'rue');
        $ville = filter_input(INPUT_POST, 'ville');
        $cp = filter_input(INPUT_POST, 'cp');
        $mail = filter_input(INPUT_POST, 'email');
        $errors = M_Commande::estValide($nom, $prenom, $rue, $ville, $cp, $mail);
        if (count($errors) > 0) {
            // Si une erreur, on recommence
            afficheErreurs($errors);
        } else {

            $id_ville = M_Commande::trouveOuCreer($ville, $cp);
            $idclient = M_Commande::trouveOuCreerClient($nom, $prenom, $rue, $mail, $id_ville);
            afficheMessage("Vous venez de vous inscrire, bienvenue !");
            $uc = '';
        }
        break;
}
