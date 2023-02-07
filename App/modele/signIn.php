<?php
include 'APP/controleur/c_session.php';


function is_existe(String $str): bool{
    return isset($str) && !empty($str);
}

$pseudo = trim(filter_input(INPUT_POST, "pseudo"));
$psw = filter_input(INPUT_POST, "psw");

if (is_existe($pseudo) && is_existe($psw)){
    $mysession = new M_Session();
    echo $mysession->register($pseudo,$psw) ? " opération réussie ":"Erreurbb";
} else{
    echo " erreur ";
}