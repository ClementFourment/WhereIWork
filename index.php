<?php 
	session_cache_limiter('private, must-revalidate'); 
	session_start(); 
	$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    $acceptLang = ['fr', 'en']; 
    $lang = in_array($lang, $acceptLang) ? $lang : 'en';
    setlocale(LC_TIME, 'fr_FR');
	date_default_timezone_set('Europe/Paris');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
	<meta http-equiv="cache-control" content="no-cache"/>
    <meta http-equiv="Expires" content="-1"/>
	<meta http-equiv="pragma" content="no-cache"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link type="text/css" href="css/styles.css" rel="stylesheet">
	<link rel="icon" type="image/png" sizes="16x16" href="img/logo.png">
	<script src="js/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.bundle.min.5.2.0.js"></script>
	<link href="css/bootstrap.min.4.5.0.css" rel="stylesheet">
	<link rel="stylesheet" href="css/bootstrap.min.5.2.0.css">
	<link rel="stylesheet" href="css/material.icons.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.4.5.0.js"></script>
	<script src='lib/main.js'></script>
	<link rel="stylesheet" href="css/jquery-ui.css">
  	<script src="js/jquery-ui.js"></script>
</head>
<body>
<?php
	//Appel des classes
		include('classes/Utilisateur.php');
		include('classes/Reserver.php');
		$utilisateur = new Utilisateur();
		$reserver = new Reserver();

	//connexion / deconnexion
		if ((EMPTY($_POST) && EMPTY($_POST)) || isset($_POST['accueil']))
		{			
			$utilisateur->entrer();
		}
		if (isset($_POST['deconnexion']))
		{
			$utilisateur->deconnexion();
		}
		if (isset($_POST['authentification']) && (EMPTY($_POST['Login']) || EMPTY($_POST['MotDePasse'])))
		{
			include('includes/authentification.php');
			echo "Veuillez remplir toutes les zones";
		}
		if(isset($_POST['authentification']) && !EMPTY($_POST['Login']) && !EMPTY($_POST['MotDePasse'])) // si les champs sont remplis
		{
			$utilisateur->connexion();
		}
//==================================================================================================================================
//==================================================================================================================================
		if (isset($_SESSION['logged']) && $_SESSION['logged']) 
		{
	// contient tout le reste du code	
			
		//Menu de navigation
			if(isset($_POST['reserverSalle']))
			{
				include('includes/reserverSalle.php');
			}
			if(isset($_POST['reserverSalleDate']))
			{
				include('includes/reserverSalleDate.php');
			}
			if(isset($_POST['mesReservations']))
			{
				include('includes/mesReservations.php');
			}
			
			if(isset($_POST['parametres']))
			{
				$utilisateur->entrer();
			}

		//Tableau de bord
			if (isset($_POST['nav_month_left']) || isset($_POST['nav_month_right'])) 
			{
				
				include('includes/interfaceAdministrateur.php');
			}


		
		
		//Réservation de salles
			if(isset($_POST['choisirSalleReserver']))
			{
				include('includes/reserverDate.php');
			}
			if (isset($_POST['confirmerReserver']))
			{
				$reserver->ajouter();
			}
			if (isset($_POST['supprimerReserver']))
			{
				$reserver->supprimer();
			}
			if (isset($_POST['supprimerReserverFromCalendar']))
			{
				$reserver->supprimerFromCalendar();
			}








			
			
		}
		// else
		// {
		// 	$url = strtok("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", '?');
		// 	header("Location: " . $url);
		// }
?>

	<?php
		// include('includes/footer.php');
	?>
</body>
</html>