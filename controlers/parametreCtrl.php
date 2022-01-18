<?php
include_once('models/register.php');
$formError = array();
// Ici c'est les conditions pour verifier le champ d'inscriptions
if (isset($_POST['inscription'])) {
    $user = new register(); // J'instencie l'objet register
    //Ici je verifie si le champ userName exist et n'est pas vide
    if (!empty($_POST['nom'])) {
        $user->nom = htmlspecialchars($_POST['nom']);
    } else {
        $formError['nom'] = 'Veuillez remplir le champ nom';
    }
    //Ici je verifie si le champ userName exist et n'est pas vide
    if (!empty($_POST['prenom'])) {
      $user->prenom = htmlspecialchars($_POST['prenom']);
    } else {
        $formError['prenom'] = 'Veuillez remplir le champ prenom';
    }
    if (!empty($_POST['phone'])) {
      $user->phone = htmlspecialchars($_POST['phone']);
    } else {
        $formError['phone'] = 'Veuillez remplir le champ numéro de téléphone';
    }
    // Ici c'est la verification du champ mot de passe
    if (!empty($_POST['pass'])) {
        if (!empty($_POST['pass'])&& mb_strlen($_POST['pass']) >= 8) {
            // if (!empty($_POST['confimPassword'])) {
                // if ($_POST['password'] === $_POST['confimPassword']) {
                    //Avec password_hash est une fonction PHP de hachage de mot de passe
                    //Le hashage de mot de passe est l'une des pratiques de sécurité.
                    //C'est une fonction qui va calculer une empreinte (ou signature) unique à partir des données fournies.
                    $user->pass = password_hash($_POST['pass'], PASSWORD_BCRYPT); //L'utilisation de la constante PASSWORD_BCRYPT pour l'algorithme fera que le paramètre password sera tronqué à une longueur maximale de 72 caractères
                // } else {
                //     $formError['confimPassword'] = 'Le mot de passe n\'est pas conforme au premier';
                // }
            // } else {
            //     $formError['confimPassword'] = 'Veuillez confirmer le mot de passe';
            // }
        } else {
            $formError['pass'] = 'Le mot de passe doit être plus de 8 caractères';
        }
    } else {
        $formError['pass'] = 'Veuillez remplir le champ du mot de passe';
    }
     
    if (count($formError) == 0) {
            //on verifie si l'utilisateur existe déjà
            $userExists = $user->isUserExists();
            //S'il n'existe pas 
            if (!$userExists->userExists) {
                //On crée l'utilisateur (INSERT INTO)
                $userRegister = $user->createdUser();
                $success = 'Le profil a bien été créé !';
                header('Location: inscription.php');
                exit;
            } else {
                $error = 'L\'adresse mail ou le nom d\'utilisateur est déjà inscrite';
                header('Location: inscription.php');
                exit;
            }
        }
}
