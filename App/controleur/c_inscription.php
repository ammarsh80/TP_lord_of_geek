<?php

include 'App/modele/M_Session.php';

/**
 * Controleur pour les inscriptions
 * @author AS
 */
switch ($action) {
    case 'demandeInscription':
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

            $id_ville = M_Session::trouveOuCreerVille($ville, $cp);
            $id_client = M_Session::trouveOuCreerClient($nom, $prenom, $rue, $mail, $id_ville);
            $idUtilisateur = M_Session::creerUtilisateur($pseudo, $psw, $id_client);
            afficheMessage("Vous venez de vous inscrire avec succès!<br> Veuillez vous-connecter grâce à votre pseudo (identifiant) et le mot de passe que vous venez de créer !");
            $uc = '';
        }
        break;
}
