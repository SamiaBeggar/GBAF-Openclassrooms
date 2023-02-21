<?php
include 'dbb_connexion.php';
session_start();

// chaque user peut voter UNE seule fois 

$vote = $_POST['vote'];
$id = $_POST['id_acteur'];
$id_user= $_SESSION['id_user'];

$sqlQuery= 'SELECT * FROM vote WHERE id_acteur= :id_acteur AND id_user=:id_user ';
$sql=$db->prepare($sqlQuery);
$sql->execute(array(':id_acteur'=> $id ,':id_user'=> $id_user ));
$data=$sql->fetch();

if ($data)
{
    echo "Vous avez déjà voté pour cet acteur";
} 
else 
{
$vote = $_POST['vote'];
$id = $_POST['id_acteur'];
$id_user= $_SESSION['id_user'];
$sqlQuery= 'INSERT INTO vote ( id_user, id_acteur, vote) VALUES (:id_user, :id_acteur, :vote)' ; 
$sql=$db->prepare($sqlQuery);
$sql->execute(array(
   ':id_user' => $id_user,
   ':id_acteur' => $id,
    ':vote' => $vote
));
}





?>