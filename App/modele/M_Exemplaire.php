<?php

/**
 * Requetes sur les exemplaires  de jeux videos
 *
 * @author Loic LOG
 */
class M_Exemplaire {

    /**
     * Retourne sous forme d'un tableau associatif tous les jeux de la
     * catégorie passée en argument
     *
     * @param $idCategorie
     * @return un tableau associatif
     */
    public static function trouveLesJeuxDeCategorie($idCategorie) {
        $req = "SELECT * FROM exemplaire JOIN jeu ON `exemplaire`.`jeu_id` = `jeu`.`id_jeu` JOIN categorie ON `jeu`.`categorie_id` = `categorie`.`id_categorie` WHERE `categorie`.`id_categorie` = '$idCategorie'";
        $res = AccesDonnees::query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }

    public static function trouverAllJeux(){
        $reqSQL = "SELECT * FROM exemplaire JOIN jeu ON `exemplaire`.`jeu_id` = `jeu`.`id_jeu` JOIN categorie ON `jeu`.`categorie_id` = `categorie`.`id_categorie` ";
        $res = AccesDonnees::query($reqSQL);
        $voirTousLesJeux = $res->fetchAll();
        return $voirTousLesJeux;   
    }

    public static function trouverLesEtat($etat){
        $reqSQL = "SELECT * FROM exemplaire JOIN jeu ON `exemplaire`.`jeu_id` = `jeu`.`id_jeu` JOIN categorie ON `jeu`.`categorie_id` = `categorie`.`id_categorie` WHERE `exemplaire`.`etat` = '$etat'";
        $res = AccesDonnees::query($reqSQL);
        $voirJeuxSelonEtat = $res->fetchAll();
        return $voirJeuxSelonEtat;   
    }

    /**
     * Retourne les jeux concernés par le tableau des idProduits passée en argument
     *
     * @param $desIdJeux tableau d'idProduits
     * @return un tableau associatif
     */
    public static function trouveLesJeuxDuTableau($desIdJeux) {
        $nbProduits = count($desIdJeux);
        $lesProduits = array();
        if ($nbProduits != 0) {
            foreach ($desIdJeux as $unIdProduit) {
                $req = "SELECT * FROM exemplaire WHERE id_exemplaire = '$unIdProduit'";
                $res = AccesDonnees::query($req);
                $unProduit = $res->fetch();
                $lesProduits[] = $unProduit;
            }
        }
        return $lesProduits;
    }

}
