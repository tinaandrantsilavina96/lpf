create database antanivao_ws;
use antanivao_ws;
create table fitahiana_rtoa
(
	idFitahiana 	int primary key not null auto_increment,
	designationFitahiana varchar(200),
	sommeFitahiana float,
	dateFitahiana dateTime
);
insert into fitahiana_rtoa(designationFitahiana,sommeFitahiana,dateFitahiana) values("testDesignation",200.0,  '2021-01-15 8:9:12');


create table mouvementFahafolonKarena_rtoa
(
	idMouvement int primary key not null auto_increment,
	sommeMouvement float,
	dateMouvement dateTime
);

insert into mouvementFahafolonKarena_rtoa(sommeMouvement,dateMouvement) values(200.0,  '2021-01-15 8:9:12');


create table fanatitraFahafolonkarena_rtoa(
	idVola int primary key not null auto_increment,
	fanatitra float,
	fahafolonkarena float,
	datePayement dateTime
);

insert into fanatitraFahafolonkarena_rtoa(fanatitra,fahafolonkarena,datePayement) values (200.0,5000.0,now());



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

