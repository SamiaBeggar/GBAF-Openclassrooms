<!DOCTYPE html>

<html>

    <head>
        <meta charset="utf-8" />
        <title>GBAF-Accueil</title>
        <link href="style.css" rel="stylesheet">
        <link rel="icon" type="image/png" sizes="16x16"  href="images/favicon.ico.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>


    <body>
    <header>
        <a href="index.php" >
        <img src="images/logo_gbaf.png" alt="Logo GBAF miniature" style= "margin-left: 0; width:45px;height:45px "/>
        </a>
    </header>

    <section>
        <div class="presentation_GBAF">
        <h1>GBAF</h1>
        <p>
           Le Groupement Banque Assurance FrançaisLe est le représentant de la profession bancaire et des assureurs sur tous les axes de la réglementation financière française. <br/>
           Sa mission est de promouvoir l'activité bancaire à l’échelle nationale. C’est aussi un interlocuteur privilégié des pouvoirs publics.
        </p>
        <p>le GBAF souhaite proposer aux salariés des grands groupes français <strong> un point d’entrée unique </strong>, répertoriant un grand nombre d’informations sur les partenaires et acteurs du groupe ainsi que sur les produits et services bancaires et financiers. Chaque salarié pourra ainsi <strong> poster un commentaire et donner son avis </strong>. </p>

</div>
        <img src="images/groupe_bancaire.jpg" alt="groupe bancaire" style="width:100%;height: 280px;filter: grayscale(100%);"/> 
    </section>
    
    <hr/>


    <section>
    <div class="description_partners">
    <h2>Nos partenaires</h2>
    <p> Le GBAF est une fédération représentant les 6 grands groupes français :</p>
        <ul>
                <li> BNP Paribas </li>  
                <li> Crédit Mutuel-CIC </li>
                <li> BPCE </li>                            
                <li> Société Générale  </li>
                <li> Crédit Agricole </li>                  
                <li> La Banque Postale </li> 
                        
            </ul>

            <?php include 'dbb_connexion.php'; ?>
            <?php
            $id_acteur = '';
            $actorsQuery = $db->prepare('SELECT * FROM acteurs');
            $actorsQuery ->execute();
            $actors =  $actorsQuery ->fetchAll();
        
               foreach ($actors as $actor) {
            ?>

                  <img src="<?php echo $actor['logo']; ?>" alt= "Logo partenaires" ?>
                  <h3> <?php echo $actor['acteur'];?> </h3>
                  <p><?php echo substr ($actor['description'], 0, 200);?>...</p>

                  <a href="actor.php?id=<?php echo $actor['id_acteur'];?>">Lire la suite</a>



           <?php
           }
           ?>
        
    </section>

    
        <?php include_once 'footer.php'; ?>

        </body>
</html>


















