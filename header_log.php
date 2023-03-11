<?php

if ( session_status () == PHP_SESSION_NONE) // if session status is none then start the session
{
     session_start();
}

?>

<header>
        
        <a href="home.php" class="logomin">
        <img src="images/logo_gbaf.png" alt="Logo GBAF miniature" style= "margin-left: 0; width:65px;height:65px ">
        </a>

        <nav class="rightheader">
           <p>Bienvenue <?php echo  $_SESSION['firstname'] ; ?> <?php echo  $_SESSION['name'] ; ?></p>

           <a href="account.php">Mon Compte</a>    
            
           <a href="deconnexion.php">Deconnexion</a>
        </nav>
    </header>