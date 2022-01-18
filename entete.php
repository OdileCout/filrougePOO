<?php session_start();
/*crée une session ou restaure celle trouvée sur le serveur, via l'identifiant de session passé 
dans une requête GET, POST ou par un cookie.*/

?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>EXO-JUS</title>
</head>

<body>
    <div class="headerDiv">
        <header id="slider">            
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="navba">
                    <a class="" href="index.php"><p class="logo"></p></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Accueil<span></span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="boutique.php">Boutique</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contact.php">Contact</a>
                            </li>
                            <?php 
                                if (isset($_SESSION['userId'])){?>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-user" style="color:white"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="profil.php?id=<?= $_SESSION['userId'] ?>">profil</a>
                                        <a class="dropdown-item" href="parametre.php">parametres</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="controlers/deconnexion.php">Deconnexion</a>
                                        </div>
                                    </li> 
                               <?php  } else{?>
                                <li class="nav-item">
                                    <a class="nav-link" href="connexion.php">Compte</a>
                                </li>
                            <?php }?>
                            <li class="nav-item caddie">
                                <a class="nav-link" href="showPanier.php"><i class="fas fa-cart-plus" style="color:white; font-size:2rem"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="boxHeader">
                <div class="texteHeader">
                    <div class="textheader">
                        <p>Lorem ipsum dolor sit amet, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint
                            occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        <button type="button" name="button">En savoir plus</button>
                    </div>
                </div>
            </div>
            <img src="assets/img/12.jpg" alt="La forêt de peupliers" id="slide">
        </header>
    </div>







