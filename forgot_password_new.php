<?php
session_start();
?>

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
    <?php include 'dbb_connexion.php'; ?>
    <?php
    if ((isset($_POST['new_password']))  && isset($_POST['password_confirmation']))
    {
      $new_password = $_POST['new_password'];
      $password_confirmation = $_POST['password_confirmation'];
      $correct_password = $new_password == $password_confirmation;

      if (!$correct_password)
      {
        ?>
        <p> <?php echo 'Les mots de passe saisis ne sont pas identiques!'; ?></p>

        <?php
      }
      else
      {
        $username =$_SESSION['username'];
        $hash = password_hash($new_password, PASSWORD_DEFAULT);
        $sqlQuery=('UPDATE account SET password = :password WHERE username = :username') ; 
        $update=$db->prepare ($sqlQuery);
        $update->execute(array ('password'=> $hash, 'username'=> $username));
        echo 'Le mot de passe a été réinitialisé avec succès ' ;
      }
    
    }
    ?>
    <form method="post" action="forgot_password_new.php">
     <fieldset>
     <legend>
     <i class="fa fa-university" aria-hidden="true" style="color : red;"></i>
     Réinitialiser votre mot de passe :
     </legend>
     <input type="password" name="new_password" placeholder="Nouveau mot de passe" /> <br>
     <input type="password" name="password_confirmation" placeholder="Confirmation du nouveau mot de passe"  /> <br>
     <input type="submit" value="Envoyer" /><br><br>

     </fieldset>
    </form>


</body>
    
    <?php include_once 'footer.php'; ?>
</html>