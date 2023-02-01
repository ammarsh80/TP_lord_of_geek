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
     * @param $nom
     * @param $rue
     * @param $cp
     * @param $ville
     * @param $mail
     * @param $listJeux

     */
    // public static function creerCommande($nom, $rue, $cp, $ville, $mail, $listJeux) {
    //     $req = "insert into commandes(nomPrenomClient, adresseRueClient, cpClient, villeClient, mailClient) values ('$nom','$rue','$cp','$ville','$mail')";
    //     $res = AccesDonnees::exec($req);
    //     $idCommande = AccesDonnees::getPdo()->lastInsertId();
    //     foreach ($listJeux as $jeu) {
    //         $req = "insert into lignes_commande(commande_id, exemplaire_id) values ('$idCommande','$jeu')";
    //         $res = AccesDonnees::exec($req);
    //     }
    // }
    public static function creerCommande($iddernierclient, $ville_id, $listJeux)
    {
        $req = "INSERT INTO commande (client_id, ville_id) VALUES ('$iddernierclient', $ville_id)";
        $res = AccesDonnees::exec($req);
        $idDerniereCommande = AccesDonnees::getPdo()->lastInsertId();
        foreach ($listJeux as $jeu) {
            $req = "INSERT INTO ligne_commande (commande_id, exemplaire_id) VALUES ('$idDerniereCommande', '$jeu')";
            $res = AccesDonnees::exec($req);
        }
    }

    /**
     * Retourne vrai si pas d'erreur
     * Remplie le tableau d'erreur s'il y a
     *
     * @param $nom : chaîne
     * @param $rue : chaîne
     * @param $ville : chaîne
     * @param $cp : chaîne
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
    public static function trouveOuCreer($ville, $cp)
    {
        $sql = "SELECT ville.id_ville FROM ville WHERE nom_ville ='" . $ville . "' AND cp= '" . $cp . "'";
        $res = AccesDonnees::query($sql);
        $id_ville = $res->fetchColumn();

        if ($id_ville == false) {
            $sql_insert = "INSERT INTO ville (nom_ville, cp) VALUES ('$ville','$cp')";
            $res = AccesDonnees::exec($sql_insert);
            $idnewVille = AccesDonnees::getPdo()->lastInsertId();
        }
        return $id_ville;
    }


    // public static function trouveOuCreerClient($nom, $prenom, $adresse, $email, $id_ville)
    // {
    //     $sql = "SELECT client.id_client FROM client WHERE email ='" . $email . "'";
    //     $res = AccesDonnees::query($sql);
    //     $idclient = $res->fetchColumn();

    //     if ($idclient == false) {
    //         $sql_insert = "INSERT INTO client (nom, prenom, adresse, email, ville_id) VALUES ('$nom','$prenom','$adresse','$email', $id_ville)";
    //         $res = AccesDonnees::exec($sql_insert);
    //         $idclient = AccesDonnees::getPdo()->lastInsertId();
    //     }
    //     return $idclient;
    // }
  

    public static function trouveOuCreerClient($nom, $prenom, $adresse, $email, $ville_id)
{
    
    $pdo = AccesDonnees::getPdo();
    $stmt = $pdo->prepare("SELECT id_client FROM client WHERE nom = ? AND prenom = ? AND adresse = ? AND email = ? AND ville_id = ?");
$stmt->execute([$nom, $prenom, $adresse, $email, $ville_id]);

    $idclient = $stmt->fetchColumn();

    if ($idclient == false) {
        $stmt = $pdo->prepare("INSERT INTO client (nom, prenom, adresse, email, ville_id) VALUES (?,?,?,?,?)");
        $stmt->execute([$nom, $prenom, $adresse, $email, $ville_id]);
        $idclient = $pdo->lastInsertId();
    }
    return $idclient;
}


// public static function trouveOuCreerClient($nom, $prenom, $adresse, $email, $idville)
// {
//     $pdo = AccesDonnees::getPdo();
//     $stmt = $pdo->prepare("SELECT id_client FROM client WHERE nom = ? AND prenom = ? AND adresse = ? AND email = ? AND ville_id = ?");
//     $stmt->execute([$nom, $prenom, $adresse, $email, $idville]);
//     $idclient = $stmt->fetchColumn();

//     if (empty($idclient)) {
//         if(verify_idville_exists($idville))
//         {
//             $stmt = $pdo->prepare("INSERT INTO client (nom, prenom, adresse, email, ville_id) VALUES (?,?,?,?,?)");
//             $stmt->execute([$nom, $prenom, $adresse, $email, $idville]);
//             $idclient = $pdo->lastInsertId();
//         }
//     }
//     return $idclient;
// }
}
