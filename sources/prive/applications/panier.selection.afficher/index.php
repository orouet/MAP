<?PHP


// var_dump($utilisateur);

/* CONFIGURATION */
$debug = false;
$format = 'html';

$image = false;
$action = false;
$tirage = false;
$tirages = false;


/* LECTURE DES ENTREES */
if (isset($_REQUEST['tirage']) && $_REQUEST['tirage'] !== '') {

	$tirage = $_REQUEST['tirage'];

}

if (isset($_REQUEST['action']) && $_REQUEST['action'] !== '') {

	$action = (string) $_REQUEST['action'];

}

if (isset($_REQUEST['image']) && $_REQUEST['image'] !== '') {

	$image = (integer) $_REQUEST['image'];

}

if (isset($_REQUEST['quantite']) && $_REQUEST['quantite'] !== '') {

	$quantite = $_REQUEST['quantite'];

}

if (isset($_REQUEST['tirages']) && $_REQUEST['tirages'] !== '') {

	$tirages = $_REQUEST['tirages'];

}

// var_dump($quantite);



/* TRAITEMENT */


/* INCLUSIONS */
require_once (CHEMIN_BIBLIOTHEQUES . 'fonctions.chaines.inc.php');
require_once (CHEMIN_BIBLIOTHEQUES . 'fonctions.uuid.inc.php');
require_once (CHEMIN_BIBLIOTHEQUES . 'fonctions.inc.php');
require_once (CHEMIN_BIBLIOTHEQUES . 'fonctions.html.inc.php');

// Selection de l'action
switch ($action) {

	case 'ajouter':
	
		$Panier->tirageAjouter($image, $tirage);
	
	break;
	
	case 'supprimer':
	
		$Panier->photoSupprimer($image);
	
	break;
	
	case 'recalculer':
	
		$Panier->tirageRecalculer($image, $tirages);
	
	break;
	
	case 'reinitialiser':
	
		$Panier->tiragesVider();
	
	break;

}

// var_dump($Panier->tirages);

$sql_in = '';


// var_dump($Panier->photos);

if ($Panier->photosCompter() > 0) {

	//
	$recap = $Panier->tiragesRecalculer($Panier->documents);
	
	//
	$Panier->verifier();
	
	// Sélection de l'étape active
	$active = 2;

} else {

	// Sauvegarde des informations dans la session
	$_SESSION['utilisateur'] = serialize($utilisateur);
	$_SESSION['panier'] = serialize($Panier);
	$_SESSION['CACHE'] = ($map_cache);
	session_write_close();
	
	header('Location: ' . URL_INDEX);
	
	die();

}

/* SORTIE */
if ($format === 'html') {

	include('index.html.php');
	
	$APP_Titre = "Etape 2 : Choix des tirages - Jérôme Berthélémy photographie";
	
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
	
	$sortie = '';
	
	// entête
	header('Pragma: public');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Cache-Control: private', false);
	header('Content-Encoding: UTF-8');
	
	header('Content-type: application/json; charset=UTF-8');
	header('Content-Disposition: attachment; filename=export.json');
	
	// on force l'encodage UTF-8 BOM
	// $sortie .= pack('CCC', 0xef, 0xbb, 0xbf);
	
	$sortie .= $APP_Sortie;
	
	echo $sortie;

}


?>