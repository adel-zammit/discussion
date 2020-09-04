<?php
session_start();
?>

<!DOCTYPE HTML>
<html lang="fr">
    
    <html>
        <head>
            <meta charset="utf-8">
            <!-- importer le fichier de style -->
            <link rel="stylesheet" href="discussion.css" type="text/css" >
        </head>
        
        <header>

</header>
 
<body>

               <?php

               if(isset($_POST['deco']))

               {
                   unset($_SESSION['login']);
                   unset($_SESSION['password']);

               }
 
 if(isset($_SESSION['login']))
 {
     
 ?>
            <h2>Vous etes connecter.</h2>

            <div class="nav">
				<button class="droite"><a class="droite" href="discussion.php">Accéder au chat</a></button>
				<button><a class="droite" href="profil.php">Editer Profil</a></button>
				<button><a class="droite" href="deconnexion.php">Deconexion</a></button>
            </div>    
            
                <?php
                echo $_SESSION['message'];
                ?>
<?php
 }
 else
{
    ?>

            <button class="droite"><a href="inscription.php" class="button">S'inscrire</a></button>
            <button class="droite"><a href="connexion.php" class="button">Se connecter</a></button>

                <?php
                 }
                ?>

        </div>
    </body>
</html>