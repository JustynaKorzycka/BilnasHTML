<?php
session_start();
require_once "dataBase.php";
if(!isset($_SESSION['userId']))
{
    header('Location: index.php');
    exit();  
}
$userId = $_SESSION['userId'];

if(isset($_POST['firstDay']))
{
    $allRight = true;
    $todayDate = date('Y-m-d');
    $firstDate = $_POST['firstDay'];
    $lastDate = $_POST['lastDay'];

    $firstYear = substr($firstDate, 0, 4);
    $firstMonth = substr($firstDate, 5, 2);
    $firstDay = substr($firstDate, 8, 2);

    $lastYear = substr($lastDate, 0, 4);
    $lastMonth = substr($lastDate, 5, 2);
    $lastDay = substr($lastDate, 8, 2);

    if((!is_numeric($firstYear)) || (!is_numeric($firstMonth))|| (!is_numeric($firstYear))|| (!is_numeric($lastYear))|| (!is_numeric($lastMonth))|| (!is_numeric($lastDay)))
    {
        $allRight = false;
        $_SESSION['error_date'] = "Nie poprawna data lub format";
    }

    else if((!checkdate($firstMonth, $firstDay, $firstYear)) || (!checkdate($lastMonth, $lastDay, $lastYear)))
    {
        $allRight = false;
        $_SESSION['error_date'] = "Nie poprawna data lub format";
    }
    else
    {
        if($firstDate > $lastDate)
        {
            $allRight = false;
            $_SESSION['error_date'] = "Niepoprawny przedział";
        }
        else if($firstDate > $todayDate || $lastDate > $todayDate)
        {
            $allRight = false;
            $_SESSION['error_date'] = "Data nie może być późniejsza niż dzisiejszy dzień";
        }
    }

    if($allRight == true)
    {

        $allIncome = $db->prepare("SELECT incomes.amount, inc.name FROM incomes JOIN incomes_category_assigned_to_users AS inc ON incomes.date_of_income>='$firstDate' AND incomes.date_of_income<='$lastDate' AND incomes.user_id='$userId' AND incomes.income_category_assigned_to_user_id=inc.id");

        $allIncome->execute();
        $allIncomeBilans = $allIncome->fetchAll();
        
        $allExpense = $db->prepare("SELECT expenses.amount, expen.name FROM expenses JOIN expenses_category_assigned_to_users AS expen ON expenses.date_of_expense>='$firstDate' AND expenses.date_of_expense<='$lastDate' AND expenses.user_id='$userId' AND expenses.expense_category_assigned_to_user_id=expen.id");
        
        $allExpense->execute();
        $allExpenseBilans = $allExpense->fetchAll();    


    }
}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
    <title>Bilans</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>
<body>
<div id="container">
    <header>
        <div class="row">
            <div class="col-xs-12">
                <h4>Przegląd bilansu finansowego z wybranego okresu</h4>
            </div>
        </div>
    </header>
    <article>
    <main>
    <div class="row">
        <div class="col-xs-5 col-xs-offset-1">
            <form class="form-horizontal" role="form" method="post">
                <div class="form-group">
                    <label for="dateOfIncome" class="col-sm-4 control-label">Początkowa data: </label>
                    <div class="col-sm-7">          
                        <input type="text" id="dateOfIncome" name = "firstDay" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="datepickerEnd" class="col-sm-4 control-label">Końcowa data: </label>
                    <div class="col-sm-7">          
                        <input type="text" id="dateOfIncome" name = "lastDay" class="form-control">
                        <span class="help-block">w postaci rrrr-mm-dd np. 2018-01-30 </span>
                        <?php if(isset($_SESSION['error_date'])) 
                            {
                                echo "<div class='error'>".$_SESSION['error_date']."</div>";
                                unset($_SESSION['error_date']);
                            }
                        ?>
                    </div>
                    
                    <button class="btn btn-lg btn-primary " id="addIncomeButton"type="submit">Wyszukaj</button> 
                </div> 
                  
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1">   
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
                                if(isset($allIncomeBilans))
                                {
                                    $number = 1;
                                    $amountOfIncome = 0;
                                    foreach($allIncomeBilans as $bilans)
                                    {
                                        echo "<tr>
                                                <td>".$number."</td>
                                                <td>".$bilans['name'].
                                                "</td><td>".$bilans['amount']."</td>
                                            </tr>";
                                            $number++;
                                            $amountOfIncome +=$bilans['amount'];
                                    }
                                }    
                            ?> 
                                </tr> 
                            </tbod>
                        </table>
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
                                if(isset($allExpenseBilans))
                                {
                                    $number = 1;
                                    $amountOfExpenses = 0;
                                    foreach($allExpenseBilans as $bilans)
                                    {
                                        echo "<tr>
                                                <td>".$number."</td>
                                                <td>".$bilans['name'].
                                                "</td><td>".$bilans['amount']."</td>
                                            </tr>";
                                            $number++;
                                            $amountOfExpenses +=$bilans['amount'];
                                    }
                                }    
                            ?> 
                            </tbod>
                        </table>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    </main>
    </article>
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1">
            <div class="yesNoMoney">
            <?php
            if(isset($allExpenseBilans))
            {
                $totalAmount = $amountOfIncome - $amountOfExpenses;
                if($totalAmount > 0)
                {
                    echo "Brawo! W tym okresie oszczędziłeś ".$totalAmount." zł";
                }
                else if($totalAmount == 0)
                {
                    echo "W tym okresie wyszedłeś na czysto";
                }
                else 
                {
                    $totalAmount = $totalAmount * (-1);
                    echo "Niestety, w tym okresie wydałeś za dużo o ".$totalAmount." zł";
                }
            }    
            ?>
            </div>   
        </div>
    </div> 
</div>
    <script type="text/javascript" src="main.js"></script>
    <script src="memory.js"></script>
    <script
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>