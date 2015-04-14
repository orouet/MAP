<?PHP


// var_dump($utilisateur);

/* CONFIGURATION */
$debug = false;
$format = 'html';

$image = false;
$action = false;
$tirage = false;



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
	
		if ($tirage !== false) {
		
			if (!isset($commande[$image])) {
			
				$Panier->tirages[$image] = array();
			
			}
			
			$Panier->tirages[$image][$tirage] = 1;
		
		}
	
	break;
	
	case 'supprimer':
	
		if ($image !== false) {
		
			$Panier->photos[$image] = false;
			
			unset($commande[$image]);
		
		}
	
	break;
	
	case 'recalculer':
	
		if ($image !== false) {
		
			if (isset($commande[$image])) {
			
				foreach($quantite as $i => $nombre) {
				
					if ($nombre == '0') {
					
						unset($commande[$image][$i]);
					
					} else {
					
						$Panier->tirages[$image][$i] = $nombre;
					
					}
				
				}
			
			}
		
		}
	
	break;
	
	case 'reinitialiser':
	
		$Panier->tirages = array();
	
	break;

}


// Sélection de l'étape active
$active = 5;



/* SORTIE */
if ($format === 'html') {

	include('index.html.php');
	
	$APP_Titre = "Etape 5 : Paiement - Jérôme Berthélémy photographie";
	
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