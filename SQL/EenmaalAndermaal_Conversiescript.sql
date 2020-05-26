SELECT * FROM Items
SELECT * FROM Voorwerp

--Users
SELECT * FROM Users
SELECT * FROM Gebruiker

INSERT INTO Gebruiker
SELECT DISTINCT Username AS gebruikersnaam,
'' AS voornaam,
'' AS achternaam,
'' AS adresregel1,
NULL AS adresregel2,
LEFT(Postalcode, 10) AS postcode,
'' AS plaatsnaam,
LEFT(Location, 60) AS land,
'' AS geboortedag,
'null@null.null' AS email, --geldige emailformaat
'' AS wachtwoord,
1 AS vraag,
'' AS antwoordtekst,
1 AS isVerkoper,
0 AS isAdmin,
NULL AS geblokkeerd
FROM Users

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

--items
--verander id zodat het bij 1000.000 begint. Zo komen er geen conflicten tussen de huidige en oude producten en kunnen wij de voorwerpnummers overnemen zonder de datatype te wijzigen
DECLARE @id AS BIGINT
SET @id = 1000000

UPDATE Items
SET @id = ID = @id + 1

--converteer daarna alle items naar de tabel voorwerp.
INSERT INTO Voorwerp
SELECT CAST(ID AS int) AS voorwerpnummer,
LEFT(titel, 255) AS titel,
'Beschrijving van: ' + titel AS Beschrijving,
CAST(prijs AS NUMERIC(10, 2)) AS startprijs,
'' AS betalingswijze,
NULL AS betalingsinstructie,
'' AS plaatsnaam,
LEFT(locatie, 60) AS land,
0 AS looptijd,
'' AS veilingbegin,
0.00 AS verzendkosten,
NULL AS verzendinstructies,
verkoper AS verkoper,
NULL AS Koper,
'' AS veilingeinde,
1 AS veilingGesloten,
NULL AS verkoopprijs
FROM Items




--Bestand
SELECT * FROM Illustraties
SELECT * FROM Bestand

INSERT INTO Bestand
SELECT illustratieFile AS filenaam,
ItemID AS voorwerpnummer
FROM Illustraties


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
