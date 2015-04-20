<?PHP

// var_dump($utilisateur);

/* CONFIGURATION */
$debug = false;
$format = 'html';

$album = false;
$page_debut = 0;
$page_pas = 20;
$image = false;
$action = false;
$filtre = 'tout';
// $filtre = 'selection';



/* LECTURE DES ENTREES */
if (isset($_REQUEST['format']) && $_REQUEST['format'] !== '') {

	$format = $_REQUEST['format'];

}

if (isset($_REQUEST['album']) && $_REQUEST['album'] !== '') {

	$album = (integer) $_REQUEST['album'];

}

if (isset($_REQUEST['page_debut']) && $_REQUEST['page_debut'] !== '') {

	$page_debut = (integer) $_REQUEST['page_debut'];

}

if (isset($_REQUEST['action']) && $_REQUEST['action'] !== '') {

	$action = (string) $_REQUEST['action'];

}

if (isset($_REQUEST['image']) && $_REQUEST['image'] !== '') {

	$image = (integer) $_REQUEST['image'];

}

if (isset($_REQUEST['filtre']) && $_REQUEST['filtre'] !== '') {

	$filtre = (string) $_REQUEST['filtre'];

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
	
		$Panier->photoBasculer($image);
	
	break;
	
	case 'reinitialiser':
	
		$Panier->vider();
	
	break;

}

// SQL
$connexion = mysqli_connect(
	SQL_SERVEUR,
	SQL_IDENTIFIANT,
	SQL_MOTDEPASSE,
	SQL_BASE
);

// Sélection de l'album
$album = $utilisateur['albums_id'];
$mon_album = $GEP->albumLire($album);

// Liste des images
$images_liste = false;

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

$pagination = false;

if ($pagination === true) {

	$requete_total = "SELECT COUNT(t.id) AS TOTAL FROM (" . $requete . ") t;";
	// print($requete_total);
	
	$resultat = mysqli_query($connexion, $requete_total);
	
	if ($resultat !== false) {
	
		$ligne = mysqli_fetch_assoc($resultat);
		$total = $ligne['TOTAL'];
		
		$pages = ceil($total / $page_pas);
		
		$pages_precedente = $page_debut - $page_pas;
		
		if ($pages_precedente < 0) {
		
			$pages_precedente = 0;
		
		}
		
		$pages_suivante = $page_debut + $page_pas;
		
		if ($pages_suivante >= $total) {
		
			if ($total > $page_pas) {
			
				$pages_suivante = $total - $page_pas;
			
			} else {
			
				$pages_suivante = 0;
			
			}
		
		}
		
		$sql_limit = "LIMIT " . $page_debut . ", " . $page_pas;
		
		$requete_page = $requete . " " . $sql_limit . ";";
		// print($requete_page);
		
		$resultat = mysqli_query($connexion, $requete_page);
	
	}

} else {

	$resultat = mysqli_query($connexion, $requete);

}

if ($resultat === false) {

	die($requete);

}

while ($ligne = mysqli_fetch_assoc($resultat)) {

	$cible = CHEMIN_STOCKAGE . $ligne['lots_id'] . '/' . $ligne['empreinte'] . '.jpg';
	
	$dimensions = getimagesize($cible);
	$morceaux = explode('.', $ligne['nom']);
	
	$ligne['libelle'] = $morceaux[0];
	$ligne['largeur'] = $dimensions[0];
	$ligne['hauteur'] = $dimensions[1];
	$ligne['qualite'] = round((($dimensions[0] * $dimensions[1]) / 1000000), 1);
	
	if (isset($Panier->photos[$ligne['id']])) {
	
		$ligne['etat'] = $Panier->photos[$ligne['id']];
	
	} else {
	
		$ligne['etat'] = false;
		$Panier->photos[$ligne['id']] = false;
	
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

// Nettoyage
unset($documents);


/* SORTIE */
if ($format === 'html') {

	include('index.html.php');
	
	$APP_Titre = "Etape 1 : Sélection des photos - Jérôme Berthélémy photographie";
	
	include(CHEMIN_PRIVE . 'html.php');
	
	echo $sortie;

}


if ($format === 'csv') {

	include('index.csv.php');
	
	include(CHEMIN_PRIVE . 'csv.php');
	
	echo $sortie;

}


if ($format === 'json') {

	include('index.json.php');
	
	include(CHEMIN_PRIVE . 'json.php');
	
	echo $sortie;

}


?>