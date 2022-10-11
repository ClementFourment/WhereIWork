<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Réserver</title>
		<meta http-equiv="Content-type" content="text/html" charset="utf-8">
		<link type="text/css" href="css/styles.css" rel="stylesheet">
	</head>
	<body>
<?php
    $_SESSION['page'] = "reserver";
	include('entete.php');
	include('database.php');
?>
	<section id="interface">
        <h1 class="h1 text-muted">Réserver</h1>
		<section id="mainContainer">
			<table class="table">
				<tbody>
				<?php
					$resultSalle = $connect->prepare("SELECT DISTINCT `Type` FROM `salle` ORDER BY `Type`");
					$resultSalle->execute();
					while($rowSalle = $resultSalle->fetch())
					{ ?>
					<tr>
						<form method="POST">
						<th scope="row"><?= $rowSalle['Type'] ?></th>
						<input type="hidden" name="type" value="<?= $rowSalle['Type'] ?>"/>
						<td><input type="submit" name="choisirSalleReserver" value="Choisir" class="btn btn-primary"/></td>
						</form>
					</tr>
					<?php
					} ?>
				</tbody>
			</table>
		</section>
    </section>
	</body>
</html>

