<?php
//On instancie l'objet register() 
$userLogin = new register(); 
if (isset($_POST['connexionButton'])){
    //On stock dans un tableau les erreurs pendant la verification
    $formErrorLogin = array();   
    if (!empty($_POST['email'])){
        // si la saisie est bien un format email avec la fonction felter_var()permet de verifier une variable, FILTER_VALIDATE_EMAIL permet de verifier si c'est bien un e-mail
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            //On recupère par la fonction htmlspecialchars() le mail pour éviter l'envoie des script (JS ou PHP) 
            //parce que celle-là sert desactiver les caractères speciaux
            $mail = $_POST['email'];
            //var_dump($userLogin->setEmail($mail));
            $userLogin->setEmail($mail);
            //var_dump($userLogin->getEmail($mail) );
        } else {
            $formErrorLogin['email'] = 'Mettez une adresse dans le bon format';
        }
    } else {
        $formErrorLogin['email'] = 'Le champ de l\'adresse e-mail est vide';
    }
    if (empty($_POST['password'])){
        $formErrorLogin['password'] = 'Le champ de mot de passe est vide';
    }
    
    if (count($formErrorLogin) == 0){ // Avant de connecté sur un profil, on verifie si il y a des erreur
        //Ici on appelle la méthode getInfoUser() pour selectionner les informations de l'utilisateur pour la connexion
        //var_dump($userLogin->getEmail($mail));
        $userInfo = $userLogin->getInfoUser(); 
        //var_dump($userInfo);
        //Donc on verifie si $userInfo est un objet
        if (is_object($userInfo)) {            
            //On verifie si le mot de passe saisie correspod à celui dans la base de donnée
            //password_verify: Vérifie qu'un mot de passe correspond à un hachage
            //var_dump($userInfo->motdepasse);
                if (password_verify($_POST['password'], $userInfo->motdepasse)) { 
                    //var_dump($userInfo->id);
                    //On stock dans le tableau associatif $_SESSION['userId'] l'id d'utilisateur connecté
                    $_SESSION['userId'] = $userInfo->id; 
                    //On stock dans le tableau associatif $_SESSION['username'] l'nom d'utilisateur connecté
                    $_SESSION['username'] = $userInfo->prenom;  
                    //Et on affiche cette variable $success dans la view 
                    $success = 'Connecté'; 
                    //var_dump($_SESSION);
                    //la fonction header('location: la page') rediriger la connexion vers la page indiqué
                    header('location:profil.php'); 
                    exit();
                } else {
                    $failed = 'Le mot de passe n\'est pas validé';
                }
        } else {
            $failed = 'Le profil n\'existe pas';
        }
    }
}
//$profilUsers = $userLogin->getUserProfil($_SESSION['userId']); //Cette attribut $profilUsers sert à affiche les informations de l'utilisateur sur la page profile

