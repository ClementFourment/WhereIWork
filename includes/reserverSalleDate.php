<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Réserver un bureau</title>
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


	if (isset($_POST['reserverSalleDate']))
	{
		$date = $_POST['reserverSalleDate'];
	}
	else
	{
		$date = $_POST['reserverSalleDate2'];
	}
?>
	<style type="text/css">
		body{
			background: url("img/bureaux.png") no-repeat center center fixed;
			background-position:50% 200px;
		}
		.bureaux1{
			display: flex;
			flex-flow: row wrap;
			position: absolute;
			top: 210px;
			margin-left: -1050px;
			width: 100px;
		}
		.bureaux2{
			display: flex;
			flex-flow: row wrap;
			position: absolute;
			top: 210px;
			margin-left: -750px;
			width: 100px;
		}
		.bureaux3{
			display: flex;
			flex-flow: row wrap;
			position: absolute;
			top: 210px;
			margin-left: -375px;
			width: 100px;
		}
		.bureaux4{
			display: flex;
			flex-flow: row wrap;
			position: absolute;
			top: 335px;
			margin-left: -780px;
			width: 100px;
		}
		.bureaux5{
			display: flex;
			flex-flow: row wrap;
			position: absolute;
			top: 335px;
			margin-left: -520px;
			width: 100px;
		}
		.bureau{
			width: 50px;
			height: 50px;
			border: 3px solid black;
		}
		.libre{
			background-color: #00FF00;
		}
		.reserve{
			background-color: #0000FF;
		}
		.libre:hover{
			cursor: pointer;
			transform: scale(1.1);
		}
		.reserve:hover{
			cursor: pointer;
			transform: scale(1.1);
		}
		.occupe{
			background-color: #FF0000;
		}
	</style>

	<?php
		if(isset($_POST['salleareserver']))
		{
			$flag = false;
			$result = $connect->prepare("SELECT * FROM `reserverSalle`, `salle` WHERE `Date` = '" . $date . "' AND `IdUtilisateur`=" . $_SESSION['id'] . " AND `salle`.`Nom` ='" . $_POST['salleareserver'] . "' AND `salle`.`IdSalle` = `reserverSalle`.`IdSalle`");
			$result->execute();
			while($row = $result->fetch())
			{
				$flag = true;
			}
			if ($flag)
			{
				$result = $connect->prepare("DELETE FROM `reserverSalle` WHERE `Date` = '" . $date . "' AND `IdUtilisateur`=" . $_SESSION['id'] . " AND `IdSalle` IN (SELECT `IdSalle` FROM `Salle` WHERE `Nom`='" . $_POST['salleareserver'] . "')");
			}
			else
			{
				$result = $connect->prepare("INSERT INTO `reserverSalle`(`IdSalle`, `IdUtilisateur`, `Date`) VALUES (" . $_POST['salleareserver'] . ", " . $_SESSION['id'] . ", '" . $date . "')");
			}
			$result->execute();
		}
	?>
	<section id="interface">
        <h1 class="h1 text-muted">Réserver un bureau le <?= $date ?></h1>
		<div class="bureaux1">
			<div id="1" class="bureau libre"></div>
			<div id="2" class="bureau libre"></div>
			<div id="3" class="bureau libre"></div>
			<div id="4" class="bureau libre"></div>
		</div>
		<div class="bureaux2">
			<div id="5" class="bureau libre"></div>
			<div id="6" class="bureau libre"></div>
			<div id="7" class="bureau libre"></div>
			<div id="8" class="bureau libre"></div>
		</div>
		<div class="bureaux3">
			<div id="9" class="bureau libre"></div>
			<div id="10" class="bureau libre"></div>
			<div id="11" class="bureau libre"></div>
			<div id="12" class="bureau libre"></div>
		</div>
		<div class="bureaux4">
			<div id="13" class="bureau libre"></div>
			<div id="14" class="bureau libre"></div>
		</div>
		<div class="bureaux5">
			<div id="15" class="bureau libre"></div>
			<div id="16" class="bureau libre"></div>
		</div>
	</section>

	<form style="visibility: hidden;" method="POST">
		<input type="hidden" name="reserverSalleDate2" value="<?= $date ?>">
		<button type="submit" id="salleareserver" name="salleareserver" value=""></button>
	</form>
	<script>
		var bureaux = new Array();
		<?php 
		$result = $connect->prepare("SELECT * FROM `reserverSalle`, `salle` WHERE `Date` = '" . $date . "' AND `salle`.`IdSalle` = `reserverSalle`.`IdSalle`");
		$result->execute();
		while($row = $result->fetch())
		{
			echo "console.log('test');";
			if($row["IdUtilisateur"] == $_SESSION['id'])
			{
				echo "bureaux[" . $row['Nom'] . "] = 'reserve';";
			}
			else
			{
				echo "bureaux[" . $row['Nom'] . "] = 'occupe';";
			}
		}
		?>
		console.log(bureaux)
		for (bureau in bureaux)
		{
			if (bureaux[bureau] == "libre")
			{
				$('#' + bureau).removeClass("occupe");
				$('#' + bureau).removeClass("reserve");
				$('#' + bureau).addClass("libre");
			}
			else if (bureaux[bureau] == "occupe")
			{
				$('#' + bureau).addClass("occupe");
				$('#' + bureau).removeClass("reserve");
				$('#' + bureau).removeClass("libre");
			}
			else if (bureaux[bureau] == "reserve")
			{
				$('#' + bureau).removeClass("occupe");
				$('#' + bureau).addClass("reserve");
				$('#' + bureau).removeClass("libre");
			}
		}

		$('.libre, .reserve').click((e) => {
			$('#salleareserver').val(e.target.id);
			$('#salleareserver').click();
		})

	</script>
	</body>
</html>

