<?php
// Your PHP code here
if (isset($_POST['submit'])) {
  $errors = array();

  // Validate Naam
  if (empty($_POST['Naam'])) {
    $errors[] = "Naam is required";
  } elseif (strlen($_POST['Naam']) > 50) {
    $errors[] = "Naam must be less than 50 characters";
  }

  // Validate Achternaam
  if (empty($_POST['Achternaam'])) {
    $errors[] = "Achternaam is required";
  } elseif (strlen($_POST['Achternaam']) > 50) {
    $errors[] = "Achternaam must be less than 50 characters";
  }

  // Validate Leeftijd
  if (empty($_POST['Leeftijd'])) {
    $errors[] = "Leeftijd is required";
  } elseif (!is_numeric($_POST['Leeftijd'])) {
    $errors[] = "Leeftijd must be a number";
  }

  // Validate Email
  if (empty($_POST['Email'])) {
    $errors[] = "Email is required";
  } elseif (!filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Email must be a valid email address";
  }

  // If there are no errors, insert the data into the database
  if (empty($errors)) {
    include('../config/config.php');

    $dsn = "mysql:host=$dbHost;
            dbname=$dbName;
            charset=UTF8";

    $pdo = new PDO($dsn, $dbUser, $dbPass);

    //Check if a record with the same values exists
    $sql = "SELECT * FROM Medewerkers WHERE Naam = :Naam AND Achternaam = :Achternaam AND Leeftijd = :Leeftijd AND Email = :Email";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':Naam', $_POST['Naam'], PDO::PARAM_STR);
    $statement->bindValue(':Achternaam', $_POST['Achternaam'], PDO::PARAM_STR);
    $statement->bindValue(':Leeftijd', $_POST['Leeftijd'], PDO::PARAM_INT);
    $statement->bindValue(':Email', $_POST['Email'], PDO::PARAM_STR);
    $statement->execute();

    if ($statement->rowCount() > 0) {
      echo '<div class="alert alert-danger text-center" role="alert">
              Er bestaat al een record met deze gegevens.
            </div>';
    }
    else {


    $sql = "INSERT INTO Medewerkers
            (
                 Naam
                 ,Achternaam
                 ,Leeftijd
                 ,Email
            )
            VALUES
            (   :Naam
                ,:Achternaam
                ,:Leeftijd
                ,:Email
            )";

    $statement = $pdo->prepare($sql);

    $statement->bindValue(':Naam', $_POST['Naam'], PDO::PARAM_STR);
    $statement->bindValue(':Achternaam', $_POST['Achternaam'], PDO::PARAM_STR);
    $statement->bindValue(':Leeftijd', $_POST['Leeftijd'], PDO::PARAM_INT);
    $statement->bindValue(':Email', $_POST['Email'], PDO::PARAM_STR);

    $statement->execute();

    header('Refresh:3; index.php');

    echo '<div class="alert alert-success text-center" role="alert">
            De gegevens zijn toegevoegd. U wordt teruggestuurd naar de index-pagina.
          </div>';
    }
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

        <div class="row" style="display:<?= empty($errors) ? 'none' : 'block'; ?>">
          <div class="col-3"></div>
          <div class="col-6">
            <?php if (isset($error)) : ?>
              <div class="alert alert-danger text-center" role="alert">
                <?= $error ?>
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
                    <label for="Naam" class="form-label">Naam:</label>
                      <input type="text" class="form-control" placeholder="Vul de naam in" id="Naam" name="Naam" value="<?= $_POST['Naam'] ?? '' ?>">
                      <?php if (isset($errors) && in_array("Naam is required", $errors)) : ?>
                        <span style="color: red;">Naam is required</span>
                      <?php elseif (isset($errors) && in_array("Naam must be less than 50 characters", $errors)) : ?>
                        <span style="color: red;">Naam must be less than 50 characters</span>
                      <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="inputTussenvoegsel" class="form-label">Tussenvoegsel:</label>
                    <input name="Tussenvoegsel" placeholder="Vul de tussenvoegsel in" type="text" class="form-control" id="inputTussenvoegsel" value="<?= $_POST['Tussenvoegsel'] ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label for="Achternaam" class="form-label">Achternaam:</label>
                      <input type="text" class="form-control" placeholder="Vul de achternaam in" id="Achternaam" name="Achternaam" value="<?= $_POST['Achternaam'] ?? '' ?>">
                      <?php if (isset($errors) && in_array("Achternaam is required", $errors)) : ?>
                        <span style="color: red;">Achternaam is required</span>
                        <?php elseif (isset($errors) && in_array("Achternaam must be less than 50 characters", $errors)) : ?>
                            <span style="color: red;">Achternaam must be less than 50 characters</span>
                        <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="Leeftijd" class="form-label">Leeftijd:</label>
                      <input type="text" placeholder="Vul de leeftijd in" class="form-control" id="Leeftijd" name="Leeftijd" value="<?= $_POST['Leeftijd'] ?? '' ?>">
                      <?php if (isset($errors) && in_array("Leeftijd is required", $errors)) : ?>
                        <span style="color: red;">Leeftijd is required</span>
                      <?php elseif (isset($errors) && in_array("Leeftijd must be a number", $errors)) : ?>
                        <span style="color: red;">Leeftijd must be a number</span>
                      <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="Email" class="form-label">Email:</label>
                      <input type="email" placeholder="Vul een email in" class="form-control" id="Email" name="Email" value="<?= $_POST['Email'] ?? '' ?>">
                      <?php if (isset($errors) && in_array("Email is required", $errors)) : ?>
                        <span style="color: red;">Email is required</span>
                      <?php elseif (isset($errors) && in_array("Email must be a valid email address", $errors)) : ?>
                        <span style="color: red;">Email must be a valid email address</span>
                      <?php endif; ?>
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
