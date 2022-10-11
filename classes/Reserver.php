<?php  
class Reserver
{
	protected $IdReserver;
    protected $Salle;
    protected $IdUtilisateur;
	protected $PrixUnitaire;
	protected $Date;
	protected $PlageHoraire;

//constructeur
	public function __construct()
	{
		include('includes/database.php');
		$resultReserver = $connect->prepare("SELECT * FROM `reserver`");
		$resultReserver->execute();
		while($rowReserver = $resultReserver->fetch())
		{
			$this->setIdReserver($rowReserver['IdReserver']);
            $this->setIdSalle($rowReserver['IdSalle']);
            $this->setIdUtilisateur($rowReserver['IdUtilisateur']);
			$this->setPrixUnitaire($rowReserver['PrixUnitaire']);
			$this->setDate($rowReserver['Date']);
			$this->setPlageHoraire($rowReserver['PlageHoraire']);
		}
	}

//Accesseurs
	public function setIdReserver($IdReserver)
	{
		$this->IdReserver = $IdReserver;
	}
    public function setIdSalle($IdSalle)
	{
		$this->IdSalle = $IdSalle;
	}
    public function setIdUtilisateur($IdUtilisateur)
	{
		$this->IdUtilisateur = $IdUtilisateur;
	}
	public function setPrixUnitaire($PrixUnitaire)
	{
		$this->PrixUnitaire = $PrixUnitaire;
	}
	public function setDate($Date)
	{
		$this->Date = $Date;
	}
	public function setPlageHoraire($PlageHoraire)
	{
		$this->PlageHoraire = $PlageHoraire;
	}

	public function getIdReserver()
	{
		return $this->IdReserver;
	}
    public function getIdSalle()
	{
		return $this->IdSalle;
	}
    public function getIdUtilisateur()
	{
		return $this->IdUtilisateur;
	}
	public function getPrixUnitaire()
	{
		return $this->PrixUnitaire;
	}
	public function getDate()
	{
		return $this->Date;
	}
	public function getPlageHoraire()
	{
		return $this->PlageHoraire;
	}



//methodes
	public function ajouter()
	{
		include('includes/database.php');
		$resultSalle = $connect->prepare("SELECT * FROM `salle` WHERE `Type`='" . $_POST['type'] . "' ORDER BY `Nom` DESC");
		$resultSalle->execute();
		while ($rowSalle = $resultSalle->fetch())
		{
			$flagLibre = true;
			$resultReserver = $connect->prepare("SELECT * FROM `reserver` WHERE `IdSalle`='" . $rowSalle['IdSalle'] . "' AND `Date`='" . $_POST['dateReserver'] . "' AND `PlageHoraire` = '" . $_POST['plageHoraire'] . "'");
			$resultReserver->execute();
			while ($rowReserver = $resultReserver->fetch())
			{
				$flagLibre = false;
			}
			if ($flagLibre) 
			{
				$flag = false;
				$idSalle = $rowSalle['IdSalle'];
			}
		}
		if (isset($idSalle)) 
		{
			$resultSalle = $connect->prepare("SELECT * FROM `salle` WHERE `Type`='" . $_POST['type'] . "' GROUP BY `Type`");
			$resultSalle->execute();
			while ($rowSalle = $resultSalle->fetch())
			{
				$resultReserver = $connect->prepare("INSERT INTO `reserver` (`IdSalle`, `IdUtilisateur`, `Date`, `PlageHoraire`) VALUES(" . $idSalle . ", " . $_SESSION['id'] . ", \"" . $_POST['dateReserver'] . "\", \"" . $_POST['plageHoraire'] . "\")");
				$resultReserver->execute();
			}
		}
		include('includes/reserverDate.php');
	}
	public function supprimer()
	{
		include('includes/database.php');
		$resultReserver = $connect->prepare("DELETE FROM `reserver` WHERE `IdReserver` = " . $_POST['supprimerReserver']);
		$resultReserver->execute();
		include('includes/mesReservations.php');
	}
	public function supprimerFromCalendar()
	{
		include('includes/database.php');
		$resultReserver = $connect->prepare("DELETE FROM `reserver` WHERE `IdReserver` = " . $_POST['supprimerReserverFromCalendar']);
		$resultReserver->execute();
		include('includes/reserverDate.php');
	}
}
?>