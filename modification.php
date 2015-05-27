<?php session_start(); ?>

<!DOCTYPE html>

<html>
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="style.css" />

        <title>SI14 - Modification message</title>
    </head>
	
	<body>
	
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
			
			if (isset($_POST["nouveau"]))
			{
				try
				{
					$bdd = new PDO('mysql:host=mutusql03.evxonline.net;dbname=sitesi;charset=utf8', "$ADMINlogin", "$ADMINmdp");
				}
				catch (Exception $e)
				{
						die('Erreur : ' . $e->getMessage());
				}	
				
				$reponse = $bdd->query('SELECT MAX(pk_id) FROM message');
				$donnees = $reponse->fetch();
				$id = $donnees[0] +1;
				$reponse->closeCursor();
				
				
				if (isset($_POST["login"]))
					$log=addslashes(htmlspecialchars($_POST["login"]));
				else $log= "A REMPLIR";
				
				if (isset($_POST["date"]))
					$date=addslashes(htmlspecialchars($_POST["date"]));
				else $log= "A REMPLIR";
					
				if (isset ($_POST["message"]))
					if (($_POST["nouveau"])=="oui")
						$message = nl2br(addslashes(htmlspecialchars($_POST["message"])));
					else $message = addslashes($_POST["message"]);
				else $message ="A REMPLIR";
				
				if (isset ($_POST["nbMots"]))
					$nbMots= $_POST["nbMots"];
				else $nbMots = 0;
								
				try
				{
					$bdd = new PDO('mysql:host=mutusql03.evxonline.net;dbname=sitesi;charset=utf8', "$ADMINlogin", "$ADMINmdp");
				}
				catch (Exception $e)
				{
						die('Erreur : ' . $e->getMessage());
				}	
				
				if ($_POST["nouveau"]=="oui")
				{
					$req = $bdd->exec("INSERT INTO message VALUES ('".$id."','".$log."','".$date."','".$message."','".$nbMots."')");

					echo 'Le message a bien ete ajoute !';
				}
				else 
				
				{				
					$id= $_POST["id"];
					
					$req = $bdd->exec("UPDATE message SET a_login = '".$log."', a_date = '".$date."', a_message = '".$message."', a_nbMots = '".$nbMots."' WHERE pk_id=".$id);

					echo 'Le message a bien été modifié !';
				
				}

			}
			
			if (isset($_GET["id"]))
				$id= (int)$_GET["id"];
			
			?>
			
		
	
		<?php include("header.php"); ?>
		
		
		<?php 
		
		if (isset($id))
		{
		
			
		
				try
				{
					$bdd = new PDO('mysql:host=mutusql03.evxonline.net;dbname=sitesi;charset=utf8', "$ADMINlogin", "$ADMINmdp");
				}
				catch (Exception $e)
				{
						die('Erreur : ' . $e->getMessage());
				}	
				
				$reponse = $bdd->query('SELECT * FROM message WHERE pk_id='.$id);

				// On affiche chaque entrée une à une
				$donnees = $reponse->fetch();
				
				
				?>
				
				
	
		<section>
		
			<article>
				<h1> Mofication du message </h1>
			
				<form method="post" action="modification.php">
				
				
				
				<TABLE BORDER="1"> 
					<TR> 
						<TH> Login </TH> 
						<TD> <input type="text" name="login" value="<?php echo $donnees['a_login'];?>"/> </TD> 
					</TR> 
					 
					<TR> 
						<TH> Date</TH> 
						<TD> <input type="text" name="date" value="<?php echo $donnees['a_date'];?>"/> </TD> 
					</TR> 
					
					<TR> 
						<TH> Texte</TH> 
						<TD> <textarea name="message" rows=30 COLS=100><?php echo $donnees['a_message'];?></textarea></TD> 
					</TR> 
					
					<TR> 
						<TH> Nombre de mots </TH> 
						<TD> <input type="text" name="nbMots" value="<?php echo $donnees['a_nbMots'];?>"/> </TD> 
					</TR> 
					
				</TABLE>
				<input type="hidden" name="nouveau" value="non"/>
				<input type="hidden" name="id" value="<?php echo $id ?>"/>
				<input type="submit" value="Valider"/>
				</form> 

			</article>
 
		</section>
		
		
		<?php
		} else echo " Nous ne savons pas quel article modifier";
		
		
		}
		else echo "Vous n\'avez pas les droits pour accéder à cette partie du site. <a href='index.php'> Veuillez vous connecter </a>"; 
		}
		
		else echo "Vous n\'avez pas les droits pour accéder à cette partie du site. <a href='index.php'> Veuillez vous connecter </a>"; ?>
			
			
	</article>
			
	</body>
	
	