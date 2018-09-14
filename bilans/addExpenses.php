<?php
session_start();

require_once "dataBase.php";
$userId = $_SESSION['userId'];

if(isset($_POST['amount']))
{
    $allRight = true;
    $amount = $_POST['amount'];
    if(!is_numeric($amount))
    {
        $ifComma = strpos($amount, ",");
        if(($ifComma==true) && (substr_count($amount, ",") == 1) && (!preg_match('/[a-z]/', $amount)))
        {
            $amount = str_replace(",",".",$amount);
            $correctAmount = round($amount, 2);
        }
        else
        {
            $allRight = false;
            $_SESSION['error_amount'] = "Podana wartość nie jest liczbą";
        }
    }
    else 
    {
        $correctAmount = round($amount, 2);
    }

    $dateExpense = $_POST['dateExpense'];
    if($dateExpense == "")
    {
        $dateExpense = date("Y-m-d");
    }
    else
    {
        $expenseYear = substr($dateExpense, 0, 4);
        $expenseMonth = substr($dateExpense, 5, 2);
        $expenseDay = substr($dateExpense, 8, 2);

        if(!checkdate($expenseMonth, $expenseDay, $expenseYear))
        {
            $allRight = false;
            $_SESSION['error_date'] = "Nie poprawna data lub format";
        }
        $todayDay = date('Y-m-d');
        if($dateExpense > $todayDay)
        {
            $allRight = false;
            $_SESSION['error_date'] = "Data nie może być późniejsza niż dzisiejszy dzień";
        }
    }

    $paymentMethod ="";
    
    if($_POST['inlineRadioOptions'])
    {
    switch($_POST['inlineRadioOptions']){
        case "cash":
        $paymentMethod = "Cash";
        break;
        case "card":
        $paymentMethod = "Debit Card";
        break;
        case "creditCart":
        $paymentMethod = "Credit Card";
        break;
        }
    }
    else{
        $allRight = false;
        $_SESSION['error_paymentMethod'] = "Wybierz sposób płatności";
    }

    $category = "";
    if ($_POST['category'])
    {
    switch($_POST['category']){
        case "transport":
        $category = "Transport";
        break;
        case "books":
        $category = "Books";
        break;
        case "food":
        $category = "Food";
        break;
        case "apartments":
        $category = "Apartments";
        break;
        case "telecommunication":
        $category = "Telecommunication";
        break;
        case "health":
        $category = "Health";
        break;
        case "clothes":
        $category = "Clothes";
        break;
        case "hygiene":
        $category = "Hygiene";
        break;
        case "kids":
        $category = "Kids";
        break;
        case "recreation":
        $category = "Recreation";
        break;
        case "trip":
        $category = "Trip";
        break;
        case "savings":
        $category = "Savings";
        break;
        case "retirement":
        $category = "For Retirement";
        break;
        case "debtRepayment":
        $category = "Debt Repayment";
        break;
        case "gift":
        $category = "Gift";
        break;
        case "another":
        $category = "Another";
        break;
        }
    }
        else{
            $allRight = false;
            $_SESSION['error_category'] = "Wybierz kategorię";
        }
    
        $comments = $_POST['comments'];
        $correctComment = htmlentities($comments, ENT_QUOTES, "UTF-8");
    }
    if($allRight == true)
    {
        $expensesCat = $db->prepare("SELECT id FROM  expenses_category_assigned_to_users WHERE user_id = :userId AND name= :category");
        $expensesCat->bindValue(':userId', $userId, PDO::PARAM_STR);
        $expensesCat->bindValue(':category', $category, PDO::PARAM_STR);
        $expensesCat->execute();
        $expensesCatId = $expensesCat->fetch();

        $expensesPayment = $db->prepare("SELECT id FROM  payment_methods_assigned_to_users WHERE user_id = :userId AND name= :paymentMethod");
        $expensesPayment->bindValue(':userId', $userId, PDO::PARAM_STR);
        $expensesPayment->bindValue(':paymentMethod', $paymentMethod, PDO::PARAM_STR);
        $expensesPayment->execute();
        $expensesPaymentId = $expensesPayment->fetch();


        $expensesQuery = $db->prepare("INSERT INTO expenses VALUES(NULL, :userId, :expensesCatId,:expensesPaymentId, :amount, :dateOfExpense, :comment)");

        $expensesQuery->bindValue(':userId', $userId, PDO::PARAM_STR);
        $expensesQuery->bindValue(':expensesCatId',  $expensesCatId['id'], PDO::PARAM_STR);
        $expensesQuery->bindValue(':expensesPaymentId',  $expensesPaymentId['id'], PDO::PARAM_STR);
        $expensesQuery->bindValue(':amount',  $correctAmount, PDO::PARAM_STR);
        $expensesQuery->bindValue(':dateOfExpense',  $dateExpense, PDO::PARAM_STR);
        $expensesQuery->bindValue(':comment',  $correctComment, PDO::PARAM_STR);
        $expensesQuery->execute();


        $_SESSION['addedExpenses'] = "Wydatek został dodany";
        header('Location: mainMenu.php');
        exit();
    }
else{
    header('Location: incomes.php');
}


?>