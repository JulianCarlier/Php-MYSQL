<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="company.css" />
</head>
<body>
<header>
<main>
<?php
    include("nav.php");
    // verbinding met de database
    include("dbconnect.php");

    if(isset($_POST["login"]))
    {
        //verbinden van de email
        $sQuery ="SELECT * from client WHERE emailadress = :emailadress";
        $oStmt = $db->prepare($sQuery);
        $oStmt-> BindValue('emailadress',$_POST['email']);
        $ww =$_POST['password'];
        $oStmt->execute();
        if($oStmt->rowCount()==1)

        {
            $rij= $oStmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($ww ,$rij['password']));
            {
                $_SESSION['emailadress']=$rij['emailadress'];
                $_SESSION["givenname"]=$rij['givenname'];
                $_SESSION['password']=$rij['password'];
                if($rij['isadmin']=="1"){
                    //login succesvol
                    $_SESSION['klogin']= true;
                    header('Refresh: 3 url=index.php');
                    echo "login succes";
                }
                else{
                    //beheerder inlog als klant
                    $_SESSION['blogin']= true;
                    header('Refresh: 3 url=index.php');
                    echo "<div class='container'>";
                    echo "<div class='panel panel-primary'>";
                    echo "<div class='panel-heading'>Inloggen is succesvol</div>";
                    echo "<div class='panel-body'>U gaat over 3 seconden naar de startpagina</div>";
                    echo "</div>";
                    echo "</div>";
                    header('Refresh: 3; url=index.php');

                }
            }
        }
        // login mislukt
        else{
            echo "login lukt niet";
        }
    }


    ?>
</header>
<br />
<div class="container" style="width:500px;">

    <form method="POST">
        <label>Email</label>
        <input type="email" name="email" class="form-control" />
        <br />
        <label>Password</label>
        <input type="password" name="password" class="form-control" />
        <br />
        <input type="submit" name="login" class="btn btn-info" value="Login" />
    </form>
</div>
<br />
</main>
</body>
</html>