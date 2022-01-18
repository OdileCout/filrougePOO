<?php
class database { 
    /**
     * On a mis la méthode __construct pour pouvoir l'appeler à tout moment et 
     * si on veut le mettre dans un serveur on pourra faire des modification facilement 
     */

    protected $db = NULL; //Je declare mon attribut de la base de donnée à null
/**
 * Cette methode methode magic __construct gère la connection à la base de donnée
 */
    public function __construct() {
        //try and cath sert à gèrer les exeptions PHP
        //les exeptions sont 
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=filrouge;charset=utf8;', 'root', '');
        } catch (PDOException $ex) {
            die('Une erreur au niveau de la base de donnée s\'est produite !' . $ex->getMessage());
        }
    }

}