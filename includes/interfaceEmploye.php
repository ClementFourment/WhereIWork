<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Accueil</title>
		<meta http-equiv="Content-type" content="text/html" charset="utf-8">
		<link type="text/css" href="css/styles.css" rel="stylesheet">
	</head>
	<body>
<?php
	$_SESSION['page'] = "accueil";
	include('entete.php');
	include('database.php');
?>
	<style type="text/css">
		body{
			background: url("img/happy_employee.png") no-repeat center center fixed;
			background-size: 100%;
			background-position:0 160px;
		}
	</style>
	<section id="interface">
		<h1 class="h1 text-muted">WhereIWork</h1>
		<div class="choix-menu-employe">
			<form method="POST">
				<button type="submit" name="reserverSalle" class="btn btn-primary">Réservation de salles</button>
				<button type="submit" name="planningTeletravail" class="btn btn-primary">Planning télétravail</button>
				<button type="submit" name="activites" class="btn btn-primary">Activités</button>
			</form>
		</div>
    </section>
	</body>
</html>

