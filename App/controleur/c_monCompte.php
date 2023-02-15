
<?php
include "App/modele/M_Commande.php";
include 'APP/modele/M_session.php';

switch ($action) {

  case 'loginClient':
    $identifiant = filter_input(INPUT_POST, 'identifiant');
    $mot_de_passe = filter_input(INPUT_POST, 'mot_de_passe');
    $client = M_session::checkPassword($identifiant, $mot_de_passe);
var_dump($client);
    if (!$client) {
      afficheErreur("Entrez votre identifiant et votre mot de passe ou enregistrez-vous sur la page 'S'inscrire', merci !");
    } else {
      $_SESSION['id'] = $client;
      // supprimerPanier();
      header('Location: index.php?uc=accueil&action=voirAll');
    }
    break;

  case 'logoutClient':
    // supprimerPanier();
    unset($_SESSION['client']);
    header('Location: index.php');
    die();
    break;
}


$commandesClient = [];

if (!empty($clientSession)) {
    $commandesClient = M_Commande::afficherCommandes($clientSession['id']);
}

switch ($action) {
    case "changerProfil":
        $nom = filter_input(INPUT_POST, "nom");
        $prenom = filter_input(INPUT_POST, "prenom");
        $rue = filter_input(INPUT_POST, "rue");
        $cp = filter_input(INPUT_POST, "cp");
        $ville = filter_input(INPUT_POST, "ville");
        $mail = filter_input(INPUT_POST, "mail");
        $erreurs = M_session::changerInfoClient($clientSession['id'], $nom, $prenom, $rue, $cp, $ville, $mail);

        if ($erreurs) {
            afficheErreurs($erreurs);
        } else {
            afficheMessage("Vos changements ont bien été enregistrés.");
        }

        $_SESSION['client'] = M_session::trouverClientParId($clientSession['id']);

        header("Location: index.php?uc=compte");
        die();
        break;

    default:
        break;
}
















// $connexion = filter_input(INPUT_POST, 'connexion');

// if ($connexion !=="Connexion"){
//   echo "recommence";
//   die;
// }


// // Ouvrir/réactiver la session. 
// // Tester si la session est nouvelle (cad ouverte par 
// // l’appel session_start() ci-dessus) ou ancienne (cad ouverte 
// //par un appel antérieur à session_start()). 
// // Le mieux est de tester si une de nos variables de session 
// // est déjà enregistrée. 
// // session_start(); 

// // if (! isset($_SESSION["date"]) ) { 
// //   // Variable "date" pas encore enregistrée. 
// //   // => nouvelle session. 
// //   // => ouvrir la session au niveau applicatif. 
// //   // Pour cet exemple : 
// //   //   - déterminer la date/heure d’ouverture de la session. 
// //   $date = date('\l\e d/m/Y à H:i:s'); 
// //   //   - enregistrer la date/heure d’ouverture de la session. 
// //   $_SESSION["date"] = $date; 
// //   //   - récupérer l’identifiant de la session (pour info). 
// //   $session = session_id(); 
// //   //   - préparer un message. 
// //   $message = "Nouvelle session :". $session ." ouvert ". "$date"; 
// // } else { 
// //   // Variable "date" déjà enregistrée. 
// //   // => ancienne session. 
// //   // => récupérer les variables de session utilisées  
// //   //    dans ce script. 
// //   // Pour cet exemple : 
// //   //   - date/heure d’ouverture de la session. 
// //   $date = $_SESSION["date"]; 
// //   //   - récupérer l’identifiant de la session (pour info). 
// //   $session = session_id(); 
// //   //   - préparer un message. 
// //   $message = "Session déjà ouverte: $session - $date"; 
// // } 
// // // Détermination de la date et de l’heure actuelle (pas celle 
// // // de l’ouverture de la session). 
// // $actuel = 'Nous sommes le '.date('d/m/Y'). 
// //           ' ; et il est '.date('H:i:s'); 
// //           echo ($message."<br>");
// //           echo ($actuel."<br>");
// //   // Inclusion du fichier contenant les fonctions générales.


// if ($connexion == "Connexion") {
//   // Récupérer les information saisies.
//   $identifiant = filter_input(INPUT_POST, 'identifiant');
//   $mot_de_passe = filter_input(INPUT_POST, 'mot_de_passe');
//   $mySession = new M_Session();
// // Initialisation des variables.
// $message = '';
// // Traitement du formulaire.
//   // Vérifier que l'utilisateur existe.
// $_SESSION['id']= $mySession->checkPassword($identifiant,$mot_de_passe);
// if ($_SESSION['id']==true){
//   echo ", Bienvenue!!!";

//   header('location: index.php?uc=accueil&action=voirAll');
//   return $_SESSION['id'];
// }
// } 
?>






