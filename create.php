<?php
if (isset($_POST['submit'])) {

  // var_dump($_POST);
  /**
   * De inloggegevens van de gebruiker van de database binnenhalen
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

  /**
   * We gaan de $_POST waarden schoonmaken met de functie
   * filter_input_array. Deze functie filtert de waarden van een
   * array met een opgegeven filter. In dit geval FILTER_SANITIZE_STRING
   */
  $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  /**
   * Maak een insert-query die de gegevens uit het formulier in de tabel zet
   * van de database
   */
  // Opdrachtje maak een insert query...
  $sql = "INSERT INTO Gebruiker
          (
               Voornaam
              ,Tussenvoegsel
              ,Achternaam
              ,Gebruikersnaam
              ,Wachtwoord
              ,IsIngelogd
              ,Ingelogd
              ,Uitgelogd
              ,IsActief
              ,Opmerking
              ,DatumAangemaakt
              ,DatumGewijzigd
          )
          VALUES
          (    :voornaam
              ,:tussenvoegsel
              ,:achternaam
              ,:gebruikersnaam
              ,:wachtwoord
              ,0
              ,NULL
              ,NULL
              ,1
              ,NULL
              ,SYSDATE(6)
              ,SYSDATE(6)
          )";

  /**
   * Bereidt de sql-query voor voor uitvoering in PDO
   */
  $statement = $pdo->prepare($sql);

  $statement->bindValue(':voornaam', $_POST['voornaam'], PDO::PARAM_STR);
  $statement->bindValue(':tussenvoegsel', $_POST['tussenvoegsel'], PDO::PARAM_STR);
  $statement->bindValue(':achternaam', $_POST['achternaam'], PDO::PARAM_STR);
  $statement->bindValue(':gebruikersnaam', $_POST['gebruikersnaam'], PDO::PARAM_STR);
  $statement->bindValue(':wachtwoord', $_POST['wachtwoord'], PDO::PARAM_STR);

  /**
   * Voer de gepreparede sql-query uit
   */
  $statement->execute();

  /**
   * Geef een melding dat de gegevens zijn toegevoegd
   */
  $display = 'flex';

  header('Refresh:3; index.php');
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gym Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  </head>
  <body>
    <div class="container mt-3">  
      
        <div class="row" style="display:<?= $display ?? 'none'; ?>">
            <div class="col-3"></div>
            <div class="col-6">
              <div class="alert alert-success text-center" role="alert">
                De gegevens zijn toegevoegd. U wordt teruggestuurd naar de index-pagina.
              </div>
            </div>
            <div class="col-3"></div>
        </div>
        
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6"><h3 class="text-primary">Voer een nieuwe gebruiker in:</h3></div>
            <div class="col-3"></div>
        </div>

        <div class="row">
          <div class="col-3"></div>
          <div class="col-6">
            <form action="create.php" method="POST">
                <div class="mb-3">
                    <label for="inputVoornaam" class="form-label">Voornaam:</label>
                    <input name="voornaam" placeholder="Vul de voornaam in" type="text" class="form-control" id="inputVoornaam" value="<?= $_POST['voornaam'] ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label for="inputTussenvoegsel" class="form-label">Tussenvoegsel:</label>
                    <input name="tussenvoegsel" placeholder="Vul het tussenvoegsel in" type="text" class="form-control" id="inputTussenvoegsel" value="<?= $_POST['tussenvoegsel'] ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label for="inputAchternaam" class="form-label">Achternaam:</label>
                    <input name="achternaam" placeholder="Vul de achternaam in" type="text" class="form-control" id="inputAchternaam" value="<?= $_POST['achternaam'] ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label for="inputGebruikersnaam" class="form-label">Gebruikersnaam:</label>
                    <input name="gebruikersnaam" placeholder="Vul de gebruikersnaam in" type="text" class="form-control" id="inputGebruikersnaam" value="<?= $_POST['gebruikersnaam'] ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label for="inputWachtwoord" class="form-label">Wachtwoord:</label>
                    <input name="wachtwoord" placeholder="Vul het wachtwoord in" type="password" class="form-control" id="inputWachtwoord" value="<?= $_POST['wachtwoord'] ?? '' ?>">	
                </div>
                <div class="d-grid gap-2">
                    <button name="submit" type="submit" class="btn btn-primary btn-lg mt-2">Verstuur</button>
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

  