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


	if (isset($_POST['reserverRestaurantDate']))
	{
		$date = $_POST['reserverRestaurantDate'];
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
		
		$flag = false;
		$result = $connect->prepare("SELECT * FROM `reserverRestaurant` WHERE `Date` = '" . $date . "' AND `IdUtilisateur`=" . $_SESSION['id']);
		$result->execute();
		while($row = $result->fetch())
		{
			$flag = true;
		}
		if ($flag)
		{
			?> <h1>Vous avez déjà réservé votre place au restaurant.</h1><?php
		}
		else
		{
			?>
			<form method="POST" id="formReserver">
				<input type="hidden" name="reserverRestaurantDate2" value="<?= $date ?>">
				<div><p>Je réserve ma place au restaurant : </p><input type="checkbox" name="validerRestaurant" required></div>
				<input type="submit" name="confirmerReserver" value="OK">
			</form>
			<?php
		}
	?>
		
	</section>
	</body>
</html>

