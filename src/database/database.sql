
drop table infotherminal_schema;
drop table schemas;
drop table infotherminals; 

 

CREATE DATABASE dbTerminal
; 


USE dbTerminal;
CREATE TABLE infotherminals (
    id INT NOT NULL IDENTITY(1,1),
    titel VARCHAR(50),
    ipAdresse VARCHAR(50),
    CONSTRAINT PK_infotherminals PRIMARY KEY (id)
);

CREATE TABLE schemas (
    id INT NOT NULL IDENTITY(1,1),
    imagePath VARCHAR(255),
    selectedTime VARCHAR(50),
    isAktiv VARCHAR(1),
    startTime VARCHAR(50),
    endTime VARCHAR(50),
    startDateTime VARCHAR(50),
    endDateTime VARCHAR(50),
    timeAktiv VARCHAR(1),
    dateAktiv VARCHAR(1), 
    titel VARCHAR(50),
    beschreibung VARCHAR(255),
    CONSTRAINT PK_schemas PRIMARY KEY (id)  -- <- Klammer fehlte hier
);

CREATE TABLE infotherminal_schema (
    id INT NOT NULL IDENTITY(1,1),
    fk_infotherminal_id INT NOT NULL,
    fk_schema_id INT NOT NULL,
    CONSTRAINT PK_infotherminal_schema PRIMARY KEY (fk_infotherminal_id, fk_schema_id),
    CONSTRAINT FK_infotherminal_schema_infotherminals FOREIGN KEY (fk_infotherminal_id) 
        REFERENCES infotherminals(id),
    CONSTRAINT FK_infotherminal_schema_schemas FOREIGN KEY (fk_schema_id) 
        REFERENCES schemas(id)
);


drop table user_login;
CREATE TABLE user_login (
    id INT IDENTITY(1,1) PRIMARY KEY, -- Bleibt int für Auto-Inkrement
    username VARCHAR(50),
    password VARCHAR(255), -- Gehashte Passwörter
    remember_me VARCHAR(1) DEFAULT '1', -- '1' = Angemeldet bleiben, '0' = Nein
    is_admin VARCHAR(1) DEFAULT '0', -- '1' = Admin, '0' = Normaler User
    is_active VARCHAR(1) DEFAULT '1', -- '1' = Aktiv, '0' = Deaktiviert
    email VARCHAR(100),
    failed_attempts VARCHAR(10) DEFAULT '0', -- Anzahl als String
    last_failed_attempt VARCHAR(50), -- Datum als String (z.B. '2023-10-01 12:00:00')
    lockout_until VARCHAR(50), -- Datum als String
    last_login VARCHAR(50), -- Datum als String
    verification_code VARCHAR(10), -- Für Passwort-Reset
    verification_expires DATETIME, -- Ablaufdatum als echtes DATETIME
    created_at DATETIME DEFAULT GETDATE(), -- Erstellungsdatum im Format yyyy-mm-dd hh:mi:ss
 );

INSERT INTO user_login (username, password, is_admin)
VALUES ('admin', '0000', '1'),
       ('user', '0000', '0');



drop table error_logs;
CREATE TABLE error_logs (
        message VARCHAR(255) NOT NULL, -- Fehler-Nachricht
        datum DATETIME DEFAULT GETDATE(), -- Aktuelles Datum und Zeit
);


CREATE table templates (
    id INT NOT NULL IDENTITY(1,1),
    templateName VARCHAR(50),
    text1 VARCHAR(255),
    text2 VARCHAR(255),
    text3 VARCHAR(255),
    text4 VARCHAR(255),
    text5 VARCHAR(255),
    text6 VARCHAR(255),
    bild1 VARCHAR(255),
    bild2 VARCHAR(255),
    bild3 VARCHAR(255),
    bild4 VARCHAR(255),
    bild5 VARCHAR(255),
    bild6 VARCHAR(255),
    video1 VARCHAR(255),
    video2 VARCHAR(255),
    video3 VARCHAR(255),
    video4 VARCHAR(255),
    CONSTRAINT PK_templates PRIMARY KEY (id)
);