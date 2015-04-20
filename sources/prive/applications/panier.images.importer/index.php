<?PHP


/* CONFIGURATION */
$debug = false;
$format = 'html';

$filtre = false;



/* LECTURE DES ENTREES */
if (isset($_REQUEST['format']) && $_REQUEST['format'] !== '') {

	$format = $_REQUEST['format'];

}

if (isset($_REQUEST['filtre']) && $_REQUEST['filtre'] !== '') {

	$filtre = $_REQUEST['filtre'];

}



/* TRAITEMENT */


/* INCLUSIONS */
require_once (CHEMIN_BIBLIOTHEQUES . 'fonctions.chaines.inc.php');
require_once (CHEMIN_BIBLIOTHEQUES . 'fonctions.uuid.inc.php');
require_once (CHEMIN_BIBLIOTHEQUES . 'fonctions.inc.php');

// Controleur de la GED (Gestion Electronique de Documents)
$GED = new GED_Controleur(
	SQL_SERVEUR,
	SQL_IDENTIFIANT,
	SQL_MOTDEPASSE,
	SQL_BASE
);

// Controleur de la GEP (Gestion Electronique de Photographies)
$GEP = new GEP_Controleur(
	SQL_SERVEUR,
	SQL_IDENTIFIANT,
	SQL_MOTDEPASSE,
	SQL_BASE
);

// On parcourt le dossier contenant les lots
$dossiers = dossierLister2(CHEMIN_FTP);
// var_dump($lots);

//
$lots = array();

// On parcourt les dossiers (lots)
foreach($dossiers as $dossier) {

	if (is_array($dossier)) {
	
		$enfants = count($dossier['contenu']);
		
		// On regarde si le dossier contient des documents
		if ($enfants > 0) {
		
			// On établit la liste des empreintes des documents
			$empreintes = array();
			
			foreach($dossier['contenu'] as $photo) {
			
				$empreintes[] = $photo['informations']['empreinte'];
			
			}
			
			// On regarde si le dossier contient des documents à importer
			if (count($empreintes) > 0) {
			
				$lot_ged = false;
				$album_gep = false;
				
				// On cherche des empreintes correspondant dans la GED
				$correspondances = $GED->empreintesVerifier($empreintes);
				// var_dump($correspondances);
				
				// on lit les informations concernant l'album
				$album_gep = $GEP->albumChercher($dossier['nom']);
				// var_dump($album_gep);
				
				// on regarde si l'album existe déjà
				if ($album_gep === false) {
				
					// On crée un nouvel album
					$album_gep = $GEP->albumAjouter($dossier['nom']);
				
				}
				
				// On regarde si l'album est bien créée
				if ($album_gep !== false) {
				
					// On regarde si on a besoin de rajouter des documents à la GED
					if (count($empreintes) > count($correspondances)) {
					
						// On crée le lot
						$lot_ged = $GED->lotCreer($dossier['nom']);
					
					}
					
					// On parcourt le contenu du lot
					foreach($dossier['contenu'] as $document) {
					
						$document_ged = false;
						$empreinte = $document['informations']['empreinte'];
						
						// On regarde si le document existe déjà dans la base
						if (isset($correspondances[$empreinte])) {
						
							// Lecture du document dans la GED
							$document_ged = $GED->documentChercher($empreinte);
							// var_dump($document_ged);
						
						} else {
						
							if ($lot_ged !== false) {
							
								// Insertion du document dans la GED
								$document_ged = $GED->documentCreer($lot_ged['id'], $document);
							
							}
						
						}
						
						// On regarde si le document existe
						if ($document_ged !== false) {
						
							// Insertion de la photo dans la GEP
							$photo_gep = $GEP->photoAjouter($album_gep, $document_ged);
						
						}
					
					}
				
				}
			
			}
		
		}
	
	}

}

$lots = $GED->lotsLister();
// var_dump($comptes);

$albums = $GEP->albumsLister();
// var_dump($albums);

$comptes = $GEP->comptesLister();
// var_dump($comptes);



/* SORTIE */
if ($format === 'html') {

	include('index.html.php');
	
	$sortie = '';
	
	//
	$sortie .= '<!doctype html>' . "\n";
	$sortie .= '<html lang="fr">' . "\n";
	
	$sortie .= '<head>' . "\n";
	$sortie .= '<meta charset="utf-8" />' . "\n";
	$sortie .= '<title>Importer des images</title>' . "\n";
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