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
		$utilisateur = new Utilisateur();

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
			
		//Réserver Salles
			if(isset($_POST['reserverSalle']))
			{
				include('includes/reserverSalle.php');
			}
			if(isset($_POST['reserverSalleDate']))
			{
				include('includes/reserverSalleDate.php');
			}
			if(isset($_POST['salleareserver']))
			{
				include('includes/reserverSalleDate.php');
			}
			
		//Réserver restaurant
			if(isset($_POST['reserverRestaurant']))
			{
				include('includes/reserverRestaurant.php');
			}
			if(isset($_POST['reserverRestaurantDate']))
			{
				include('includes/reserverRestaurantDate.php');
			}
			if(isset($_POST['confirmerReserverRestaurant']))
			{
				include('includes/validerReserverRestaurantDate.php');
			}

		//Réserver parking
			if(isset($_POST['reserverParking']))
			{
				include('includes/reserverParking.php');
			}
			if(isset($_POST['reserverParkingDate']))
			{
				include('includes/reserverParkingDate.php');
			}
			if(isset($_POST['confirmerReserverParking']))
			{
				include('includes/validerReserverParkingDate.php');
			}
		
		//Covoiturage
			if(isset($_POST['covoiturage']))
			{
				include('includes/covoiturage.php');
			}
			if(isset($_POST['ajouterCovoiturage']))
			{
				include('includes/ajouterCovoiturage.php');
			}
			if(isset($_POST['confirmerAjouterCovoiturage']))
			{
				include('includes/covoiturage.php');
			}
			if(isset($_POST['joindreCovoiturage']))
			{
				include('includes/covoiturage.php');
			}
			if(isset($_POST['retirerCovoiturage']))
			{
				include('includes/covoiturage.php');
			}
			if(isset($_POST['supprimerCovoiturage']))
			{
				include('includes/covoiturage.php');
			}
			
		//Activite
			if(isset($_POST['activite']))
			{
				include('includes/activite.php');
			}
			if(isset($_POST['ajouterActivite']))
			{
				include('includes/ajouterActivite.php');
			}
			if(isset($_POST['confirmerAjouterActivite']))
			{
				include('includes/activite.php');
			}
			if(isset($_POST['joindreActivite']))
			{
				include('includes/activite.php');
			}
			if(isset($_POST['retirerActivite']))
			{
				include('includes/activite.php');
			}
			if(isset($_POST['supprimerActivite']))
			{
				include('includes/activite.php');
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