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

/**
 * Verwijder de gegevens als de 'id' wordt meegegeven in de URL via GET
 */
if (isset($_GET['id'])) {
    // Maak een delete-query die de gegevens uit de tabel verwijdert
    $sql = "DELETE FROM Lid WHERE Id = :id";

    // Bereidt de sql-query voor voor uitvoering in PDO
    $statement = $pdo->prepare($sql);

    // Koppel de id aan de query
    $statement->bindParam(':id', $_GET['id'], PDO::PARAM_INT);

    // Voer de query uit
    $statement->execute();

    // Geef een succesbericht en stuur de gebruiker terug naar index.php
    header('Refresh: 3; url=index.php');
}

/**
 * Maak een select-query die alle gegevens uit de de tabel Lid
 * haalt. Sorteer op achternaam
 */
$sql = "SELECT  L.Id
               ,L.Voornaam
               ,L.Tussenvoegsel
               ,L.Achternaam
               ,L.Relatienummer
               ,L.Mobiel
               ,L.Email
               ,L.IsActief
               ,L.Opmerking
        FROM Lid AS L
        ORDER BY L.Achternaam ASC" ;

/**
 * Met de method prepare van het pdo-object maak je de sql-query
 * klaar voor het PDO-object om uitgevoerd te worden. De gepreparde
 * sql-query stoppen we in de variabele $statement
 */
$statement = $pdo->prepare($sql);

/**
 * Voer nu de gepreparde sql-query uit op de database
 */
$statement->execute();

/**
 * Haal de geselecteerde records binnen als objecten in een array
 * en stop deze in een variabele $result
 */
$result = $statement->fetchAll(PDO::FETCH_OBJ);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gym SignUp - Leden</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  </head>
  <body>
    <div class="container mt-3">
        
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8"><h3 class="text-primary">Leden van GymSignUp</h3></div>
            <div class="col-2"></div>
        </div>

        <div class="row">
          <div class="col-2"></div>
          <div class="col-2"><h6>Nieuwe lid <a href="./create.php"><i class="bi bi-plus-square text-danger"></i></a></h5></div>
          <div class="col-2"></div>
        </div>

        <div class="row">
          <div class="col-2"></div>
          <div class="col-8">
              <table class="table table-hover">
                <thead>
                    <th>Voornaam</th>
                    <th>Tussenvoegsel</th>
                    <th>Achternaam</th>
                    <th>Relatienummer</th>
                    <th>Mobiel</th>
                    <th>Email</th>
                    <th>Is Actief</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    <?php foreach ($result as $row) : ?>
                        <tr>
                            <td><?= $row->Voornaam ?></td>
                            <td><?= $row->Tussenvoegsel ?></td>
                            <td><?= $row->Achternaam ?></td>
                            <td><?= $row->Relatienummer ?></td>
                            <td><?= $row->Mobiel ?></td>
                            <td><?= $row->Email ?></td>
                            <td><?= $row->IsActief ? 'Ja' : 'Nee' ?></td>
                            <td>
                              <a href="update.php?id=<?= $row->Id; ?>">
                                  <i class="bi bi-pencil-square text-primary"></i>
                              </a>
                            </td>
                            <td>
                              <a href="index.php?id=<?= $row->Id; ?>">
                                <i class="bi bi-x-square text-danger"></i>
                              </a>
                            </td>
                        </tr>
                    <?php endforeach;  ?>
                </tbody>
              </table>
          </div>
          <div class="col-2"></div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
