<?php
if (isset($_POST['submit'])) {

  include('../config/config.php');

  $dsn = "mysql:host=$dbHost;
          dbname=$dbName;
          charset=UTF8";

  $pdo = new PDO($dsn, $dbUser, $dbPass);

  $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  // Check if a record with the same Id already exists
  $sql = "SELECT * FROM Medewerkers WHERE Id = :Id";
  $statement = $pdo->prepare($sql);
  $statement->bindValue(':Id', $_POST['Id'], PDO::PARAM_INT);
  $statement->execute();

  if ($statement->rowCount() > 0) {
    // If a record with the same Id already exists, display an error message
    $error = "Er is een fout opgetreden bij het toevoegen van de medewerker. Probeer het later opnieuw.";
    $display = 'flex';
  } else {
    // If no record with the same Id exists, insert the new record
    $sql = "INSERT INTO Medewerkers
            (
                 Id
                 ,Naam
                 ,Tussenvoegsel
                 ,Achternaam
                 ,Leeftijd
                 ,Email
            )
            VALUES
            (    :Id
                ,:Naam
                ,:Tussenvoegsel
                ,:Achternaam
                ,:Leeftijd
                ,:Email
            )";

    $statement = $pdo->prepare($sql);

    $statement->bindValue(':Id', $_POST['Id'], PDO::PARAM_INT);
    $statement->bindValue(':Naam', $_POST['Naam'], PDO::PARAM_STR);
    $statement->bindValue(':Tussenvoegsel', $_POST['Tussenvoegsel'], PDO::PARAM_STR);
    $statement->bindValue(':Achternaam', $_POST['Achternaam'], PDO::PARAM_STR);
    $statement->bindValue(':Leeftijd', $_POST['Leeftijd'], PDO::PARAM_INT);
    $statement->bindValue(':Email', $_POST['Email'], PDO::PARAM_STR);

    $statement->execute();

    $display = 'flex';

    header('Refresh:3; index.php');
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Medewerkers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  </head>
  <body>
    <div class="container mt-3">

        <div class="row" style="display:<?= $display ?? 'none'; ?>">
          <div class="col-3"></div>
          <div class="col-6">
            <?php if (isset($error)) : ?>
              <div class="alert alert-danger text-center" role="alert">
                <?= $error ?>
              </div>
            <?php else : ?>
              <div class="alert alert-success text-center" role="alert">
                De gegevens zijn toegevoegd. U wordt teruggestuurd naar de index-pagina.
              </div>
            <?php endif; ?>
          </div>
          <div class="col-3"></div>
        </div>

        <div class="row">
            <div class="col-3"></div>
            <div class="col-6"><h3 class="text-primary">Voer een nieuwe medewerker in:</h3></div>
            <div class="col-3"></div>
        </div>

        <div class="row">
          <div class="col-3"></div>
          <div class="col-6">
            <form action="create.php" method="POST">
                <div class="mb-3">
                    <label for="inputId" class="form-label">Id:</label>
                    <input name="Id" placeholder="Vul de id in" type="number" min="0" max="255" class="form-control" id="Id" value="<?= $_POST['Id'] ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label for="inputNaam" class="form-label">Naam:</label>
                    <input name="Naam" placeholder="Vul de naam in" type="text" class="form-control" id="inputNaam" value="<?= $_POST['Naam'] ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label for="inputTussenvoegsel" class="form-label">Tussenvoegsel:</label>
                    <input name="Tussenvoegsel" placeholder="Vul de tussenvoegsel in" type="text" class="form-control" id="inputTussenvoegsel" value="<?= $_POST['Tussenvoegsel'] ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label for="inputAchternaam" class="form-label">Achternaam:</label>
                    <input name="Achternaam" placeholder="Vul de achternaam in" type="text" class="form-control" id="inputAchternaam" value="<?= $_POST['Achternaam'] ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label for="inputLeeftijd" class="form-label">Leeftijd:</label>
                    <input name="Leeftijd" placeholder="Vul de leeftijd in" type="number" min="0" max="255" class="form-control" id="inputLeeftijd" value="<?= $_POST['Leeftijd'] ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email:</label>
                    <input name="Email" placeholder="Vul een email in" type="text" class="form-control" id="inputEmail" value="<?= $_POST['Email'] ?? '' ?>">
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
