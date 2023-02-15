<?php
session_start();
if(isset($_SESSION['username'])) {
  header('Location:home.php');
}
?>

<!DOCTYPE html>

<html>

    <head>
        <meta charset="utf-8" />
        <title>GBAF-Inscription</title>
        <link href="style.css" rel="stylesheet">
        <link rel="icon" type="image/png" sizes="16x16"  href="images/favicon.ico.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
    <?php include_once 'header.php'; ?>
    <?php
      if(isset($_GET['reg_err']))
            {
              $err = htmlspecialchars($_GET['reg_err']);
              switch($err)
              {
                case 'success':
                ?>
                    <div class="alert alert-success">
                        <strong>Succès</strong> inscription réussie !
                    </div>
                <?php
                break;
                case 'password':
                ?>
                      <div class="alert alert-danger">
                          <strong>Erreur</strong> les mots de passe saisis ne sont pas identiques
                      </div>
                <?php
                break;
                case 'already':
                ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> Cet identifiant est déjà utilisé 
                        </div>
                <?php
              }
            }
            ?>


         <!--formulaire d'inscription-->
         <form method="post" action="create_account_traitement.php">
          <fieldset>
          <legend>
          <i class="fa fa-university" aria-hidden="true" style="color : red;"></i>
          Création d'un compte :
        </legend>
          <input type="text" name="firstname" placeholder=" Prénom" required  />
          <input type="text" name="name" placeholder=" Nom" required />
          <input type="text" name="username" placeholder="Identifiant" required />
          <input type="password" name="password" placeholder="Mot de passe" required/>
          <input type="password" name="password_confirmation" placeholder="Confirmation du mot de passe" required />
          <input list="secret_question" name="secret_question"placeholder="Choissisez une question secrète" required >
             <datalist id="secret_question" >
               <option value="Quel est le nom de votre ville natale ?">
               <option value="Quel est le nom de votre meilleur/e ami/e?">
               <option value="Quel est le nom de famille de votre professeur d’enfance préféré ?">
               <option value="Dans quelle ville se sont rencontrés vos parents? ">
             </datalist>
          <input type="text" name="answer" placeholder=" Réponse à votre question secrète" required  />
          <input type="submit" name="send" value="Valider" />

          </fieldset>
         </form>
    </body>
    <?php include_once 'footer.php'; ?>


    </html>
