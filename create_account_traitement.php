<?php
include 'dbb_connexion.php';

if(!empty($_POST['firstname']) && !empty($_POST['name']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['password_confirmation']) && !empty($_POST['secret_question']) && !empty($_POST['answer']))
{
        $firstname = htmlspecialchars($_POST['firstname']);
        $name = htmlspecialchars($_POST['name']);
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $password_confirmation = htmlspecialchars($_POST['password_confirmation']);
        $secret_question= htmlspecialchars($_POST['secret_question']);
        $answer = htmlspecialchars($_POST['answer']);
    
    $check = $db->prepare("SELECT *  FROM account WHERE username=?");
    $check->execute(array($username));
    $data_login = $check->fetch();
    $row = $check->rowCount();

    if($row == 0){
        if($password == $password_confirmation)
        {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $insert = $db->prepare('INSERT INTO account (nom, prenom, username, password, question, reponse) VALUES  (?, ?, ?, ?, ?, ?)');
            $insert->execute(array(
                'nom' => $name,
                'prenom' => $firstName,
                'username' => $username,
                'password' => $password,
                'question' => $secret_question,
                'reponse' => $answer,
            ));
            header('Location:create_account.php?reg_err=success');


        }else header('Location: create_account.php?reg_err=password');

    }else header('Location: create_account.php?reg_err=already');
    
}
?>