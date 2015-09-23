

CREATE TABLE IF NOT EXISTS atelier (
    Id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    Titre VARCHAR(255),
    Theme VARCHAR(255),
    Type VARCHAR(255), 
    LundiAM BOOLEAN,
    LundiPM BOOLEAN,
    MardiAM BOOLEAN,
    MardiPM BOOLEAN,
    MercrediAM BOOLEAN,
    MercrediPM BOOLEAN,
    JeudiAM BOOLEAN,
    JeudiPM BOOLEAN,
    VendrediAM BOOLEAN,
    VendrediPM BOOLEAN,
    Laboratoire VARCHAR(255), 
    Lieu VARCHAR(255), 
    Duree VARCHAR(255), 
    Capacite INTEGER(4),
    Inscription BOOLEAN, 
    Resume TEXT,
    AnimConf VARCHAR(255),
    Partenaires VARCHAR(255),
    PublicVise VARCHAR(255),
    Contenu VARCHAR(255),
    PRIMARY KEY (Id)
);
