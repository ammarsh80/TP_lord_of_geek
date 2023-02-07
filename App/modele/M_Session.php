<?php
class M_Session
{
    private function connexion(): PDO
    {
        // Connexion et sélection de la base de données :
        try {
            $conn = new PDO("mysql:host=localhost:8080;dbname=ma_base_jeux", "root", "MajdAhmad023716292)");
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
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
        $sql = 'SELECT 1 FROM utilisateurs ';
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
        $sql = "INSERT INTO utilisateurs (identifiant, mot_de_passe)
        VALUES(:pseudo, :psw);";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":pseudo", $pseudo);
        $stmt->bindParam(":psw", $psw);
        return $stmt->execute();
    }
    public function checkPassword(String $pseudo, String $psw)
    {
        $conn = $this->connexion();
        $sql = "SELECT id, mot_de_passe FROM utilisateurs WHERE identifiant = :pseudo";
        // prepare and bind
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":pseudo", $pseudo);
        // Exécution
        $stmt->execute();

        $data = $stmt->fetch();
        $psw_bdd = $data['mot_de_passe'];

        if (!password_verify($psw, $psw_bdd)) {
            $data = false;
        }
        return $data['id'];
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
    /**
     * creer une ville
     *
     * @param [chaîne] $ville
     * @param [INT] $cp
     * @return :$id_ville
     */
    public static function creerVille($ville, $cp)
    {
        $req = "INSERT INTO ville (nom_ville, cp) VALUES (:ville,:cp)";
        $statement = AccesDonnees::getPdo()->prepare($req);
        $statement->bindParam(':ville', $ville, PDO::PARAM_STR);
        $statement->bindParam(':cp', $cp, PDO::PARAM_INT);
        $statement->execute();
        $id_ville = AccesDonnees::getPdo()->lastInsertId();
        return $id_ville;
    }
  /**
   * creer un nouveau utilisateur
   *
   * @param [chaîne] $pseudo
   * @param [chaîne] $psw
   * @return void
   */
    public static function creerUtilisateur($pseudo, $psw ,$idclient)
    {
        $pdo = AccesDonnees::getPdo();
        $req = "INSERT INTO utilisateur (identifiant, mot_de_passe, client_id) VALUES (:pseudo,:psw, :client_id)";
        $statement = AccesDonnees::getPdo()->prepare($req);
        $statement->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $statement->bindParam(':psw', $psw, PDO::PARAM_STR);
        $statement->bindParam(':client_id', $idclient, PDO::PARAM_INT);
        $statement->execute();
        $idUtilisateur = $statement->fetchColumn();
        $idUtilisateur = $pdo->lastInsertId();
        return $idUtilisateur;
    }

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
    public static function creerClient($nom, $prenom, $adresse, $email, $ville_id)
    {
        $pdo = AccesDonnees::getPdo();
        $req = "INSERT INTO client (nom, prenom, adresse, email, ville_id) VALUES (:nom,:prenom,:adresse,:email,:ville_id)";
        $statement = AccesDonnees::getPdo()->prepare($req);
        $statement->bindParam(':nom', $nom, PDO::PARAM_STR);
        $statement->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $statement->bindParam(':adresse', $adresse, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':ville_id', $ville_id, PDO::PARAM_INT);
        $statement->execute();
        $idclient = $statement->fetchColumn();
        $idclient = $pdo->lastInsertId();
        return $idclient;
    }
}
