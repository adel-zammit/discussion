<html>
	
	
	<head>
		<title>Discussions</title>
		<link href="discussion.css" rel="stylesheet">
	</head>
	
	<header>
		
		</header>

		<div class="nav">
				<button class="droite"><a href="index.php">Acceuil</a></button>
				<button class="droite"><a href="profil.php">Editer Profil</a></button>
				<button class="droite"><a href="deconnexion.php">Deconexion</a></button>
            </div>  

		

<?php

session_start();


if(!empty($_POST['deco']))
{
	unset($_SESSION['login']);
	unset($_SESSION['password']);
}
if((isset($_SESSION['login']))&&(isset($_SESSION['password'])))
{
?>
	
			
<?php	
	
	$connexion= mysqli_connect("localhost", "root", "", "discussion"); 
	$query="SELECT login, date, id_utilisateur, message FROM `utilisateurs` ,`messages` WHERE utilisateurs.id = id_utilisateur  ORDER BY `messages`.`id` ASC";
	$result= mysqli_query($connexion, $query);
		
	$requete="SELECT id, message FROM `messages` ORDER by id ASC";
	$idresult= mysqli_query($connexion, $requete);
?>
<article class="espacemessages">
	<fieldset>
		<legend>Forum de discussion</legend>
	<table class="formulaire">
		<tr> <br>
			<th>Utilisateur(s)</th>
			<th>Commentaires</th>
		</tr>
<?php	
while(($row = mysqli_fetch_array($result)) && ($id = mysqli_fetch_array($idresult))){
?>
	<tr> 
		<td><?php echo "Posté par : ";echo "<strong>".$row['login']."</strong>"; echo " le "; echo $row['date'];?></td>
		<td><?php echo $row['message'];?></td>
		<?php
		
		if(isset($_SESSION['login']))
		{
		if(($_SESSION['login'] == $row['login'])||($_SESSION['login']=="admin"))
		{
		?>
		
		<td>
			<form method="post" action="discussion.php">
				<input type="submit" name="effacer" value="Supprimer">
				<input type="hidden" name="moi" value="<?php echo $id['id'] ?>">  
            </form>
        </fieldset>
		</div>
		<?php
		}
		if(isset($_POST['effacer']))
		{
			$message= $_POST['moi'];
			$connexion= mysqli_connect("localhost", "root", "", "discussion"); 
			$query2="DELETE FROM `messages` WHERE messages . id = '$message'";
			$result2= mysqli_query($connexion, $query2);
			header ('location: discussion.php');			
		}
		}
		?>
		</td>
	</tr>
<?php
		
}
?>
</table>
	<div class="discussioncom">
		<form class="ajout" method="post" action=""> <br>
			<textarea name="text" placeholder="Ajoutez un message"></textarea>
			<input type="submit" name="ajout" value="Ajouter">
		</form>
	</div>


<?php
	if(isset($_POST['ajout']))
	{
		$connexion= mysqli_connect("localhost", "root", "", "discussion"); 
		$login=$_SESSION['login'];
		$query1="SELECT  id from utilisateurs WHERE login='$login'";
		$resultat= mysqli_query($connexion, $query1);
		$row = mysqli_fetch_array($resultat);
		
		$id_user=$row['id'];
		
		$query1 = "INSERT INTO `messages` (`id`, `message`, `id_utilisateur`, `date`) VALUES (NULL, '".$_POST['text']."', '".$id_user."', CURRENT_TIMESTAMP());";		
		mysqli_query($connexion, $query1);		 
		mysqli_close($connexion);
		header('location: discussion.php');
	}
}
else
{
	
 $_SESSION['connexion']="connecté";
?>




<article>
<div id='disdeco'>Vous n'êtes pas connecté<br>Vous devez être connecté pour pouvoir s'exprimer</div>
<img id="gifno" src="jordan.gif"></article> <?php
 
}

?>
	
	
	</body>
</html>