<?php
session_start();
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
<?php include 'header_log.php' ; ?>

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
<a href="#">Visiter le site de <?php echo $actor['acteur'];?></a><br>
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
    <h4><?php echo $nbPost ['nb_post']; ?> Commentaire(s)</h4>
    </div>
    <?php
  }
    ?>

   <!--ajouter un commentaire-->
    <?php
    $id_user= $_SESSION['id_user'];
    $sqlQuery='SELECT * FROM post WHERE id_user = :id_user AND id_acteur = :id_acteur';
    $result= $db->prepare($sqlQuery);
    $result->execute (array(':id_user'=> $id_user, ':id_acteur'=> $id));
    $data_comments= $result ->fetch();
    ?>

    <?php
       if ($data_comments)
       {
      ?>
      <div class="already_comments">
      <?php echo " Vous avez déjà publié un commentaire pour cet acteur "; ?>  
      </div> 
      <?php
      } 
      else 
      {
       ?>
       <div class="new_comments">
        <a href="actor_comments_new.php?id=<?php echo $actor['id_acteur']; ?>">
        <p> Nouveau commentaire </p>
        </a>
        <?php
    }
    ?>
    

    <div class="votes">
     <!-- nombre des likes , dislikes pour l'acteur -->
      <!--vote=1 : LIKE-->
     <?php
     $id = $_GET['id'];
     $sqlQuery = 'SELECT * FROM vote WHERE id_acteur=? AND vote=1'; 
     $likes= $db->prepare($sqlQuery);
     $likes->execute(array($id));
     $nbLikes = $likes-> rowCount();
       /* vote=2: DISLIKE */
     $sqlQuery = 'SELECT * FROM vote WHERE id_acteur = ? AND vote =2';
     $dislikes = $db->prepare($sqlQuery);
     $dislikes->execute(array($_GET['id']));
     $nbDislikes= $dislikes-> rowCount();
     ?>
     
       <!-- formulaire de vote  -->
      <form method="post" action= "votes_traitement.php" >

       <span class="vote_count"><?php echo $nbLikes - $nbDislikes; ?></span> 

        <input type=hidden name="id_acteur" value ="<?php echo $id; ?>">
        <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
        <button class="like" type="submit" name="vote" value="1">
          <i id="id_like" class="fa fa-thumbs-up" style="font-size:22px"></i>
        </button>

        <button class="dislike" type="submit" name="vote" value="2">
          <i id="id_dislike" class="fa fa-thumbs-down" style="font-size:22px"></i>
        </button> 
      </form>



      <!-- Afficher les commentaires laissés par les autres users-->
      <div class="other_comments">
      <?php

        $sqlQuery=('SELECT * FROM post INNER JOIN account ON post.id_user = account.id_user WHERE id_acteur = :id_acteur ORDER BY date_add DESC LIMIT 3');
        $query = $db -> prepare ($sqlQuery);
        $query -> execute(array('id_acteur' => $id));
        while ($data_comment = $query -> fetch())
        {
        ?>
         
         <p> <?php echo($data_comment['prenom']); ?> </p>
         <p> <?php echo $data_comment['date_add']; ?> </p>
         <p> <?php echo nl2br($data_comment['post']); ?> </p>
      
        <?php
        }
        ?>

</section>


<?php include_once 'footer.php'; ?>

</body>


</html>
