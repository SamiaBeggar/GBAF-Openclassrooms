<?php

?>
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
<section>

<div class="actor_details">
<?php 

  $id = $_GET['id'];
  if(isset($id) && !empty($id))
{
  //récupérer les données de chaque acteur 
      $sqlQuery = 'SELECT * FROM acteurs WHERE id_acteur = ?';
      $actorsQuery= $db -> prepare( $sqlQuery);
      $actorsQuery->execute(array($id));
      $actor = $actorsQuery->fetch();
}
?>
<!-- afficher les données de l'acteur --> 
<img src="<?php echo $actor['logo']; ?>" alt= "Logo partenaires" ?>
<h2><?php echo $actor['acteur']; ?></h2>
<p><?php echo  nl2br ($actor['description'] ) ;?></p>
</section>


<section>

<div class="comments">
<?php
// nombre des commentaires
 $id = $_GET['id'];
  $sqlQuery = 'SELECT COUNT(*) AS nb_post FROM post WHERE id_acteur = ?';
  $commentsQuery = $db->prepare($sqlQuery);
  $commentsQuery->execute(array($id));
  while ($nbPost = $commentsQuery->fetch())
  {
?> 
    <div class="comments_number">
    <h3><?php echo $nbPost ['nb_post']; ?> Commentaire(s)</h3>
    </div>
    <?php
  }
    ?>

   <!--ajouter un commentaire-->
    <?php
    $sqlQuery='SELECT * FROM post WHERE id_user = ? AND id_acteur = ?';
    $result= $db->prepare($sqlQuery);
    $result -> execute (array('id_user' => $_SESSION['id_user'], 'id_acteur' => $_GET['id_acteur']));
    $data_comments= $result ->fetch();
       /* si aucun commentaire laissé par cet user pour cet acteur */
    if (!$data_comments) 

    ?>
    <div id="new_comment_button">
      <a href="actor_comments_traitement.php?id_acteur=<?php echo $_GET['id_acteur']; ?>">
      <p> Nouveau commentaire</p>
      </a>
    </div> 

    <div class="votes">
     <!-- nombre des likes , dislikes pour l'acteur -->
      <!--vote=1 : LIKE-->
     <?php
     $id = $_GET['id'];
     $sqlQuery = 'SELECT * FROM vote WHERE id_acteur=? AND vote=1'; 
     $likes= $db->prepare($sqlQuery);
     $likes->execute(array($_GET['id']));
     $nbLikes = $likes-> rowCount();
       /* vote=2: DISLIKE */
     $sqlQuery = 'SELECT * FROM vote WHERE id_acteur = ? AND vote =2';
     $dislikes = $db->prepare($sqlQuery);
     $dislikes->execute(array($_GET['id']));
     $nbDislikes= $dislikes-> rowCount();
     ?>
     <div id="like_dislike_button_content">
     <?php
      /* les valeurs likes, dislikes pour user acteur  */
     $result = $db -> prepare('SELECT * FROM vote WHERE id_acteur = :id_acteur AND id_user = :id_user AND vote = 1');
     $result -> execute(array(
      'id_acteur' => $_GET['id_acteur'],
      'id_user' => $_SESSION['id_user']));
     $likes = $result -> fetch();

      $result = $db -> prepare('SELECT * FROM vote WHERE id_acteur = :id_acteur AND id_user = :id_user AND vote = 2');
      $result -> execute(array(
        'id_acteur' => $_GET['id_acteur'],
        'id_user' => $_SESSION['id_user']));
      $dislikes = $result -> fetch();

      ?>
     <?php

      if ($likes != 0)
      {
      ?>
      <div class="like_button">
       <a href="actor_likes_dislikes_traitement.php?id_acteur=<?php echo $_GET['id_acteur']; ?>&likes_dislikes=1">
       <p> <?php echo $nbLikes; ?> </p>
       <img src="............"> <!-- A ajouter-->
       </a>
      </div>

      <?php
      }
       else
      {
      ?>
      <div class="like_button">
        <a href="actor_likes_dislikes_traitement.php?id_acteur=<?php echo $_GET['id_acteur']; ?>&likes_dislikes=1">
        <p><?php echo $nbLikes; ?></p>
        <img src="........"> <!-- A ajouter-->
        </a>
      </div>

      <?php
 
       }
       ?>

      <?php
      if ($dislikes != 0)
      {
      ?>
      <div class="dislike_button">
        <a href="actor_likes_dislikes_traitement.php?id_acteur=<?php echo $_GET['id_acteur']; ?>&likes_dislikes=2">
        <p> <?php echo $nbDislikes; ?> </p>
        <img src="........."> <!-- A ajouter-->
        </a>
        </div>
       <?php
       }
        else
       {
       ?>
       <div class="dislike_button">
       <a href="actor_likes_dislikes_traitement.php?id_acteur=<?php echo $_GET['id_acteur']; ?>&likes_dislikes=2">
        <p> <?php echo $nbDislikes; ?> </p>
        <img src="........."> <!-- A ajouter-->
        </a>
        </div>
      <?php
      }
      ?>

      <!-- Afficher les commentaires laissés par les autres users-->
      <div class="other_comments">
      <?php

        $sqlQuery=('SELECT * FROM post INNER JOIN account ON post.id_user = account.id_user WHERE id_acteur = :id_acteur ORDER BY date_add DESC LIMIT 3');
        $query = $db -> prepare ($sqlQuery);
        $query -> execute(array('id_acteur' => $_GET['id_acteur']));
        while ($data_comment = $query -> fetch())
        {
        ?>
         <div class="comment_content_container">
         <p> <?php echo($data_comment['prenom']); ?> </p>
         <p> <?php echo $data_comment['date_add']; ?> </p>
         <p> <?php echo nl2br($data_comment['post']); ?> </p>
          
         </div>
        <?php
        }
        ?>

</section>


<?php include_once 'footer.php'; ?>

</body>


</html>
