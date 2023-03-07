<?php
session_start();
include 'dbb_connexion.php';

//Vérifier que les variables sont renseignées 
if(isset($_POST['username']) && isset($_POST['question']) && isset($_POST['reponse']))
{
    $username = htmlspecialchars($_POST['username']);
    $question = htmlspecialchars($_POST['question']);
    $reponse = htmlspecialchars($_POST['reponse']);
//Récupérer les données et comparer avec db
    $check = $db->prepare('SELECT * FROM account WHERE username = ?');
    $check ->execute(array($username));
    $data = $check->fetch();
    $row = $check->rowCount();
// Si > 0 , user existe
    if($row > 0)
    {
        if (($question==$data['question']) AND ($reponse==$data['reponse']))
        {
            $_SESSION['id_user'] = $data['id_user'];
            $_SESSION['username'] = $data['username'];
            header('Location: forgot_password_new.php');
            
        

        }else header('Location: forgot_password.php?forgot_err=wrong_answer');

    }else header('Location: forgot_password.php?forgot_err=username');

}else header('Location: forgot_password.php');


?>

