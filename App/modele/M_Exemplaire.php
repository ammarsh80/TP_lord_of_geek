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
        $req = "SELECT * FROM exemplaire
         JOIN jeu ON `exemplaire`.`jeu_id` = `jeu`.`id_jeu` 
        JOIN categorie ON `jeu`.`categorie_id` = `categorie`.`id_categorie` 
        JOIN console ON `exemplaire`.`console_id` = `console`.`id_console`
        WHERE `categorie`.`id_categorie` = :idCategorie";
        $statement = AccesDonnees::getPdo()->prepare($req);
        $statement->bindParam(':idCategorie', $idCategorie, PDO::PARAM_INT);
        $statement->execute();
        $lesLignes = $statement->fetchAll();
        return $lesLignes;
        }

/**
 * affiche tou les jeux
 *
 * @return void
 */
    public static function trouverAllJeux(){
        $reqSQL = "SELECT * FROM exemplaire
       JOIN jeu ON `exemplaire`.`jeu_id` = `jeu`.`id_jeu` 
        JOIN categorie ON `jeu`.`categorie_id` = `categorie`.`id_categorie` 
        JOIN console ON `exemplaire`.`console_id` = `console`.`id_console`";
        $statement = AccesDonnees::getPdo()->prepare($reqSQL);
        $statement->execute();
        $voirTousLesJeux = $statement->fetchAll();
        return $voirTousLesJeux;
        }

    public static function trouverLesEtat($etat){
        $reqSQL = "SELECT * FROM exemplaire 
        JOIN jeu ON `exemplaire`.`jeu_id` = `jeu`.`id_jeu` 
        JOIN categorie ON `jeu`.`categorie_id` = `categorie`.`id_categorie`
        JOIN console ON `exemplaire`.`console_id` = `console`.`id_console` 
        WHERE `exemplaire`.`etat` = :etat";
        $statement = AccesDonnees::getPdo()->prepare($reqSQL);
        $statement->bindParam(':etat', $etat, PDO::PARAM_STR);
        $statement->execute();
        $voirJeuxSelonEtat = $statement->fetchAll();
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
                $req = "SELECT * FROM exemplaire WHERE id_exemplaire = :unIdProduit";
                $statement = AccesDonnees::getPdo()->prepare($req);
                $statement->bindParam(':unIdProduit', $unIdProduit, PDO::PARAM_INT);
                $statement->execute();
                $unProduit = $statement->fetch();
                $lesProduits[] = $unProduit;
            }
        }
        return $lesProduits;
    }

}
