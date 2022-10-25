/*on creer un 1er lieu qui sert de lieu de test*/
INSERT INTO lieu(ville,adresse) VALUES('NANTES','35 AVENUE DU CHAMP DU CHAMP DE MANOEUVRE');

/*le mot de passe non crypté pour les utilisateurs est isen*/
INSERT INTO etudiant(pseudo,email, nom, prenom, telephone, password, id_lieu) VALUES('nlemp','noemie.lempereur@isen-ouest.yncrea.fr','LEMPEREUR', 'NOEMIE', '0102030405', '$2y$10$2n3vrhu9YDnnkluwHaDNGuymLZ0rnmZVCDS8.n3N33MT7Wd4vT53q', 29);

INSERT INTO etudiant(pseudo,email, nom, prenom, telephone, password, id_lieu) VALUES('jules','jules.lucas@isen-ouest.yncrea.fr','LUCAS', 'JULES', '0302030405', '$2y$10$2n3vrhu9YDnnkluwHaDNGuymLZ0rnmZVCDS8.n3N33MT7Wd4vT53q', 29);

/*pour creer un trajet il faut creer un lieu, on a mis l'id 29 dans nos trajets car cetait le 29e lieu qu'on a crée,
 mais il faudra changer ce parametre dans votre insertion avec le bon id du lieu*/
INSERT INTO trajet(date, nb_passagers,prix, site_depart, fumeur, animaux, site_heure, ville_heure, commentaire,pseudo,id_site,id_lieu) VALUES('2021-07-01',3,5.85,FALSE,FALSE,TRUE, '2021-07-01 17:30:00', '2021-07-01 14:30:00', 'bla', 'nlemp', 2, 29);

INSERT INTO trajet(date, nb_passagers,prix, site_depart, fumeur, animaux, site_heure, ville_heure, commentaire,pseudo,id_site,id_lieu) VALUES('2021-07-01',3,5.85,TRUE,FALSE,TRUE, '2021-07-01 12:00:00', '2021-07-01 15:30:00', 'bla', 'nlemp', 2, 29);

INSERT INTO trajet(date, nb_passagers,prix, site_depart, fumeur, animaux, site_heure, ville_heure, commentaire,pseudo,id_site,id_lieu) VALUES('2021-07-01',2,4,FALSE,TRUE,TRUE, '2021-07-01 16:00:00', '2021-07-01 12:30:00', 'je vous propose le trajet le moins cher', 'jules', 2, 29);


INSERT INTO trajet(date, nb_passagers,prix, site_depart, fumeur, animaux, site_heure, ville_heure, commentaire,pseudo,id_site,id_lieu) VALUES('2021-07-01',3,3,FALSE,TRUE,TRUE, '2021-07-01 15:00:00', '2021-07-01 11:30:00', 'test3', 'jules', 2, 29);

INSERT INTO trajet(date, nb_passagers,prix, site_depart, fumeur, animaux, site_heure, ville_heure, commentaire,pseudo,id_site,id_lieu) VALUES('2021-07-01',4,4.5,FALSE,TRUE,FALSE, '2021-07-01 14:00:00', '2021-07-01 10:30:00', 'test4', 'nlemp', 2, 29);

INSERT INTO trajet(date, nb_passagers,prix, site_depart, fumeur, animaux, site_heure, ville_heure, commentaire,pseudo,id_site,id_lieu) VALUES('2021-07-01',5,5,FALSE,FALSE,FALSE, '2021-07-01 18:00:00', '2021-07-01 14:30:00', 'test5', 'jules', 2, 29);

INSERT INTO trajet(date, nb_passagers,prix, site_depart, fumeur, animaux, site_heure, ville_heure, commentaire,pseudo,id_site,id_lieu) VALUES('2021-07-01',6,6,FALSE,TRUE,TRUE, '2021-07-01 16:30:00', '2021-07-01 13:00:00', 'test6', 'nlemp', 2, 29);

INSERT INTO trajet(date, nb_passagers,prix, site_depart, fumeur, animaux, site_heure, ville_heure, commentaire,pseudo,id_site,id_lieu) VALUES('2021-07-01',7,7,FALSE,TRUE,TRUE, '2021-07-01 14:00:00', '2021-07-01 10:30:00', 'test7', 'jules', 2, 29);

INSERT INTO trajet(date, nb_passagers,prix, site_depart, fumeur, animaux, site_heure, ville_heure, commentaire,pseudo,id_site,id_lieu) VALUES('2021-07-01',8,8,FALSE,TRUE,TRUE, '2021-07-01 18:00:00', '2021-07-01 14:30:00', 'test8', 'nlemp', 2, 29);

INSERT INTO trajet(date, nb_passagers,prix, site_depart, fumeur, animaux, site_heure, ville_heure, commentaire,pseudo,id_site,id_lieu) VALUES('2021-07-01',9,9,FALSE,TRUE,TRUE, '2021-07-01 20:00:00', '2021-07-01 16:30:00', 'test9', 'jules', 2, 29);

INSERT INTO trajet(date, nb_passagers,prix, site_depart, fumeur, animaux, site_heure, ville_heure, commentaire,pseudo,id_site,id_lieu) VALUES('2021-07-01',1,10,FALSE,TRUE,TRUE, '2021-07-01 21:00:00', '2021-07-01 17:30:00', 'test10', 'nlemp', 2, 29);

INSERT INTO trajet(date, nb_passagers,prix, site_depart, fumeur, animaux, site_heure, ville_heure, commentaire,pseudo,id_site,id_lieu) VALUES('2021-07-01',1,11,FALSE,TRUE,TRUE, '2021-07-01 21:30:00', '2021-07-01 18:00:00', 'test11', 'jules', 2, 29);