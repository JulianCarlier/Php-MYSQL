<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="company.css">  
    <title>Alle beheerders</title>
</head>
<body>
    <header>
		<h1>Company</h1>
	    <!-- hieronder wordt het menu opgehaald. -->
	    <?php
            session_start();
            include "nav.html";
	    ?>
	</header>

    <main>
    <?php
        // Verbinding maken met de database 
        require_once("dbconnect.php");

        if(isset($_POST["LogInAdmin"]))
        {
            $_SESSION["klantlogin"] = true;
            $_SESSION["login-idklant"] = $_POST["idclient"];
            $_SESSION["givenName"] = $_POST["givenname"];
            $_SESSION["surname"] = $_POST["surname"];

            echo "<div class='container'>";
            echo "<div class='panel panel-primary'>";
            echo "<div class='panel-heading'>Inloggen is succesvol</div>";
            echo "<div class='panel-body'>U gaat over 3 seconden naar de startpagina</div>";
            echo "</div>";
            echo "</div>";
            header('Refresh: 3; url=index.php');
        }
    ?>
    </main>
</body>
</html>