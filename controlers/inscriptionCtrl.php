<?php
include_once('models/register.php');

/* function isAjax() {
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
} */

$formError = array();
// Ici c'est les conditions pour verifier le champ d'inscriptions
if (isset($_POST['inscription'])) {
    $user = new register(); // J'instencie l'objet register
    //Ici je verifie si le champ userName exist et n'est pas vide
    if (!empty($_POST['nom'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $user->setNom($nom);
    } else {
        $formError['nom'] = 'Veuillez remplir le champ nom';
    }
    //Ici je verifie si le champ userName exist et n'est pas vide
    if (!empty($_POST['prenom'])) {
        $prenom = htmlspecialchars($_POST['prenom']);
        $user->setPrenom($prenom);
    } else {
        $formError['prenom'] = 'Veuillez remplir le champ prenom';
    }
    if (!empty($_POST['phone'])) {
        $phone = htmlspecialchars($_POST['phone']);
        $user->setPhone($phone);
    } else {
        $formError['phone'] = 'Veuillez remplir le champ numéro de téléphone';
    }
    // Ici Je fais la verification sur le champ adresse emeil
    if (!empty($_POST['email'])) { // si le champ n'est pas vide
        // si la saisie est bien un format email avec la fonction felter_var() qui permet de verifier une variable, FILTER_VALIDATE_EMAIL permet de verifier si c'est bien un e-mail
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            // si les conditions sont rempli on recupère la saisie
            $email = htmlspecialchars($_POST['email']);
            $user->setEmail($email); // htmlspecialchars() permet d'eviter les injections sql   
        } else {
            // si non on affiche cette erreur si la deuxième condition n'est pas rempli
            $formError['email'] = 'Le champ doit être rempli par un text de format e-mail';
        }
    } else {
        // si non on affiche cette erreur si la troisième condition n'est pas rempli
        $formError['email'] = 'Veillez remplir le champ adresse e-mail';
    }
    // Ici c'est la verification du champ mot de passe
    if (!empty($_POST['pass'])) {
        if (!empty($_POST['pass'])&& mb_strlen($_POST['pass']) >= 8) {
            // if (!empty($_POST['confimPassword'])) {
                // if ($_POST['password'] === $_POST['confimPassword']) {
                    //Avec password_hash est une fonction PHP de hachage de mot de passe
                    //Le hashage de mot de passe est l'une des pratiques de sécurité.
                    //C'est une fonction qui va calculer une empreinte (ou signature) unique à partir des données fournies.
                    $pass = password_hash($_POST['pass'], PASSWORD_BCRYPT); 
                    $user->setPass($pass); //L'utilisation de la constante PASSWORD_BCRYPT pour l'algorithme fera que le paramètre password sera tronqué à une longueur maximale de 72 caractères
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
     
    //Capture des erreurs avec Ajax
    /*  if (!empty($formError)) {
        if(isAjax()){
           
            echo json_decode($formError);
            header('Content-Type: application/json');
            http_response_code(400);
            die();
        }
        var_dump($formError);
        header('Location: inscription.php');
     } else {
        if(isAjax()) {
            echo json_encode(['success' => 'Bravo !']);
            header('Content-Type: application/json');
            die();
        }
        
    } */
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
