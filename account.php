
<!DOCTYPE html>

<html>
<head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>GBAF-Paramètres du compte</title>
        <link href="style.css" rel="stylesheet">
        <link rel="icon" type="image/png" sizes="16x16"  href="images/favicon.ico.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
<?php include 'header_log.php' ; ?>
<?php include 'dbb_connexion.php'; ?>

<?php
if (isset($_POST['firstname']) && isset($_POST['name']) && isset($_POST['username']) && isset($_POST['secret_question']) && isset($_POST['answer']) && isset($_POST['password']))
{
  $firstname = htmlspecialchars($_POST['firstname']);
  $name = htmlspecialchars($_POST['name']);
  $username = htmlspecialchars($_POST['username']);
  $secret_question= htmlspecialchars($_POST['secret_question']);
  $answer = htmlspecialchars($_POST['answer']);
  $password = htmlspecialchars($_POST['password']);
  $passwordHash = password_hash($password, PASSWORD_DEFAULT);


  $id_user= $_SESSION['id_user'];

  $sqlQuery= 'SELECT * FROM Account WHERE id_user = ?' ; 
  $sql = $db->prepare($sqlQuery);
  $sql->execute(array($id_user));
  $account = $sql->fetch();

  $update=$db-> prepare ('UPDATE account SET nom=:nom, prenom=:prenom, password=:password, question=:question, reponse=:reponse WHERE id_user=:id');
  $update->execute(array(
    'nom' => $name, 
    'prenom' => $firstname, 
    'password' => $passwordHash ,
    'question' => $secret_question,
    'reponse' => $answer,
    'id' => $_SESSION['id_user']
  ));

echo "<p> Les modifications ont été prises en compte ! </p>";

}
?>


<?php
$id_user= $_SESSION['id_user'];

$sqlQuery= 'SELECT nom, prenom, username, password, question, reponse FROM account WHERE id_user = ?' ; 
$sql = $db->prepare($sqlQuery);
$sql->execute(array($id_user));
$data = $sql->fetch();
?>

    <form method="post" action="account.php">
      <fieldset>
      <legend>
      <i class="fa fa-university" aria-hidden="true" style="color : red;"></i>
       Mon compte :
      </legend>
      <label>Prénom:</label>
      <input type="text" name="firstname" value="<?php echo $data['prenom']; ?>"  required />
      <label>Nom:</label>
      <input type="text" name="name" value="<?php echo $data['nom']; ?>"  required />
      <label>Identifiant:</label>
      <input type="text" name="username" value="<?php echo $data['username']; ?>" required   />
      <label>Question secrète:</label>
      <select name="secret_question" >
        <?php
        $selected = ($data['question'] == "Quel est le nom de votre ville natale ?" )? "selected":"";
        ?>
        <option <?php echo $selected;?> value="Quel est le nom de votre ville natale ?">Quel est le nom de votre ville natale ?</option>
        <?php
        $selected = ($data['question'] == "Quel est le nom de votre meilleur/e ami/e?")? "selected":"";
        ?>
        <option <?=$selected;?> value="Quel est le nom de votre meilleur/e ami/e?">Quel est le nom de votre meilleur/e ami/e?</option>
        <?php
        $selected = ($data['question'] == "Quel est le nom de famille de votre professeur d’enfance préféré ?")? "selected":"";
        ?>
        <option <?=$selected;?> value="Quel est le nom de famille de votre professeur d’enfance préféré ?">Quel est le nom de famille de votre professeur d’enfance préféré ?</option>
        <?php
        $selected = ($data['question'] == "Dans quelle ville se sont rencontrés vos parents? ")? "selected":"";
        ?>
        <option <?=$selected;?> value="Dans quelle ville se sont rencontrés vos parents? ">Dans quelle ville se sont rencontrés vos parents? </option>
      </select>
</br>
      <label>Réponse:</label>
      <input type="text" name="answer" value="<?php echo $data['reponse']; ?>" required/>
      <label>Mot de passe:</label>
      <input type="password" name="password" placeholder="Saisissez votre mot de passe pour confirmer les modifications" />
      <input type="submit" name="send" value="ENREGISTRER LES MODIFICATIONS" />
      </fieldset>
   </form>




<?php include_once 'footer.php'; ?>

</body>

</html>