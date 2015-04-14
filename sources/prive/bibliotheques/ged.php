<?PHP


//
class GED_Controleur
{

	//
	public $connexion;
	
	
	//
	public function __construct ($serveur, $identifiant, $motdepasse, $base)
	{
	
		$this->connexion = false;
		
		// SQL
		$connexion = mysqli_connect(
			$serveur,
			$identifiant,
			$motdepasse,
			$base
		);
		
		if ($connexion !== false) {
		
			$this->connexion = $connexion;
		
		} else {
		
			die("Problème de connexion au serveur SQL");
		
		}
	
	}
	
	
	//
	public function documentChercher($empreinte)
	{
	
		// intialisation des variables
		$sortie = false;
		
		// traitement
		$requete = "SELECT * FROM `ged__documents` WHERE empreinte = '" . ($empreinte) . "';";
		
		$resultat = mysqli_query($this->connexion, $requete);
		
		if ($resultat !== false) {
		
			$nombre = mysqli_num_rows($resultat);
			
			if ($nombre === 1) {
			
				$sortie = mysqli_fetch_assoc($resultat);
			
			}
		
		} else {
		
			die($requete);
		
		}
		
		// sortie
		return $sortie;
	
	}
	
	
	//
	public function documentCreer($insert_id, $document)
	{
	
		// intialisation des variables
		$sortie = false;
		$chemin = CHEMIN_STOCKAGE . $insert_id . '/';
		$nom = $document['nom'];
		$source = $document['chemin'];
		$empreinte = $document['informations']['empreinte'];
		$cible = $chemin . $empreinte . '.jpg';
		
		// traitement
		$requete = "
			INSERT INTO `ged__documents` (
				`id`,
				`ts`,
				`lots_id`,
				`nom`,
				`empreinte`
			) VALUE (
				null,
				null,
				'" . ($insert_id) . "',
				'" . addslashes($nom) . "',
				'" . ($empreinte) . "'
			);
		";
		
		$resultat = mysqli_query($this->connexion, $requete);
		
		if ($resultat !== false) {
		
			$insert_id = mysqli_insert_id($this->connexion);
			$document_ged = $this->documentLire($insert_id);
			
			// Copie du document
			$copie = copy($source, $cible);
			
			if ($copie === true) {
			
				$sortie = $document_ged;
			
			}
		
		} else {
		
			die($document['nom'] . " : insert KO");
		
		}
		
		// sortie
		return $sortie;
	
	}
	
	
	//
	public function documentLire($id)
	{
	
		// intialisation des variables
		$sortie = false;
		
		// traitement
		$requete = "SELECT * FROM `ged__documents` WHERE id = " . ($id) . ";";
		
		$resultat = mysqli_query($this->connexion, $requete);
		
		if ($resultat !== false) {
		
			$sortie = mysqli_fetch_assoc($resultat);
		
		} else {
		
			die($requete);
		
		}
		
		// sortie
		return $sortie;
	
	}
	
	
	//
	public function empreintesVerifier($empreintes)
	{
	
		// intialisation des variables
		$sortie = false;
		$sql_in = "";
		$correspondances = array();
		
		// traitement
		$sql_in = "'";
		$sql_in .= implode("','", $empreintes);
		$sql_in .= "'";
		
		
		$requete = "
			SELECT
				*
			FROM
				`ged__documents`
			WHERE
				empreinte IN (" . $sql_in . ")
			;
		";
		// print($requete);
		
		$resultat = mysqli_query($this->connexion, $requete);
		
		if ($resultat !== false) {
		
			while ($ligne = mysqli_fetch_assoc($resultat)) {
			
				$cle = $ligne['empreinte'];
				$correspondances[$cle] = $ligne;
			
			}
		
		}
		
		// var_dump($correspondances);
		
		$sortie = $correspondances;
		
		// sortie
		return $sortie;
	
	}
	
	
	//
	public function lotCreer($nom)
	{
	
		// intialisation des variables
		$sortie = false;
		
		// traitement
		// On tente d'insérer un nouveau lot
		$requete = "
			INSERT INTO `ged__lots` (
				`id`,
				`ts`,
				`nom`
			) VALUE (
				null,
				null,
				'" . addslashes($nom) . "'
			);
		";
		
		$resultat = mysqli_query($this->connexion, $requete);
		
		if ($resultat !== false) {
		
			$insert_id = mysqli_insert_id($this->connexion);
			$lot_ged = $this->lotLire($insert_id);
			
			// Création du dossier de stockage
			$chemin = CHEMIN_STOCKAGE . $insert_id . '/';
			$creation = mkdir($chemin, 0777, false);
			
			if ($creation === true) {
			
				$sortie = $lot_ged;
			
			} else {
			
				die("Impossible de créer le dossier " . $chemin);
			
			}
		
		} else {
		
			die($requete);
		
		}
		
		// sortie
		return $sortie;
	
	}
	
	
	//
	public function lotChercher($nom)
	{
	
		// intialisation des variables
		$sortie = false;
		
		// traitement
		$requete = "SELECT * FROM `ged__lots` WHERE nom = '" . addslashes($nom) . "';";
		
		$resultat = mysqli_query($this->connexion, $requete);
		
		if ($resultat !== false) {
		
			$nombre = mysqli_num_rows($resultat);
			
			if ($nombre === 1) {
			
				$sortie = mysqli_fetch_assoc($resultat);
			
			}
		
		} else {
		
			die($requete);
		
		}
		
		// sortie
		return $sortie;
	
	}
	
	
	//
	public function lotLire($id)
	{
	
		// intialisation des variables
		$sortie = false;
		
		// traitement
		$requete = "SELECT * FROM `ged__lots` WHERE id = " . ($id) . ";";
		
		$resultat = mysqli_query($this->connexion, $requete);
		
		if ($resultat !== false) {
		
			$sortie = mysqli_fetch_assoc($resultat);
		
		} else {
		
			die($requete);
		
		}
		
		// sortie
		return $sortie;
	
	}
	
	
	//
	public function lotsLister()
	{
	
		// intialisation des variables
		$sortie = false;
		
		// traitement
		$requete = "
			SELECT
				l.*,
				(SELECT count(d.id) as documents FROM`ged__documents` d WHERE d.lots_id = l.id) AS documents
			FROM
				`ged__lots` l
			;
		";
		
		$resultat = mysqli_query($this->connexion, $requete);
		
		if ($resultat !== false) {
		
			$sortie = array();
			
			while($ligne = mysqli_fetch_assoc($resultat)) {
			
				$sortie[] = $ligne;
			
			}
		
		} else {
		
			die($requete);
		
		}
		
		// sortie
		return $sortie;
	
	}


}


?>