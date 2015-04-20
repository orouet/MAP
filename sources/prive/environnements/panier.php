<?PHP


// Application par défaut
define('ENVIRONNEMENT_APP', 'panier.images.lister');


/* PANIER */
// Chargement des bibliothèques
require_once(CHEMIN_BIBLIOTHEQUES . 'panier.php');

// on regarde si l'utilisateur est authentifié
if (isset($_SESSION['utilisateur'])) {

	$utilisateur = unserialize($_SESSION['utilisateur']);

} else {

	header('Location: ' . URL_LOGIN);
	die();

}

// Initialisation du panier
if (isset($_SESSION['panier'])) {

	$Panier = unserialize($_SESSION['panier']);

} else {

	//
	include(CHEMIN_DONNEES . 'tirages.inc.php');
	$Panier = new MAP_Panier($produits);

}

// Vérification de l'état du panier
$Panier->verifier();

// cache
$map_cache = false;

if (isset($_SESSION['CACHE'])) {

	$temp = $_SESSION['CACHE'];
	
	if (is_array($temp)) {
	
		$map_cache = $temp;
	
	}
	
	unset($temp);

}


?>