<?php
session_start();
require_once "dataBase.php";

if(isset($_POST['login']))
{
    $login = filter_input(INPUT_POST, 'login');
    $password = filter_input(INPUT_POST, 'password');

    $logquery = $db->prepare('SELECT id,password FROM users WHERE login= :login');
    $logquery->bindValue(':login', $login, PDO::PARAM_STR);
    $logquery->execute();

    $user = $logquery->fetch();
  

    
    if(!$user)
    {   
        $_SESSION['wrongLog'] = "Nie ma takiego loginu";
        $_SESSION['LogValue'] = $login;
        header('Location: logIn.php');
        exit();
    }
    
    if($user &&password_verify($password, $user['password']))
    {
        $_SESSION['userId'] = $user['id'];
        unset($_SESSION['wrongPass']);
    }
    else 
    {
        $_SESSION['wrongPass'] = "Niepoprawne hasło";
        header('Location: logIn.php');
        exit();
    }
}
header('Location: logIn.php');