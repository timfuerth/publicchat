<!DOCTYPE html> 
<html lang="de-at">
<head>
	<?php 
	if (isset($_SESSION['user'])){
		echo '<title>PublicChat '.$_SESSION['user'].'</title>';
	}
	else{
		echo '<title>PublicChat</title>';
	}
	?>
	
	<link rel="stylesheet" href="styles/styles.css">
	<link rel="icon" type="image/x-icon" href="view/images/logo.png">
	<meta lang="de-at"/>
	<meta http-equiv="Content-Type" 
      content="text/html; charset=utf-8">
	<meta name="description" content="Einfaches Finden und Bewerben für Praktikumsplätze"/>
	
	<!--<meta name="google-site-verification" content="">-->

</head>

<body>
	<header>
		<div id="headerl">
		<a href="index.php"><img src="view/images/logo.png" class="logo" alt=""></a>
		<?php 
			if (isset($_SESSION['user'])){
				echo '<h1>PublicChat - '.$_SESSION['user'].'</h1>';
			}
			else{
				echo '<h1>Hallo</h1>';
			}
		?>
		</div>
		<div id="headerr">
			<h1 id="h1ToUser"></h1>
			<button><a href="view/login.php">abmelden</a></button>
		</div>
			
	</header>
</body>
</html>