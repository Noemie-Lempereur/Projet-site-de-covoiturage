------------------------------------------------------------
--        Script Postgre 
------------------------------------------------------------



------------------------------------------------------------
-- Table: site
------------------------------------------------------------
CREATE TABLE  site(
	id    SERIAL NOT NULL ,
	nom   VARCHAR (50) NOT NULL  ,
	CONSTRAINT site_PK PRIMARY KEY (id)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: lieu
------------------------------------------------------------
CREATE TABLE  lieu(
	id     SERIAL NOT NULL ,
	ville   VARCHAR (50) NOT NULL ,
	adresse     VARCHAR (2000)  NOT NULL  ,
	CONSTRAINT lieu_PK PRIMARY KEY (id)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: etudiant
------------------------------------------------------------
CREATE TABLE  etudiant(
	pseudo          VARCHAR (50) NOT NULL ,
	email           VARCHAR (100) NOT NULL ,
	nom             VARCHAR (50) NOT NULL ,
	prenom          VARCHAR (50) NOT NULL ,
	telephone   CHAR (10)  NOT NULL ,
	password        VARCHAR (200) NOT NULL ,
	id_lieu         INT  NOT NULL  ,
	CONSTRAINT etudiant_PK PRIMARY KEY (pseudo)

	,CONSTRAINT etudiant_lieu_FK FOREIGN KEY (id_lieu) REFERENCES  lieu(id)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: trajet
------------------------------------------------------------
CREATE TABLE  trajet(
	id      SERIAL NOT NULL ,
	date           DATE  NOT NULL ,
	nb_passagers   INT  NOT NULL ,
	prix           FLOAT  NOT NULL ,
	site_depart    BOOL  NOT NULL ,
	fumeur         BOOL  NOT NULL ,
	animaux        BOOL  NOT NULL ,
	site_heure     TIMESTAMP  NOT NULL ,
	ville_heure    TIMESTAMP  NOT NULL ,
	commentaire    VARCHAR (2000)  NOT NULL ,
	pseudo         VARCHAR (50) NOT NULL ,
	id_site        INT  NOT NULL ,
	id_lieu        INT  NOT NULL  ,
	CONSTRAINT trajet_PK PRIMARY KEY (id)

	,CONSTRAINT trajet_etudiant_FK FOREIGN KEY (pseudo) REFERENCES  etudiant(pseudo)
	,CONSTRAINT trajet_site0_FK FOREIGN KEY (id_site) REFERENCES  site(id)
	,CONSTRAINT trajet_lieu1_FK FOREIGN KEY (id_lieu) REFERENCES  lieu(id)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Rejoindre
------------------------------------------------------------
CREATE TABLE rejoindre(
	id_trajet   INT  NOT NULL ,
	pseudo      VARCHAR (50) NOT NULL  ,
	CONSTRAINT rejoindre_PK PRIMARY KEY (id_trajet,pseudo)

	,CONSTRAINT rejoindre_trajet_FK FOREIGN KEY (id_trajet) REFERENCES trajet(id)
	,CONSTRAINT rejoindre_etudiant0_FK FOREIGN KEY (pseudo) REFERENCES etudiant(pseudo)
)WITHOUT OIDS;



INSERT INTO site(id,nom) VALUES(1,'ISEN BREST');
INSERT INTO site(id,nom) VALUES(2,'ISEN CAEN');
INSERT INTO site(id,nom) VALUES(3,'ISEN NANTES');
INSERT INTO site(id,nom) VALUES(4,'ISEN RENNES');