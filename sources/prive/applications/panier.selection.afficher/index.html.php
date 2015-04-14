<?PHP


$html_slogan = "La boutique en ligne.";
$html_titre = "Choix des tirages";


/* HTML */
$APP_Sortie = '';

include(CHEMIN_PRIVE . 'entete.html.php');

$APP_Sortie .= '<table id="Squelette" class="squelette">' . "\n";

$APP_Sortie .= '<tr>' . "\n";

$APP_Sortie .= '<td class="gauche">' . "\n";

$APP_Sortie .= '<div id="Page">' . "\n";

$APP_Sortie .= '<div class="fenetre">' . "\n";

$APP_Sortie .= '<h1>' . $html_titre . '</h1>' . "\n";

$APP_Sortie .= '<br />' . "\n";

$APP_Sortie .= '<table id="Selection">' . "\n";

$compteur = 0;

// $photos = $Panier->photos;
// ksort($photos);
// var_dump($photos);

$images = $Panier->documents;

$tirages = $Panier->produits['tirages'];
$delais = $Panier->produits['delais'];

foreach ($images as $image_id => $document) {

	if ($Panier->photoEtat($image_id) === true) {
	
		$APP_Sortie .= '<tr>' . "\n";
		
		$APP_Sortie .= '<td class="" style="width:30px;vertical-align:middle;">' . "\n";
		$APP_Sortie .= '<input class="css-checkbox" type="checkbox" name="grp_coche" value="' . $document['id'] . '" />' . "\n";
		$APP_Sortie .= '<label class="css-label"></label>' . "\n";
		$APP_Sortie .= '</td">' . "\n";
		
		$APP_Sortie .= '<td class="" style="width:200px;">' . "\n";
		
		$classe = '';
		
		$document_url = URL_INDEX . '?app=panier.images.afficher&amp;document=' . $document['id'];
		
		$APP_Sortie .= '<div id="Photo' . $document['id'] . '" class="photo ' . $classe . '">' . "\n";
		
		$APP_Sortie .= '<a class="lightbox fancybox.image" href="' . $document_url . '" rel="album" title="' . $document['libelle'] . '">';
		$APP_Sortie .= '<img src="' . $document_url . '&amp;largeur=240&amp;hauteur=160" alt="" />' . "\n";
		$APP_Sortie .= '</a>';
		
		$APP_Sortie .= '<div class="cartouche">' . "\n";
		
		$APP_Sortie .= '<div class="titre">';
		$APP_Sortie .= $document['libelle'];
		$APP_Sortie .= '</div>' . "\n";
		
		$APP_Sortie .= '<div class="action">' . "\n";
		
		$APP_Sortie .= '<a href="' . URL_APP . '&amp;action=supprimer&amp;image=' . $document['id'] . '">';
		$APP_Sortie .= '<img style="width:20px;height:20px;" src="' . URL_IMAGES . 'selection_supprimer_20x20.png" alt="Supprimer" />' . "\n";
		$APP_Sortie .= '</a>' . "\n";
		
		$APP_Sortie .= '</div>' . "\n";
		
		$APP_Sortie .= '</div>' . "\n";
		
		$APP_Sortie .= '</div>' . "\n";
		
		
		$APP_Sortie .= '</td>' . "\n";
		
		
		$APP_Sortie .= '<td>' . "\n";
		
		// Tirages disponibles
		$tirages_dispo = array();
		$tableau = array();
		
		if (isset($Panier->tirages[$document['id']])) {
		
			$tableau = $Panier->tirages[$document['id']];
		
		}
		
		foreach ($tirages as $ligne) {
		
			if (!isset($tableau[$ligne['id']])) {
			
				$tirages_dispo[$ligne['id']] = $ligne;
			
			}
		
		}
		
		$APP_Sortie .= '<div style="padding : 10px 0px 10px 10px;">' . "\n";
		
		if (count($tirages_dispo) > 0) {
		
			$APP_Sortie .= '<form action="' . URL_APP . '" method="post">' . "\n";
			
			$APP_Sortie .= '<div style="padding:0px 0px 10px 0px;">' . "\n";
			
			$APP_Sortie .= '<select name="tirage" style="width:500px;">' . "\n";
			
			foreach ($tirages_dispo as $ligne) {
			
				$APP_Sortie .= '<option value="' . $ligne['id'] . '">' . htmlentities($ligne['libelle']) . '</option>' . "\n";
			
			}
			
			$APP_Sortie .= '</select>' . "\n";
			
			$APP_Sortie .= '<input type="hidden" name="image" value="' . $document['id'] . '" />' . "\n";
			$APP_Sortie .= '<input type="hidden" name="action" value="ajouter" />' . "\n";
			$APP_Sortie .= '<input type="submit" value="+" />' . "\n";
			
			$APP_Sortie .= '</div>' . "\n";
			
			$APP_Sortie .= '</form>' . "\n";
		
		}
		
		if (isset($Panier->tirages[$document['id']])) {
		
			$tableau = $Panier->tirages[$document['id']];
			
			if (count($tableau) > 0) {
			
				$APP_Sortie .= '<form action="' . URL_APP . '" method="post">' . "\n";
				
				$APP_Sortie .= '<table class="commande">' . "\n";
				
				$APP_Sortie .= '<tr>' . "\n";
				
				$APP_Sortie .= '<th class="">' . "\n";
				$APP_Sortie .= "&nbsp;" . "\n";
				$APP_Sortie .= '</th>' . "\n";
				
				$APP_Sortie .= '<th class="">' . "\n";
				$APP_Sortie .= "Prix Unitaire" . "\n";
				$APP_Sortie .= '</th>' . "\n";
				
				$APP_Sortie .= '<th class="">' . "\n";
				$APP_Sortie .= "Quantité" . "\n";
				$APP_Sortie .= '</th>' . "\n";
				
				$APP_Sortie .= '<th class="">' . "\n";
				$APP_Sortie .= "Prix Total" . "\n";
				$APP_Sortie .= '</th>' . "\n";
				
				$APP_Sortie .= '<th class="">' . "\n";
				$APP_Sortie .= "Suppr." . "\n";
				$APP_Sortie .= '</th>' . "\n";
				
				$APP_Sortie .= '</tr>' . "\n";
				
				foreach ($tableau as $i => $quantite) {
				
					$l = $tirages[$i];
					
					$montant = $l['tarif'] * $quantite;
					
					$APP_Sortie .= '<tr class="">' . "\n";
					
					$APP_Sortie .= '<td class="libelle">' . "\n";
					
					$APP_Sortie .= '<div class="gamme">';
					// $APP_Sortie .= $l['gamme'] . " " . $l['format'] . "cm";
					$APP_Sortie .= $l['libelle'];
					$APP_Sortie .= '</div>' . "\n";
					
					$APP_Sortie .= '<div class="description">';
					$APP_Sortie .= $l['description'];
					$APP_Sortie .= '</div>' . "\n";
					
					// $APP_Sortie .= '<div class="fabrication">';
					// $APP_Sortie .= "Délai de réalisation : " . $delais[$l['delai']];
					// $APP_Sortie .= '</div>' . "\n";
					
					$APP_Sortie .= '</td>' . "\n";
					
					$APP_Sortie .= '<td class="tarif">' . "\n";
					$APP_Sortie .= number_format($l['tarif'], 2, ',', ' ') . " €" . "\n";
					$APP_Sortie .= '</td>' . "\n";
					
					$APP_Sortie .= '<td class="quantite">' . "\n";
					$APP_Sortie .= '<input type="text" name="tirages[' . $i . ']" value="' . $quantite . '" size="2" />' . "\n";
					$APP_Sortie .= '<a href="#" title="+">' . "+" . '</a>' . "\n";
					$APP_Sortie .= '<a href="#" title="-">' . "-" . '</a>' . "\n";
					$APP_Sortie .= '</td>' . "\n";
					
					$APP_Sortie .= '<td class="montant">' . "\n";
					$APP_Sortie .= number_format($montant, 2, ',', ' ') . " €" . "\n";
					$APP_Sortie .= '</td>' . "\n";
					
					$APP_Sortie .= '<td class="action">' . "\n";
					
					$url = URL_APP . "&amp;action=recalculer&amp;image=" . $document['id'] . "&amp;tirages[" . $i . "]=0";
					$APP_Sortie .= '<a href="' . $url . '">';
					$APP_Sortie .= '<img style="width:20px;height:20px;" src="' . URL_IMAGES . 'selection_supprimer_20x20.png" alt="X" />' . "\n";
					$APP_Sortie .= '</a>' . "\n";
					$APP_Sortie .= '</td>' . "\n";
					
					$APP_Sortie .= '</tr>' . "\n";
				
				}
				
				$APP_Sortie .= '</table>' . "\n";
				
				
				$APP_Sortie .= '<div style="padding:10px 0px 10px 0px;">' . "\n";
				$APP_Sortie .= '<input type="hidden" name="image" value="' . $document['id'] . '" />' . "\n";
				$APP_Sortie .= '<input type="hidden" name="action" value="recalculer" />' . "\n";
				$APP_Sortie .= '<input type="submit" value="' . "Recalculer" . '" />' . "\n";
				$APP_Sortie .= '</div>' . "\n";
				
				$APP_Sortie .= '</form>' . "\n";
			
			}
		
		}
		
		$APP_Sortie .= '</div>' . "\n";
		
		$APP_Sortie .= '</td>' . "\n";
		$APP_Sortie .= '</tr>' . "\n";
	
	}

}

$APP_Sortie .= '<tr>' . "\n";

$APP_Sortie .= '<td colspan="3">';
$APP_Sortie .= '<br />';
$APP_Sortie .= '<br />';
$APP_Sortie .= '</td>' . "\n";

$APP_Sortie .= '</tr>' . "\n";

$APP_Sortie .= '<tr>' . "\n";

$APP_Sortie .= '<td colspan="3">';
$APP_Sortie .= '<h2>' . "Ajouter des tirages à toutes les photos" . '</h2>';
$APP_Sortie .= '</td>' . "\n";

$APP_Sortie .= '</tr>' . "\n";

$APP_Sortie .= '<tr>' . "\n";

$APP_Sortie .= '<td colspan="3">';
$APP_Sortie .= '<br />';
$APP_Sortie .= '</td>' . "\n";

$APP_Sortie .= '</tr>' . "\n";

$APP_Sortie .= '<tr>' . "\n";

$APP_Sortie .= '<td>' . "\n";
$APP_Sortie .= "&nbsp;";
$APP_Sortie .= '</td>' . "\n";

$APP_Sortie .= '<td colspan="2">' . "\n";

// $APP_Sortie .= '<form action="' . URL_APP . '" method="post">' . "\n";

$APP_Sortie .= '<div style="padding:0px 0px 10px 0px;">' . "\n";

$APP_Sortie .= '<select name="grp_tirage" style="width:500px;">' . "\n";

foreach ($tirages as $ligne) {

	$APP_Sortie .= '<option value="' . $ligne['id'] . '">' . htmlentities($ligne['libelle']) . '</option>' . "\n";

}

$APP_Sortie .= '</select>' . "\n";

$APP_Sortie .= '<input type="hidden" name="action" value="ajouter" />' . "\n";
$APP_Sortie .= '<input type="submit" value="Ajouter" />' . "\n";

$APP_Sortie .= '</div>' . "\n";

// $APP_Sortie .= '</form>' . "\n";

$APP_Sortie .= '</td>' . "\n";

$APP_Sortie .= '</tr>' . "\n";


$APP_Sortie .= '</table>' . "\n";

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