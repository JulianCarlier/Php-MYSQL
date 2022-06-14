<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="company.css">
<body>

<?php
include "nav.php";
echo "<main>";

?>
<main>
    <?php
    require_once("dbconnect.php");

    $email = ($_SESSION['emailadress']);
    $hash = '';

    if ($email  ) {
// user is ingelogged

        if (isset($_POST["submit"])) {
            $oldpassword =  $_POST['oldpassword'];
            $newpassword = $_POST['newpassword'];
            $repeatnewpassword = ($_POST['repeatnewpassword']);
            // haal wachtwoord op van ingelogde gebruiker
            $query = $db->prepare("SELECT password FROM client WHERE emailadress =:emailadress");
            $query->bindValue(':emailadress', $email);
            $query->execute();
            if($query->rowCount() <> 1)
            {
                echo "<br>Geen één record gevonden<br><br>";
                echo "email-adres: ".$email."<br><br>";
                echo "klogin uit SESSION: ".$_SESSION["klogin"]."<br><br>";
            }

            // controlleerd wachtwoord in database

            $resultq = $query->fetch(PDO::FETCH_ASSOC);

            if (password_verify($oldpassword , $resultq["password"])) {
                echo 'Password is veranderd!';
            } else {
                echo 'password is niet veranderd.';
                exit();
            }

            //check de 2 nieuwe wachtwoorden
            if ($newpassword == $repeatnewpassword) {
                //succes wachtwoord veranderd
                echo "Wachtwoord is veranderd";

            } else {
                //geen succes wachtwoorden niet gelijk
                echo "Wachtwoorden zijn niet gelijk";
                exit();
            }
            //succes
            // veranderd wachtwoord in db
            $ww = password_hash($newpassword, PASSWORD_DEFAULT);
            $querychange = $db->prepare("UPDATE client SET password='$ww' WHERE emailadress = :emailadress");

            $querychange->bindValue(':emailadress', $email);
            $querychange->execute();
            session_destroy();
            die("Your password has been changed. <a href'index.php'>Return</a> to the main page");
            exit();

        } else {

            echo "
        <form action='passwordchange.php' method='POST'><p>
                Oud Wachtwoord: <input type='text' name='oldpassword'><br>
                Nieuw Wachtwoord: <input type='password' name='newpassword'><br>
                Herhaal Wachtwoord: <input type='password' name='repeatnewpassword'><p>
                <input type='submit' name='submit' value='change password'>
        </form>
        ";
        }

    } else {
        // user is niet ingelogged
        die("Je moet ingelogged zijn op je wacthwoord te veranderen");
    }
    ?>
</main>
</body>