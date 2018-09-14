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
    <title>Wydatki</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	
</head>
<body>
<div class="container">
    <header>
        <div class="row">
            <div class="col-md-5 col-xs-10">
                <h4>Wprowadź wydatek:</h4>
            </div>
        </div>
    </header>
    <article>
    <main>
        <div class="row">
            <div class="col-md-5 col-xs-10">
                <div id="expenseBlank">
                    <form class="form-horizontal" role="form" method="post" action="addExpenses.php">
                        <div class="form-group">
                            <label for="amountOfExpense" class="col-xs-4 col-md-3 control-label"><p class="text-left">Kwota:</p></label>
                            <div class="col-xs-7 col-md-6">
                                <input type="text" class="form-control input-lg" name = "amount" id="amountOfExpense" placeholder="... zł" >
                                <?php if(isset($_SESSION['error_amount'])) 
                                {
                                    echo "<div class='error'>".$_SESSION['error_amount']."</div>";
                                    unset($_SESSION['error_amount']);
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dateOfExpense" class="col-xs-4 col-md-3 control-label"><p class="text-left">Data:</p></label>
                            <div class="col-xs-7 col-md-6">
                                <input type="text" class="form-control input-lg" id="dateOfExpense" name = "dateExpense" placeholder="..." >
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
                            <p>Sposób płatoności: </p>
                            <label class="radio-inline">
                            <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="cash"> Gotówka
                            </label>
                            <label class="radio-inline">
                            <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="card"> Karta debetowa
                            </label>
                            <label class="radio-inline">
                            <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="creditCart"> Karta kredytowa
                            </label>
                            <?php if(isset($_SESSION['error_paymentMethod'])) 
                                {
                                    echo "<div class='error'>".$_SESSION['error_paymentMethod']."</div>";
                                    unset($_SESSION['error_paymentMethod']);
                                }
                            ?>
                        </div>
                        <div class="form-group" id="optionExpenses">
                            <label for="category" class="col-xs-4 col-md-3 control-label"><p class="text-left">Kategoria:</p></label>
                                <div class="col-xs-7 col-md-6">
                                    <select class="form-control" name="category">
                                        <option value="transport">Transport</option>
                                        <option value="books">Książki</option>
                                        <option value="food">Jedzienie</option>
                                        <option value="apartments">Mieszkanie</option>
                                        <option value="telecommunication">Telekomunikacja</option>
                                        <option value="health">Opieka zdrowotna</option>
                                        <option value="clothes">Ubranie</option>
                                        <option value="hygiene">Higiena</option>
                                        <option value="kids">Dzieci</option>
                                        <option value="recreation">Relaks</option>
                                        <option value="trip">Wycieczka</option>
                                        <option value = "savings">Oszczędności</option>
                                        <option value="retirement">Na złotą jesień - emerytura</option>         
                                        <option value="debtRepayment">Spłata długu</option>
                                        <option value="gift">Prezenty</option>
                                        <option value = "another">Inne</option>
                                    </select> 
                                    <?php if(isset($_SESSION['error_category'])) 
                                    {
                                        echo "<div class='error'>".$_SESSION['error_category']."</div>";
                                        unset($_SESSION['error_category']);
                                    }
                                    ?>
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="comments" class="col-xs-4 col-md-3 control-label"><p class="text-left">Komentarz :</p></label>
                            <div class="col-xs-7 col-md-6">
                                <textarea class="form-control" rows="2" placeholder="Opcjonalnie" name = "comments"></textarea>
                            </div> 
                        </div>
                        <p>
                        <button class="btn btn-lg btn-primary " id="addExpenseButton"type="submit">Dodaj</button>
                        <button class="btn btn-lg btn-primary " id="notExpenseButton"type="button"onclick="location.href='mainMenu.php';">Anuluj</button>
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