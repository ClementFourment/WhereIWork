<?php  
class Utilisateur
{
	protected $IdUtilisateur;
    protected $Nom;
    protected $Prenom;
	protected $Login;
	protected $MotDePasse;
    protected $Type;

//constructeur
	public function __construct()
	{
		include('includes/database.php');
		$resultUtilisateur = $connect->prepare("SELECT * FROM `utilisateur`");
		$resultUtilisateur->execute();
		while($rowUtilisateur = $resultUtilisateur->fetch())
		{
			if (isset($_SESSION['id']) && $rowUtilisateur['IdUtilisateur'] === $_SESSION['id'])
			{
				$this->setIdUtilisateur($rowUtilisateur['IdUtilisateur']);
                $this->setNom($rowUtilisateur['Nom']);
                $this->setPrenom($rowUtilisateur['Prenom']);
				$this->setLogin($rowUtilisateur['Login']);
				$this->setMotDePasse($rowUtilisateur['MotDePasse']);
                $this->setType($rowUtilisateur['Type']);
			}
		}
	}

//Accesseurs
	public function setIdUtilisateur($IdUtilisateur)
	{
		$this->IdUtilisateur = $IdUtilisateur;
	}
    public function setNom($Nom)
	{
		$this->Nom = $Nom;
	}
    public function setPrenom($Prenom)
	{
		$this->Prenom = $Prenom;
	}
	public function setLogin($Login)
	{
		$this->Login = $Login;
	}
	public function setMotDePasse($MotDePasse)
	{
		$this->MotDePasse = $MotDePasse;
	}
    public function setType($Type)
	{
		$this->Type = $Type;
	}

	public function getIdUtilisateur()
	{
		return $this->IdUtilisateur;
	}
    public function getNom()
	{
		return $this->Nom;
	}
    public function getPrenom()
	{
		return $this->Prenom;
	}
	public function getLogin()
	{
		return $this->Login;
	}
	public function getMotDePasse()
	{
		return $this->MotDePasse;
	}
    public function getType()
	{
		return $this->Type;
	}

//methodes
	public function deconnexion()
	{
		$_SESSION['id']="";
		$_SESSION['Login']="";
		$_SESSION['logged']=false;
		$url = strtok("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", '?');
		header("Location: " . $url);
	}
	public function connexion()
	{
		$_SESSION['Login'] = $_POST['Login'];
		include('includes/database.php');
		$resultUtilisateur = $connect->prepare("SELECT * FROM `utilisateur`");
		$resultUtilisateur->execute();
		$flagConnect = false;
		$flagLogin = false;
		while($rowUtilisateur = $resultUtilisateur->fetch())
		{
			if ($rowUtilisateur['Login'] === $_POST['Login'] && $_POST['MotDePasse'] == $rowUtilisateur['MotDePasse']) // si les identifiants sont bons
			{
				$flagConnect = true;
				$_SESSION['logged']=true;
				$_SESSION['id'] = $rowUtilisateur['IdUtilisateur'];
				$this->setType($rowUtilisateur['Type']);
				$this->entrer();
			}
			if ($rowUtilisateur['Login'] === $_POST['Login'])
			{
				$flagLogin = true;
			}
		}
		if(!$flagLogin)// mot de passe ou login incorrect
		{
			include('includes/authentification.php');
			echo "<font color='#CC3333'>Login incorrect !</font>";
		}
		else
		{
			if (!$flagConnect) 
			{
				include('includes/authentification.php');
				echo "<font color='#CC3333'>Mot de passe incorrect !</font>";
			}
		}
	}
	public function entrer()
	{
		if ($this->getType() === "Employé") 
		{
			include('includes/interfaceEmploye.php');
		}
		else if ($this->getType() === "Administrateur") 
		{
			include('includes/interfaceAdministrateur.php');
		}
		else if (isset($_SESSION['logged']) && $_SESSION['logged'])
		{
			include('includes/authentification.php');
			echo "Il y a un problème avec votre compte...";
		}
		else
		{
			include('includes/authentification.php');
		}
	}
}
?>