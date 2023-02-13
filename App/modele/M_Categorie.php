<?php

/**
 * Les jeux sont rangés par catégorie
 *
 * @author Loic LOG
 */
class M_Categorie {

    /**
     * Retourne toutes les catégories sous forme d'un tableau associatif
     *
     * @return le tableau associatif des catégories
     */
    public static function trouveLesCategories() {
        $req = "SELECT * FROM categorie";
        $res = AccesDonnees::query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }
/**
 * Retourne toutes les console sous forme d'un tableau associatif
 *
 * @return le tableau associatif des cosnole
 */
    public static function trouveLesConsoles(){
        $req = "SELECT * FROM console";
        $res = AccesDonnees::query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }

}
