<!DOCTYPE html>
<html lang="nl"> 
<head>
	 <meta charset="UTF-8">
	 <title>Company</title>
	 <link rel="stylesheet" type="text/css" href="company.css">  
</head>

<body>  
	<header>
		<h1>Company</h1>
		<!-- hieronder wordt het menu opgehaald. -->
		<?php
		//	include "nav.html";
            require_once "dbconnect.php";
		?>
	</header>
 
	<!-- in de tabel client heb je zojuist het veld passwrd toegevoegd. Deze module vult alle records met een dummy wachtwoord hash -->
 	<main>
        <?php	
            $pw=password_hash("123456", PASSWORD_DEFAULT);
            $query = $db->prepare("UPDATE client SET password=:nwpw");
            $query->bindValue(':nwpw', $pw);
            $query->execute();
            echo "In totaal ".$query->rowCount()." records aangepast";
        ?>
    </main>
	
</body>
</html>
	
