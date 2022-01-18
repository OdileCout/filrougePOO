<?php
include_once('entete.php');
include_once('panier/panier.class.php');
include_once('panier/db.class.php');
    $DB = new Db();
    $Panier = new Panier($DB);
    $message = array();
if(isset($_GET['id'])){
    //Je passe une requête pour pour afficher le produit quand je fait l'ajout (appel de la fonction add()) 
    $products = $DB->query('SELECT id FROM listeproduits WHERE id = :id', array('id' => $_GET['id']));
    if(empty($products)){
        echo("Ce produit n'existe pas");
    }
    //J'appelle la methode add() dans ma class Panier
    $Panier->add($products[0]->id);
    $message['retour'] = 'Retour à la boutique';
}else{
    $erreur = ('Vous n\'avez pas séléctionné de produit à ajouter au panier');
}

    //Pour supprimer un produit dans le panier
    if(isset($_GET['del'])){
        $Panier->del($_GET['del']);
    }

    $ids = array_keys($_SESSION['panier']);
    /*Pour eviter une erreur quand il n'y a plus de produit dans le panier
     si la variable $ids est vide, je mis la variable $product en tableau vide*/
    if(empty($ids)){
        $product = array();
    }else{//Sinon elle continu a faire la requête
        $product = $DB->query('SELECT * FROM listeproduits WHERE id IN ('.implode(',',$ids).')');
    }
?>
<div class="table container pb-5 pt-5">
    <div class="mb-4">
        <?php
        if(isset($message['retour'])){ ?>
            <button class="btn btn-success"><a href="javascript:history.back()" style="color:white; text-decoration:none;"> <?= $message['retour'] ?></a></button>
        <?php } ?>
    </div>
    <form method="post" action="showPanier.php">
        <div class="wrap">
            <div class="rowtitle">
                <span class="name">Nom de produit</span>
                <span class="price">Prix</span>
                <span class="quantity">quantité</span>
                <span class="subtotal">Prix avecTVA</span>
                <span class="action">Actions</span>
            </div>
        <?php if(isset($_SESSION['panier']) && !empty($_SESSION['panier'])){ 
                foreach($product as $prod){  
     /*                    if(isset($_GET['retire'])){
        var_dump($_GET['retire']);
        $Panier->retire($_GET['retire']); 
    }*/
        ?>
                <div class="row">
                    <!-- <a href="3" class="img"><img src="assets/img/boutique/%g.jpg" alt="produit"></a> -->
                    <span class="name"><?= (isset($prod->nom_produit)) ? $prod->nom_produit : '' ?></span>
                    <span class="price"><?= (isset($prod->prix_unitaire)) ? number_format($prod->prix_unitaire, 2, '.', ' ').' €' : ''  ?></span>
                    <!-- J'affiche la quantité dans $_SESSION['panier'][$prod->id] qui est égale à 1 au début et qui s'incrémente au clic sur le même produit -->
                    <span class="quantity"><?= $_SESSION['panier'][$prod->id] ?><a href="showPanier.php?retire="><img src="assets/img/boutique/del.png" alt="" srcset=""></a></span>
                    <span class="subtotal"><?= (isset($prod->nom_produit)) ? number_format(($prod->prix_unitaire * $_SESSION['panier'][$prod->id]) * 1.196,2, ',',' ').' €' : '' ?></span>
                    <span class="action">
                        <a href="showPanier.php?del=<?= $prod->id ?>"><img src="assets/img/boutique/del.png" alt="" srcset=""></a>
                    </span>
                </div>
        <?php } 
        } else{?>
                <div class="row">
                    <span class="pl-5"><?= (isset($erreur)) ? $erreur : '' ?></span>
                </div>
        <?php } ?>
            <div class="grandTotal"> <!-- la fonction number_format() retourne des chiffres à virgule, elle prend 2 ou 4 argument -->
                Grand total : <span class="total"><?= number_format($Panier->total() * 1.196,2,',',' '); ?> € </span>
            </div>
        </div>
    </form>
</div>
<?php
    include_once('piedPage.php');
 ?>
 