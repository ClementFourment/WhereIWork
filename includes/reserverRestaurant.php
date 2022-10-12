<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Réserver restaurant</title>
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
	.fc-day-future, .fc-day-today {
		cursor: pointer;
	}
	.fc-day-future:hover, .fc-day-today:hover{
		background-color: rgba(28, 128, 255, 0.3);
		font-weight: bold;
	}
	.fc-day-past {
		background: repeating-linear-gradient(
		  45deg,
		  #FAA,
		  #FAA 10px,
		  #FCC 10px,
		  #FCC 20px
		);

	}
</style>
	<section id="interface">
        <h1 class="h1 text-muted">Réserver restaurant</h1>

		<br>
		<div id='calendar'></div>


		<div id="divReservation"></div> 
    </section>

	<form style="visibility: hidden;" method="POST">
		<button type="submit" id="reserverRestaurantDate" name="reserverRestaurantDate" value=""></button>
	</form>


	<script>
		var events = [];

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
			    	choisirJour(e.dateStr);
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
			});

			calendar.render();
		});


		function choisirJour(date) {
			var today = new Date();
			today = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
			today =  new Date(today).getTime();
			day = new Date(date).getTime();

			if(today <= day)
			{
				$('#reserverRestaurantDate').val(date);
				$('#reserverRestaurantDate').click();
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
 			titleType.append("type")
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

