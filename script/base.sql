create database pharma;
use pharma;


create table typeuser
(
	idtypeuser int  primary key not null auto_increment,
	nomtypeuser varchar(200)
);
insert into typeuser(nomtypeuser) values ('Admin');
insert into typeuser(nomtypeuser) values ('Docteur');

create table user
(
	iduser int primary key not null auto_increment,
	idtypeuser int,
	nomuser varchar(200),
	prenomuser varchar(200),
	sex VARCHAR (10),
	user VARCHAR (100),
	pass VARCHAR (300),
	phone VARCHAR (400),
	naissanceuser dateTime
);
insert into user (idtypeuser,nomuser,prenomuser,sex,user,pass,phone,naissanceuser)
values (1,'Andriantsilavina' , 'Tina', 'M','tsila','7c4a8d09ca3762af61e59520943dc26494f8941b','0344709345' ,'1996-01-15 8:9:12' );

insert into user (idtypeuser,nomuser,prenomuser,sex,user,pass,phone,naissanceuser)
values (1,'Andry' , 'Tsitohaina', 'M','andry','7c4a8d09ca3762af61e59520943dc26494f8941b','0344745789' ,'1996-01-15 8:9:12' );


create or replace view userdetaille as
select user.*, typeuser.nomtypeuser from user join typeuser on typeuser.idtypeuser=user.idtypeuser;

create table tokenuser
(
	iduser int,
	token varchar(300),
	expiration dateTime
);
insert into tokenuser(iduser,token,expiration) values
(1,'shfdsjhdkfjshkdfj' ,'2030-01-15 8:9:12' );



create table tokenverificationemail
(
	iduser int,
	token varchar(300),
	expiration dateTime
);
insert into tokenverificationemail(iduser,token,expiration) values
(1,'shfdsjhdkfjshkdfj' ,'2030-01-15 8:9:12' );


create table classemedicament
(
	idclassemedicament int  primary key not null auto_increment,
	nomclassemedicament varchar(200)
);
insert into classemedicament(nomclassemedicament) VALUES ('ALLERGOLOGIE');
insert into classemedicament(nomclassemedicament) VALUES ('ANESTHESIOLOGIE');
insert into classemedicament(nomclassemedicament) VALUES ('ANTALGIQUE');
insert into classemedicament(nomclassemedicament) VALUES ('ANTI-INFLAMMATOIRES');


create table sousclassemedicament
(
	idsousclassemedicament int  primary key not null auto_increment,
	idclassemedicament  int,
	nomsousclassemedicament varchar(200)
);
insert into sousclassemedicament(idclassemedicament, nomsousclassemedicament) VALUES (1,'Divers');
insert into sousclassemedicament(idclassemedicament, nomsousclassemedicament) VALUES (1,'Antihistaminiques non anticholinergiques');
insert into sousclassemedicament(idclassemedicament, nomsousclassemedicament) VALUES (1,'Antihistaminiques  anticholinergiques');

insert into sousclassemedicament(idclassemedicament, nomsousclassemedicament) VALUES (2,'Divers');
insert into sousclassemedicament(idclassemedicament, nomsousclassemedicament) VALUES (2,'Médicament d²urgence des états de choc');
insert into sousclassemedicament(idclassemedicament, nomsousclassemedicament) VALUES (2,'Curarisants');

insert into sousclassemedicament(idclassemedicament, nomsousclassemedicament) VALUES (3,'Divers');
insert into sousclassemedicament(idclassemedicament, nomsousclassemedicament) VALUES (3,'Floctaf&nine et glaténine');
insert into sousclassemedicament(idclassemedicament, nomsousclassemedicament) VALUES (3,'Aspirine et autres slicylés');

insert into sousclassemedicament(idclassemedicament, nomsousclassemedicament) VALUES (4,'Divers');
insert into sousclassemedicament(idclassemedicament, nomsousclassemedicament) VALUES (4,'Anti-inflammatoires non stérodiens');
insert into sousclassemedicament(idclassemedicament, nomsousclassemedicament) VALUES (4,'Enzymes à visée anti-inflammatoire et anti- oedéma');

create table formemedicament
(
	idformemedicament int  primary key not null auto_increment,
	nomformemedicament varchar(200)
);
insert into  formemedicament(nomformemedicament) values ('Comprimé');
insert into  formemedicament(nomformemedicament) values ('Comprimé pelliculé sécable');
insert into  formemedicament(nomformemedicament) values ('Pdre p.preo.injectable');
insert into  formemedicament(nomformemedicament) values ('Creme dermique');
insert into  formemedicament(nomformemedicament) values ('Gélule');
insert into  formemedicament(nomformemedicament) values ('Solution injéctable perfusion');
insert into  formemedicament(nomformemedicament) values ('Solution Buvable');


-- create table unite
-- (
-- 	idunite int  primary key not null auto_increment,
-- 	nomunite  varchar(50),
-- 	symboleunite varchar(10)
-- );
-- insert into  unite(nomunite,symboleunite) values ('Milli-litre','ml');
-- insert into  unite(nomunite,symboleunite) values ('Litre','l');



-- create table presentationmedicament
-- (
-- 	idpresentationmedicament int  primary key not null auto_increment,
-- 	nompresentationmedicament   varchar(50)
-- );

create table conditionementmedicament
(
	idconditionementmedicament int  primary key not null auto_increment,
	nomconditionementmedicament   varchar(50)
);
insert into conditionementmedicament(nomconditionementmedicament) values('Sachet');
insert into conditionementmedicament(nomconditionementmedicament) values('Flacon');
insert into conditionementmedicament(nomconditionementmedicament) values('Blister');
insert into conditionementmedicament(nomconditionementmedicament) values('Ampoule');


-- create table specificationmedicament
-- (
-- 	idspecificationmedicament int  primary key not null auto_increment,
-- 	nomspecificationmedicament   varchar(50)
-- );

create table dcimedicament
(
	iddcimedicament int  primary key not null auto_increment,
	nomdcimedicament   varchar(50)
);
insert into dcimedicament(nomdcimedicament) values('Monosulfure de sodium + Levure');
insert into dcimedicament(nomdcimedicament) values('ESOMEPRAZOLE');
insert into dcimedicament(nomdcimedicament) values('PARACETAMOL+PHENIRAMINE+VITAMINE C');
insert into dcimedicament(nomdcimedicament) values('DESLORATADINE');



create table tableaumedicament
(
	idtableaumedicament int  primary key not null auto_increment,
	nomtableaumedicament   varchar(50)
);
insert into tableaumedicament(nomtableaumedicament) values('Aucun Tableau');
insert into tableaumedicament(nomtableaumedicament) values('A');
insert into tableaumedicament(nomtableaumedicament) values('B');
insert into tableaumedicament(nomtableaumedicament) values('C');



create table duree
(
	idduree int  primary key not null auto_increment,
	nomduree   varchar(50)
);
insert into duree(nomduree) values('Mois');
insert into duree(nomduree) values('Annee');



create table pays
(
	idpays int  primary key not null auto_increment,
	nompays VARCHAR (100),
	symbolepays VARCHAR (10)
);
insert into pays(nompays,symbolepays) values('Madagascar','MG');

create table laboratoire
(
	idlaboratoire int  primary key not null auto_increment,
	nomlaboratoire   varchar(50),
	description varchar(500),
	idpays int,
	longitudelaboratoire VARCHAR (300),
	latitudelaboratoire  VARCHAR (300)
);
insert into laboratoire (nomlaboratoire,description,idpays,longitudelaboratoire,latitudelaboratoire) VALUES
(
  'LaboTest',
  'Description Lqbo Test ',
  1,
  '1235464687878',
  '78643535'
);


create table medicament
(
	idmedicament int  primary key not null auto_increment,
	idsousclassemedicament  int,
	nommedicament varchar(200),
	dosagemedicament VARCHAR (50),
	idformemedicament int,
	presentationmedicament VARCHAR (50),
	iddcimedicament int,
	idlaboratoire int,
  idconditionementmedicament int,
  specificationmedicament VARCHAR (200),
  idtableaumedicament int,
  dureeconservationmedicament decimal(5,2),
  iddureeconservationmedicament int
);
insert into medicament(idsousclassemedicament,nommedicament,dosagemedicament,idformemedicament,
presentationmedicament,iddcimedicament,idlaboratoire,idconditionementmedicament,specificationmedicament,idtableaumedicament,dureeconservationmedicament,iddureeconservationmedicament)
VALUES
(2,'AERIUS 0.5mg/Mi Sirop FI 150 ml',
  '0.5 mg/ml',
  7,
  'FL/150ml',
  4,
  1,
  2,
  'En verre ambré de type III+Bouchon en PP avec sécurité enfant+seringue graduée 2.5ml et 5ml',
  4,
  24,
  1

);


insert into medicament(idsousclassemedicament,nommedicament,dosagemedicament,idformemedicament,
presentationmedicament,iddcimedicament,idlaboratoire,idconditionementmedicament,specificationmedicament,idtableaumedicament,dureeconservationmedicament,iddureeconservationmedicament)
VALUES
(2,'Test 2',
  '0.5 mg/ml',
  7,
  'FL/120ml',
  4,
  1,
  2,
  'En verre amb',
  2,
  12,
  1

);

create table prixmedicament(
  idprixmedicament int  primary key not null auto_increment,
  prixmedicament decimal(16,6),
  dateprixmedicament datetime
);


create table imagemedicament(
  idimage int  primary key not null auto_increment,
  idmedicament int
);

insert into imagemedicament(idmedicament) VALUES (1);
insert into imagemedicament(idmedicament) VALUES (1);
insert into imagemedicament(idmedicament) VALUES (1);
insert into imagemedicament(idmedicament) VALUES (1);










create or replace view medicamentdetaille as
select med.idmedicament,med.idsousclassemedicament, med.nommedicament,med.dosagemedicament dosage,
medforme.nomformemedicament forme, med.presentationmedicament presentation,
dcimedicament.nomdcimedicament dci, laboratoire.nomlaboratoire laboratoire,
conditionementmedicament.nomconditionementmedicament conditionement,
med.specificationmedicament, tableaumedicament.nomtableaumedicament tableau,
med.dureeconservationmedicament conservation, duree.nomduree duree,
classemedicament.nomclassemedicament classe,
sousclassemedicament.nomsousclassemedicament sousclasse
from medicament med
join formemedicament medforme on medforme.idformemedicament=med.idformemedicament
join dcimedicament on dcimedicament.iddcimedicament=med.iddcimedicament
join laboratoire on laboratoire.idlaboratoire=med.idlaboratoire
join conditionementmedicament on conditionementmedicament.idconditionementmedicament=med.idconditionementmedicament
join tableaumedicament  on tableaumedicament.idtableaumedicament=med.idtableaumedicament
join duree on duree.idduree=med.iddureeconservationmedicament
join sousclassemedicament on sousclassemedicament.idsousclassemedicament=med.idsousclassemedicament
join classemedicament on sousclassemedicament.idclassemedicament=classemedicament.idclassemedicament
;



create table specialite(
  idspecialite int  primary key not null auto_increment,
  nomspecialite VARCHAR (100),
  descriptionspecialite VARCHAR (200)
);
insert into specialite (nomspecialite,descriptionspecialite) values ('Dentiste' ,'description');
insert into specialite (nomspecialite,descriptionspecialite) values ('Gynécologue' ,'description');
insert into specialite (nomspecialite,descriptionspecialite) values ('Generialiste' ,'description');
insert into specialite (nomspecialite,descriptionspecialite) values ('Sexologue' ,'description');
insert into specialite (nomspecialite,descriptionspecialite) values ('Derlatologue' ,'description');


-- Sepecialiter docteur satria ny docteure taiditra ao anaty ny table user
-- Dr Anankiray afak manana specialite maro2
create table specialitedocteur(
  idspecialitedocteur int  primary key not null auto_increment,
  iduser int ,
  idspecialite int
);
insert into specialitedocteur(iduser,idspecialite) values (2,1);
insert into specialitedocteur(iduser,idspecialite) values (2,2);


-- detaille sy ny toerana misy an ilay dr
create table detailledocteur(
  iddetailledocteur int  primary key not null auto_increment,
  iduser int ,
  description VARCHAR (2000),
  ouverture TIME ,
  fermeture TIME
);
insert into detailledocteur (iduser,description,ouverture,fermeture)
values
(
  2,
  'Description Detaille Docteur',
  '09:10',
  '17:00'
);


--idtypeuser,nomuser,prenomuser,sex,user,pass,phone,naissanceuser
create or replace view v_docteurdetaille as
  select user.iduser ,user.nomuser nom, user.prenomuser prenom , user.sex sexe, user.phone , user.naissanceuser naissance,
    specialite.idspecialite, specialite.nomspecialite,
    detailledocteur.description , detailledocteur.ouverture, detailledocteur.fermeture
    from user
    join specialitedocteur on specialitedocteur.iduser=user.iduser
    join specialite on specialite.idspecialite=specialitedocteur.idspecialite
    join detailledocteur on detailledocteur.iduser=user.iduser
    ;


create table rdv(
  idrdv int  primary key not null auto_increment,
  iduserdocteur int ,
  iduserclient int,
  daterdv datetime
);
insert into rdv(iduserdocteur,iduserclient,daterdv) values (1,2,'2022-02-24T12:40:00+01:00');
create or replace view v_rdvdetaille as
  select rdv.*, dr.nomuser nomdocteur, dr.prenomuser prenomdocteur,
  cl.nomuser nomclient, cl.prenomuser prenomclient
  from rdv
  join user dr on dr.iduser=rdv.iduserdocteur
  join user cl on cl.iduser=rdv.iduserclient
  ;



create table imagepharmacie(
  idimage int  primary key not null auto_increment,
  idpharmacie int
);

insert into imagepharmacie(idpharmacie) VALUES (1);
insert into imagepharmacie(idpharmacie) VALUES (1);
insert into imagepharmacie(idpharmacie) VALUES (1);



create table imagelaboratoire(
  idimage int  primary key not null auto_increment,
  idlaboratoire int
);

insert into imagelaboratoire(idlaboratoire) VALUES (1);
insert into imagelaboratoire(idlaboratoire) VALUES (1);
insert into imagelaboratoire(idlaboratoire) VALUES (1);



create table imageuser(
  idimage int  primary key not null auto_increment,
  iduser int
);

insert into imageuser(iduser) VALUES (1);
insert into imageuser(iduser) VALUES (1);
insert into imageuser(iduser) VALUES (1);




create table question(
  idquestion int  primary key not null auto_increment,
  iduser int,
  idspecialite int,
  titre VARCHAR (200),
  question VARCHAR (2000),
  sexe VARCHAR (3),
  taille int,
  poids int,
  masquernom int,
  traitement VARCHAR (2000),
  antecedant VARCHAR (2000),
  datequestion datetime
);
insert into question(iduser,idspecialite,titre,question,sexe,taille,poids,masquernom,traitement,antecedant, datequestion) VALUES
(
  1,
  1,
  'titre question',
  'Question Detaille',
  'M',
  18,
  80,
  0,
  'trautement',
  'antecedant',
  now()
);

create or replace view v_questiondetaille as
select question.*,
       cl.idtypeuser, cl.nomuser,cl.prenomuser , cl.sex,cl.user,cl.phone,cl.naissanceuser,
       sp.nomspecialite,sp.descriptionspecialite
       from question
       join user cl on cl.iduser=question.iduser
       join specialite sp  on sp.idspecialite=question.idspecialite;




create table reponse(
  idreponse int  primary key not null auto_increment,
  idquestion int,
  iduserdocteur int,
  reponse VARCHAR (2000),
  datereponse datetime
);
insert into reponse(idquestion,iduserdocteur,reponse) VALUES
(
  1,1,'Reponseljskdfjslkjsldfkl'
);
create or replace view v_reponsedetaille as
  select reponse.*,
    qt.titre, qt.idspecialite,qt.iduser idclient , qt.question,qt.sexe,qt.taille,qt.poids, qt.masquernom,qt.traitement,qt.antecedant, qt.datequestion ,
    dr.nomuser nomdocteur, dr.prenomuser prenomdocteur,
    cl.nomuser nomclient, cl.prenomuser prenomclient
  from reponse
    join question qt on qt.idquestion=reponse.idquestion
    join user dr on dr.iduser=reponse.iduserdocteur
    join user cl on cl.iduser=qt.iduser
;




create table actualite(
  idactualite int  primary key not null auto_increment,
  iduser int,
  titre VARCHAR (200),
  texte VARCHAR (2000),
  dateactualite datetime
);
insert into actualite( iduser, titre, texte, dateactualite) VALUES
(
  1,'titreactualite',
  'texteactualite',
  now()
);

create or replace view v_actualitedetaille as
  select actualite.* ,
   user.nomuser , user.prenomuser
  from actualite
  join user on user.iduser=actualite.iduser
;

create table imageactualite(
  idimage int  primary key not null auto_increment,
  idactualite int
);
insert into imageactualite(idactualite) VALUES (1);




----- recherche Medicament par nom
select * from medicamentdetaille
where nommedicament like '%'+'AE'+'%'

select * from medicamentdetaille
where nommedicament like '%AE%'





ALTER TABLE user  drop  CONSTRAINT   fk_user_idtypeuser;ALTER TABLE user  drop  CONSTRAINT   fk_user_idtypeuser;
ALTER TABLE user  ADD CONSTRAINT fk_user_idtypeuser FOREIGN KEY (idtypeuser) REFERENCES typeuser(idtypeuser);
ALTER TABLE tokenuser  ADD CONSTRAINT fk_tokenuser_iduser FOREIGN KEY (iduser) REFERENCES user(iduser);

ALTER TABLE sousclassemedicament  ADD CONSTRAINT fk_sousclassemedicament_idclassemedicament FOREIGN KEY
(idclassemedicament) REFERENCES classemedicament(idclassemedicament, nomclassemedicament) ;

create table docteur
(
	iddocteur 	int primary key not null auto_increment,
	nomdocteur varchar(200),
	prenom float,
	dateFitahiana dateTime
);
insert into fitahiana(designationFitahiana,sommeFitahiana,dateFitahiana) values("testDesignation",200.0,  '2021-01-15 8:9:12');









create table mouvementFahafolonKarena
(
	idMouvement int primary key not null auto_increment,
	sommeMouvement float,
	dateMouvement dateTime
);

insert into mouvementFahafolonKarena(sommeMouvement,dateMouvement) values(200.0,  '2021-01-15 8:9:12');


create table fanatitraFahafolonkarena(
	idVola int primary key not null auto_increment,
	fanatitra float,
	fahafolonkarena float,
	datePayement dateTime
);

insert into fanatitraFahafolonkarena(fanatitra,fahafolonkarena,datePayement) values (200.0,5000.0,now());






-- create table etatFitahiana
-- (
-- 	idEtatFitahiana int primary key not null auto_increment,
-- 	idFitahiana int,
-- 	dateEtatFitahiana dateTime
-- );
-- insert into etatFitahiana(idFitahiana,dateEtatFitahiana)values(1,'2021-01-15 10:9:12');




-- create or replace  view fitahianaEfa  as 
-- 	select * from fitahiana where idFitahiana not in (select idFitahiana from etatFitahiana);

-- create or replace  view fitahianaMbola as 
-- 	select * from fitahiana where idFitahiana in (select idFitahiana from etatFitahiana);

-- create or replace view totalFitahianaMbola as 
-- 	select sum(sommeFitahiana) as somme from fitahiana where idFitahiana not in (select idFitahiana from etatFitahiana);

