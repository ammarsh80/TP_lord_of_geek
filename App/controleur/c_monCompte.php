
<?php
session_destroy();

include 'APP/modele/M_session.php';

?>

<?php
// Inclusion du fichier contenant les fonctions générales.
$mySession = new M_Session();
// Initialisation des variables.
$message = '';
// Traitement du formulaire.
$formulaire_recu = filter_input(INPUT_POST, 'connexion');
if ($formulaire_recu == "Connexion") {
  // Récupérer les information saisies.
  $identifiant = filter_input(INPUT_POST, 'identifiant');
  $mot_de_passe = filter_input(INPUT_POST, 'mot_de_passe');
  // Vérifier que l'utilisateur existe.
$_SESSION['id']= $mySession->checkPassword($identifiant,$mot_de_passe);
if ($_SESSION['id']){
  echo " Bravoooooooooo!!!";
  return $_SESSION['id'];
}
//   var_dump($mySession->checkPassword($identifiant,$mot_de_passe));
}

// Ouvrir/réactiver la session. 
session_start(); 
// Tester si la session est nouvelle (cad ouverte par 
// l’appel session_start() ci-dessus) ou ancienne (cad ouverte 
//par un appel antérieur à session_start()). 
// Le mieux est de tester si une de nos variables de session 
// est déjà enregistrée. 
if (! isset($_SESSION["date"]) ) { 
  // Variable "date" pas encore enregistrée. 
  // => nouvelle session. 
  // => ouvrir la session au niveau applicatif. 
  // Pour cet exemple : 
  //   - déterminer la date/heure d’ouverture de la session. 
  $date = date('\l\e d/m/Y à H:i:s'); 
  //   - enregistrer la date/heure d’ouverture de la session. 
  $_SESSION["date"] = $date; 
  //   - récupérer l’identifiant de la session (pour info). 
  $session = session_id(); 
  //   - préparer un message. 
  $message = "Nouvelle session : $session - $date"; 
} else { 
  // Variable "date" déjà enregistrée. 
  // => ancienne session. 
  // => récupérer les variables de session utilisées  
  //    dans ce script. 
  // Pour cet exemple : 
  //   - date/heure d’ouverture de la session. 
  $date = $_SESSION["date"]; 
  //   - récupérer l’identifiant de la session (pour info). 
  $session = session_id(); 
  //   - préparer un message. 
  $message = "Session déjà ouverte: $session - $date"; 
} 
// Détermination de la date et de l’heure actuelle (pas celle 
// de l’ouverture de la session). 
$actuel = 'Nous sommes le '.date('d/m/Y'). 
          ' ; et il est '.date('H:i:s'); 
          echo ($message);
          echo ($actuel);
         
?>




