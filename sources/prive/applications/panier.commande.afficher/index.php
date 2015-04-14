<?PHP


// var_dump($utilisateur);

/* CONFIGURATION */
$debug = false;
$format = 'html';

$image = false;
$action = false;
$tirage = false;
$case_delai = false;
$case_retractation = false;
$case_cgv = false;



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

if (isset($_REQUEST['case_delai']) && $_REQUEST['case_delai'] !== '') {

	$case_delai = $_REQUEST['case_delai'];

}

if (isset($_REQUEST['case_retractation']) && $_REQUEST['case_retractation'] !== '') {

	$case_retractation = $_REQUEST['case_retractation'];

}

if (isset($_REQUEST['case_cgv']) && $_REQUEST['case_cgv'] !== '') {

	$case_cgv = $_REQUEST['case_cgv'];

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

	case 'actualiser':
	
		$Panier->commande['conditions']['delai'] = false;
		
		if ($case_delai == 'oui') {
		
			$Panier->commande['conditions']['delai'] = true;
		
		}
		
		$Panier->commande['conditions']['retractation'] = false;
		
		if ($case_retractation == 'oui') {
		
			$Panier->commande['conditions']['retractation'] = true;
		
		}
		
		$Panier->commande['conditions']['cgv'] = false;
		
		if ($case_cgv == 'oui') {
		
			$Panier->commande['conditions']['cgv'] = true;
		
		}
	
	break;

}

//
$Panier->commandeCalculer();

$Panier->verifier();

// Sélection de l'étape active
$active = 3;


/* SORTIE */
if ($format === 'html') {

	include('index.html.php');
	
	$APP_Titre = "Etape 3 : Validation de la commande - Jérôme Berthélémy photographie";
	
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