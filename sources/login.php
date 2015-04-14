<?PHP


// choix du fuseau horaire
date_default_timezone_set('Europe/Paris');


// détection du nom et du port
$serveur_base = 'localhost';
$serveur_port = '80';

$temp = explode(":", $_SERVER['HTTP_HOST'], 2);
$serveur_base = $temp[0];

if (isset($temp[1])) {

	$serveur_port = $temp[1];

}

unset($temp);


// chargement du fichier de configuration
$configuration = './prive/hotes/' . $serveur_base . '_' . $serveur_port . '.php';
include($configuration);



/* CONSTANTES */
define('DEBUG', false);

define('CHEMIN_PRIVE', CHEMIN_RACINE . 'prive/');
define('CHEMIN_BIBLIOTHEQUES', CHEMIN_PRIVE . 'bibliotheques/');
define('CHEMIN_DONNEES', CHEMIN_PRIVE . 'donnees/');
define('CHEMIN_APPLICATIONS', CHEMIN_PRIVE . 'applications/');

define('URL_INDEX', URL_RACINE . 'index.php');
define('URL_LOGIN', URL_RACINE . 'login.php');
define('URL_PUBLIC', URL_RACINE . 'public/');
define('URL_IMAGES', URL_PUBLIC . 'images/');
define('URL_STYLES', URL_PUBLIC . 'styles/');
define('URL_SCRIPTS', URL_PUBLIC . 'scripts/');

define('EURO', chr(128));


/**
 * Débogage
 * @param mixed $variable
 * @param string $message
 * @return boolean
 */
function debug($variable, $message = '')
{

	// Initialisation des variables
	$sortie = false;
	
	// Traitement
	if (DEBUG === true) {
	
		if ($message !== '') {
		
			echo $message . print_r($variable, true);
		
		} else {
		
			echo print_r($variable, true);
		
		}
		
		$sortie = true;
	
	}
	
	// Sortie
	return $sortie;

}



/* FONCTIONS ET BIBLIOTHEQUES */




/* VARIABLES PAR DEFAUT */
$authentification = FALSE;



/* SESSION */
// Début de la session
@session_start();

// RAZ de la session
$_SESSION = array();



/* AUTHENTIFICATION DU CLIENT */
if (isset($_REQUEST['identifiant']) && isset($_REQUEST['motdepasse'])) {

	$identifiant = (string) $_REQUEST['identifiant'];
	$motdepasse = (string) $_REQUEST['motdepasse'];
	
	// SQL
	$connexion = mysqli_connect(SQL_SERVEUR, SQL_IDENTIFIANT, SQL_MOTDEPASSE, SQL_BASE);
	
	// Vérification de l'utilisateur
	$requete = "
		SELECT
			*
		FROM
			`gep__comptes`
		WHERE
			identifiant = '" . addslashes($identifiant) . "'
			AND motdepasse = '" . addslashes($motdepasse) . "'
		;
	";
	// print($requete);
	
	$resultat = mysqli_query($connexion, $requete);
	
	$correspondances = mysqli_num_rows($resultat);
	print($correspondances);
	
	if ($correspondances === 1) {
	
		$utilisateur = mysqli_fetch_assoc($resultat);
		$authentification = true;
	
	}

} else {

	header('Content-Type: application/xhtml+xml; charset=UTF-8');
	
	/* SORTIE */
	$sortie = '';
	
	$sortie .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">' . "\n";
	$sortie .= '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" dir="ltr">' . "\n";
	
	$sortie .= '<head>' . "\n";
	
	$sortie .= '<meta http-equiv="content-type" content="text/html; charset=utf-8" />' . "\n";
	$sortie .= '<meta http-equiv="content-language" content="fr" />' . "\n";
	$sortie .= '<meta name="generator" content="LaMAP" />' . "\n";
	$sortie .= '<meta name="robots" content="index,follow" />' . "\n";
	$sortie .= '<meta name="revisit-after" content="2 days" />' . "\n";
	$sortie .= '<meta name="publisher" content="LaMAP" />' . "\n";
	$sortie .= '<meta name="copyright" content="LaMAP" />' . "\n";
	$sortie .= '<meta name="identifier-url" content="' . '" />' . "\n";
	$sortie .= '<meta name="Description" content="LaMAP" />' . "\n";
	
	$sortie .= '<link type="text/css" rel="stylesheet" href="' . URL_STYLES . 'general.css' . '" media="projection, screen, tv" />' . "\n";
	$sortie .= '<link type="text/css" rel="stylesheet" href="' . URL_STYLES . 'login.css' . '" media="projection, screen, tv" />' . "\n";
	$sortie .= '<link type="text/css" rel="stylesheet" href="' . URL_STYLES . 'album.css' . '" media="projection, screen, tv" />' . "\n";
	$sortie .= '<link type="text/css" rel="stylesheet" href="' . URL_STYLES . 'surcharges.css' . '" media="projection, screen, tv" />' . "\n";
	
	$sortie .= '<title>Authentification</title>' . "\n";
	
	$sortie .= '</head>' . "\n";
	
	$sortie .= '<body>' . "\n";
	
	$sortie .= '<div id="Page">' . "\n";
	
	$sortie .= '<div id="Identification">' . "\n";
	
	$sortie .= '<div class="fenetre">' . "\n";
	
	$sortie .= '<div class="titre" style="padding:10px 0px;">' . "Authentification" . '</div>' . "\n";
	
	$sortie .= '<form action="' . URL_LOGIN . '" method="post">' . "\n";
	$sortie .= '<table class="identification">' . "\n";
	
	$sortie .= '<tr>' . "\n";
	$sortie .= '<td class="champs">Identifiant : </td>' . "\n";
	$sortie .= '<td class="reponse"><input type="text" name="identifiant" size="30" /></td>' . "\n";
	$sortie .= '</tr>' . "\n";
	
	$sortie .= '<tr>' . "\n";
	$sortie .= '<td class="champs">Mot de passe : </td>' . "\n";
	$sortie .= '<td class="reponse"><input type="password" name="motdepasse" size="30" /></td>' . "\n";
	$sortie .= '</tr>' . "\n";
	
	$sortie .= '<tr>' . "\n";
	$sortie .= '<td colspan="2" class="valide" style="padding:10px 0px;">' . "\n";
	$sortie .= '<input type="hidden" name="etape" value="2" />' . "\n";
	$sortie .= '<input class="bouton" type="submit" value="Valider" />' . "\n";
	$sortie .= '</td>' . "\n";
	$sortie .= '</tr>' . "\n";
	
	$sortie .= '</table>' . "\n";
	$sortie .= '</form>' . "\n";
	
	$sortie .= '</div>' . "\n";
	
	$sortie .= '</div>' . "\n";
	
	$sortie .= '</div>' . "\n";
	
	$sortie .= '</body>' . "\n";
	
	$sortie .= '</html>' . "\n";
	
	
	echo $sortie;
	
	session_write_close();
	
	die();

}


// Redirection
if ($authentification === true) {

	$_SESSION['utilisateur'] = serialize($utilisateur);
	
	session_write_close();
	
	header('Location: ' . URL_INDEX);
	
	die();

} else {

	session_write_close();
	
	header('Location: ' . URL_LOGIN);
	
	die();

}


?>