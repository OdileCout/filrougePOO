<?php 
include('models/constante.php');

if(isset($_GET['id'])){
    $message = array();
    //unset($_SESSION['panier']);
      
        $idprod = $_GET['id'];
        $valeur = 1;
        $quantité = 0;
        if(empty($_SESSION['panier']) && !isset($_SESSION['panier'])){
               // var_dump($row);
                $_SESSION['panier'] = array();
                array_push($_SESSION['panier'], $idprod);
        }else{   
            if(in_array($idprod, $_SESSION['panier'])){
                $valeur++;
                $quantité = $valeur;
            }else{
                //Je rentre le id dans le tableau de la session
                array_push($_SESSION['panier'], $idprod);
                /* unset($_SESSION['panier']); */ 
            }  
        }
    try{
        $keys = array_keys($_SESSION['panier']);
        $sql = 'SELECT `id`, `nom_produit`, `description`, `prix_unitaire`, `quantite_disponibles`, `numeroImage` 
        FROM `listeproduits` 
        WHERE `id`
        IN('.implode(',',$keys).')';
        $row = query($sql);
        var_dump($row); 
      
        var_dump($quantité);
        var_dump($_SESSION['panier']);
        if(!isset($row)){
            $message['erreur'] ='Ce produit n\'existe pas';
        }
        if(isset($_SESSION['panier'])){
        $message['panier'] = 'le produit a bien été ajouté dans votre panier'; 
        $message['retour'] ='retourner voir le cathalogue';
        }
    } catch (PDOException $err){
        echo $err->getMessage();
    }
 }else{
    die('Vous n\'avez pas selectionner un produit');
}

function query($sql){
    $dsn = 'mysql:host='.HOST.';port='.PORT.';dbname='.DATA;
    $options = [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION];
    $pdo = new PDO($dsn, USER, PASS, $options);
    $query =  $pdo->prepare($sql);
    //$query->bindValue(':id', $data, PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_OBJ);
}