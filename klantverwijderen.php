<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="company.css">
    <title>Klant verwijderen</title>
</head>
<body>
<header>
    <h1>Company</h1>
    <!-- hieronder wordt het menu opgehaald. -->
    <?php

    include "nav.html";
    ?>
</header>

<main>
    <?php
    // Verbinding maken met de database
    require_once("dbconnect.php");

    // Geselecteerde gegevens ophalen uit de tabel client
    $query = $db->prepare("SELECT *
                FROM client ");

    $query->execute();
    $resultq = $query->fetchAll(PDO::FETCH_ASSOC);



    echo "<table>";
    echo "<thead><th>Voornaam</th><th>Achternaam</th></thead>";
    echo "<tbody>";


    foreach ($resultq as $data) {

        // formulier voor de delete proces

        echo "<form method='POST' action='deleteproces.php'>";



        echo "<tr>";
        echo "<input type='hidden' name='id' value='".$data['idclient']."'>";
        echo "<td>".$data["surname"]."<input type='hidden' name='surname' value =".$data["surname"]."></td>";
        echo "<td>".$data["givenname"]."<input type='hidden' name='givenname' value =".$data["givenname"]."></td>";
        echo "<td><input type='submit' name='delete' value='delete'></td>";

        echo "</tr>";
        echo "</form>";
    }
    ?>
</main>
</body>
</html>