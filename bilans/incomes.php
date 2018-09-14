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
    <title>Przychody</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	
</head>
<body>
<div class="container">
    <header>
        <div class="row">
            <div class="col-md-5 col-xs-10">
                <h4>Wprowadź przychód:</h4>
            </div>
        </div>
    </header>
    <article>
    <main>
        <div class="row">
            <div class="col-md-5 col-xs-10">
                <div id="incomeBlank">
                    <form class="form-horizontal" role="form" method="post" action="addIncome.php"
                    >
                        <div class="form-group">
                            <label for="amountOfIncome" class="col-xs-4 col-md-3 control-label"><p class="text-left">Kwota:</p></label>
                            <div class="col-xs-7 col-md-6">
                                <input type="text" class="form-control input-lg" id="amountOfIncome" name = "amount" placeholder="... zł" >
                                <?php if(isset($_SESSION['error_amount'])) 
                                {
                                    echo "<div class='error'>".$_SESSION['error_amount']."</div>";
                                    unset($_SESSION['error_amount']);
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                                <label for="dateOfIncome" class="col-xs-4 col-md-3 control-label"><p class="text-left">Data:</p></label>
                                <div class="col-xs-7 col-md-6">
                                    <input type="text" class="form-control input-lg" id="dateOfIncome" name = "dateIncome" placeholder="..." >
                                    <span class="help-block">w postaci rrrr-mm-dd np. 2018-01-30. Domyślnie wstaw aktualną datę</span>
                                    <?php if(isset($_SESSION['error_date'])) 
                                    {
                                        echo "<div class='error'>".$_SESSION['error_date']."</div>";
                                        unset($_SESSION['error_date']);
                                    }
                                     ?>
                                </div>
                        </div>
                        <div class="radio">
                            <p>Kategoria: </p>
                            <label class="radio-inline">
                            <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="salary"> Wynagrodzenie
                            </label>
                            <label class="radio-inline">
                            <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="bankInterest"> Odsetki bankowe
                            </label>
                            <label class="radio-inline">
                            <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="allegro"> Sprzedaż na allegro
                            </label>
                            <label class="radio-inline">
                            <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="other"> Inne
                            </label>
                            <?php if(isset($_SESSION['error_category'])) 
                            {
                                echo "<div class='error'>".$_SESSION['error_category']."</div>";
                                unset($_SESSION['error_category']);
                            }
                            ?>
                        </div>
                        <div class="form-group" id="incomeCategory">
                            <label for="comments" class="col-xs-4 col-md-3 control-label"><p class="text-left">Komentarz :</p></label>
                            <div class="col-xs-7 col-md-6">
                                <textarea class="form-control" rows="2" placeholder="Opcjonalnie" name = "comments"></textarea>
                            </div> 
                        </div>
                        <p>
                        <button class="btn btn-lg btn-primary " id="addIncomeButton"type="submit">Dodaj</button>
                        <button class="btn btn-lg btn-primary " id="notIncomeButton"type="button" onclick="location.href='mainMenu.php';">Anuluj</button>
                        </p>
                    </form>
                </div>
            </div> 
            <div class="col-md-3 col-md-offset-2 col-xs-5 col-xs-offset-1">
                <div id="expensePhoto">
                    <img src="img/save3.png" >
                </div>  
            </div>
        </div>

    </main>
    </article>
</div>
    <script 
    src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
	
</body>
</html>