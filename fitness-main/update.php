<?php
/**
 * Haal de inloggegevens op uit het bestand config.php
 */
include('config/config.php');

/**
 * We gaan gebruikmaken van PDO (PHP-DataObjects) en die wil de
 * inloggegevens in een dsn-string (data-sourcenamestring) hebben
 */
$dsn = "mysql:host=$dbHost;
        dbname=$dbName;
        charset=UTF8";

/**
 * Maak een nieuw PDO-object zodat we een verbinding hebben met onze database
 */       
$pdo = new PDO($dsn, $dbUser, $dbPass);


if (isset($_POST['submit'])) {

    /**
     * We gaan de $_POST waarden schoonmaken met de functie
     * filter_input_array. Deze functie filtert de waarden van een
     * array met een opgegeven filter. In dit geval FILTER_SANITIZE_STRING
     */
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    /**
     * Var_dump om te testen of de $_POST goed gevuld is
     */
    // var_dump($_POST);

    /**
     * Maak een update-query die de gegevens uit het formulier in de tabel zet
     * van de database
     */
    $sql = "UPDATE Gebruiker AS G
            SET    G.Voornaam = :voornaam
                  ,G.Tussenvoegsel = :tussenvoegsel
                  ,G.Achternaam = :achternaam
                  ,G.Gebruikersnaam = :gebruikersnaam
                  ,G.Wachtwoord = :wachtwoord
                  ,G.IsIngelogd = :isIngelogd
                  ,G.Ingelogd = :ingelogd
                  ,G.Uitgelogd = :uitgelogd
                  ,G.IsActief = :isActief
                  ,G.Opmerking = :opmerking
            WHERE  G.Id = :id";

    /**
     * Bereidt de sql-query voor voor uitvoering in PDO
     * en stop het resultaat in een variabele $statement
     */
    $statement = $pdo->prepare($sql);


    /**
     * Koppel de waarden uit het formulier aan de query
     */
    $statement->bindValue(':voornaam', $_POST['voornaam'], PDO::PARAM_STR);
    $statement->bindValue(':tussenvoegsel', $_POST['tussenvoegsel'], PDO::PARAM_STR);
    $statement->bindValue(':achternaam', $_POST['achternaam'], PDO::PARAM_STR);
    $statement->bindValue(':gebruikersnaam', $_POST['gebruikersnaam'], PDO::PARAM_STR);
    $statement->bindValue(':wachtwoord', $_POST['wachtwoord'], PDO::PARAM_STR);
    $statement->bindValue(':isIngelogd', $_POST['isIngelogd'], PDO::PARAM_INT);
    $statement->bindValue(':ingelogd', $_POST['ingelogd'], PDO::PARAM_STR);
    $statement->bindValue(':uitgelogd', $_POST['uitgelogd'], PDO::PARAM_STR);
    $statement->bindValue(':isActief', $_POST['isActief'], PDO::PARAM_INT);
    $statement->bindValue(':opmerking', $_POST['opmerking'], PDO::PARAM_STR);
    $statement->bindValue(':id', $_POST['Id'], PDO::PARAM_INT);

    /**
     * Voer nu de gepreparede sql-query uit op de database
     */
    $statement->execute();

    /**
     * Stuur de gebruiker terug naar de index.php
     */
    $display = 'flex';
    header('Refresh:4; url=index.php');    
} else {

    /**
     * Maak een select-query die op basis van een id het record ophaalt
     */
    $sql = "SELECT  G.Id
                   ,G.Voornaam
                   ,G.Tussenvoegsel
                   ,G.Achternaam
                   ,G.Gebruikersnaam
                   ,G.Wachtwoord
                   ,G.IsIngelogd
                   ,G.Ingelogd
                   ,G.Uitgelogd
                   ,G.IsActief
                   ,G.Opmerking

            FROM Gebruiker AS G

            WHERE G.Id = :id";

    /**
     * Met de method prepare van het pdo-object maak je de sql-query geschikt voor gebruik in 
     * het PDO-object. De gepreparede sql-query stoppen we in de variabele $statement
     */
    $statement = $pdo->prepare($sql);

    /**
     * Koppel de id aan de query
     */
    $statement->bindValue(':id', $_GET['id'], PDO::PARAM_INT);

    /**
     * Voer nu de gepreparede sql-query uit op de database
     */
    $statement->execute();

    /**
     * Haal de geselecteerde record binnen als een object en stop deze in de variabele $result
     */
    $result = $statement->fetch(PDO::FETCH_OBJ);

}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wijzig Gebruiker Gegevens</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
  <body>

    <div class="container mt-4">
    <div class="row" style="display:<?= $display ?? 'none'; ?>">
        <div class="col-3"></div>
        <div class="col-6">
            <div class="alert alert-success text-center" role="alert">
                Het record is gewijzigd
            </div>
        </div>
        <div class="col-3"></div>
    </div>

    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <h3 class="text-primary">Wijzig Gebruiker Gegevens</h3>
        </div>
        <div class="col-3"></div>
    </div>

    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <form action="update.php" method="POST">
                <div class="mb-3">
                    <label for="inputVoornaam" class="form-label">Voornaam:</label>
                    <input name="voornaam" placeholder="Vul de voornaam in" type="text" class="form-control" id="inputVoornaam" value="<?= $result->Voornaam ?? $_POST['voornaam']; ?>">
                </div>
                <div class="mb-3">
                    <label for="inputTussenvoegsel" class="form-label">Tussenvoegsel:</label>
                    <input name="tussenvoegsel" placeholder="Vul het tussenvoegsel in" type="text" class="form-control" id="inputTussenvoegsel" value="<?= $result->Tussenvoegsel ?? $_POST['tussenvoegsel']; ?>">
                </div>
                <div class="mb-3">
                    <label for="inputAchternaam" class="form-label">Achternaam:</label>
                    <input name="achternaam" placeholder="Vul de achternaam in" type="text" class="form-control" id="inputAchternaam" value="<?= $result->Achternaam ?? $_POST['achternaam']; ?>">
                </div>
                <div class="mb-3">
                    <label for="inputGebruikersnaam" class="form-label">Gebruikersnaam:</label>
                    <input name="gebruikersnaam" placeholder="Vul de gebruikersnaam in" type="text" class="form-control" id="inputGebruikersnaam" value="<?= $result->Gebruikersnaam ?? $_POST['gebruikersnaam']; ?>">
                </div>
                <div class="mb-3">
                    <label for="inputWachtwoord" class="form-label">Wachtwoord:</label>
                    <input name="wachtwoord" placeholder="Vul het wachtwoord in" type="password" class="form-control" id="inputWachtwoord" value="<?= $result->Wachtwoord ?? $_POST['wachtwoord']; ?>">
                </div>
                <div class="mb-3">
                    <label for="inputIsIngelogd" class="form-label">Is Ingelogd:</label>
                    <input name="isIngelogd" placeholder="Is ingelogd?" type="checkbox" class="form-control" id="inputIsIngelogd" value="<?= $result->IsIngelogd ?? $_POST['isIngelogd']; ?>">
                </div>
                <div class="mb-3">
                    <label for="inputIngelogd" class="form-label">Ingelogd:</label>
                    <input name="ingelogd" placeholder="Inlogdatum" type="datetime-local" class="form-control" id="inputIngelogd" value="<?= $result->Ingelogd ?? $_POST['ingelogd']; ?>">
                </div>
                <div class="mb-3">
                    <label for="inputUitgelogd" class="form-label">Uitgelogd:</label>
                    <input name="uitgelogd" placeholder="Uitlogdatum" type="datetime-local" class="form-control" id="inputUitgelogd" value="<?= $result->Uitgelogd ?? $_POST['uitgelogd']; ?>">
                </div>
                <div class="mb-3">
                    <label for="inputIsActief" class="form-label">Is Actief:</label>
                    <input name="isActief" placeholder="Is actief?" type="checkbox" class="form-control" id="inputIsActief" value="<?= $result->IsActief ?? $_POST['isActief']; ?>">
                </div>
                <div class="mb-3">
                    <label for="inputOpmerking" class="form-label">Opmerking:</label>
                    <textarea name="opmerking" placeholder="Vul een opmerking in" class="form-control" id="inputOpmerking"><?= $result->Opmerking ?? $_POST['opmerking']; ?></textarea>
                </div>
                <input type="hidden" name="Id" value="<?= $result->Id ?? $_POST['Id']; ?>">
                <div class="d-grid gap-2">
                    <button name="submit" type="submit" class="btn btn-primary btn-lg mt-2" value="submit">Wijzig</button>
                </div>
            </form>
        </div>
        <div class="col-3"></div>
    </div>

    <div class="row mt-3">
        <div class="col-3"></div>
        <div class="col-6">
            <a href="index.php">
                <i class="bi bi-arrow-left-square-fill text-danger" style="font-size:1.5em"></i>
            </a>
        </div>
        <div class="col-3"></div>
    </div>

    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
