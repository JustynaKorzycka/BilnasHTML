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
    <title>Rejestracja</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
   
	
</head>
<body>
<div class="container">
<header> 
    <div class="row">
        <div class="col-xs-7">
            <h2>Wypełnij poniższy formularz:</h2>
        </div>
    </div>
</header>
<main>
    <div class="row">
        <div class="col-md-5 col-xs-10">
            <div id="blanks">
            <form role="form" method="post" action="save.php">
                <div class="form-group">
                    <label for="userName">Imię</label>
                    <input type="text" name="userName" class="form-control input-lg" id="userName" placeholder="Imię..." >
                    <?php if(isset($_SESSION['error_name'])) 
                    {
                        echo "<div class='error'>".$_SESSION['error_name']."</div>";
                        unset($_SESSION['error_name']);
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="email">Adres email</label>
                    <input type="text" name="email" class="form-control input-lg" id="email" placeholder="twoj@mail.com" >
                    <?php if(isset($_SESSION['error_email'])) 
                    {
                        echo"<div class='error'>".$_SESSION['error_email']."</div>";
                        unset($_SESSION['error_email']);
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="userLogin">Login</label>
                    <input type="text" name= "login" class="form-control input-lg" id="userLogin" placeholder="Login..." >
                    <?php if(isset($_SESSION['error_login'])) 
                    {
                        echo "<div class='error'>".$_SESSION['error_login']."</div>";;
                        unset($_SESSION['error_login']);
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="userPassword">Hasło</label>
                    <input type="password" name= "password" class="form-control input-lg" id="userPassword" placeholder="tajne hasło..." >
                    <?php if(isset($_SESSION['error_pass'])) 
                    {
                        echo "<div class='error'>".$_SESSION['error_pass']."</div>";
                        unset($_SESSION['error_pass']);
                    }
                    ?>
                </div>

                <button class="btn btn-lg btn-primary btn-block" id="regButton"type="submit">Zarejestruj</button>
            
            </form>  
            </div>
        </div>
        <div class="col-md-4  col-md-offset-1 col-xs-10 col-xs-offset-1">
            <div id="formImage">
                    <img src="img/save1.png" >
            </div>  
        </div>


</main>
</div>
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>