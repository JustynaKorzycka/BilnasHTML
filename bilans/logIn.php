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
    <title>Logowanie</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/fontello.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	
	
</head>
<body>
    <div class="container">
        <header>
            <div class="row">
                <div class="col-xs-7">
                    <h2>Panel logowania: </h2>
                </div>
            </div> 
        </header>
        <main>
            <div class="row">
                <div class="col-md-5 col-xs-10">
                   <div id="loginBlank">
                    <form rule="form" method="post" action="log.php">
                        <div class="form-group">
                            <label for="loginSubmit">Login</label>
                            <input type="text" class="form-control input-lg" name = "login" id="loginSubmit">
                            <?php if(isset($_SESSION['wrongLog'])) 
                            {
                                echo "<div class='error'>".$_SESSION['wrongLog']."</div>";
                                unset($_SESSION['wrongLog']);
                            }
                             ?>
                        </div>
                        <div class="form-group">
                            <label for="passwordSubmit">Hasło</label>
                            <input type="password" class="form-control input-lg" name = "password" id="passwordSubmit">
                            <?php if(isset($_SESSION['wrongPass'])) 
                            {
                                echo "<div class='error'>".$_SESSION['wrongPass']."</div>";
                                unset($_SESSION['wrongPass']);
                            }
                             ?>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block" id="regButton" type="submit" >Zaloguj</button>
                    </form>
                    </div> 
                </div>
                
                    <div class="col-md-4  col-md-offset-1 col-xs-10 col-xs-offset-1">
                        <div id="loginPicture" >
                            <img src="img/save2.png" class="img-thumbnail">
                        </div>
                    </div>
                </div>  
            </main>     
        </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
	
</body>
</html>