<?php
session_start();
require_once "dataBase.php";
if(!isset($_SESSION['userId']))
{
    header('Location: index.php');
    exit();  
}

$userId = $_SESSION['userId'];

$thisMonth = date('m');
$thisYear = date('Y');
$thisDate = date('Y-m-d');
$firstDay = $thisYear."-".$thisMonth."-01";

$thisMonthIncome = $db->prepare("SELECT incomes.amount, inc.name FROM incomes JOIN incomes_category_assigned_to_users AS inc ON incomes.date_of_income>='$firstDay' AND incomes.date_of_income<='$thisDate' AND incomes.user_id='$userId' AND incomes.income_category_assigned_to_user_id=inc.id");


$thisMonthIncome->execute();
$thisMonthBilnasIncome = $thisMonthIncome->fetchAll();

$thisMonthExpenses = $db->prepare("SELECT expenses.amount, expen.name FROM expenses JOIN expenses_category_assigned_to_users AS expen ON expenses.date_of_expense>='$firstDay' AND expenses.date_of_expense<='$thisDate' AND expenses.user_id='$userId' AND expenses.expense_category_assigned_to_user_id=expen.id");

$thisMonthExpenses->execute();
$thisMonthBilnasExpense = $thisMonthExpenses->fetchAll();

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
    <title>Bilans</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	
</head>
<body onload="currentMonth();">
<div class="container">
    <header>
        <div class="row">
            <div class="col-xs-12">
                <h4>Przegląd bilansu finansowego z bieżącego miesiąca</h4>
            </div>
        </div>
    </header>
    <article>
    <main>
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1">   
            <div id="todayMonth"> </div>
            <div class="row">
                <div class="col-xs-6">
                    <div class="table-responsive col-xs-11">
                        <table class="table table-bordered table-condensed" id="incomeTable">
                            <thead>
                                <tr>
                                    <th colspan="3" class= "text-center">Przychody</th>
                                </tr>
                            </thead>
                            <thead>
                                <tr>
                                    <th class= "text-center">#</th>
                                    <th class= "text-center">Kategoria</th>
                                    <th class= "text-center">Kwota PLN</th>
                                </tr>
                            </thead>
                            <tbod>
                                <?php
                                $number = 1;
                                $amountOfIncome = 0;
                                foreach($thisMonthBilnasIncome as $bilans)
                                {
                                    echo "<tr>
                                            <td>".$number."</td>
                                            <td>".$bilans['name'].
                                            "</td><td>".$bilans['amount']."</td>
                                        </tr>";
                                        $number++;
                                        $amountOfIncome +=$bilans['amount'];
                                }
                                ?> 
                                
                            </tbod>
                        </table>
                        <?php echo'<span style= "font-size: 20px; ">Suma: '.$amountOfIncome.' zł</span>'; ?>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="table-responsive col-xs-11">
                        <table class="table table-bordered  table-condensed" id="expenseTable">
                            <thead>
                                <tr>
                                    <th colspan="3" class= "text-center">Wydatki</th>
                                </tr>
                            </thead>
                            <thead>
                                <tr>
                                    <th class= "text-center">#</th>
                                    <th class= "text-center">Kategoria</th>
                                    <th class= "text-center">Kwota PLN</th>
                                </tr>
                            </thead>
                            <tbod>
                            <?php
                                $number = 1;
                                $amountOfExpenses = 0;
                                foreach($thisMonthBilnasExpense as $bilans)
                                {
                                    echo "<tr>
                                    <td>".$number."</td>
                                    <td>".$bilans['name'].
                                    "</td><td>".$bilans['amount']."</td>
                                        </tr>";
                                        $number++;
                                        $amountOfExpenses +=$bilans['amount'];
                                }
                                ?> 
                            </tbod>
                        </table>
                        <?php echo'<span style= "font-size: 20px; ">Suma: '.$amountOfExpenses.' zł</span>'; ?>
                </div>
            </div> 
        </main>
        </article>
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1">
            <div class="yesNoMoney">
                <?php
                    $totalAmount = $amountOfIncome - $amountOfExpenses;
                    if($totalAmount > 0)
                    {
                        echo "Brawo! W tym miesiącu oszczędziłeś ".$totalAmount." zł";
                    }
                    else if($totalAmount == 0)
                    {
                        echo "W tym miesiącu wyszedłeś na czysto";
                    }
                    else 
                    {
                        $totalAmount = $totalAmount * (-1);
                        echo "Niestety, w tym miesiącu wydałeś za dużo o ".$totalAmount." zł";
                    }
                ?>
            
            </div>   
        </div>
    </div> 
</div>
    <script type="text/javascript" src="main.js"></script>
    <script src="memory.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>