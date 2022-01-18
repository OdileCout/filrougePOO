<?php
include_once('database.php');
class Listeproduit extends database { 
    private $id;
    private $nom_produit;
    private $description;
    private $prix_unitaire;
    private $quantite_disponibles;

    /* //Constructeur
    public function __construct(int $Newid=0, string $newnom_produit='', string $description='', float $prix_unitaire='', float $quantite_disponibles = '' ){
        $this->id = $Newid;
        $this->nom_produit = $newnom_produit;
        $this->description = $description;
        $this->prix_unitaire = $prix_unitaire;
        $this->quantite_disponibles = $quantite_disponibles;
        $this->setNom_produit($newnom_produit);
        $this->setDescription($description);
        $this->setPrix_unitaire($prix_unitaire);
        // On appelle la méthode du parent
        parent::__construct();
    } */
    //Accesseurs et mutateurs (ENCAPSULATION)
    public function getNom_produit(){
        return $this->nom_produit;
    }

    public function setNom_produit(string $newnom_produit){
        //Teste si param est une date
        if((bool) strtotime($newnom_produit)){
            $this->dob = $newnom_produit;
        }else{
            throw new Exception(__CLASS__.': Le parametre doit être une date');
        }
        
    }
    public function getWeight(){
        return $this->weight;
    }
    public function setDescription(float $newWeight){
        //Teste du poids si la valeur est entre 200g et 1tonne
        if($newWeight > .2 ||  $newWeight < 1000){
            $this->weight = $newWeight;
        }else{
            throw new Exception(__CLASS__.': Le doit être compris entre 200g et 1t');
        }
    }
    public function getFemale(){
        return $this->female;
    }
    public function setPrix_unitaire(bool $newFemale){
        $this->female = $newFemale;
    }
    //



}

