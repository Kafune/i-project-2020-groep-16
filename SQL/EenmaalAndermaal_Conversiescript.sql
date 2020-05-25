SELECT * FROM Items
SELECT * FROM Voorwerp

--items
SET IDENTITY_INSERT Voorwerp ON

INSERT INTO Voorwerp
SELECT CAST(ID AS int) AS voorwerpnummer,
LEFT(titel, 255) AS titel,
Beschrijving AS Beschrijving, --maximale aantal
prijs AS startprijs,
NULL AS betalingswijze,
NULL AS betalingsinstructie,
NULL AS plaatsnaam,
locatie AS land,
NULL AS looptijd,
NULL AS veilingbegin,
0.00 AS verzendkosten,
NULL AS verzendinstructies,
verkoper AS verkoper,
NULL AS koper,
NULL AS veilingeinde,
NULL AS veiliongGesloten,
NULL AS verkoopprijs
FROM Items

SET IDENTITY_INSERT Voorwerp OFF

--Users
SELECT * FROM Users
SELECT * FROM Gebruiker

INSERT INTO Gebruiker
SELECT Username AS gebruikersnaam,
NULL AS voornaam,
NULL AS achternaam,
NULL AS adresregel1,
NULL AS adresregel2,
Postalcode AS postcode,
NULL AS plaatsnaam,
Location AS land,
NULL AS geboortedag,
NULL AS email,
NULL AS wachtwoord,
NULL AS vraag,
NULL AS antwoordtekst,
NULL AS isVerkoper
FROM Users


--Bestand
SELECT * FROM Illustraties
SELECT * FROM Bestand

INSERT INTO Bestand
SELECT illustratieFile AS filenaam,
ItemID AS voorwerpnummer
FROM Illustraties