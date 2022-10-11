<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta http-equiv="Content-type" content="text/html" charset="utf-8">
		<link type="text/css" href="css/styles.css" rel="stylesheet">
	</head>
	<body>
		<nav id="nav" class="nav" role="navigation">
			<div class="menu-nav">
				<form method="POST">
					<button id="accueil" class="nav-btn" name="accueil" type="submit">Accueil</button>
					<button id="reserver" class="nav-btn" name="reserver" type="submit">Réserver</button>
					<button id="mesReservations" class="nav-btn" name="mesReservations" type="submit">Mes réservations</button>
				</form>
			</div>
			
			
			<div class="autre">
				<form method="POST">
					<button class="nav-btn" name="deconnexion" type="submit" value="Se déconnecter">Se déconnecter</button>
				</form>
			</div>

			<div class="hamburger">
				<div class="hamburger1"></div>
				<div class="hamburger2"></div>
				<div class="hamburger3"></div>
			</div>


			<div id="volet-menu" class="volet-menu">
				<div class="volet-menu-menu">
					<form method="POST">
						<button id="accueil" name="accueil" type="submit">Tableau de bord</button>
						<button id="reserver" name="reserver" type="submit">Réserver</button>
						<button id="mesReservations" name="mesReservations" type="submit">Mes réservations</button>
					</form>
				</div>
				<div class="deconnexion">
					<form method="POST">
						<button name="deconnexion" type="submit" value="Se déconnecter">Se déconnecter</button>
					</form>
				</div>
			</div>
		</nav>
		<script type="text/javascript">
		//souligne les boutons de navigation en suivant la souris.
			var mousePosition;
			var middleElementPosition;
			$(".nav-btn").hover(function(e){
				mousePosition = e.clientX;
				middleElementPosition = this.getBoundingClientRect().left + (this.getBoundingClientRect().right - this.getBoundingClientRect().left) / 2;
				if (mousePosition >= middleElementPosition) 
				{
					$(this).addClass("right");
				}
				else
				{
					$(this).removeClass("right");
				}
			});

		//souligne la page actuelle
			if("<?= $_SESSION['page'] ?>" == "accueil")
			{
				$('#accueil').removeClass("nav-btn");
				$('#accueil').addClass("nav-selected");
			}
			else if("<?= $_SESSION['page'] ?>" == "reserver")
			{
				$('#reserver').removeClass("nav-btn");
				$('#reserver').addClass("nav-selected");
			}
			else if("<?= $_SESSION['page'] ?>" == "mesReservations")
			{
				$('#mesReservations').removeClass("nav-btn");
				$('#mesReservations').addClass("nav-selected");
			}

		//ferme le volet-menu avec echap
			$(document).on("keydown", function(e){
				if(e.originalEvent.keyCode == 27)
				{
					if ($('#volet-menu').attr('class') == "volet-menu ouvert") 
					{
						ouvrirFermerMenuVolet();
					}
				}
			});
		//ferme le volet-menu en cliquant n'importe où ailleurs de celui-ci
			$('body').click(function(e){
				if (e.target.className == 'hamburger' || e.target.className == 'hamburger ouvert' || e.target.className == 'hamburger1' || e.target.className == 'hamburger2' || e.target.className == 'hamburger3')
				{
					ouvrirFermerMenuVolet();
				}
				else if (e.target.className != "volet-menu ouvert" && e.target.nodeName != "BUTTON")
				{
					if ($('#volet-menu').attr('class') == "volet-menu ouvert") 
					{
						ouvrirFermerMenuVolet();
					}
				}
			});
		//fonction qui ferme ou ouvre le volet-menu
			function ouvrirFermerMenuVolet(){
				$('#volet-menu').toggleClass("ouvert");
				$('.menu-nav').toggleClass("hidden");
				$('.hamburger').toggleClass("ouvert");
			}
		</script>
	</body>
</html>