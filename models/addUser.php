<?php







// var_dump($_POST);
// //récuperer les données
// // if(isset($_POST['prenom'])){
// //     $prenom = $_POST['prenom']; 
// // }
// //verif
// $nom = isset($_POST['nom']) ? trim($_POST['nom']) : '';
// $prenom = isset($_POST['prenom']) ? trim($_POST['prenom']) : '';
// $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
// $email = isset($_POST['email']) ? $_POST['email'] : '';
// $pass = isset($_POST['pass']) ? $_POST['pass'] : '';
// //Initialiser le tableau des erreurs $erreurs
// $erreurs = [];
// //valider les données
// //Valider $prenom
// if(empty($nom) && preg_match('/\^[A-zÀ-û]{1,}\$/', $nom) === 0){
//     //ajouter un message d'erreur dans le tableau $erreurs
//     $erreurs['nom'] = 'le champ nom n\'est valide';
// }
// //Valider $prenom
// if(empty($prenom) && preg_match('/\^[A-zÀ-û]{1,}\$/', $prenom) === 0){
//     //ajouter un message d'erreur dans le tableau $erreurs
//     $erreurs['prenom'] = 'le champ prenom n\'est valide';
// }
// //Valider le numéro de téléphone
// if(empty($phone) === 0){
//     //ajouter un message d'erreur dans le tableau $erreurs
//     $erreurs['phone'] = 'le champ numéro de téléphone n\'est valide';
// }
// //Pour l'adresse email
// $email = 'odiletot@gmail.com';
// if(empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) === 0){
//     //ajouter un message d'erreur dans le tableau $erreurs
//     $erreurs['pass'] = 'le champ mot de passe n\'est valide';
// }
// if(empty($pass) === 0){
//     //ajouter un message d'erreur dans le tableau $erreurs
//     $erreurs['pass'] = 'le champ mot de passe n\'est valide';
// }
// // //Valider $age : $age >= 12 <= 130
// // if(empty($age) && ($age < 12 || $age > 130)){
// //     //ajouter un message d'erreur dans le tableau $erreurs
// //     $erreurs['age'] = 'l\'age n\'est valide';
// // }
// // //valider $taille : $taille >= 0.50 <= 2.50
// // if(empty($taille) && ($taille < 0.50 || $taille > 2.50)){
// //     //ajouter un message d'erreur dans le tableau $erreurs
// //     $erreurs['taille'] = 'le taille n\'est valide';
// // }
// // if(empty($genre) && ($genre != 'homme' && $genre != 'femme')){
// //     //ajouter un message d'erreur dans le tableau $erreurs
// //     $erreurs['genre'] = 'le genre n\'est valide';
// // }
// //Protection contre attaque xss
// $nom = htmlspecialchars($nom);
// $prenom = htmlspecialchars($prenom);
// $phone = htmlspecialchars($phone);
// $email = htmlspecialchars($email);
// $pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);
// //Si echec de validation,
// //rediriger vers la page de formulaire avec des messages d'erreur et les données saisies
// if(count($erreurs) > 0){//Si le tableau erreur n'est pas vide
//     $_SESSION['inscription-donnees']['nom'] = $nom;
//     $_SESSION['inscription-donnees']['prenom'] = $prenom;
//     $_SESSION['inscription-donnees']['phone'] = $phone;
//     $_SESSION['inscription-donnees']['email'] = $email;
//     $_SESSION['inscription-donnees']['pass'] = $pass;
//     $_SESSION['inscription-donnees'] = $erreurs;
//     header("location: inscription.php");//redirection avec le code HTTP 302
//     exit;
// }
//Sinon,
//On stocke les données dans la BDD
try{
    $dsn = 'mysql:host=localhost;port=3306;dbname=filrouge';
    $options = [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION];
    $pdo = new PDO($dsn, 'root', '', $options);
    $sql ='insert into utilisateurs (nom, prenom, email, numPhone, motdepasse) values(:nom, :prenom, :email, :numPhone, :motdepasse)';
    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement->execute(
        array(
            ':nom' =>$nom,
            ':prenom'=>$prenom,
            ':email'=>$email,
            ':numPhone'=>$phone,
            ':motdepasse'=>$pass
        )
    );
    echo'<div class="jumbotron">membre '.$nom.' a été ajouté</div>';
}catch(Exception $ex){
    $_SESSION['membre-add-form-erreur-sql'] = $ex->getMessage();
    header("location: inscription.php");
    exit;
}