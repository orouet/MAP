<?PHP



/* CONFIGURATION */
$debug = false;

$image_type = 'PNG';
$image_type = 'JPEG';

$document_id = false;
$largeur = false;
$hauteur = false;



/* LECTURE DES ENTREES */
if (isset($_REQUEST['document']) && $_REQUEST['document'] !== '') {

	$document_id = (integer) $_REQUEST['document'];

}

if (isset($_REQUEST['largeur']) && $_REQUEST['largeur'] !== '') {

	$largeur = (integer) $_REQUEST['largeur'];

}

if (isset($_REQUEST['hauteur']) && $_REQUEST['hauteur'] !== '') {

	$hauteur = (integer) $_REQUEST['hauteur'];

}

// Sélection du document
if ($document_id === false) {

	die("Document manquant");

}



/* TRAITEMENT */


/* INCLUSIONS */
require_once (CHEMIN_BIBLIOTHEQUES . 'fonctions.chaines.inc.php');
require_once (CHEMIN_BIBLIOTHEQUES . 'fonctions.uuid.inc.php');
require_once (CHEMIN_BIBLIOTHEQUES . 'fonctions.inc.php');

/* CACHE SQL */
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

$document = false;

if (isset($images_liste['images'][$document_id])) {

	$document = $images_liste['images'][$document_id];

}

if ($document === false) {

	// die();
	
	// SQL
	$connexion = mysqli_connect(SQL_SERVEUR, SQL_IDENTIFIANT, SQL_MOTDEPASSE, SQL_BASE);
	
	// Lecture des informations du document
	$requete = "
		SELECT
			*
		FROM
			`ged__documents`
		WHERE
			id = " . $document_id . "
		;
	";
	// print($requete);
	
	$resultat = mysqli_query($connexion, $requete);
	
	if ($resultat !== false) {
	
		$document = mysqli_fetch_assoc($resultat);
	
	} else {
	
		die("Document N°" . $document_id . " inconnu");
	
	}

}

// var_dump($document);

// sauvegarde du document dans la liste
$images_liste['images'][$document_id] = $document;

// sauvegarde de la liste dans le cache
$map_cache['images_liste'] = $images_liste;

$sortie = '';

$cible = CHEMIN_STOCKAGE . $document['lots_id'] . '/' . $document['empreinte'] . '.jpg';

// var_dump($cible);
// die();

switch ($image_type) {

	case 'JPEG':
	
		$content_type = 'image/jpeg';
		$extension = '.jpeg';
	
	break;
	
	case 'PNG':
	
		$content_type = 'image/png';
		$extension = '.png';
	
	break;

}

if (file_exists($cible)) {

	if (($largeur !== false) && ($hauteur !== false)) {
	
		$miniature = $largeur . 'x' . $hauteur . $extension;
		
		// On regarde dans le cache
		$cache_lot = CHEMIN_CACHE . $document['lots_id'] . '/';
		$cache_empreinte = $cache_lot . $document['empreinte'] . '/';
		$cache_document = $cache_empreinte . $miniature;
		// var_dump($cache_lot);
		// var_dump($cache_empreinte);
		// var_dump($cache_document);
		// die();
		
		if (file_exists($cache_document)) {
		
			$cible = $cache_document;
			// die();
		
		} else {
		
			$lot_dir = file_exists($cache_lot);
			$empreinte_dir = file_exists($cache_empreinte);
			
			if ($lot_dir === false) {
			
				$lot_dir = mkdir($cache_lot);
			
			}
			
			if ($empreinte_dir === false) {
			
				$empreinte_dir = mkdir($cache_empreinte);
			
			}
			
			if ($lot_dir && $empreinte_dir) {
			
				$m = imagesMiniatureGenerer($cible, $cache_document, $largeur, $hauteur);
				
				if ($m === true) {
				
					$cible = $cache_document;
				
				} else {
				
					die("Impossible de créer le document " . $cache_document);
				
				}
			
			} else {
			
				die("Impossible de créer les dossiers");
			
			}
		
		}
	
	}
	
	$etag = md5($cible);
	
	// Cache HTTP
	$http_cache = false;
	
	if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])) {
	
		header('HTTP/1.1 304 Not Modified');
		header('Content-Length: 0');
		$http_cache = true;
	
	}
	
	if (!empty($_SERVER['HTTP_IF_NONE_MATCH']) && $_SERVER['HTTP_IF_NONE_MATCH'] == $etag) {
	
		header('HTTP/1.1 304 Not Modified');
		header('Content-Length: 0');
		$http_cache = true;
	
	}
	
	if ($http_cache === false) {
	
		$taille = filesize($cible);
		
		$date = filemtime($cible);
		$duree = (60*60*24*7);
		$expiration = time() + $duree;
		
		if ($taille !== false) {
		
			// On vide le tampon de sortie
			ob_end_clean();
			
			// entête
			// header("Content-Disposition: Attachment;filename=" . $document_id . '.png'); 
			header('ETag: "' . $etag . '"');
			header('Content-Type: ' . $content_type);
			header('Content-Length: ' . $taille);
			header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $date) . ' GMT');
			header('Cache-control: max-age=' . $duree);
			header('Expires:' . gmdate('D, d M Y H:i:s', $expiration) .' GMT');
			
			readfile($cible);
			
			die();
		
		} else {
		
			var_dump($cible);
			
			die();
		
		}
	
	}

} else {

	die("Erreur de stockage");

}


?>