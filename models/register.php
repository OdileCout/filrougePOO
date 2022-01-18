<?php
include_once('database.php');
class register extends database { // extends sert à appler la classe database 
    //Ici je mes attribut que j'appellerai avec ma méthode dans la vue
        private $id;
        private $nom;
        private $prenom;
        private $phone;
        private $email;
        private $pass;
        private $date;
        private $role;
    
        //Ici c'est la méthode magic construct qui sert à connecté à la base de donnée et pour envoyer un message d'erreur au cas ou on ne peut pas se connecté
        public function __construct(int $id = 0, string $nom ='', string $prenom = '', int $phone = 0, string $email = '', string $pass = '', string $date = null, string $role = '' ) {
            // On appelle la méthode du parent
            parent::__construct();
            $this->setNom($nom);
            $this->setPrenom($prenom);
            $this->setPhone($phone);
            $this->setEmail($email);
            $this->setPass($pass);
            $this->setId($id);
            $this->setRole($role);
        }
        //Id
        public function getId(): ?int
        {
            return $this->id;
        }
        public function setId(int $id): int
        {
            $this->id = $id;

            return $this->id;
        }
        //Nom
         public function getNom(): ?string
        {
            return $this->nom;
        }

        public function setNom(string $nom): self
        {
            $this->nom = $nom;

            return $this;
        }
        //Prenom
        public function getPrenom(): ?string
        {
            return $this->prenom;
        }

        public function setPrenom(string $prenom): self
        {
            $this->prenom = $prenom;

            return $this;
        }
        //Phone
        public function getPhone(): ?int
        {
            return $this->phone;
        }

        public function setPhone(int $phone): self
        {
            $this->phone = $phone;

            return $this;
        }
        //Email
        public function getEmail(): ?string
        {
            return $this->email;
        }

        public function setEmail(string $email): self
        {
            $this->email = $email;

            return $this;
        }
        //Pass
        public function getPass(): ?string
        {
            return $this->pass;
        }

        public function setPass(string $pass): self
        {
            $this->pass = $pass;

            return $this;
        }
        //Date
        public function getDate(): ?int
        {
            return $this->date;
        }
        //Rôle utilisateur
        public function getRole(): ?string
        {
            return $this->role;
        }

        public function setRole(string $role): self
        {
            $this->role = $role;

            return $this;
        }
        /**
         * Cette méthode permet d'inserer l'inscription de l'utilisateur 
         * @return type booléen
         */
        public function createdUser() {
            $query = 'INSERT INTO `utilisateurs` (`nom`,`prenom`,`numPhone`,`email`,`motdepasse`) '
                    . 'VALUES (:nom, :prenom,:phone,:email,:pass)';
            $pdoStatment = $this->db->prepare($query); //On prepare la requette dans l'attribut $query
            $pdoStatment->bindValue(':nom', $this->getNom(), PDO::PARAM_STR); //On donne la valeur au marquer nominatif mais en même temps on le protège de l'injection sql avec "bindvalue et PDO::PARAM_STR"
            $pdoStatment->bindValue(':prenom', $this->getPrenom(), PDO::PARAM_STR); // PDO::PARAM_STR sert à paramètrer la valeur en indiquant le type, donc ça le protège des injection sql
            $pdoStatment->bindValue(':phone', $this->getPhone(), PDO::PARAM_STR);
            $pdoStatment->bindValue(':email', $this->getEmail(), PDO::PARAM_STR); // PDO::PARAM_STR sert à paramètrer la valeur en indiquant le type, donc ça le protège des injection sql
            $pdoStatment->bindValue(':pass', $this->getPass(), PDO::PARAM_STR);
            return $pdoStatment->execute();
        }

        public function isUserExists() { 
            $query = 'SELECT COUNT(`id`) AS `userExists` '
                    . 'FROM `utilisateurs` '
                    . 'WHERE `email` = :email OR `nom` = :nom';
            $pdoStatment = $this->db->prepare($query);
            $pdoStatment->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
            $pdoStatment->bindValue(':nom', $this->getNom(), PDO::PARAM_STR);
            $pdoStatment->execute(); // On execute l'objet $pdoStatement
            return $pdoStatment->fetch(PDO::FETCH_OBJ); // Ici on fetch l'objet parce qu'on va sortir des valeur qu'on a déjà dans la base de donnée
        }
        /**
     * Cette méthode retourne les informations d'un utilisateur quand il est connecté
     * @return type objet
     */
    public function getInfoUser() {
        $query = 'SELECT `motdepasse`, `id`, `email`, `prenom` '
                . 'FROM `utilisateurs` '
                . 'WHERE `email` = :email';
        $pdoStatment = $this->db->prepare($query);
        $pdoStatment->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
        $pdoStatment->execute();
        return $pdoStatment->fetch(PDO::FETCH_OBJ);
    }
    /**
    
     */
    public function getUserProfil(int $param){
        $query = 'SELECT `utilisateurs`.`nom` AS `nom`,`utilisateurs`.`motdepasse` AS `pass`,`utilisateurs`.`prenom` AS `prenom`, `roleutilisateurs`.`nom` AS `role` ' 
                    . 'FROM `utilisateurs` '
                    . 'LEFT JOIN `roleutilisateurs` '
                    . 'ON `utilisateurs`.`id_roleUtilisateurs` = `roleutilisateurs`.`id` '
                    . 'WHERE `utilisateurs`.`id` = :id ';
        $pdoStatment = $this->db->prepare($query);
        $pdoStatment->bindValue(':id', $this->setId($param), PDO::PARAM_INT);
        $pdoStatment->execute();
        return $pdoStatment->fetch(PDO::FETCH_OBJ);
    }
}