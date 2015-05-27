<?php session_start(); ?>

<!DOCTYPE html>

<html>
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="style.css" />

        <title>SI14 - redaction message </title>
    </head>
	
	<body>
	
	<?php 
	
	if ((isset($_POST["login"])) && (isset($_POST["mdp"])) )
		{
		$_SESSION["login"] = htmlspecialchars($_POST["login"]);
		$_SESSION["mdp"] =  htmlspecialchars($_POST["mdp"]);
		}
	
	include("connect.php");	

	if ((isset($_SESSION["login"])) && (isset($_SESSION["mdp"])))
		{
		if (($_SESSION["login"]=="flo" || $_SESSION["login"]=="dylan" || $_SESSION["login"]=="celine" ) && $_SESSION["mdp"]=="$ADMINmdp")
			{?>
	
		<?php include("header.php"); ?>
	
		<section>
		
			<article>
				<h1> Rédaction d'un nouveau message </h1>
			
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

			</article>
 
		</section>
		
		
		
		<?php }
		else echo "Vous n\'avez pas les droits pour accéder à cette partie du site. <a href='index.php'> Veuillez vous connecter </a>"; 
		}
		
		else echo "Vous n\'avez pas les droits pour accéder à cette partie du site. <a href='index.php'> Veuillez vous connecter </a>"; ?>
			
			
	</article>
			
	</body>
	
	