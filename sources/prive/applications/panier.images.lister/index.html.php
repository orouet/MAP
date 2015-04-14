<?PHP


$colonnes = 4;

$html_slogan = "La boutique en ligne.";
$html_titre = "Sélection des photos";

$ajax_url = URL_INDEX . '?app=panier.images.selectionner';


/* HTML */
$APP_Sortie = '';

include(CHEMIN_PRIVE . 'entete.html.php');

$APP_Sortie .= '<table id="Squelette" class="squelette">' . "\n";

$APP_Sortie .= '<tr>' . "\n";

$APP_Sortie .= '<td class="gauche">' . "\n";

$APP_Sortie .= '<div id="Page">' . "\n";

$APP_Sortie .= '<div class="fenetre">' . "\n";

$tout_classe = 'actif';
$tout_coche = 'checked="checked"';

$selection_classe = '';
$selection_coche = '';

if ($filtre != 'tout') {

	$tout_classe = '';
	$tout_coche = '';
	
	$selection_classe = 'actif';
	$selection_coche = 'checked="checked"';

}

$APP_Sortie .= '<div id="Filtre" style="float:right;vertical-align:middle;width:200px;">' . "\n";

$APP_Sortie .= '<a id="Tout" class="' . $tout_classe . '" href="' . URL_APP . '&amp;filtre=tout" onclick="javascript:MAP_albumTout();return false;">';
$APP_Sortie .= '<input id="ToutCoche" type="radio" ' . $tout_coche . ' />' . "\n";
$APP_Sortie .= '<span>' . "Afficher tout" . '</span>';
$APP_Sortie .= '</a>' . "\n";

$APP_Sortie .= '<br />' . "\n";

$APP_Sortie .= '<a id="Selection" class="' . $selection_classe . '" href="' . URL_APP . '&amp;filtre=selection" onclick="javascript:MAP_albumSelections();return false;">';
$APP_Sortie .= '<input id="SelectionCoche" type="radio" ' . $selection_coche . ' />' . "\n";
$APP_Sortie .= '<span>' . "Afficher la sélection" . '</span>';
$APP_Sortie .= '</a>' . "\n";

$APP_Sortie .= '</div>' . "\n";


$APP_Sortie .= '<h1>' . $html_titre . '</h1>' . "\n";

$APP_Sortie .= '<br />' . "\n";

$APP_Sortie .= '<h2>' . $mon_album['nom'] . " (" . count($Panier->documents) . " photos)" . '</h2>' . "\n";

$APP_Sortie .= '<div id="Album">' . "\n";

$compteur = 0;

foreach($Panier->documents as $document) {

	if (is_array($document)) {
	
		$classe = '';
		$coche = '';
		
		
		if ($document['etat'] === true) {
		
			$classe = "selectionnee";
			$coche = 'checked="checked"';
		
		}
		
		if ( (($filtre == 'selection') AND ($document['etat'] === true)) OR ($filtre == 'tout') ) {
		
			$document_url = URL_INDEX . '?app=panier.images.afficher&amp;document=' . $document['id'];
			
			$APP_Sortie .= '<div id="Photo' . $document['id'] . '" class="photo ' . $classe . '">' . "\n";
			
			$APP_Sortie .= '<a class="lightbox fancybox.image" href="' . $document_url . '" rel="album" title="' . $document['libelle'] . '">';
			$APP_Sortie .= '<img style="" src="' . $document_url . '&amp;largeur=180&amp;hauteur=120" alt="" />' . "\n";
			$APP_Sortie .= '</a>';
			
			$APP_Sortie .= '<div class="cartouche">' . "\n";
			
			$APP_Sortie .= '<div class="titre">';
			$APP_Sortie .= $document['libelle'];
			$APP_Sortie .= '</div>' . "\n";
			
			$APP_Sortie .= '<div class="action">' . "\n";
			
			$url = URL_APP . '&amp;page_debut=' . $page_debut . '&amp;image=' . $document['id'] . '&amp;filtre=' . $filtre . '&amp;action=basculer';
			$ajax_data = '{image:' . $document['id'] . '}';
			$javascript = "MAP_imageBasculer('" . $ajax_url . "', " . $ajax_data . ");";
			
			$APP_Sortie .= '<a href="' . $url . '" onclick="javascript:' . $javascript . 'return false;">';
			$APP_Sortie .= '<input id="Photo' . $document['id'] . '_coche" class="css-checkbox" type="checkbox" ' . $coche . ' />' . "\n";
			$APP_Sortie .= '<label class="css-label"></label>' . "\n";
			$APP_Sortie .= '</a>' . "\n";
			
			$APP_Sortie .= '</div>' . "\n";
			
			$APP_Sortie .= '</div>' . "\n";
			
			$APP_Sortie .= '</div>' . "\n";
			
			$compteur ++;
		
		}
		
		// if ($compteur == $colonnes) {
		
			// $compteur = 0;
			
			// $APP_Sortie .= '<br class="nettoyeur" />' . "\n";
		
		// }
	
	}

}

$APP_Sortie .= '<br class="nettoyeur" />' . "\n";

$APP_Sortie .= '</div>' . "\n";

if ($pagination === true) {

	$APP_Sortie .= '<div class="pagination">' . "\n";
	
	$APP_Sortie .= '<div class="compteur">' . "\n";
	$APP_Sortie .= "Page " . (ceil($page_debut / $page_pas) + 1) . " sur " . $pages . "\n";
	$APP_Sortie .= '</div>' . "\n";
	
	$APP_Sortie .= '<div class="boutons">' . "\n";
	$APP_Sortie .= '<a href="' . URL_INDEX . '?app=panier.images.lister&amp;page_debut=' . $pages_precedente . '" style="">';
	$APP_Sortie .= '<button style="width:200px;">' . "Page précédente" . '</button>' . "\n";
	$APP_Sortie .= '</a>' . "\n";
	$APP_Sortie .= '<a href="' . URL_INDEX . '?app=panier.images.lister&amp;page_debut=' . $pages_suivante . '" style="">';
	$APP_Sortie .= '<button style="width:200px;">' . "Page suivante" . '</button>' . "\n";
	$APP_Sortie .= '</a>' . "\n";
	$APP_Sortie .= '</div>' . "\n";
	
	$APP_Sortie .= '<br class="nettoyeur" />' . "\n";
	
	$APP_Sortie .= '</div>' . "\n";

}

$APP_Sortie .= '</div>' . "\n";

$APP_Sortie .= '</div>' . "\n";

$APP_Sortie .= '</td>' . "\n";

$APP_Sortie .= '<td class="droite">' . "\n";

$APP_Sortie .= '<div class="colonne">' . "\n";

include(CHEMIN_PRIVE . 'compte.html.php');

$APP_Sortie .= '</div>' . "\n";

$APP_Sortie .= '</td>' . "\n";


$APP_Sortie .= '</tr>' . "\n";

$APP_Sortie .= '</table>' . "\n";

// var_dump($Panier->photos);

?>