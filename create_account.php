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
         <!--formulaire d'inscription-->
         <form method="post" action="create_account.php">
          <fieldset>
          <legend>
          <i class="fa fa-university" aria-hidden="true" style="color : red;"></i>
          Création d'un compte :
        </legend>
          <input type="text" name="firstname" placeholder=" Prénom" required  />
          <input type="text" name="name" placeholder=" Nom" required />
          <input type="text" name="username" placeholder="Identifiant" required />
          <input type="password" name="new_password" placeholder="Mot de passe" required/>
          <input type="password" name="password_confirmation" placeholder="Confirmation du mot de passe" required />
          <input type="text" name="secret_question" placeholder=" Renseignez votre question secrète" required />
          <input type="text" name="answer" placeholder=" Réponse à votre question secrète" required  />
          <input type="submit" name="send" value="Valider" />

          </fieldset>
         </form>
    </body>
    <?php include_once 'footer.php'; ?>


    </html>
