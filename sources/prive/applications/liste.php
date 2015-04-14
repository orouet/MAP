<?PHP


require_once (CHEMIN_BIBLIOTHEQUES . 'fonctions.inc.php');

$tableau = dossierLister(CHEMIN_APPLICATIONS);
// var_dump($tableau);

$sortie = '';

$sortie .= '<!doctype html>' . "\n";
$sortie .= '<html lang="fr">' . "\n";

$sortie .= '<head>' . "\n";
$sortie .= '<meta charset="utf-8" />' . "\n";
$sortie .= '<title>Projets</title>' . "\n";
$sortie .= '<link rel="icon" href="' . URL_IMAGES . 'favicon.ico" />' . "\n";
$sortie .= '<link href="' . URL_STYLES . 'general.css" rel="stylesheet" />' . "\n";
$sortie .= '</head>' . "\n";

$sortie .= '<body>' . "\n";

$sortie .= '<h1>Liste des applications</h1>' . "\n";

$sortie .= '<table class="">' . "\n";

foreach ($tableau as $cle => $application) {

	if (is_array($application)) {
	
		$sortie .= '<tr>' . "\n";
		$sortie .= '<td>' . "\n";
		$sortie .= '<a href="' . URL_INDEX . '?app=' . $cle . '">' . $cle . '</a>' . "\n";
		$sortie .= '</td>' . "\n";
		$sortie .= '</tr>' . "\n";
	
	}

}

$sortie .= '</table>' . "\n";

$sortie .= '<script src="' . URL_SCRIPTS . 'general.js"></script>' . "\n";

$sortie .= '</body>' . "\n";

$sortie .= '</html>' . "\n";

echo $sortie;


?>