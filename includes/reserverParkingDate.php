<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Réserver parking</title>
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
	include('entete.php');
	setlocale(LC_TIME, 'fr_FR');
	date_default_timezone_set('Europe/Paris');


	if (isset($_POST['reserverParkingDate']))
	{
		$date = $_POST['reserverParkingDate'];
	}
?>
	<style type="text/css">
		#formReserver{
			display: flex;
			flex-flow: column wrap;
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
        <h1 class="h1 text-muted">Réserver parking le <?= $date ?></h1>
	
			<br>
			<br>
			<div style="display: flex; flex-flow: row wrap; align-items: center; width: 100vw; justify-content: space-evenly;">
				<form id="formReserver" method="POST">
					<input type="hidden" name="reserverParkingDate2" value="<?= $date ?>">
					<div><p>Je réserve ma place au parking : </p><input type="checkbox" name="validerParking" required></div>
					<input type="submit" name="confirmerReserverParking" value="OK">
				</form>
			</div>
		
	</section>
	</body>
</html>

