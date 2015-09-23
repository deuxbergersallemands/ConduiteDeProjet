

CREATE TABLE IF NOT EXISTS atelier (
    Id          SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    Titre       VARCHAR(255),
    Theme       VARCHAR(255),
    Type        VARCHAR(255), 
    Lundi       INT(2),
    Mardi       INT(2),
    Mercredi    INT(2),
    Jeudi       INT(2),
    Vendredi    INT(2),
    Laboratoire VARCHAR(255), 
    Lieu        VARCHAR(255), 
    Duree       VARCHAR(255), 
    Capacite    INTEGER(4),
    Inscription BOOLEAN, 
    Resume      TEXT,
    AnimConf    VARCHAR(255),
    Partenaires VARCHAR(255),
    PublicVise  VARCHAR(255),
    Contenu     VARCHAR(255),
    PRIMARY KEY (Id)
);
