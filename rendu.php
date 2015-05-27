<?php session_start(); ?>

<!DOCTYPE html>

<html>
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="style.css" />

        <title>SI14 - Written project</title>
    </head>
	
	<body>
	
	
		<article id="credits">
	
			<h1> Connection </h1>
			<p> This is a private chat, please connect to access the discussion <p>
			
			
			
			<form >
			
			<div id="connectform">
			<TABLE BORDER="0" id="connectformtab" > 
				<TR> 
					<Th> Title </Th> 
					<TD> <input type="text" name="login" value="The new billionaires' trip"/> </TD> 
				</TR> 
				 
				<TR> 
					<Th> Password </Th> 
					<TD> <input type="password" name="mdp" value="blablablablabla"/> </TD> 
				</TR> 
			</TABLE> 
		
			<input type="submit" value="Enter"/>
			</div>
			</form>
			
		</article>
	
		<div id="debut">HappyDydy started a new conversation with SarcasticCeline and DepressedFlo.</div>
	
		<section>
		
		<?php

			include("connect.php");
		
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
			</article>	
		
		<?php	}$reponse->closeCursor(); ?>
		
		
		<p id ='fin'> The discussion has been closed. <p>
		
		
		
			<article id="credits">
				<h1> Authors </h1>
				
				<p> This project was written for the SI14 course, by 3 students :<p>
				<p>
				<?php
				$reponse = $bdd->query('select T.somme from 
											(select a_login, sum(a_nbMots) as somme from message group by a_login) T
											where a_login="SarcasticCeline"');
				
				while ($row = $reponse->fetch())				
						echo "<em>Celine PIETTE :</em> SarcasticCeline (total of ".$row[0]." words)<br>";
				
				$reponse = $bdd->query('select T.somme from 
											(select a_login, sum(a_nbMots) as somme from message group by a_login) T
											where a_login="HappyDydy"');
								
				while ($row = $reponse->fetch())
						echo "<em>Dylan COHEN TANNUGI :</em> HappyDydy (total of ".$row[0]." words)<br>";
				
				$reponse = $bdd->query('select T.somme from 
											(select a_login, sum(a_nbMots) as somme from message group by a_login) T
											where a_login="DepressedFlo"');
								
				while ($row = $reponse->fetch())
						echo "<em>Florian GUYET :</em> DepressedFlo (total of ".$row[0]." words)<br>";
				?>
				</p>
			</article>
		
		</section>
			
	</article>
		
	</body>
	
	