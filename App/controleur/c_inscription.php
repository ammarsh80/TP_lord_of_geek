<?php

include 'App/modele/M_Session.php';

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
        $pseudo = filter_input(INPUT_POST, 'pseudo');
        $psw = filter_input(INPUT_POST, 'psw');
        $rue = filter_input(INPUT_POST, 'rue');
        $ville = filter_input(INPUT_POST, 'ville');
        $cp = filter_input(INPUT_POST, 'cp');
        $mail = filter_input(INPUT_POST, 'email');
        $errors = M_Session::estValideInscription($nom, $prenom, $pseudo, $psw, $rue, $ville, $cp, $mail);
        if (count($errors) > 0) {
            // Si une erreur, on recommence
            afficheErreurs($errors);
        } else {

            $id_ville = M_Session::creerVille($ville, $cp);
            $idClient = M_Session::creerClient($nom, $prenom, $rue, $mail, $id_ville);
            $idUtilisateur = M_Session::creerUtilisateur($pseudo, $psw, $idClient);
            afficheMessage("Vous venez de vous inscrire, bienvenue !");
            $uc = '';
        }
        break;
}
