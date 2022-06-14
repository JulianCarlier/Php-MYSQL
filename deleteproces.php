<?php

require_once("dbconnect.php");

if(isset($_POST["delete"])){
    $id = $_POST['id'];
// zorgt er voor dat client wordt verwijderd
    $query = $db->prepare("DELETE FROM client WHERE idclient = :idclient");
    $query->bindparam("idclient", $id);

    if($query->execute()){

        //Klant is verwijderd

        echo "De klant is verwijderd. <a href='klantverwijderen.php'>Terug</a>";

    } else{
        // klant is toevoegd
        echo "Klant verwijderen is mislukt. <a href='klantverwijderen.php'>Terug</a>";
    }

    echo "<br>";
}

?>





































































