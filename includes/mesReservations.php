<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Mes réservations</title>
		<meta http-equiv="Content-type" content="text/html" charset="utf-8">
		<link type="text/css" href="css/styles.css" rel="stylesheet">
	</head>
	<body>
<?php
	$_SESSION['page'] = "mesReservations";
	include('entete.php');
	include('database.php');
?>

<style>
	.table-wrapper {
		width: 700px;
		margin: 30px auto;
		background: #fff;
		padding: 20px;	
		box-shadow: 0 1px 1px rgba(0,0,0,.05);
	}
	.table-title {
		padding-bottom: 10px;
		margin: 0 0 10px;
	}
	.table-title h2 {
		margin: 6px 0 0;
		font-size: 22px;
	}
	.table-title .add-new {
		float: right;
		height: 30px;
		font-weight: bold;
		font-size: 12px;
		text-shadow: none;
		min-width: 100px;
		border-radius: 50px;
		line-height: 13px;
	}
	.table-title .add-new i {
		margin-right: 4px;
	}
	table.table {
		table-layout: fixed;
	}
	table.table tr th, table.table tr td {
		border-color: #e9e9e9;
	}
	table.table th i {
		font-size: 13px;
		margin: 0 5px;
		cursor: pointer;
	}
	table.table th:last-child {
		width: 100px;
	}
	table.table td a {
		cursor: pointer;
		display: inline-block;
		margin: 0 5px;
		min-width: 24px;
	}    
	table.table td a.add {
		color: #27C46B;
	}
	table.table td a.edit {
		color: #FFC107;
	}
	table.table td a.delete {
		color: #E34724;
	}
	table.table td i {
		font-size: 19px;
	}
	table.table td a.add i {
		font-size: 24px;
		margin-right: -1px;
		position: relative;
		top: 3px;
	}    
	table.table .form-control {
		height: 32px;
		line-height: 32px;
		box-shadow: none;
		border-radius: 2px;
	}
	table.table .form-control.error {
		border-color: #f50000;
	}
	table.table td .add {
		display: none;
	}
	.modal-confirm {
		top: 50px;	
		color: #636363;
		width: 400px;
	}
	.modal-confirm .modal-content {
		padding: 20px;
		border-radius: 5px;
		border: none;
		text-align: center;
		font-size: 14px;
	}
	.modal-confirm .modal-header {
		border-bottom: none;   
		position: relative;
	}
	.modal-confirm h4 {
		text-align: center;
		font-size: 26px;
		margin: 30px 0 -10px;
	}
	.modal-confirm .close {
		position: absolute;
		top: -5px;
		right: -2px;
	}
	.modal-confirm .modal-body {
		color: #999;
	}
	.modal-confirm .modal-footer {
		border: none;
		text-align: center;		
		border-radius: 5px;
		font-size: 13px;
		padding: 10px 15px 25px;
	}
	.modal-confirm .modal-footer a {
		color: #999;
	}		
	.modal-confirm .icon-box {
		width: 80px;
		height: 80px;
		margin: 0 auto;
		border-radius: 50%;
		z-index: 9;
		text-align: center;
		border: 3px solid #f15e5e;
	}
	.modal-confirm .icon-box i {
		color: #f15e5e;
		font-size: 46px;
		display: inline-block;
		margin-top: 13px;
	}
	.modal-confirm .btn, .modal-confirm .btn:active {
		color: #fff;
		border-radius: 4px;
		background: #60c7c1;
		text-decoration: none;
		transition: all 0.4s;
		line-height: normal;
		min-width: 120px;
		border: none;
		min-height: 40px;
		border-radius: 3px;
		margin: 0 5px;
	}
	.modal-confirm .btn-secondary {
		background: #c1c1c1;
	}
	.modal-confirm .btn-secondary:hover, .modal-confirm .btn-secondary:focus {
		background: #a8a8a8;
	}
	.modal-confirm .btn-danger {
		background: #f15e5e;
	}
	.modal-confirm .btn-danger:hover, .modal-confirm .btn-danger:focus {
		background: #ee3535;
	}
	.trigger-btn {
		display: inline-block;
		margin: 100px auto;
	}
</style>
</head>
<body>
	<section id="interface">
		<div class="container-xl">
			<div class="table-responsive">
				<div class="table-wrapper" style="width:100%">
					<div class="table-title">
						<div class="row">
							<div class="col-sm-8"><h2 class="font-weight-bold text-muted">Mes réservations</h2></div>
							<div class="col-sm-4">
								<form method="POST">
								</form>
							</div>
						</div>
					</div>
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th><center>Identifiant</center></th>
								<th><center>Salle</center></th>
								<th><center>Nom</center></th>
								<th><center>Prénom</center></th>
								<th><center>Date</center></th>
								<th><center>Plage horaire</center></th>
								<th><center>Actions</center></th>
							</tr>
						</thead>
						<tbody>
						<?php 
							$resultReserver = $connect->prepare("SELECT * FROM `reserver` WHERE `IdUtilisateur` =" . $_SESSION['id'] . " ORDER BY `Date` DESC");
							$resultReserver->execute();
							while($rowReserver = $resultReserver->fetch())
							{ ?>
							<tr>
								<td><center><?= $rowReserver['IdReserver'] ?></center></td>
								<?php
								$resultSalle = $connect->prepare("SELECT * FROM `salle` WHERE `IdSalle`=" . $rowReserver['IdSalle']);
								$resultSalle->execute();
								while($rowSalle = $resultSalle->fetch())
								{ ?>
									<td><center><?= $rowSalle['Nom'] ?></center></td>
								<?php }
								$resultUtilisateur = $connect->prepare("SELECT * FROM `utilisateur` WHERE `IdUtilisateur`=" . $rowReserver['IdUtilisateur']);
								try{
									$resultUtilisateur->execute();
									while($rowUtilisateur = $resultUtilisateur->fetch())
									{ ?>
										<td><center><?= $rowUtilisateur['Nom'] ?></center></td>
										<td><center><?= $rowUtilisateur['Prenom'] ?></center></td>
									  <?php
									}
								}
								catch(Exception $e){
								  ?>
									<td><center>-</center></td>
									<td><center>-</center></td>
								  <?php
								}
								?>
								<td><center><?= strftime("%d/%m/%Y", strtotime($rowReserver['Date'])) ?></center></td>
								<td><center><?= $rowReserver['PlageHoraire'] ?></center></td>
								<td>
									<center>
									<?php
										$year = getdate()['year'];
										$month = getdate()['mon'];
										$day = getdate()['mday'];

										if ($day < 10)
										{
											$day = '0' + $day;
										}
										if ($month < 10)
										{
											$month = '0' + $month;
										}
										
										if (strtotime($rowReserver['Date']) > strtotime($year . "-" . $month . "-" . $day))
										{
											?>
											<form method="POST">
												<button onclick="afficherSupprimer(<?= $rowReserver['IdReserver'] ?>)" class="btn btn-link" type='button'><i class="material-icons">&#xE872;</i></button>
											</form>
											<?php
										}
										else
										{
											echo "-";
										}
										?>
									</center>
								</td>
							</tr> 
							<?php } ?>    
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div id="divSuppression" class="modal fade">
			<div class="modal-dialog modal-confirm">
				<div class="modal-content">
					<div class="modal-header flex-column">
						<div class="icon-box">
							<i class="material-icons">&#xE5CD;</i>
						</div>						
						<h4 class="modal-title w-100">Êtes-vous sûr ?</h4>	
		                <button onclick="cacherSupprimer()" type="button" class="close" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<p>Voulez-vous vraiment supprimer la réservation <span id="idReserver"></span>?</p>
					</div>
					<div class="modal-footer justify-content-center">
						<button onclick="cacherSupprimer()" type="button" class="btn btn-secondary">Annuler</button>
						<form method="POST">
							<button id="supprimerReserver" type="submit" class="btn btn-danger" name="supprimerReserver">Supprimer</button>
						</form>
					</div>
				</div>
			</div>
		</div>     
	</section>	
	<script type="text/javascript">
		function afficherSupprimer(idReserver){
			$('#divSuppression').modal("show");
			$('#idReserver').text(idReserver);
			$('#supprimerReserver').val(idReserver);
		}
		function cacherSupprimer(){
			$('#divSuppression').modal("hide");
		}
	</script>
</body>
</html>

