<?php session_start(); ?>

<!DOCTYPE html>

<html>
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="style.css" />

        <title>SI14 - Conversation</title>
    </head>
	
	<body>
	
	<a href=#bas > Aller en bas de page</a><br>
	<a href="rendu.php"> Le rendu final est par là </a><br>
	
	
	<?php 

	include("connect.php");
	
	if ((isset($_POST["login"])) && (isset($_POST["mdp"])) )
		{
		$_SESSION["login"] = htmlspecialchars($_POST["login"]);
		$_SESSION["mdp"] =  htmlspecialchars($_POST["mdp"]);
		}
		
	if ((isset($_SESSION["login"])) && (isset($_SESSION["mdp"])))
		{
		if (($_SESSION["login"]=="flo" || $_SESSION["login"]=="dylan" || $_SESSION["login"]=="celine" ) && $_SESSION["mdp"]=="$ADMINmdp")
			{
			
			
				
				?>
	
		<?php include("header.php"); ?>
		<div id="debut">HappyDydy started a new conversation with SarcasticCeline and DepressedFlo.</div>
	
		<section>
		
		<?php
		
				try
				{
					$bdd = new PDO('mysql:host=mutusql03.evxonline.net;dbname=sitesi;charset=utf8', "$ADMINlogin", "$ADMINmdp");
				}
				catch (Exception $e)
				{
						die('Erreur : ' . $e->getMessage());
				}	
				
				$reponse = $bdd->query('SELECT * FROM message');
				
				
				while ($donnees = $reponse->fetch())
				{
				?>
			
		
			<article>
			
			<div class='entete'> 
				<img class="avatar" src="images/<?php echo $donnees['a_login'] ?>.jpg" alt="avatar"/> 
				<h1><?php echo $donnees['a_login'] ?></h1>
				
				<p class="date"> <?php echo $donnees['a_date'] ?></p>
			</div>
				
				<p class="message"> <?php echo $donnees['a_message']?>
				<p>			
				
				<div class="words"><?php echo $donnees['a_nbMots'] ?> words.</div>
				<p> <a href="modification.php?id=<?php echo $donnees['pk_id'] ?>" > Edit </a> </p>
			</article>
 
	
		
		<?php	}$reponse->closeCursor(); ?>
		
		<article id="bas">
				<h1> Redaction d'un nouveau message </h1>
			
				<form method="post" action="modification.php">
				
				<TABLE BORDER="1"> 
					<TR> 
						<TH> Login </TH> 
						<TD> <input type="text" name="login"/> </TD> 
					</TR> 
					 
					<TR> 
						<TH> Date</TH> 
						<TD> <input type="text" name="date"/> </TD> 
					</TR> 
					
					<TR> 
						<TH> Texte</TH> 
						<TD> <textarea name="message"  rows=30 COLS=100></textarea></TD> 
					</TR> 
					
					<TR> 
						<TH> Nombre de mots </TH> 
						<TD> <input type="text" name="nbMots"/> </TD> 
					</TR> 
					
				</TABLE> 
				<input type="submit" value="Valider"/>
				<input type="hidden" name="nouveau" value="oui"/>
				</form> 
				<h1> Total des mots pour chaque perso</h1>
				
				<?php
				$reponse = $bdd->query('select a_login, sum(a_nbMots) from message group by a_login');
								
				while ($row = $reponse->fetch())
						echo $row[0]." - ".$row[1]." mots<br>";
				?>

			</article>
			
			<a href="rendu.php"> Le rendu final est par là </a><br>
		
		</section>
		<?php }
		else echo "Vous n\'avez pas les droits pour accéder à cette partie du site. <a href='index.php'> Veuillez vous connecter </a>"; 
		}
		
		else echo "Vous n\'avez pas les droits pour accéder à cette partie du site. <a href='index.php'> Veuillez vous connecter </a>"; ?>
			
			
	</article>
		
	</body>
	
</html>	