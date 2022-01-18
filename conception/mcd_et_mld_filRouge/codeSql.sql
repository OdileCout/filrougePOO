#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: roleUtilisateurs
#------------------------------------------------------------

CREATE TABLE roleUtilisateurs(
        id              Int  Auto_increment  NOT NULL ,
        administrateurs Varchar (225) NOT NULL ,
        utilisateurs    Varchar (225) NOT NULL
	,CONSTRAINT roleUtilisateurs_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: utilisateurs
#------------------------------------------------------------

CREATE TABLE utilisateurs(
        id                  Int  Auto_increment  NOT NULL ,
        nom                 Varchar (225) NOT NULL ,
        prenom              Varchar (225) NOT NULL ,
        email               Varchar (225) NOT NULL ,
        numPhone            Int NOT NULL ,
        motdepasse          Varchar (225) NOT NULL ,
        date                Datetime NOT NULL ,
        id_roleUtilisateurs Int NOT NULL
	,CONSTRAINT utilisateurs_PK PRIMARY KEY (id)

	,CONSTRAINT utilisateurs_roleUtilisateurs_FK FOREIGN KEY (id_roleUtilisateurs) REFERENCES roleUtilisateurs(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: articlesBlog
#------------------------------------------------------------

CREATE TABLE articlesBlog(
        id              Int  Auto_increment  NOT NULL ,
        titre           Longtext NOT NULL ,
        article         Longtext NOT NULL ,
        image           Varchar (225) NOT NULL ,
        date            Datetime NOT NULL ,
        id_utilisateurs Int NOT NULL
	,CONSTRAINT articlesBlog_PK PRIMARY KEY (id)

	,CONSTRAINT articlesBlog_utilisateurs_FK FOREIGN KEY (id_utilisateurs) REFERENCES utilisateurs(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: commentaires
#------------------------------------------------------------

CREATE TABLE commentaires(
        id              Int  Auto_increment  NOT NULL ,
        commentaire     Longtext NOT NULL ,
        id_articlesBlog Int NOT NULL ,
        id_utilisateurs Int NOT NULL
	,CONSTRAINT commentaires_PK PRIMARY KEY (id)

	,CONSTRAINT commentaires_articlesBlog_FK FOREIGN KEY (id_articlesBlog) REFERENCES articlesBlog(id)
	,CONSTRAINT commentaires_utilisateurs0_FK FOREIGN KEY (id_utilisateurs) REFERENCES utilisateurs(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: listeProduits
#------------------------------------------------------------

CREATE TABLE listeProduits(
        id                   Int  Auto_increment  NOT NULL ,
        nom_produit          Varchar (225) NOT NULL ,
        description          Longtext NOT NULL ,
        prix_unitaire        Float NOT NULL ,
        quantite_disponibles Int NOT NULL
	,CONSTRAINT listeProduits_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: commandes
#------------------------------------------------------------

CREATE TABLE commandes(
        id              Int  Auto_increment  NOT NULL ,
        date            Datetime NOT NULL ,
        quantite        Double NOT NULL ,
        id_utilisateurs Int NOT NULL
	,CONSTRAINT commandes_PK PRIMARY KEY (id)

	,CONSTRAINT commandes_utilisateurs_FK FOREIGN KEY (id_utilisateurs) REFERENCES utilisateurs(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: appartenir
#------------------------------------------------------------

CREATE TABLE appartenir(
        id               Int NOT NULL ,
        id_listeProduits Int NOT NULL
	,CONSTRAINT appartenir_PK PRIMARY KEY (id,id_listeProduits)

	,CONSTRAINT appartenir_commandes_FK FOREIGN KEY (id) REFERENCES commandes(id)
	,CONSTRAINT appartenir_listeProduits0_FK FOREIGN KEY (id_listeProduits) REFERENCES listeProduits(id)
)ENGINE=InnoDB;

