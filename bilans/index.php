<?php
session_start();
if(isset($_SESSION['userId']))
{
    header('Location: mainMenu.php');
    exit();
}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
    <title>Bilnas finansowy - strona główna</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/fontello.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	
	
</head>
<body>
    <div class="container">
        <div class="row" id="firstHeader">
            <div class="col-xs-12">
             <header>
            <div id="admission">
            <?php
                if(isset($_SESSION['allRight']))
                {
                    echo "<span style='font-size:20px'>".$_SESSION['allRight']."</span>";
                    unset($_SESSION['allRight']);
                }

            ?>
                <p class="text-center">Zacznij już dziś kontrolę swoich finansów!</p>
            </div>
            </header>
            </div>
        </div>
        <main>
            <article>
                <div class="row">
                    <div class="col-xs-4 col-xs-offset-2">
                        <a href="registration.php" class="linki">
                            <div id="registration" class="panel">
                            Rejestracja
                            <i class="demo-icon icon-pen"></i>
                            </div>
                        </a>
                    </div>
                    <div class="col-xs-4">
                        <a href="logIn.php"class="linki" >
                            <div id="logIn" class="panel">
                            Logowanie
                            <i class="demo-icon icon-user"></i>
                            </div>
                        </a>
                    </div>
                <div style="clear:both;"> </div>
                </div>
            </article>
        </main>
        <div class="col-xs-10 col-xs-offset-1">
        <div id="quatation"><i>Lepiej jest godzinę pomyśleć o swoich pieniądzach, niż tydzień na nie pracować – Andre Costolany.</i></div>
        </div>  

    </div>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>