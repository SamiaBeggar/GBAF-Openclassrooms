<!DOCTYPE html>

<html>

  <head>
        <meta charset="utf-8" />
        <title>GBAF-Mot de passe oublié</title>
        <link href="style.css" rel="stylesheet">
        <link rel="icon" type="image/png" sizes="16x16"  href="images/favicon.ico.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>


  <body>
  <?php include_once 'header.php'; ?>
        <!--formulaire récupération mot de passe-->
        <form method="post" action="forgot_password.php">
          <fieldset>
          <legend>
          <i class="fa fa-university" aria-hidden="true" style="color : red;"></i>
          Réinitialiser votre mot de passe :
          </legend>
            <input type="text" name="username" placeholder="Identifiant" required />  
            <input type="submit" value="Envoyer" />
          </fieldset>
        </form>
  </body>
       <?php include_once 'footer.php'; ?>

</html>