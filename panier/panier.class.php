<?php
class Panier{
    //Pour avoir la connexion de la base de donnée dans la classe db.class.php
    private $db;//J'initialise un attribut $db
    public function __construct($db){
        //Si la session n'existe pas j'initialise la session avec session_start
        if(!isset($_SESSION)){
            session_start();
        }
        //Si $_SESSION['panier'] n'existe pas, j'initialise la $_SESSION['panier'] à un tableau
        if(!isset($_SESSION['panier'])){
            $_SESSION['panier'] = array();
        }
        $this->db = $db;//J'initialise un attribut $db
    }
    /**
     *@return 
     *ajoute des produit dans le panier
     *Quand j'ajoute le produit dans le panier, l'id du produit est l'index du tableau
     *et la valeur egal 1 (la quantité)
     */
    public function add($product_id)
    {
        //Je teste si j'ai déjà un produit defini dans mon panier
        if(isset($_SESSION['panier'][$product_id])){
            //J'incrémente la quantité
            $_SESSION['panier'][$product_id]++;
        } else{//Sinon la quantité égal à 1 
            $_SESSION['panier'][$product_id] = 1;
        }
    }
    /**
     *@return
     *Retirer un produit dans le panier
     */
    /* public function retire($product_id){
        
         $_SESSION['panier'][$product_id] = $product_id;
            $_SESSION['panier'][$product_id]--;
            var_dump($_SESSION['panier'][$product_id]);
	} */
    /**
     *@return
     *Supprime un produit dans le panier
     */
    public function del($product_id){
		unset($_SESSION['panier'][$product_id]);
	}

    public function count(){
		return array_sum($_SESSION['panier']);
	}
    /**
     *@return 
     *Calcule la total du prix dans le panier
     */
    public function total(){
		$total = 0;//On initialise la variable à zéro
		$ids = array_keys($_SESSION['panier']);//Je prend les id des produit avec array_keys dans le tableau $_SESSION['panier']
		if(empty($ids)){//si la variable $ids est vide, je mis la variable $product en tableau vide
			$products = array();
		}else{//sinon on passe la requête dans laquelle je prend l'id et le prix
			$products = $this->db->query('SELECT id, prix_unitaire FROM listeproduits WHERE id IN ('.implode(',',$ids).')');
		}
        //On parcours le tableau de la réponse de la requête
		foreach( $products as $product ) {
            //Je la somme du prix des produits dans le tableau $_SESSION['panier'] fois la quantité
			$total += $product->prix_unitaire * $_SESSION['panier'][$product->id];
		}
		return $total;
	}

}