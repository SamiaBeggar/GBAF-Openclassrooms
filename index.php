<?php
session_start();

?>

<!DOCTYPE html>
<html lang="fr">


    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>GBAF-Extranet</title>
        <link href="style.css" rel="stylesheet">
        <link rel="icon" type="image/png" sizes="16x16"  href="images/favicon.ico.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
    <?php include_once 'header.php'; ?>
    <?php include 'dbb_connexion.php'; ?>
    <?php
          if(isset($_GET['login_err']))
            {
              $err = htmlspecialchars($_GET['login_err']);

                  switch($err)
                  {
                  case 'password' :
                  ?>
                    <p><strong>Erreur</strong> Mot de passe incorrect !</p>
                  <?php
                  break;
                  case 'already' :
                  ?>
                    <p><strong>Erreur</strong> Compte introuvable !</p>
                  <?php
                  break;
                  }
            }
            ?>
        <!--formulaire de connexion-->
        <form method="post" action="login.php">
          <fieldset>
          <legend>
          <i class="fa fa-university fa-xs" aria-hidden="true" style="color : red;"></i>
          Connexion :
          </legend>
          <input type="text" name="username" placeholder="Identifiant" > <br>
          <input type="password" name="password" placeholder="Mot de passe"  > <br>
          <input type="submit" value="Envoyer" ><br><br>
          <p>
            <a href="forgot_password.php">Mot de passe oublié ?</a> <br>
            <a href="create_account.php">Pas encore de compte ? Inscrivez-vous !</a>
          </p>
          </fieldset>
        </form>

        <?php include_once 'footer.php'; ?>


     </body>
    
    
</html>