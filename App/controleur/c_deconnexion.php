<?php

session_destroy();
echo "vous êtes deconnecté";
header('location: index.php?uc=accueil&action=voirAll');
exit;