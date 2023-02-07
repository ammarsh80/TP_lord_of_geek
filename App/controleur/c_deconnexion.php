<?php

echo "vous êtes deconnecté";
session_start();
session_destroy();
header('location: index.php?uc=accueil&action=voirAll');
exit;