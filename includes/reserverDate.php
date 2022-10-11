<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Réserver</title>
		<meta http-equiv="Content-type" content="text/html" charset="utf-8">
		<link type="text/css" href="css/styles.css" rel="stylesheet">
		<link href='lib/main.css' rel='stylesheet' />
		<script src='lib/main.js'></script>
		<script type="text/javascript" src='lib/locales/fr.js'></script>
	</head>
	<body>
<?php
    $_SESSION['page'] = "reserver";
	include('entete.php');
	include('database.php');
	setlocale(LC_TIME, 'fr_FR');
	date_default_timezone_set('Europe/Paris');
?>
<style>
	body {
		overflow-y: hidden !important;
	}
	#titleType {
		font-size: 1.75em;
		margin: 0;
	}
	.calendar-trash {
		position: absolute; 
		bottom: -100px;
		opacity: 0.5;
	}
	.shake {
		bottom: 10px;
		animation: shake-animation 0.2s ease infinite;
		transform-origin: 50% 50%;
	}
	.shake .material-icons {
		transition: 1s;
		transform: scale(2);
	}
	.material-icons {
		transition: 0.1s;
	}
	@keyframes shake-animation {
		0% { transform:translate(0,0) }
		50% { transform:translate(20px,0) }
	  	100% { transform:translate(0,0) }
	}
	.fc-event-dragging:not(.fc-selected) { 
		opacity: 1;
		transform: scale(1.2, 1.2);
	}
	#calendar {
		width: 80%;
		max-height: 650px;
	 	margin: 0 auto;
	}
	.fc-toolbar {
	    text-transform: uppercase;
	}
	.flexStart {
		width: 229px;
	}
	.flexEnd {
		width: 229px;
		display: flex;
		flex: row;
		justify-content: flex-end;
	}
	.fc-toolbar-chunk {
		width: 229px;
		display: flex;
		justify-content: center;
	}
	.fc-scroller {
		height: auto!important;
		overflow-y: auto;
	}
	.fc-icon.fc-icon-chevron-right, .fc-icon.fc-icon-chevron-left{
		color: white;
	}
	.fc-view-harness.fc-view-harness-active {
	}
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
	<section id="interface">
        <h1 class="h1 text-muted">Réserver</h1>

		<br>
		<div id='calendar'></div>

		<div style="width: 80%; height: 60px; display: flex; flex-flow: column wrap; justify-content:space-around;">
			<div style="display: flex; flex-flow: row wrap; align-items: center;">
				<div class="fc-daygrid-event-dot"></div>
				Matin
			</div>
			<div style="display: flex; flex-flow: row wrap; align-items: center;">
				<div class="fc-daygrid-event-dot" style="border-color: rgb(255, 85, 85)"></div>
				Après-midi
			</div>
		</div>

		<div id="calendarTrash" class="calendar-trash"><i class="material-icons" style="font-size: 50px">&#xE872;</i></div>

		<div id="divReservation"></div>     
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
							<input type="hidden" name="type" value="<?= $_POST['type'] ?>">
							<button id="supprimerReserverFromCalendar" type="submit" class="btn btn-danger" name="supprimerReserverFromCalendar">Supprimer</button>
						</form>
					</div>
				</div>
			</div>
		</div>    
    </section>
    <script type="text/javascript">
    	function afficherReserver(date){
    		var type = '<?= $_POST['type'] ?>';
    		type = type.replaceAll(' ', '%20');
    		$('#divReservation').load("includes/divReservation.php?type=" + type + "&date=" + date);

		}
		function cacherReserver(){
			$('#divReservation').modal("hide");
		}










		function afficherSupprimer(idReserver){
			$('#divSuppression').modal("show");
			$('#idReserver').text(idReserver);
			$('#supprimerReserverFromCalendar').val(idReserver);
		}
		function cacherSupprimer(){
			$('#divSuppression').modal("hide");
		}
    </script>



   


	<script>
		var events = [
		<?php
	    	$resultReserver = $connect->prepare("SELECT * FROM `reserver` WHERE `IdUtilisateur` = " . $_SESSION['id']);
			$resultReserver->execute();
			while($rowReserver = $resultReserver->fetch())
			{
				$resultSalle = $connect->prepare("SELECT * FROM `salle` WHERE `IdSalle`=" . $rowReserver['IdSalle']);
				$resultSalle->execute();
				while($rowSalle = $resultSalle->fetch())
				{
					echo  "	{
								title: '" . $rowSalle['Nom'] . "', 
								start: '" . $rowReserver['Date'] . "',
								id: '" . $rowReserver['IdReserver'] . "',
								allDay: true,
								display: 'list-item',
								overlap: false,
								disableDragging: true,
						";
					if ($rowReserver['PlageHoraire'] == 'Après-midi') 
					{
						echo "
								color: '#ff5555',
						";
					}

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
					
					if (strtotime($rowReserver['Date']) <= strtotime($year . "-" . $month . "-" . $day)) 
					{
						echo "
								editable: false,
						";
					}
					echo "
							}, 
						";
				}
			}





		//les salles pour lesquelles les réservations sont completes
			$resultDate = $connect->prepare("SELECT * FROM `reserver` WHERE `IdSalle` IN (SELECT `IdSalle` FROM `salle` WHERE `Type`=\"" . $_POST['type'] . "\") GROUP BY `Date`");
			$resultDate->execute();
			while($rowDate = $resultDate->fetch())
			{
				$nbSalle = 0;
				$resultReserver = $connect->prepare("SELECT * FROM `salle` WHERE `Type`=\"" . $_POST['type'] . "\"");
				$resultReserver->execute();
				while($rowReserver = $resultReserver->fetch())
				{
					$nbSalle +=1;
				}

				$nbSalleReserveeMatin = 0;
				$resultReserver = $connect->prepare("SELECT * FROM `reserver` WHERE `Date`='" . $rowDate['Date'] . "' AND `PlageHoraire`='Matin' AND `IdSalle` IN (SELECT `IdSalle` FROM `salle` WHERE `Type`=\"" . $_POST['type'] . "\")");
				$resultReserver->execute();
				while($rowReserver = $resultReserver->fetch())
				{
					$nbSalleReserveeMatin +=1;
				}

				$nbSalleReserveeAprem = 0;
				$resultReserver = $connect->prepare("SELECT * FROM `reserver` WHERE `Date`='" . $rowDate['Date'] . "' AND `PlageHoraire`='Après-midi' AND `IdSalle` IN (SELECT `IdSalle` FROM `salle` WHERE `Type`=\"" . $_POST['type'] . "\")");
				$resultReserver->execute();
				while($rowReserver = $resultReserver->fetch())
				{
					$nbSalleReserveeAprem +=1;
				}

				

				if ($nbSalle == $nbSalleReserveeMatin && $nbSalle == $nbSalleReserveeAprem) 
				{
					echo  "	{
								start: '" . $rowDate['Date'] . "',
								allDay: true,
								overlap: false,
								display: 'background',
								color: 'red',
							}, 
						";
				}
				else if($nbSalle == $nbSalleReserveeMatin)
				{
					echo  "	{
								start: '" . $rowDate['Date'] . "',
								allDay: true,
								overlap: false,
								display: 'background',
								color: '#ff9f89',
							}, 
						";
				}
				else if($nbSalle == $nbSalleReserveeAprem)
				{
					echo  "	{
								start: '" . $rowDate['Date'] . "',
								allDay: true,
								overlap: false,
								display: 'background',
								color: '#ff9f89',
							}, 
						";
				}
			}
	    ?>];

		document.addEventListener('DOMContentLoaded', function() {
		
			var calendarEl = document.getElementById('calendar');

			var calendar = new FullCalendar.Calendar(calendarEl, {
				
			  	locale: 'fr',
				headerToolbar: {
					right: 'prev,today,next',
					center: 'title',
					left: '',
				},
				titleFormat: {
					month: 'long',
					year: 'numeric',
				},
				navLinks: false, 
				businessHours: false, 
				editable: true,
				selectable: false,
				dropAccept: '',
				events: events,
				dateClick: function(e) {
			    	reserver(e.dateStr);
			  	},
			  	eventClick: function(e) {
			  		var id = e.event._def.publicId;
			  		if (id) 
			  		{
				  		reserver(e.el.parentNode.parentNode.parentNode.parentNode.dataset.date);
			  		}
			  	},
			  	eventAllow: function(dropInfo, draggedEvent) {
		    		return false;
				},
			  	eventDragStart:function(e) {

		  			//animation poubelle
			  		startTriggerTrash();
			  		//console.log(event.createdby)
			  		var date = e.jsEvent.path[4].dataset.date || e.jsEvent.path[5].dataset.date;
			  		//console.log(date)
			  		return false;

			  	},
			  	eventDragStop: function(e) {
			  		var date = e.el.parentNode.parentNode.parentNode.parentNode.dataset.date;
			  		var id = e.event._def.publicId;

				    var trashEl = jQuery('#calendarTrash');
				    var ofs = trashEl.offset();

				    var x1 = ofs.left;
				    var x2 = ofs.left + trashEl.outerWidth(true);
				    var y1 = ofs.top;
				    var y2 = ofs.top + trashEl.outerHeight(true);

				    if (e.jsEvent.pageX >= x1 && e.jsEvent.pageX<= x2 && e.jsEvent.pageY >= y1 && e.jsEvent.pageY <= y2) 
				    {
			        	console.log("suppression de " + id);
			        	afficherSupprimer(id);
				    }
			  		stopTriggerTrash();
				},
			});

			calendar.render();
		});


		function reserver(date) {
			var today = new Date();
			var year = today.getFullYear();
			var month = (today.getMonth() + 1);
			var day = today.getDate();

			if (day < 10)
			{
				day = '0' + day;
			}
			if (month < 10)
			{
				month = '0' + month;
			}
			today = year + '-' + month + '-' + day;

			if (Date.parse(today) <= Date.parse(date))
			{
				afficherReserver(date);
			}	
			
		}



		function startTriggerTrash() {
			$('#calendarTrash').toggleClass('shake');
		}
		function stopTriggerTrash() {
			$('#calendarTrash').toggleClass('shake');
		}


		document.addEventListener("DOMContentLoaded", function () {
			
			
			var titleType = document.createElement("h2");
 			titleType.append("<?= $_POST['type'] ?>")
 			titleType.setAttribute("class", "text-muted");
 			titleType.setAttribute("id", "titleType");

			$('.fc-toolbar-chunk')[0].appendChild(titleType);
			$('.fc-toolbar-chunk')[0].setAttribute('class', 'flexStart')
			$('.fc-toolbar-chunk')[1].setAttribute('class', 'flexEnd')

			//$('.fc-toolbar-chunk')[0].append($titleType)
		});
		</script>
	</body>
</html>

