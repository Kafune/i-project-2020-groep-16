SELECT * FROM Items
SELECT * FROM Voorwerp

--items
--verander id zodat het bij 1000.000 begint
DECLARE @id AS BIGINT
SET @id = 1000000

UPDATE Items
SET @id = ID = @id + 1

--converteer daarna alle items naar de tabel voorwerp.
INSERT INTO Voorwerp
SELECT CAST(ID AS int) AS voorwerpnummer,
LEFT(titel, 255) AS titel,
Beschrijving AS Beschrijving, --maximale aantal
CAST(prijs AS NUMERIC(10, 2)) AS startprijs,
'NIET BEKEND' AS betalingswijze,
NULL AS betalingsinstructie,
'Geen' AS plaatsnaam,
LEFT(locatie, 60) AS land,
0 AS looptijd,
'1999-01-01 00:00:00.000' AS veilingbegin,
0.00 AS verzendkosten,
NULL AS verzendinstructies,
verkoper AS verkoper,
'' AS Koper,
'1999-01-11 00:00:00.000' AS veilingeinde,
1 AS veilingGesloten,
NULL AS verkoopprijs
FROM Items

--Users
SELECT * FROM Users
SELECT * FROM Gebruiker

INSERT INTO Gebruiker
SELECT DISTINCT Username AS gebruikersnaam,
'Onbekend' AS voornaam,
'Onbekend' AS achternaam,
'Onbekend' AS adresregel1,
NULL AS adresregel2,
LEFT(Postalcode, 10) AS postcode,
'Onbekend' AS plaatsnaam,
LEFT(Location, 60) AS land,
'1970-01-01 00:00:00.000' AS geboortedag,
'Onbekend@onbekend.net' AS email,
'Onbekend' AS wachtwoord,
1 AS vraag,
'Onbekend' AS antwoordtekst,
1 AS isVerkoper
FROM Users


--Bestand
SELECT * FROM Illustraties
SELECT * FROM Bestand

INSERT INTO Bestand
SELECT illustratieFile AS filenaam,
ItemID AS voorwerpnummer
FROM Illustraties


--verkoper
INSERT INTO Verkoper
SELECT gebruikersnaam AS gebruikersnaam,
NULL AS banknaam,
NULL AS rekeningnummer,
'Post' AS controleoptienaam,
NULL AS creditcardnummer,
NULL AS controlenummer
FROM Gebruiker
WHERE isVerkoper = 1

--rubrieken
SELECT * FROM Categorieen
SELECT * FROM Rubriek

INSERT INTO Rubriek
SELECT ID AS rubrieknummer,
Name AS rubrieknaam,
Parent AS rubriek
FROM Categorieen

--voorwerp in rubrieken
INSERT INTO VoorwerpInRubriek
SELECT ID AS voorwerpnummer,
Categorie AS rubrieknummer
FROM items



--Zodra alle conversie bestanden zijn gelukt, verwijder de geimporteerde tabellen

ALTER TABLE Categorieen
DROP CONSTRAINT FK_Items_In_Categorie
DROP TABLE Categorieen
DROP TABLE Illustraties
DROP TABLE Items
DROP TABLE Users
DROP TABLE tblIMAOLand
