<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Réserver restaurant</title>
		<meta http-equiv="Content-type" content="text/html" charset="utf-8">
		<link type="text/css" href="css/styles.css" rel="stylesheet">
		<link href='lib/main.css' rel='stylesheet' />
		<script src='lib/main.js'></script>
		<script type="text/javascript" src='lib/locales/fr.js'></script>
	</head>
	<body>
<?php
    $_SESSION['page'] = "reserver";
	include('database.php');
	setlocale(LC_TIME, 'fr_FR');
	date_default_timezone_set('Europe/Paris');


	if (isset($_POST['reserverRestaurantDate2']))
	{
		$date = $_POST['reserverRestaurantDate2'];
	}
?>
	<style type="text/css">
		#formReserver{
			display: flex;
			flex-flow: column wrap;
			position: absolute;
			top: 300px;
			left: 50%;
			transform: translateX(-50%);
		}
		#formReserver div{
			display: flex;
			flex-flow: row wrap;
			align-items: inline-block;
			font-size: 30px;
		}
		input[type="checkbox"] {
			cursor: pointer;
			height: 45px;
			width: 45px;
			margin-left: 5px;
		}
	</style>

	<section id="interface">
        <h1 class="h1 text-muted">Réserver restaurant le <?= $date ?></h1>
	<?php
		if (isset($_POST['validerRestaurant'])) 
		{
			$result = $connect->prepare("INSERT INTO `reserverRestaurant` (`IdUtilisateur`, `Date`) VALUES (" . $_SESSION['id'] . ", '" . $date . "')");
			$result->execute();
		}
	?>
		<h1>Félicitation, vous venez de réserver votre place au restaurant.</h1>
	</section>
	</body>
</html>

