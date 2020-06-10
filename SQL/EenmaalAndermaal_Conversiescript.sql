SELECT * FROM Items
SELECT * FROM Voorwerp

--Users
SELECT * FROM Users
SELECT * FROM Gebruiker

INSERT INTO Vraag VALUES(
999999,
'CONVERSIEVRAAG'
)

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
999999 AS vraag,
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


ALTER TABLE Illustraties DROP CONSTRAINT ItemsVoorPlaatje

DECLARE @id AS BIGINT
SET @id = 1000000

UPDATE Items
SET @id = ID = @id + 1

SET IDENTITY_INSERT Voorwerp ON

--converteer daarna alle items naar de tabel voorwerp.
INSERT INTO Voorwerp (voorwerpnummer, titel, beschrijving, startprijs, betalingswijze, betalingsinstructie, plaatsnaam, land, looptijd, veilingbegin, verzendkosten, verzendinstructies, verkoper, koper, veilingeinde, veilingGesloten, mailVerzonden, verkoopprijs, geblokkeerd)
SELECT CAST(ID AS int) AS voorwerpnummer,
LEFT(titel, 255) AS titel,
'Beschrijving van: ' + titel AS Beschrijving,
CAST(prijs AS NUMERIC(10, 2)) AS startprijs,
'GEEN' AS betalingswijze,
'GEEN' AS betalingsinstructie,
'GEEN' AS plaatsnaam,
LEFT(locatie, 60) AS land,
0 AS looptijd,
'2000-01-01' AS veilingbegin,
CAST(0.05 AS numeric(8,2)) verzendkosten,
NULL AS verzendinstructies,
verkoper AS verkoper,
NULL AS koper,
'2000-01-02' AS veilingeinde,
1 AS veilingGesloten,
1 AS mailVerzonden,
NULL AS verkoopprijs,
0 AS geblokkeerd
FROM Items

SET IDENTITY_INSERT Voorwerp OFF


--Bestand
SELECT * FROM Illustraties
SELECT * FROM Bestand

DECLARE @id1 AS BIGINT
SET @id1 = 1000000

UPDATE Illustraties
SET @id1 = ItemID = @id1 + 1

INSERT INTO Bestand
SELECT DISTINCT illustratieFile AS filenaam,
CAST(ItemID AS INT) voorwerpnummer
FROM Illustraties

--rubrieken
SELECT * FROM Categorieen
SELECT * FROM Rubriek

SET IDENTITY_INSERT Rubriek ON

INSERT INTO Rubriek (rubrieknummer, rubrieknaam, rubriek)
SELECT ID AS rubrieknummer,
Name AS rubrieknaam,
Parent AS rubriek
FROM Categorieen

SET IDENTITY_INSERT Rubriek OFF

--voorwerp in rubrieken
INSERT INTO VoorwerpInRubriek
SELECT ID AS voorwerpnummer,
Categorie AS rubrieknummer
FROM items

SELECT * FROM BESTAND
SELECT * FROM VOORWERP

--Zodra alle conversie bestanden zijn gelukt, verwijder de geimporteerde tabellen
ALTER TABLE ITEMS DROP CONSTRAINT FK_Items_In_Categorie
DROP TABLE Categorieen
DROP TABLE Illustraties
DROP TABLE Items
DROP TABLE Users
DROP TABLE tblIMAOLand