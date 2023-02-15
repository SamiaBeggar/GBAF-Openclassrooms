<?php 
session_start(); 
include 'dbb_connexion.php';

if(!empty($_POST['username']) && !empty($_POST['password']))
{
    $username = htmlspecialchars($_POST['username']); 
    $password = htmlspecialchars($_POST['password']);

    $check = $db->prepare("SELECT *  FROM account WHERE username=?");
    $check->execute(array($username));
    $data_login = $check->fetch();
    $row = $check->rowCount();
    // Si > 0 , user existe
     if($row > 0)
    {
        //vérifier le mdp 
        if(password_verify($password, $data['password']))
        {

            $_SESSION['id_user'] = $data_login['id_user'];
            $_SESSION['firstname'] = $data_login['firstname'];
            $_SESSION['name'] = $data_login['name'];
            $_SESSION['username'] = $data_login['username'];
            $_SESSION['password'] = $data_login['password'];
            $_SESSION['secret_question'] = $data_login['secret_question'];
            $_SESSION['answer'] = $data_login['answer'];
            header('Location:home.php');

        }else header('Location: index.php');

    }else header('Location: index.php?login_err=password');
} else header ('location : index.php?login_err=username' );

?>