<?php
session_start();
include 'dbb_connexion.php';
?>

<!DOCTYPE html>
<html lang="fr">


  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>GBAF-Mot de passe oublié</title>
        <link href="style.css" rel="stylesheet">
        <link rel="icon" type="image/png" sizes="16x16"  href="images/favicon.ico.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>


  <body>
  <?php include_once 'header.php'; ?>
  <?php
        if(isset($_GET['forgot_err']))
        {
          $err = htmlspecialchars($_GET['forgot_err']);
            switch($err)
            {
            case 'wrong_answer':
              ?>
              <p><strong>Erreur</strong> Les données saisies ne sont pas correctes !</p>
              <?php
            break;
            case 'username' :
              ?>
              <p><strong>Erreur</strong> Compte introuvable !</p>
              <?php
            break;
            }            
        }
        ?>
        <!--formulaire récupération mot de passe-->
        <form method="post" action="forgot_password_traitement.php">
          <fieldset>
          <legend>
          <i class="fa fa-university" aria-hidden="true" style="color : red;"></i>
          Réinitialiser votre mot de passe :
          </legend>
            <input type="text" name="username" placeholder="Identifiant" required>  
            <input list="question" name="question" placeholder="Choissisez votre question secrète" required>
            <datalist id="question" >
               <option value="Quel est le nom de votre ville natale ?">
               <option value="Quel est le nom de votre meilleur/e ami/e?">
               <option value="Quel est le nom de famille de votre professeur d’enfance préféré ?">
               <option value="Dans quelle ville se sont rencontrés vos parents? ">
             </datalist>
            <input type="text" name="reponse" placeholder=" La réponse " required>
            <input type="submit" value="Envoyer">
          </fieldset>
        </form>
  </body>
  
       <?php include_once 'footer.php'; ?>

</html>