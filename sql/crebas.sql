/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de cr�ation :  26/03/2019 09:55:37                      */
/*==============================================================*/

SET FOREIGN_KEY_CHECKS=0;
drop table if exists ASSOCIER;

drop table if exists CONTENIR;

drop table if exists CREER;

drop table if exists DISPOSER;

drop table if exists EST_INVITE;

drop table if exists NOTE;



drop table if exists QUESTION;


drop table if exists REGLE;

drop table if exists REPONSE_DISPONIBLE;

drop table if exists SPECIFIER;

drop table if exists TAG;

drop table if exists TENTER;

drop table if exists ENSEIGNANT;

drop table if exists PARTICIPANT;


drop table if exists QUESTIONNAIRE;


/*==============================================================*/
/* Table : ASSOCIER                                             */
/*==============================================================*/
create table ASSOCIER
(
   LIBELLE              varchar(50) not null,
   ID_QUESTION          int not null,
   primary key (LIBELLE, ID_QUESTION)
);

/*==============================================================*/
/* Table : CONTENIR                                             */
/*==============================================================*/
create table CONTENIR
(
   ID_QUESTION          int not null,
   ID_QUESTIONNAIRE     int not null,
   BAREME               decimal  not null,
   primary key (ID_QUESTION, ID_QUESTIONNAIRE)
);

/*==============================================================*/
/* Table : CREER                                                */
/*==============================================================*/
create table CREER
(
   ID_QUESTION          int not null,
   ID_USER              int not null,
   primary key (ID_QUESTION, ID_USER)
);

/*==============================================================*/
/* Table : DISPOSER                                             */
/*==============================================================*/
create table DISPOSER
(
   ID_QUESTION          int not null,
   ID_PROPOSITION       int not null,
   primary key (ID_QUESTION, ID_PROPOSITION)
);

/*==============================================================*/
/* Table : ENSEIGNANT                                           */
/*==============================================================*/
create table ENSEIGNANT
(
   ID_USER              int not null auto_increment,
   LOGIN                varchar(200) not null,
   PASSWORD             varchar(200) not null,
   INTERNE              bool not null,
   DESCRIPTION          varchar(200),
   NOM                  varchar(50),
   PRENOM               varchar(50),
   MAIL                 varchar(200),

   primary key (ID_USER)
);

/*==============================================================*/
/* Table : EST_INVITE                                           */
/*==============================================================*/
create table EST_INVITE
(
   EMAIL                varchar(50) not null,
   ID_QUESTIONNAIRE     int not null,
   A_PARTICIPE          bool,
   primary key (EMAIL, ID_QUESTIONNAIRE)
);

/*==============================================================*/
/* Table : NOTE                                                 */
/*==============================================================*/
create table NOTE
(
   ID_USER              int not null,
   ENS_ID_USER          int not null,
   ID_NOTE              int not null,
   ID_QUESTIONNAIRE     int not null,
   VALEUR               decimal not null,
   primary key (ID_NOTE)
);

/*==============================================================*/
/* Table : PARTICIPANT                                          */
/*==============================================================*/
create table PARTICIPANT
(
   ID_USER              int not null auto_increment,
   LOGIN                varchar(200) not null,
   PASSWORD             varchar(200) not null,
   PROMOTION            varchar(50),
   MAJEURE              varchar(50),
   NOM                  varchar(50),
   PRENOM               varchar(50),
   MAIL                 varchar(200),


   primary key (ID_USER)
);

/*==============================================================*/
/* Table : QUESTION                                             */
/*==============================================================*/
create table QUESTION
(
   ID_QUESTION          int not null auto_increment,
   TYPE                 char(10) not null,
   INTITULE_QUESTION    varchar(100) not null,
   primary key (ID_QUESTION)
);

/*==============================================================*/
/* Table : QUESTIONNAIRE                                        */
/*==============================================================*/
create table QUESTIONNAIRE
(
   ID_QUESTIONNAIRE     int not null,
   TITRE                varchar(50) not null,
   DESCRIPTION_QUESTIONNAIRE varchar(200),
   DATE_OUVERTURE       date,
   DATE_FERMETURE       date,
   CONNEXION_REQUISE    bool not null,
   ETAT                 varchar(50) not null,
   URL                  varchar(200),
   ID_CREATEUR          int not null,
   primary key (ID_QUESTIONNAIRE)
);

/*==============================================================*/
/* Table : REGLE                                                */
/*==============================================================*/
create table REGLE
(
   ID_REGLE             int not null,
   BONUS				int,
   MALUS				int,
   primary key (ID_REGLE)
);

/*==============================================================*/
/* Table : REPONSE_DISPONIBLE                                   */
/*==============================================================*/
create table REPONSE_DISPONIBLE
(
   ID_PROPOSITION       int not null auto_increment,
   REP_ID_PROPOSITION   int,
   REP_ID_PROPOSITION2  int,
   ID_USER              int,
   INTITULE_PROPOSITION varchar(100),
   REPONSE_CORRECTE     bool,
   primary key (ID_PROPOSITION)
);

/*==============================================================*/
/* Table : SPECIFIER                                            */
/*==============================================================*/
create table SPECIFIER
(
   ID_QUESTIONNAIRE     int not null,
   ID_REGLE             int not null,
   primary key (ID_QUESTIONNAIRE, ID_REGLE)
);

/*==============================================================*/
/* Table : TAG                                                  */
/*==============================================================*/
create table TAG
(
   LIBELLE              varchar(50) not null,
   COULEUR              varchar(50) not null,
   primary key (LIBELLE)
);

/*==============================================================*/
/* Table : TENTER                                               */
/*==============================================================*/
create table TENTER
(
   ID_USER              int not null,
   ID_PROPOSITION       int not null,
   A_CORRIGER           bool not null,
   JUSTE                tinyint(1),
   primary key (ID_USER, ID_PROPOSITION)
);

alter table ASSOCIER add constraint FK_ASSOCIER foreign key (LIBELLE)
      references TAG (LIBELLE) on delete restrict on update cascade;

alter table ASSOCIER add constraint FK_ASSOCIER2 foreign key (ID_QUESTION)
      references QUESTION (ID_QUESTION) on delete restrict on update cascade;

alter table CONTENIR add constraint FK_CONTENIR foreign key (ID_QUESTION)
      references QUESTION (ID_QUESTION) on delete restrict on update cascade;

alter table CONTENIR add constraint FK_CONTENIR2 foreign key (ID_QUESTIONNAIRE)
      references QUESTIONNAIRE (ID_QUESTIONNAIRE) on delete restrict on update cascade;

alter table CREER add constraint FK_CREER foreign key (ID_QUESTION)
      references QUESTION (ID_QUESTION) on delete restrict on update cascade;

alter table CREER add constraint FK_CREER2 foreign key (ID_USER)
      references ENSEIGNANT (ID_USER) on delete restrict on update cascade;

alter table DISPOSER add constraint FK_DISPOSER foreign key (ID_QUESTION)
      references QUESTION (ID_QUESTION) on delete restrict on update cascade;

alter table DISPOSER add constraint FK_DISPOSER2 foreign key (ID_PROPOSITION)
      references REPONSE_DISPONIBLE (ID_PROPOSITION) on delete restrict on update cascade;

alter table EST_INVITE add constraint FK_EST_INVITE2 foreign key (ID_QUESTIONNAIRE)
      references QUESTIONNAIRE (ID_QUESTIONNAIRE) on delete restrict on update cascade;

alter table NOTE add constraint FK_CORRESPONDRE foreign key (ID_QUESTIONNAIRE)
      references QUESTIONNAIRE (ID_QUESTIONNAIRE) on delete restrict on update cascade;

alter table NOTE add constraint FK_GERER foreign key (ENS_ID_USER)
      references ENSEIGNANT (ID_USER) on delete restrict on update cascade;

alter table REPONSE_DISPONIBLE add constraint FK_APPAREILLER foreign key (REP_ID_PROPOSITION2)
      references REPONSE_DISPONIBLE (ID_PROPOSITION) on delete restrict on update cascade;

alter table REPONSE_DISPONIBLE add constraint FK_APPAREILLER2 foreign key (REP_ID_PROPOSITION)
      references REPONSE_DISPONIBLE (ID_PROPOSITION) on delete restrict on update cascade;

alter table REPONSE_DISPONIBLE add constraint FK_SUPERVISER foreign key (ID_USER)
      references PARTICIPANT (ID_USER) on delete restrict on update cascade;

alter table SPECIFIER add constraint FK_SPECIFIER foreign key (ID_QUESTIONNAIRE)
      references QUESTIONNAIRE (ID_QUESTIONNAIRE) on delete restrict on update cascade;

alter table SPECIFIER add constraint FK_SPECIFIER2 foreign key (ID_REGLE)
      references REGLE (ID_REGLE) on delete restrict on update cascade;

alter table TENTER add constraint FK_TENTER2 foreign key (ID_PROPOSITION)
      references REPONSE_DISPONIBLE (ID_PROPOSITION) on delete restrict on update restrict;

alter table QUESTIONNAIRE add constraint FK_CREATEUR foreign key (ID_CREATEUR)
      references ENSEIGNANT (ID_USER) on delete restrict on update cascade;

SET FOREIGN_KEY_CHECKS=1;
