<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="company.css">
    <title>Document</title>
</head>
<body>
<?php
include "nav.html";
require_once("dbconnect.php");
echo "<main>";
if (isset($_POST["register"]) != true) {
?>
<?php
    $query = $db->prepare("SELECT * from country");
    $query->execute();
    $result=$query->fetchAll(PDO::FETCH_ASSOC);
    ?>
<h2>Registratie Formulier</h2>
<form method="POST">
    <label for="givenname">Voornaam:</label><br>
    <input type="text" id="givenname" name="givenname" required value="test"><br>
    <label for="surname">Achternaam:</label><br>
    <input type="text" id="surname" name="surname" required value="test"><br>
    <label for="midInitials">Overige Initialen:</label><br>
    <input type="text" id="midInitials" name="midInitials"><br>
    <legend>geslacht:</legend>
    <label for="female">Vrouw</label>
    <input type="radio" id="female" name="gender">
    <label for="male">Man</label>
    <input type="radio" id="male" name="gender">
    <label for="other">Anders</label>
    <input type="radio" id="other" name="gender"><br>
    <label for="streetadress">Adres:</label><br>
    <input type="text" id="streetadress" name="streetadress" required value="test"><br>
    <label for="city">Woonplaats:</label><br>
    <input type="text" id="city" name="city" required value="test"><br>
    <label for="zipcode">Postcode:</label><br>
    <input type="text" id="zipcode" name="zipcode" required value="test"><br>
    <label for="country">Selecteer uw land:</label><br>
    <select  id="country" name="country">
        <?php
            foreach ($result as $rij)
            {
                echo '<option value="'.$rij['idcountry'].'"> ';
                echo $rij['code'].' - '.$rij['name'];
                echo '</option>';
            }
            ?>
    </select><br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required value="test@tgest.ta"><br>
    <label for="phonenr">Telefoonnummer:</label><br>
    <input type="text" id="phonenr" name="phonenr" required value="062814298"><br>
    <label for="birthday">Geboortedatum:</label><br>
    <input type="date" id="birthday" name="birthday" required value="2005-01-01"><br>
    <label for="occupation">beroep:</label><br>
    <input type="text" id="occupation" name="occupation" required value="test"><br>
    <label for="password1">Wachtwoord:</label><br>
    <input type="password" id="password1" name="password1" required value="test"><br>
    <label for="password2">Herhaal Wachtwoord:</label><br>
    <input type="password" id="password2" name="password2" required value="test"><br>
    <input type="submit" value="register" name="register">
</form>
<?php
}

if (isset($_POST["register"])) {

$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
$ww = password_hash($_POST['password1'], PASSWORD_DEFAULT);

try {
    $query = $db->prepare("SELECT emailadress FROM client WHERE emailadress = :emailadress");
    $query->bindValue(':emailadress', $_POST['email']);
    $query->execute();

    if($query->rowCount() > 0) {
        echo "Email bestaat al in de database.";
        exit();
    }


    $query = $db->prepare("INSERT INTO client(surname, givenname, middleinitial, zipcode, countryid, streetadress,
                                                 telephonenumber, occupation, city, emailadress, birthday, password) 
                                VALUES (:surname,:givenname,:middleinitial,:zipcode,:countryid,:streetadress,
                                        :telephonenumber,:occupation,:city,:emailadress, :birthday,:password)");

    $query->bindValue(':givenname', $_POST['givenname']);
    $query->bindValue(':surname', $_POST['surname']);
    $query->bindValue(':city', $_POST['city']);
    $query->bindValue(':emailadress', $_POST['email']);
    $query->bindValue(':birthday', $_POST['birthday']);
    $query->bindValue(':middleinitial', $_POST['midInitials']);
    $query->bindValue(':telephonenumber', $_POST['phonenr']);
    $query->bindValue(':zipcode', $_POST['zipcode']);
    $query->bindValue(':streetadress', $_POST['streetadress']);
    $query->bindValue(':countryid', $_POST['country']);
    $query->bindValue(':occupation', $_POST['occupation']);
    $query->bindValue(':password', $ww);
    $query->execute();


} catch(Exception $e) {
    $sMsg = '<p>
            Regelnummer: '.$e->getLine().'<br> />
            Bestand:  '.$e->getFile().'<br> />
            Foutmelding '.$e->getMessage().'<br> />
            </p> ';
    trigger_error($sMsg);
}
?>


<!-- melding dat het gelukt is -->
<div class="registration_completed">Beste<?php echo ' ' . $_POST['givenname'] . ' ' . $_POST['surname'] . ','?> uw registratie is succesvol <br>
    Uw klantnummer is: <?php echo ' ' .$db->lastInsertId()?> </div>


<?php
}
?>
</main>
</body>
</html>
