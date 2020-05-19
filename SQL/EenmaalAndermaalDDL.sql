go
use iproject16
go


/* Tabellen aanmaken */
go
CREATE TABLE Bestand (
	filenaam varchar(20) NOT NULL,
	voorwerpnummer int NOT NULL
)
go

go
CREATE TABLE Bod (
    ID int IDENTITY (1,1) NOT NULL,
	voorwerp int NOT NULL,
	bodbedrag numeric(10,2) NOT NULL,
	gebruiker varchar(20) NOT NULL,
	boddag date NOT NULL,
	bodtijdstip datetime NOT NULL
)
go

go
CREATE TABLE Categorieen (
    ID int IDENTITY(1,1) NOT NULL,
    Name varchar(100) NULL,
    Parent int NULL
)
go

go
CREATE TABLE Feedback (
	voorwerpnummer int NOT NULL,
	soortgebruiker varchar(8) NOT NULL,
	feedbacksoort char(8) NOT NULL,
	dag date NOT NULL,
	tijdstip datetime NOT NULL,
	commentaar varchar(50)
)
go

go
CREATE TABLE Gebruiker (
	gebruikersnaam varchar(20) NOT NULL,
	voornaam varchar(15) NOT NULL,
	achternaam varchar(30) NOT NULL,
	adresregel1 varchar(50) NOT NULL,
	adresregel2 varchar(50) NULL,
	postcode varchar(10) NOT NULL,
	plaatsnaam varchar(25) NOT NULL,
	land varchar(20) NOT NULL,
	geboortedag date NOT NULL,
	email varchar(50) NOT NULL,
	wachtwoord varchar(64) NOT NULL,
	vraag int NOT NULL,
	antwoordtekst varchar(30) NOT NULL,
	isVerkoper bit NOT NULL
)
go

go
CREATE TABLE Gebruikerstelefoon (
	volgnr int NOT NULL,
	gebruikersnaam varchar(20) NOT NULL,
	telefoonnummer int NOT NULL
)
go

go
CREATE TABLE Rubriek (
	rubrieknummer int NOT NULL,
	rubrieknaam varchar(30) NOT NULL,
	rubriek int,				 
	volgnr int NOT NULL
)
go

go
CREATE TABLE Verkoper (
	gebruikersnaam varchar(20) NOT NULL,
	banknaam varchar(20),
	rekeningnummer varchar(34),
	controleoptienaam char(10) NOT NULL,
	creditcardnummer varchar(19),
    controlenummer char(23) NULL
)
go

go
CREATE TABLE Voorwerp (
	voorwerpnummer int IDENTITY(1,1) NOT NULL,
	titel varchar(50) NOT NULL,
	beschrijving varchar(5000) NOT NULL,
	startprijs numeric(10,2) NOT NULL,
	betalingswijze varchar(25) NOT NULL,
	betalingsinstructie varchar(50) NULL,
	plaatsnaam varchar(50) NOT NULL,
	land varchar(20) NOT NULL,
	looptijd smallint NOT NULL,
	veilingbegin datetime NOT NULL,
	verzendkosten numeric(8,2) NULL,
	verzendinstructies varchar(50) NULL,
	verkoper varchar(20) NOT NULL,
	koper varchar(20) NULL,
    veilingeinde datetime NOT NULL,
	veilingGesloten bit NOT NULL,
    verkoopprijs numeric(15, 2) null
)
go

go
CREATE TABLE VoorwerpInRubriek (
	voorwerpnummer int NOT NULL,
	rubrieknummer int NOT NULL
)
go

go
CREATE TABLE Vraag (
	vraagnummer int NOT NULL,
	tekstvraag varchar(250) NOT NULL
)
go

/* Primary Keys */
go
ALTER TABLE Bestand
ADD CONSTRAINT PK_Bestand PRIMARY KEY (filenaam);

ALTER TABLE Bod 
ADD CONSTRAINT PK_Bod PRIMARY KEY (voorwerp, bodbedrag);

ALTER TABLE Feedback
ADD CONSTRAINT PK_Feedback PRIMARY KEY (voorwerpnummer, soortgebruiker);

ALTER TABLE Gebruiker
ADD CONSTRAINT PK_Gebruiker PRIMARY KEY (gebruikersnaam);

ALTER TABLE Gebruikerstelefoon
ADD CONSTRAINT PK_Gebruikerstelefoon PRIMARY KEY (volgnr, gebruikersnaam);

ALTER TABLE Rubriek
ADD CONSTRAINT PK_Rubriek PRIMARY KEY (rubrieknummer);

ALTER TABLE Verkoper
ADD CONSTRAINT PK_Verkoper PRIMARY KEY (gebruikersnaam);

ALTER TABLE Voorwerp
ADD CONSTRAINT PK_Voorwerp PRIMARY KEY (voorwerpnummer);

ALTER TABLE VoorwerpInRubriek 
ADD CONSTRAINT PK_VoorwerpInRubriek PRIMARY KEY (voorwerpnummer, rubrieknummer);

ALTER TABLE Vraag
ADD CONSTRAINT PK_Vraag PRIMARY KEY (vraagnummer);
go



/* Foreign Keys */
go
ALTER TABLE Bestand
ADD CONSTRAINT FK_Bestand_Voorwerp_REF_Voorwerpnummer FOREIGN KEY (voorwerpnummer)
	REFERENCES Voorwerp (voorwerpnummer);

ALTER TABLE Bod
ADD CONSTRAINT FK_Bod_Voorwerp_REF_Voorwerpnummer FOREIGN KEY (voorwerp)
	REFERENCES Voorwerp (voorwerpnummer)
	ON UPDATE CASCADE
	ON DELETE NO ACTION;

ALTER TABLE Bod
ADD CONSTRAINT FK_Bod_Gebruiker_REF_Gebruikersnaam FOREIGN KEY (gebruiker)
	REFERENCES Gebruiker (gebruikersnaam);

ALTER TABLE Feedback
ADD CONSTRAINT FK_Feedback_Voorwerp_REF_Voorwerpnummer FOREIGN KEY (voorwerpnummer)
	REFERENCES Voorwerp (voorwerpnummer);

ALTER TABLE Gebruiker
ADD CONSTRAINT FK_Gebruiker_Vraag_REF_Vraagnummer FOREIGN KEY (vraag)
	REFERENCES Vraag (vraagnummer);

ALTER TABLE Gebruikerstelefoon
ADD CONSTRAINT FK_Gebruikerstelefoon_Gebruiker_REF_Gebruikersnaam FOREIGN KEY (gebruikersnaam)
	REFERENCES Gebruiker (gebruikersnaam);

ALTER TABLE Rubriek
ADD CONSTRAINT FK_Rubriek_Rubriek_Ref_Rubrieknummer FOREIGN KEY (rubriek)
	REFERENCES Rubriek (rubrieknummer);

ALTER TABLE Verkoper
ADD CONSTRAINT FK_Verkoper_Voorwerp_Ref_Verkoper FOREIGN KEY (gebruikersnaam)
	REFERENCES Gebruiker (gebruikersnaam); 

ALTER TABLE Voorwerp
ADD CONSTRAINT FK_Voorwerp_Verkoper_Ref_Gebruikersnaam FOREIGN KEY (verkoper)
	REFERENCES Verkoper (gebruikersnaam);

ALTER TABLE Voorwerp
ADD CONSTRAINT FK_Voorwerp_Gebruiker_REF_Gebruikersnaam FOREIGN KEY (verkoper)
	REFERENCES Gebruiker (gebruikersnaam); 

ALTER TABLE VoorwerpInRubriek
ADD CONSTRAINT FK_VoorwerpInRubriek_Voorwerp_REF_Voorwerpnummer FOREIGN KEY (voorwerpnummer)
	REFERENCES Voorwerp (voorwerpnummer);

ALTER TABLE VoorwerpInRubriek
ADD CONSTRAINT FK_VoorwerpInRubriek_Rubriek_REF_Rubrieknummer FOREIGN KEY (rubrieknummer)
	REFERENCES Rubriek (rubrieknummer);
go

go
/* Check Constraints */
/* Gebruiker > 18 jaar */
ALTER TABLE Gebruiker
ADD CONSTRAINT CK_Gebruiker_Leeftijd CHECK (DATEADD(year, 18, geboortedag) <= getdate());

/* Feedbacksoort: negatief, neutraal, positief  */
ALTER TABLE Feedback
ADD CONSTRAINT CK_Feedbacksoort CHECK (feedbacksoort = 'negatief' OR Feedbacksoort = 'neutraal' OR Feedbacksoort = 'positief');

/* Exclusief koper of verkoper */
ALTER TABLE Feedback
ADD CONSTRAINT CK_Gebruikersoort CHECK (soortgebruiker = 'koper' OR soortgebruiker = 'verkoper');

/* Valide email checken */
ALTER TABLE Gebruiker
ADD CONSTRAINT CK_VALIDE_EMAIL CHECK (email LIKE '%_@__%.__%');

go

/* Unique Constraints */
/* Gebruiker niet twee keer bieden */
ALTER TABLE Bod
ADD CONSTRAINT UN_Bod_Twee_Keer UNIQUE (gebruiker, bodtijdstip);
go