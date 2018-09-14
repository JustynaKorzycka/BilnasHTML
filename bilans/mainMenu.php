<?php
session_start();
if(!isset($_SESSION['userId']))
{
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
    <title>Menu główne</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="fontello/css/fontello.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	
	
</head>
<body>

    <div class="container">
    <header>  
        <div class="row">
            <div class="col-xs-10 col-md-10">
            <?php if(isset($_SESSION['addedIncome'])) 
                {
                    echo "<div style='margin-left:200px'>".$_SESSION['addedIncome']."</div>";
                    unset($_SESSION['addedIncome']);
                }
            ?> 
            <?php if(isset($_SESSION['addedExpenses'])) 
                {
                    echo "<div style='margin-left:200px'>".$_SESSION['addedExpenses']."</div>";
                    unset($_SESSION['addedExpenses']);
                }
            ?> 
                <h3 class="text-center">Witaj w swoim prywatnym przeglądzie finansowym!
                </h3> 
            </div>
            <div class="col-xs-1 col-md-1">   
                <div id="logOut">
                    <a href="logOut.php" id="linkLogOut"><i class="demo-icon icon-off"></i></a>
                </div>
            </div>  
            
        </div>
    </header>  
        <article>
            <main>
                <div class="row">
                    <div class="col-md-4 col-xs-10 col-md-offset-1">
                        <a href="incomes.php" class="linkInMenu">
                            <div class="menuOption" id="addIncome">
                                <i class="demo-icon icon-money"></i>
                                <p>dodaj przychód</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-xs-10">
                        <a href="expenses.php" class="linkInMenu">
                            <div class="menuOption" id="addExpense">
                                <i class="demo-icon icon-credit-card"></i>
                                <p>dodaj wydatek</p>
                            </div>
                        </a>   
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-xs-10 col-md-offset-1">
                        <a href="bilans.php" class="linkInMenu">
                            <div class="menuOption" id="seeBilnas">
                            <i class="demo-icon icon-news"></i>
                            <p>przegląd bilansu</p>
                            </div>
                        </a>   
                    </div>
                    <div class="col-md-4 col-xs-10">
                        <a href="#" class="linkInMenu"> 
                            <div class="menuOption" id="settings">
                            <i class="demo-icon icon-wrench"></i>
                            <p>ustawienia</p>
                            </div>
                        </a>
                    </div>
                </div>
            </main>
        </article>
    </div>
    <script 
    src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>