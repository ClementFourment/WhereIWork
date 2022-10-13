<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Ajouter une activite</title>
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
        <h1 class="h1 text-muted">Ajouter une activite</h1>
        <form id="formActivite" method="POST" style="min-width: 300px; max-width: 600px; width: 100%">
            <div class="form-group">
                <label id="nomLabel" for="nom">Nom</label>
                <input class="form-control" type="text" name="nom" id="nom" placeholder="Nom..." value="<?= isset($_POST['nom']) ? $_POST['nom'] : '' ?>" required>
            </div>
            <div class="form-group">
                <label id="descriptionLabel" for="description">Description</label>
                <input class="form-control" type="text" name="description" id="description" placeholder="Description..." value="<?= isset($_POST['description']) ? $_POST['description'] : '' ?>" required>
            </div>
            <div class="form-group">
                <label id="dateLabel" for="date">Date</label>
                <input class="form-control timepicker" type="text" name="date" id="date" placeholder="Date..." value="<?= isset($_POST['date']) ? $_POST['date'] : '' ?>" required>
            </div>
            <div class="form-group">
                <label id="heureDebutLabel" for="heureDebut">Heure de départ</label>
                <input class="form-control timepicker" type="text" name="heureDebut" id="heureDebut" placeholder="Heure de départ..." value="<?= isset($_POST['heureDebut']) ? $_POST['heureDebut'] : '' ?>" required>
            </div>
            <div class="form-group">
                <label id="heureFinLabel" for="heureFin">Heure de fin</label>
                <input class="form-control timepicker" type="text" name="heureFin" id="heureFin" placeholder="Heure de fin..." value="<?= isset($_POST['heureFin']) ? $_POST['heureFin'] : '' ?>" required>
            </div>
            <div class="form-group">
                <label id="placeLabel" for="place">Nombre de places</label>
                <input class="form-control timepicker" type="text" name="place" id="place" placeholder="Places..." value="<?= isset($_POST['place']) ? $_POST['place'] : '' ?>" required>
            </div>
            
            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="confirmerAjouterActivite" value="Ajouter">
            </div>
        </form>
    </section>
	</body>
</html>

