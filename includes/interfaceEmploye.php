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
	include('database.php');
	include('entete.php');
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
				<div>
					<button type="submit" name="covoiturage" class="btn btn-primary">Covoiturage</button>
					<button type="submit" name="reserverRestaurant" class="btn btn-primary">Restauration</button>
					<button type="submit" name="reserverParking" class="btn btn-primary">Réserver un parking</button>
				</div>
				<div>
					<button type="submit" name="reserverSalle" class="btn btn-primary">Réserver un bureau</button>
					<button type="submit" name="planningTeletravail" class="btn btn-primary">Planning télétravail</button>
					<button type="submit" name="activites" class="btn btn-primary">Activités</button>
				</div>
			</form>
		</div>
    </section>
	</body>
</html>

