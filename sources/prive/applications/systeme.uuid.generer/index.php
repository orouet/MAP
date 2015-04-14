<?PHP


/* CONFIGURATION */
$debug = false;
$format = 'html';



/* LECTURE DES ENTREES */
if (isset($_REQUEST['format']) && $_REQUEST['format'] !== '') {

	$format = $_REQUEST['format'];

}



/* TRAITEMENT */


/* INCLUSIONS */
require_once (CHEMIN_BIBLIOTHEQUES . 'fonctions.chaines.inc.php');
require_once (CHEMIN_BIBLIOTHEQUES . 'fonctions.uuid.inc.php');
require_once (CHEMIN_BIBLIOTHEQUES . 'fonctions.inc.php');



// Définition des valeurs par défaut
$etape = 1;
$donnees = array();

$nombre = 1;
$uuids = array();


// Lecture des données transmises
if (isset($_REQUEST['etape'])) {

	if ($_REQUEST['etape'] != '') {
	
		$etape = (integer) $_REQUEST['etape'];
	
	}

}

if (isset($_REQUEST['nombre'])) {

	if ($_REQUEST['nombre'] != '') {
	
		$nombre = (integer) $_REQUEST['nombre'];
	
	}

}


// Etape 1


// Etape 2
if ($etape == 2) {

	$etape = 1;
	
	if ($nombre > 0) {
	
		$etape = 2;
		
		for ($i = 0; $i < $nombre; $i ++) {
		
			$uuid = (string) uuid_v4_generer();
			$uuids[] = $uuid;
		
		}
	
	}

}

// Mise en forme du résultat
$donnees = array(
	'etape' => $etape,
	'nombre' => $nombre,
	'uuids' => $uuids,
);



/* SORTIE */
if ($format === 'html') {

	include('index.html.php');
	
	$sortie = '';
	
	//
	$sortie .= '<!doctype html>' . "\n";
	$sortie .= '<html lang="fr">' . "\n";
	
	$sortie .= '<head>' . "\n";
	$sortie .= '<meta charset="utf-8" />' . "\n";
	$sortie .= '<title>Générateur de UUID</title>' . "\n";
	$sortie .= '<link rel="icon" href="' . URL_IMAGES . 'favicon.ico" />' . "\n";
	$sortie .= '<link href="' . URL_STYLES . 'general.css" rel="stylesheet" />' . "\n";
	$sortie .= '</head>' . "\n";
	
	$sortie .= '<body>' . "\n";
	
	$sortie .= $APP_Sortie;
	
	$sortie .= '<script src="' . URL_SCRIPTS . 'general.js"></script>' . "\n";
	
	$sortie .= '</body>' . "\n";
	
	$sortie .= '</html>' . "\n";
	
	echo $sortie;

}


if ($format === 'csv') {

	include('index.csv.php');
	
	$sortie = '';
	
	// entête
	header('Pragma: public');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Cache-Control: private', false);
	header('Content-Encoding: UTF-8');
	
	header('Content-type: text/csv; charset=UTF-8');
	header('Content-Disposition: attachment; filename=export.csv');
	
	// on force l'encodage UTF-8 BOM
	// $sortie .= pack('CCC', 0xef, 0xbb, 0xbf);
	
	$sortie .= $APP_Sortie;
	
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