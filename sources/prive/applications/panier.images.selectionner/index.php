<?PHP

// var_dump($utilisateur);

/* CONFIGURATION */
$debug = false;
$format = 'json';

$album = false;
$image = false;
$action = false;



/* LECTURE DES ENTREES */
if (isset($_REQUEST['image']) && $_REQUEST['image'] !== '') {

	$image = (integer) $_REQUEST['image'];

}



/* TRAITEMENT */


/* INCLUSIONS */
require_once (CHEMIN_BIBLIOTHEQUES . 'fonctions.chaines.inc.php');
require_once (CHEMIN_BIBLIOTHEQUES . 'fonctions.uuid.inc.php');
require_once (CHEMIN_BIBLIOTHEQUES . 'fonctions.inc.php');
require_once (CHEMIN_BIBLIOTHEQUES . 'fonctions.html.inc.php');

// Controleur de la GEP (Gestion Electronique de Photographies)
$GEP = new GEP_Controleur(
	SQL_SERVEUR,
	SQL_IDENTIFIANT,
	SQL_MOTDEPASSE,
	SQL_BASE
);

// Selection de l'action
switch ($action) {

	case 'ajouter':
	
		$Panier->photoAjouter($image);
	
	break;
	
	case 'supprimer':
	
		$Panier->photoSupprimer($image);
	
	break;
	
	case 'basculer':
	default :
	
		$Panier->photoBasculer($image);
	
	break;

}

// SQL
$connexion = mysqli_connect(SQL_SERVEUR, SQL_IDENTIFIANT, SQL_MOTDEPASSE, SQL_BASE);


// Sélection de l'album
$album = $utilisateur['albums_id'];
$mon_album = $GEP->albumLire($album);

// Liste des images
$images_liste = false;

// Lecture de la liste des images en cache
if ($map_cache !== false) {

	if (isset($map_cache['images_liste'])) {
	
		$temp = $map_cache['images_liste'];
		
		if (isset($temp['expiration'])) {
		
			if ($temp['expiration'] < time()) {
			
				$images_liste = $temp;
			
			}
		
		}
		
		unset($temp);
	
	}

}

// Initialisation de la liste des images
if ($images_liste === false) {

	$images_liste = array(
		'expiration' => time() + (60*60),
		'images' => array(),
	);

}

// Lecture des documents
$documents = array();

$requete = "
	SELECT
		p.id AS id,
		d.lots_id AS lots_id,
		d.nom AS nom,
		d.empreinte AS empreinte
	FROM
		`ged__documents` d,
		`gep__photos` p
	WHERE
		p.albums_id = " . $album . "
		AND d.id = p.documents_id
	ORDER BY
		nom ASC
";
// print($requete);

$resultat = mysqli_query($connexion, $requete);

while ($ligne = mysqli_fetch_assoc($resultat)) {

	$cible = CHEMIN_STOCKAGE . $ligne['lots_id'] . '/' . $ligne['empreinte'] . '.jpg';
	
	$dimensions = getimagesize($cible);
	$morceaux = explode('.', $ligne['nom']);
	
	$ligne['libelle'] = $morceaux[0];
	$ligne['largeur'] = $dimensions[0];
	$ligne['hauteur'] = $dimensions[1];
	$ligne['qualite'] = round((($dimensions[0] * $dimensions[1]) / 1000000), 1);
	
	$ligne['etat'] = false;
	
	if (isset($Panier->photos[$ligne['id']])) {
	
		$ligne['etat'] = $Panier->photos[$ligne['id']];
	
	}
	
	$documents[$ligne['id']] = $ligne;
	
	//
	// sauvegarde du document dans la liste
	$images_liste['images'][$ligne['id']] = $ligne;

}

$Panier->documents = $documents;

// sauvegarde de la liste dans le cache
$map_cache['images_liste'] = $images_liste;

// Sélection de l'étape active
$active = 1;

// var_dump($albums);
// var_dump($documents);

$reponse = array(
	'image' => $images_liste['images'][$image],
	'selections' => $Panier->photosCompter(),
);


/* SORTIE */
if ($format === 'json') {

	$APP_Sortie = json_encode($reponse);
	
	include(CHEMIN_PRIVE . 'json.php');
	
	echo $sortie;

}


?>