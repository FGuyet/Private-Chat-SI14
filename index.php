<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="style.css" />
	
        <title>SI14 - Connexion </title>
    </head>
	
	<body>
	<article>
	
			<h1> Formulaire de connexion </h1>
			
			<form method="post" action="conversation.php">
			
			
			<TABLE BORDER="1"> 
				<TR> 
					<TH> Login </TH> 
					<TD> <input type="text" name="login"/> </TD> 
				</TR> 
				 
				<TR> 
					<TH> Password </TH> 
					<TD> <input type="password" name="mdp"/> </TD> 
				</TR> 
			</TABLE> 
			<input type="submit" value="Se connecter"/>
			</form> 
			
	</article>
			
	</body>