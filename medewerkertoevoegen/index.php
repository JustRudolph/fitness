<?php
include('../config/config.php');

$dsn = "mysql:host=$dbHost;
        dbname=$dbName;
        charset=UTF8";

$pdo = new PDO($dsn, $dbUser, $dbPass);

$sql = "SELECT  HAVE.Id
               ,HAVE.Naam
               ,HAVE.Tussenvoegsel
               ,HAVE.Achternaam
               ,HAVE.Leeftijd
               ,HAVE.Email

        FROM Medewerkers AS HAVE

        ORDER BY Id ASC" ;


$statement = $pdo->prepare($sql);

$statement->execute();

$result = $statement->fetchAll(PDO::FETCH_OBJ);


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Medewerker Overzicht</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  </head>
  <body>
    <div class="container mt-3">

        <div class="row">
            <div class="col-1"></div>
            <div class="col-10"><h3 class="text-primary">Medewerker Overzicht</h3></div>
            <div class="col-1"></div>
        </div>

            <div class="row">
              <div class="col-1"></div>
              <div class="col-2"><h6>Nieuwe medewerker <a href="./create.php"><i class="bi bi-plus-square text-danger"></i></a></h5></div>
              <div class="col-1"></div>
            </div>

        <div class="row">
          <div class="col-1"></div>
          <div class="col-10">
              <table class="table table-hover">
                <thead>
                    <th>Naam</th>
                    <th>Tussenvoegsel</th>
                    <th>Achternaam</th>
                    <th>Leeftijd</th>
                    <th>Email</th>
                    <th>Update</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                    <?php foreach ($result as $row) : ?>
                        <tr>
                            <td><?= $row->Naam ?></td>
                            <td><?= $row->Tussenvoegsel ?></td>
                            <td><?= $row->Achternaam ?></td>
                            <td class="text-center"><?= $row->Leeftijd ?></td>
                            <td class="text-center"><?= $row->Email ?></td>
                            <td>
                              <a href="update.php?id=<?= $row->Id; ?>">
                                  <i class="bi bi-pencil-square text-primary"></i>
                              </a>
                            </td>
                            <td>
                              <a href="delete.php?id=<?= $row->Id; ?>">
                                <i class="bi bi-x-square text-danger"></i>
                              </a>
                            </td>
                        </tr>
                    <?php endforeach;  ?>
                </tbody>
              </table>
          </div>
          <div class="col-1"></div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
