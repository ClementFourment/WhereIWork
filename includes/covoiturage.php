<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Covoiturage</title>
		<meta http-equiv="Content-type" content="text/html" charset="utf-8">
		<link type="text/css" href="css/styles.css" rel="stylesheet">
	</head>
	<body>
<?php
	$_SESSION['page'] = "covoiturage";
	include('entete.php');
	include('database.php');
?>

<?php 

if(isset($_POST['joindreCovoiturage']))
{
    $result = $connect->prepare("INSERT INTO `covoiturer` (`IdCovoiturage`, `IdUtilisateur`) VALUES (" . $_POST['joindreCovoiturage'] . ", " . $_SESSION['id'] . ")");
    $result->execute();
}
if(isset($_POST['retirerCovoiturage']))
{
    $result = $connect->prepare("DELETE FROM `covoiturer` WHERE `IdCovoiturage`=" . $_POST['retirerCovoiturage'] . " AND `IdUtilisateur`=" . $_SESSION['id']);
    $result->execute();
}
if(isset($_POST['supprimerCovoiturage']))
{
    $result = $connect->prepare("DELETE FROM `covoiturer` WHERE `IdCovoiturage`=" . $_POST['supprimerCovoiturage']);
    $result->execute();

    $result = $connect->prepare("DELETE FROM `covoiturage` WHERE `IdCovoiturage`=" . $_POST['supprimerCovoiturage']);
    $result->execute();
}
if(isset($_POST['confirmerAjouterCovoiturage']))
{
    $result = $connect->prepare("INSERT INTO `covoiturage` (`Depart`, `Arrivee`, `Place`, `Heure`, `IdUtilisateur`) VALUES ('" . $_POST['depart'] . "', '" . $_POST['arrivee'] . "', '" . $_POST['place'] . "', '" . $_POST['heure'] . "', " . $_SESSION['id'] . ")");
    $result->execute();
}
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
        z-index: 9;
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
        <h1 class="h1 text-muted">Covoiturage</h1>
		<div class="container-xl">
			<div class="table-responsive">
				<div class="table-wrapper" style="width:100%">
					<div class="table-title">
						<div class="row">
							<div class="col-sm-12">
								<form method="POST">
									<button type="submit" name="ajouterCovoiturage" class="btn btn-info add-new"><i class="fa fa-plus"></i> Ajouter</button>
								</form>
							</div>
						</div>
					</div>
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th><center>Lieu de départ</center></th>
								<th><center>Lieu d'arrivée</center></th>
								<th><center>Heure de départ</center></th>
								<th><center>Conducteur</center></th>
								<th><center>Nombre de places</center></th>
								<th><center>Email</center></th>
								<th><center>Actions</center></th>
							</tr>
						</thead>
						<tbody>
						<?php
							$resultCovoiturage = $connect->prepare("SELECT * FROM `covoiturage`, `utilisateur` WHERE `covoiturage`.`IdUtilisateur` = `utilisateur`.`IdUtilisateur`");
							$resultCovoiturage->execute();
							while($rowCovoiturage = $resultCovoiturage->fetch())
							{ ?>
							<tr>
								<td><center><?= $rowCovoiturage['Depart'] ?></center></td>
								<td><center><?= $rowCovoiturage['Arrivee'] ?></center></td>
								<td><center><?= $rowCovoiturage['Heure'] ?></center></td>
                                <td><center><?= $rowCovoiturage['Nom'] . ' ' . $rowCovoiturage['Prenom'] ?></center></td>

                                <?php
                                $resultCovoiturer = $connect->prepare("SELECT * FROM `covoiturer` WHERE `IdCovoiturage`=" . $rowCovoiturage['IdCovoiturage']);
                                $resultCovoiturer->execute();
                                $flag = false;
                                $compteur = 0;
                                while($rowCovoiturer = $resultCovoiturer->fetch())
                                {
                                    $compteur +=1;
                                    if ($rowCovoiturer['IdUtilisateur'] == $_SESSION['id'])
                                    {
                                        $flag=true;
                                    }
                                }
                                ?>
								<td><center><?= $compteur . "/" . $rowCovoiturage['Place'] ?></center></td>
                                <td><center><?= $rowCovoiturage['Email'] ?></center></td>
								<?php
                                if ($_SESSION['id'] == $rowCovoiturage['IdUtilisateur'])
                                { ?>
								<td>
									<center>
										<form method="POST">
											<button onclick="afficherSupprimer(<?= $rowCovoiturage['IdCovoiturage'] ?>)" class="btn btn-link" type='button'><i class="material-icons">&#xE872;</i></button>
										</form>
									</center>
								</td>
                                <?php 
                                }
                                else
                                { 
                                    if($flag)
                                    {
                                    ?>
                                    <td>
                                        <center>
                                            <form method="POST">
                                                <button class="btn btn-link col-sm-4" type='submit' name="retirerCovoiturage" value="<?= $rowCovoiturage['IdCovoiturage'] ?>"><i class="material-icons">&#xe5c9;</i></button>
                                            </form>
                                        </center>
                                    </td>
                                    <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <td>
                                            <center>
                                                <form method="POST">
                                                    <button class="btn btn-link col-sm-4" type='submit' name="joindreCovoiturage" value="<?= $rowCovoiturage['IdCovoiturage'] ?>"><i class="material-icons">&#xe147;</i></button>
                                                </form>
                                            </center>
                                        </td>
                                        <?php 
                                    }
                                }
                                ?>
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
						<p>Voulez-vous vraiment supprimer le covoiturage <span id="idCovoiturage"></span>?</p>
					</div>
					<div class="modal-footer justify-content-center">
						<button onclick="cacherSupprimer()" type="button" class="btn btn-secondary">Annuler</button>
						<form method="POST">
							<button id="supprimerCovoiturage" type="submit" class="btn btn-danger" name="supprimerCovoiturage">Supprimer</button>
						</form>
					</div>
				</div>
			</div>
		</div>     
	</section>	
	<script type="text/javascript">
		function afficherSupprimer(idCovoiturage){
			$('#divSuppression').modal("show");
			$('#idCovoiturage').text(idCovoiturage);
			$('#supprimerCovoiturage').val(idCovoiturage);
		}
		function cacherSupprimer(){
			$('#divSuppression').modal("hide");
		}
	</script>
</body>
</html>

