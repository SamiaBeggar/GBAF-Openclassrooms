<?php
session_start();
include 'dbb_connexion.php';
include 'header_log.php' ; 
?>

<!DOCTYPE html>

<html>

    <head>
        <meta charset="utf-8" />
        <title>GBAF-Ajouter un commentaire</title>
        <link href="style.css" rel="stylesheet">
        <link rel="icon" type="image/png" sizes="16x16"  href="images/favicon.ico.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
   

        <?php
        
        if (isset($post)) {
            $date = date('Y-m-d H:i:s');
            $post = $_POST['post'];
            $id_user= $_SESSION['id_user'];
            $id = $_GET['id'];
         $sqlQuery= ('INSERT INTO post (id_user, id_acteur, date_add, post) VALUES (:id_user, :id_acteur, :date, :post)');
         $newcomments=$db->prepare($sqlQuery);
         $newcomments->execute(array(
            'id_user'=>$id_user,
            'id_acteur'=>$id,
            'date'=>$date,
            'post'=>$post
         ));
         header('Location: actor.php?id=' . $id);
        }
        ?>


<form method="post" action="actor_comments_new.php">
<fieldset>
     <legend>
     <i class="fa fa-university" aria-hidden="true" style="color : red;"></i>
     Ajoutez un commentaire professionnel et constructif:
    </legend>
    <textarea id="post" name="post" rows="4" cols="74"></textarea>
    <input type="submit" value="Envoyer" />
</fieldset>
</form>


