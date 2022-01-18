<?php
// J'instencie l'objet register
$user = new register();
//Si la variable superglobale $_SESSION['userId'] existe on recupère l'id de l'utilisateur et le met dans la session
if (isset($_SESSION['userId'])) {
    var_dump($_SESSION['userId']);
   //$_SESSION['userId'] = $user->getId();
    //On récupère les information de l'utilisateur connecté
    $profil = $user->getUserProfil($_SESSION['userId']);
     var_dump($_SESSION['userId']);
}
//On affiche les information de l'utilisateur
//$usersGetInfo = $user->getInfoUser();
