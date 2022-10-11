<?php 
	session_start();
	include('database.php'); 
?>
<style>

	.modal-confirm {
		top: 50%;
		color: #636363;
		width: 80%;
	}
	.modal-confirm .modal-content {
		padding: 20px;
		border-radius: 5px;
		border: none;		
		transform: translateY(-75%);
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
	.modal-confirm .btn-danger-reserver {
		background: #00aa00;
	}
	.modal-confirm .btn-danger-reserver:hover, .modal-confirm .btn-danger-reserver:focus {
		background: green;
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
<div id="divReservationChild" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header flex-column">				
				<h4 class="modal-title w-100">Voulez-vous réserver à cette date : <span id="date"></span> ?</h4>	
	            <button onclick="cacherReserver()" type="button" class="close" aria-hidden="true">&times;</button>
			</div>
			<form id="formReserver" method="POST">
				<div class="modal-body">
					<input type="hidden" id="type" name="type" value="<?= $_GET['type'] ?>">
					<input type="hidden" id="dateReserver" name="dateReserver" value="<?= $_GET['date'] ?>">
		            <div class="form-group">
		            	<div  style="display: flex; justify-content: start;">
		                	<label for="plageHoraire">Plage horaire</label>
		            	</div>
		                <select id="plageHoraire" name="plageHoraire" class="custom-select my-1 mr-sm-2" required>
		                    <option value="" disabled selected hidden>Plage horaire...</option>
		                    <?php

			                    $nbSalle = 0;
								$resultReserver = $connect->prepare("SELECT * FROM `salle` WHERE `Type`=\"" . $_GET['type'] . "\"");
								$resultReserver->execute();
								while($rowReserver = $resultReserver->fetch())
								{
									$nbSalle +=1;
								}

								$nbSalleReserveeMatin = 0;
								$resultReserver = $connect->prepare("SELECT * FROM `reserver` WHERE `Date`='" . $_GET['date'] . "' AND `PlageHoraire`='Matin' AND `IdSalle` IN (SELECT `IdSalle` FROM `salle` WHERE `Type`=\"" . $_GET['type'] . "\")");
								$resultReserver->execute();
								while($rowReserver = $resultReserver->fetch())
								{
									$nbSalleReserveeMatin +=1;
								}

								$nbSalleReserveeAprem = 0;
								$resultReserver = $connect->prepare("SELECT * FROM `reserver` WHERE `Date`='" . $_GET['date'] . "' AND `PlageHoraire`='Après-midi' AND `IdSalle` IN (SELECT `IdSalle` FROM `salle` WHERE `Type`=\"" . $_GET['type'] . "\")");
								$resultReserver->execute();
								while($rowReserver = $resultReserver->fetch())
								{
									$nbSalleReserveeAprem +=1;
								}

								if($nbSalle != $nbSalleReserveeMatin)
								{
									echo  "<option value='Matin'>Matin</option>";
								}
								if($nbSalle != $nbSalleReserveeAprem)
								{
									echo  "<option value='Après-midi'>Après-midi</option>";
								}
								if($nbSalle == $nbSalleReserveeMatin && $nbSalle == $nbSalleReserveeAprem)
								{
									echo "
										<script>
											//alert('Toutes les salles ont été réservés ce jour.');
											cacherReserver();
										</script>
									";
								}

		                    ?>
		                    
		                </select>
		            </div>
				</div>
				<div class="modal-footer justify-content-center">
					<button onclick="cacherReserver()" type="button" class="btn btn-secondary">Annuler</button>
					<button id="confirmerReserver" type="submit" class="btn btn-danger-reserver" name="confirmerReserver">Réserver</button>
				</div>
			</form>
		</div>
	</div>
</div> 

<script type="text/javascript">

	$('#divReservationChild').modal("show");

	var newDate = new Date('<?= $_GET['date'] ?>').toLocaleDateString("fr-FR");
	$('#date').text(newDate);


	function cacherReserver() {
		$('#divReservationChild').modal("hide");
	}


</script>