<?php
include "connect.php";
if($_POST[""]=="") {
    echo "<h2>Geen resultaat gevonden</h2>";
    echo "<h2><a href=index.php>Terug</a></h2>";
}


$query = $db->prepare("SELECT * FROM customer");
        $query->execute();
        $resultq = $query->fetchAll(PDO::FETCH_ASSOC);

  foreach ($resultq as $data) {
            echo "naam klant : " . $data["name"];
            echo "<br>";
            echo "straatnaam : " . $data["street"];
            echo "<br>";
            echo "huisnummer : " . $data["housenumber"];
            echo "<br>";
            echo "stad : " . $data["city"];
            echo "<br>";
            echo "e-mail : " . $data["e-mail"];
            echo "<br>";
            echo "telefoonnummer : " . $data["phonenumber"];
            echo "postcode : " . $data["postal-code"];
        }
?>