<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Ajouter une covoiturage</title>
		<meta http-equiv="Content-type" content="text/html" charset="utf-8">
		<link type="text/css" href="css/styles.css" rel="stylesheet">
	</head>
	<body>
<?php
    $_SESSION['page'] = "";
	include('entete.php');
	include('database.php');
?>
	<section id="interface">
        <h1 class="h1 text-muted">Ajouter une covoiturage</h1>
        <form id="formCovoiturage" method="POST" style="min-width: 300px; max-width: 600px; width: 100%">
            <div class="form-group">
                <label id="departLabel" for="depart">Lieu de départ</label>
                <input class="form-control" type="text" name="depart" id="depart" placeholder="Départ..." value="<?= isset($_POST['depart']) ? $_POST['depart'] : '' ?>" required>
            </div>
            <div class="form-group">
                <label id="arriveeLabel" for="arrivee">Lieu d'arrivée</label>
                <input class="form-control" type="text" name="arrivee" id="arrivee" placeholder="Arrivée..." value="<?= isset($_POST['arrivee']) ? $_POST['arrivee'] : '' ?>" required>
            </div>
            <div class="form-group">
                <label id="placeLabel" for="place">Nombre de places</label>
                <input class="form-control timepicker" type="text" name="place" id="place" placeholder="Places..." value="<?= isset($_POST['place']) ? $_POST['place'] : '' ?>" required>
            </div>
            <div class="form-group">
                <label id="heureLabel" for="heure">Heure de départ</label>
                <input class="form-control timepicker" type="text" name="heure" id="heure" placeholder="Heure..." value="<?= isset($_POST['heure']) ? $_POST['heure'] : '' ?>" required>
            </div>
            
            
            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="confirmerAjouterCovoiturage" value="Ajouter">
            </div>
        </form>
    </section>
	</body>
</html>

