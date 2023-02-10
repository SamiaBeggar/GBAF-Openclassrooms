<!DOCTYPE html>

<html>

<head>
        <meta charset="utf-8" />
        <title>GBAF-Partenaires</title>
        <link href="style.css" rel="stylesheet">
        <link rel="icon" type="image/png" sizes="16x16"  href="images/favicon.ico.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


<body>
<?php include 'dbb_connexion.php'; ?>
<?php 
  $id = $_GET['id'];
  if(isset($id) && !empty($id))
{
      $sqlQuery = 'SELECT * FROM acteurs WHERE id_acteur = ?';
      $actorsQuery= $db -> prepare( $sqlQuery);
      $actorsQuery->execute(array($id));
      $actor = $actorsQuery->fetch();
}
?>

<img src="<?php echo $actor['logo']; ?>" alt= "Logo partenaires" ?>
<h2><?php echo $actor['acteur']; ?></h2>
<p><?php echo  nl2br ($actor['description'] ) ;?></p>


<?php include_once 'footer.php'; ?>

</body>


</html>


