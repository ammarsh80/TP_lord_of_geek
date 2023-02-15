<?php

class M_Session
{
    private function connexion(): PDO
    {
        // Connexion et sélection de la base de données :
        try {
            // $conn = new PDO("mysql:host=localhost:8080; dbname=ma_base_jeux", "root", "MajdAhmad023716292)");
            $conn = AccesDonnees::getPdo();
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            die;
        }
        return $conn;
    }
    /**
     * Fonction qui vérifie que l'identification saisie est correcte.
     */
    function utilisateur_existe($identifiant, $mot_de_passe): bool
    {
        $conn = $this->connexion();
        $sql = 'SELECT 1 FROM utilisateur ';
        $sql .= 'WHERE identifiant = :login AND mot_de_passe = :mdp';
        // prepare and bind
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":login", $identifiant);
        $stmt->bindParam(":mdp", $mot_de_passe);
        // Exécution
        $stmt->execute();
        // L'identification est bonne si la requête a retourné
        // une ligne (l'utilisateur existe et le mot de passe
        // est bon).
        // Si c'est le cas $existe contient 1, sinon elle est
        // vide. Il suffit de la retourner en tant que booléen.
        if ($stmt->rowCount() > 0) {
            // ok, il existe
            $existe = true;
        } else {
            $existe = false;
        }
        return (bool) $existe;
    }
    
    function register(String $pseudo, String $psw): bool
    {
        $conn = $this->connexion();
        $psw = password_hash($psw, PASSWORD_BCRYPT);
        $sql = "INSERT INTO utilisateur (identifiant, mot_de_passe)
        VALUES(:pseudo, :psw);";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":pseudo", $pseudo);
        $stmt->bindParam(":psw", $psw);
        return $stmt->execute();
    }

    public static function checkPassword(String $pseudo, String $psw)
    {
        $conn = AccesDonnees::getPdo();
        $sql = "SELECT id_utilisateur, mot_de_passe, identifiant, client_id FROM utilisateur WHERE identifiant = :pseudo";
        // prepare and bind
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":pseudo", $pseudo);
        // Exécution
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch();
            $psw_bdd = $data['mot_de_passe'];
            // Le reste du code ici
        }
        if ($stmt->rowCount() == 0){
            header('Location: index.php?uc=inscription&action=demandeInscription');

            afficheErreur("Entrez votre identifiant et votre mot de passe ou enregistrez-vous sur la page 'S'inscrire', merci !");

            die;
        }

        if (password_verify($psw, $psw_bdd)) {
            $id_utilisateur = $data['id_utilisateur'];
            $identifiant = $data['identifiant'];
            echo "Bonjour " . "$identifiant" . " vous êtes connecté";
            return $id_utilisateur;
        }
        return false;
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
    public static function estValideInscription($nom, $prenom, $pseudo, $psw, $rue, $ville, $cp, $mail)
    {
        $erreurs = [];
        if ($nom == "") {
            $erreurs[] = "Il faut saisir le champ nom";
        }
        if ($prenom == "") {
            $erreurs[] = "Il faut saisir le champ nom";
        }
        if ($pseudo == "") {
            $erreurs[] = "Il faut saisir le champ pseudo";
        }
        if ($psw == "") {
            $erreurs[] = "Il faut saisir le champ mot de passe";
        } else if (!estUnPwd($psw)) {
            $erreurs[] = "Votre mot de passe doit contenir au moins 8 caractères dont: 1 lettre, 1 chiffre et 1 caractère spécial";
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
    // /**
    //  * creer une ville
    //  *
    //  * @param [chaîne] $ville
    //  * @param [INT] $cp
    //  * @return :$id_ville
    //  */
    // public static function creerVille($ville, $cp)
    // {
    //     $pdo = AccesDonnees::getPdo();
    //     $req = "SELECT ville.id_ville FROM ville WHERE nom_ville = :ville AND cp= :cp";
    //     $statement = AccesDonnees::getPdo()->prepare($req);
    //     $statement->bindParam(':ville', $ville, PDO::PARAM_STR);
    //     $statement->bindParam(':cp', $cp, PDO::PARAM_INT);
    //     $statement->execute();
    //     $id_ville = $statement->fetchColumn();

    //     if ($id_ville == false) {
    //         $req = "INSERT INTO ville (nom_ville, cp) VALUES (:ville,:cp)";
    //         $statement = AccesDonnees::getPdo()->prepare($req);
    //         $statement->bindParam(':ville', $ville, PDO::PARAM_STR);
    //         $statement->bindParam(':cp', $cp, PDO::PARAM_INT);
    //         $statement->execute();
    //         $id_ville = AccesDonnees::getPdo()->lastInsertId();
    //         return $id_ville;
    //     }
    // }

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


    // function register(String $pseudo, String $psw): bool
    // {
    //     $conn = $this->connexion();
    //     $psw = password_hash($psw, PASSWORD_BCRYPT);
    //     $sql = "INSERT INTO utilisateur (identifiant, mot_de_passe)
    //     VALUES(:pseudo, :psw);";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->bindParam(":pseudo", $pseudo);
    //     $stmt->bindParam(":psw", $psw);
    //     return $stmt->execute();
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
    /**
     * creer un nouveau utilisateur
     *
     * @param [chaîne] $pseudo
     * @param [chaîne] $psw
     * @return void
     */
    public static function creerUtilisateur($pseudo, $psw, $id_client)
    {

        $pdo = AccesDonnees::getPdo();
        $req = "SELECT id_utilisateur FROM utilisateur WHERE identifiant = :pseudo";
        $statement = AccesDonnees::getPdo()->prepare($req);
        $statement->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $statement->execute();
        $id_Utilisateur = $statement->fetchColumn();

        if ($id_Utilisateur == false) {
            $psw = password_hash($psw, PASSWORD_BCRYPT);
            $req = "INSERT INTO utilisateur (identifiant, mot_de_passe, client_id) VALUES (:pseudo,:psw, :client_id)";
            $statement = AccesDonnees::getPdo()->prepare($req);
            $statement->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
            $statement->bindParam(':psw', $psw, PDO::PARAM_STR);
            $statement->bindParam(':client_id', $id_client, PDO::PARAM_INT);
            $statement->execute();
            $id_Utilisateur = $statement->fetchColumn();
            $id_Utilisateur = $pdo->lastInsertId();
        }
        return $id_Utilisateur;
    }

    public static function changerInfoClient($id, $nom, $prenom, $rue, $cp, $ville, $mail) {
        if($erreurs = static::estProfilValide($nom, $prenom, $rue, $cp, $ville, $mail)) {
            return $erreurs;
        }
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare("UPDATE client SET nom = :nom, prenom = :prenom, adresse_rue = :rue, cp = :cp, ville = :ville, mail = :mail WHERE client.id = :id");
        $stmt->bindParam(":nom", $nom);
        $stmt->bindParam(":prenom", $prenom);
        $stmt->bindParam(":rue", $rue);
        $stmt->bindParam(":cp", $cp);
        $stmt->bindParam(":ville", $ville);
        $stmt->bindParam(":mail", $mail);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

    }

    public static function estProfilValide($nom, $prenom, $rue, $cp, $ville, $mail) {
        $erreurs = [];
        if ($nom == "") {
            $erreurs[] = "Il faut saisir le champ nom";
        }
        if ($prenom == "") {
            $erreurs[] = "Il faut saisir le champ prenom";
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
    public static function trouverClientParId($id_client) {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare("SELECT * FROM client WHERE id_client = :id_client");
        $stmt->bindParam(":id_client", $id_client);
        $stmt->execute();
        $client = $stmt->fetch(PDO::FETCH_ASSOC);
        return $client;
    }
}
