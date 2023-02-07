<?php

/**
 * Requetes sur les commandes
 *
 * @author Loic LOG
 */
class M_Commande
{

    /**
     * Crée une commande
     *
     * Crée une commande à partir des arguments validés passés en paramètre, l'identifiant est
     * construit à partir du maximum existant ; crée les lignes de commandes dans la table contenir à partir du
     * tableau d'idProduit passé en paramètre
     * @param $iddernierclient
     * @param $ville_id
     * @param $listJeux
     */
    public static function creerCommande($iddernierclient, $ville_id, $listJeux)
    {
        $req = "INSERT INTO commande (client_id, ville_id) VALUES (:iddernierclient, :ville_id)";
        $statement = AccesDonnees::getPdo()->prepare($req);
        $statement->bindParam(':iddernierclient', $iddernierclient, PDO::PARAM_INT);
        $statement->bindParam(':ville_id', $ville_id, PDO::PARAM_INT);
        $statement->execute();
        $idDerniereCommande = AccesDonnees::getPdo()->lastInsertId();

        foreach ($listJeux as $jeu) {
            $req = "INSERT INTO ligne_commande (commande_id, exemplaire_id) 
            VALUES (:idDerniereCommande, :jeu)";
            $statement = AccesDonnees::getPdo()->prepare($req);
            $statement->bindParam(':idDerniereCommande', $idDerniereCommande, PDO::PARAM_INT);
            $statement->bindParam(':jeu', $jeu, PDO::PARAM_INT);
            $statement->execute();
        }
    }

    /**
     * Retourne vrai si pas d'erreur
     * Remplie le tableau d'erreur s'il y a
     *
     * @param $nom : chaîne
     * @param $prenom : chaîne
     * @param $rue : chaîne
     * @param $ville : chaîne
     * @param $cp : INT
     * @param $mail : chaîne
     * @return : array
     */
    public static function estValide($nom, $prenom, $rue, $ville, $cp, $mail)
    {
        $erreurs = [];
        if ($nom == "") {
            $erreurs[] = "Il faut saisir le champ nom";
        }
        if ($prenom == "") {
            $erreurs[] = "Il faut saisir le champ nom";
        }
        if ($rue == "") {
            $erreurs[] = "Il faut saisir le champ rue";
        }
        if ($ville == "") {
            $erreurs[] = "Il faut saisir le champ ville";
        }
        if ($cp == "") {
            $erreurs[] = "Il faut saisir le champ Code postal";
        } else if (!estUnCp($cp)) {
            $erreurs[] = "erreur de code postal";
        }
        if ($mail == "") {
            $erreurs[] = "Il faut saisir le champ mail";
        } else if (!estUnMail($mail)) {
            $erreurs[] = "erreur de mail";
        }
        return $erreurs;
    }
    /**
     * trouve ou creer une ville
     *
     * @param [chaîne] $ville
     * @param [INT] $cp
     * @return :$id_ville
     */
    public static function trouveOuCreerVille($ville, $cp)
    {
        $pdo = AccesDonnees::getPdo();
        $req = "SELECT ville.id_ville FROM ville WHERE nom_ville = :ville AND cp= :cp";
        $statement = AccesDonnees::getPdo()->prepare($req);
        $statement->bindParam(':ville', $ville, PDO::PARAM_STR);
        $statement->bindParam(':cp', $cp, PDO::PARAM_INT);
        $statement->execute();
        $id_ville = $statement->fetchColumn();

        if ($id_ville == false) {
            $req = "INSERT INTO ville (nom_ville, cp) VALUES (:ville,:cp)";
            $statement = AccesDonnees::getPdo()->prepare($req);
            $statement->bindParam(':ville', $ville, PDO::PARAM_STR);
            $statement->bindParam(':cp', $cp, PDO::PARAM_INT);
            $statement->execute();
            $id_ville = AccesDonnees::getPdo()->lastInsertId();
        }
        return $id_ville;
    }
    // /**
    //  * trouve un client déjà enregistré ou crée un nouveau client
    //  *
    //  * @param [chaîne] $nom
    //  * @param [chaîne] $prenom
    //  * @param [chaîne] $adresse
    //  * @param [chaîne] $email
    //  * @param [INT] $ville_id
    //  * @return :$idclient
    //  */
    // public static function trouveOuCreerClient($nom, $prenom, $adresse, $email, $ville_id)
    // {

    //     $pdo = AccesDonnees::getPdo();
    //     $req = "SELECT id_client FROM client WHERE nom = :nom AND prenom = :prenom AND adresse = :adresse AND email = :email AND ville_id = :ville_id";
    //     $statement = AccesDonnees::getPdo()->prepare($req);
    //     $statement->bindParam(':nom', $nom, PDO::PARAM_STR);
    //     $statement->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    //     $statement->bindParam(':adresse', $adresse, PDO::PARAM_STR);
    //     $statement->bindParam(':email', $email, PDO::PARAM_STR);
    //     $statement->bindParam(':ville_id', $ville_id, PDO::PARAM_INT);
    //     $statement->execute();
    //     $idclient = $statement->fetchColumn();

    //     if ($idclient == false) {
    //         $req = "INSERT INTO client (nom, prenom, adresse, email, ville_id) VALUES (:nom,:prenom,:adresse,:email,:ville_id)";
    //         $statement = AccesDonnees::getPdo()->prepare($req);
    //         $statement->bindParam(':nom', $nom, PDO::PARAM_STR);
    //         $statement->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    //         $statement->bindParam(':adresse', $adresse, PDO::PARAM_STR);
    //         $statement->bindParam(':email', $email, PDO::PARAM_STR);
    //         $statement->bindParam(':ville_id', $ville_id, PDO::PARAM_INT);
    //         $statement->execute();
    //         $idclient = $statement->fetchColumn();
    //         $idclient = $pdo->lastInsertId();
    //     }
    //     return $idclient;
    // }
       /**
     * crée un nouveau client
     *
     * @param [chaîne] $nom
     * @param [chaîne] $prenom
     * @param [chaîne] $adresse
     * @param [chaîne] $email
     * @param [INT] $ville_id
     * @return :$idclient
     */
    public static function trouveOuCreerClient($nom, $prenom, $adresse, $email, $ville_id)
    {

        $pdo = AccesDonnees::getPdo();
        $req = "SELECT id_client FROM client WHERE nom = :nom AND prenom = :prenom AND adresse = :adresse AND email = :email AND ville_id = :ville_id";
        $statement = AccesDonnees::getPdo()->prepare($req);
        $statement->bindParam(':nom', $nom, PDO::PARAM_STR);
        $statement->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $statement->bindParam(':adresse', $adresse, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':ville_id', $ville_id, PDO::PARAM_INT);
        $statement->execute();
        $id_client = $statement->fetchColumn();
        if ($id_client == false) {
            $req = "INSERT INTO client (nom, prenom, adresse, email, ville_id) VALUES (:nom,:prenom,:adresse,:email,:ville_id)";
            $statement = AccesDonnees::getPdo()->prepare($req);
            $statement->bindParam(':nom', $nom, PDO::PARAM_STR);
            $statement->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $statement->bindParam(':adresse', $adresse, PDO::PARAM_STR);
            $statement->bindParam(':email', $email, PDO::PARAM_STR);
            $statement->bindParam(':ville_id', $ville_id, PDO::PARAM_INT);
            $statement->execute();
            $id_client = $statement->fetchColumn();
            $id_client = $pdo->lastInsertId();
        }
        return $id_client;
    }
}
