<?PHP

$developper = false;

$colonnes = 4;

/* HTML */
$APP_Sortie = '';

$APP_Sortie .= '<h1>PANIER</h1>' . "\n";

$APP_Sortie .= '<h2>Lister des images</h2>' . "\n";

$APP_Sortie .= '<div class="">' . "\n";

$APP_Sortie .= '<table class="" style="width:100%;">' . "\n";

$APP_Sortie .= '<tr style="vertical-align:top;">' . "\n";

$APP_Sortie .= '<td style="width:100%;">' . "\n";
$APP_Sortie .= '<ul>' . "\n";

$compteur = 0;

foreach($documents as $document) {

	if (is_array($document)) {
	
		$APP_Sortie .= '<a href="#" style="text-decoration:none;float:left;width:20%;">';
		
		
		$APP_Sortie .= '<div class="" style="">' . "\n";
		
		$APP_Sortie .= $document['empreinte'];
		
		// $APP_Sortie .= '<img class="icone" src="' . URL_IMAGES . $icone . '" alt="" />';
		// $APP_Sortie .= '&nbsp;&nbsp;';
		
		$APP_Sortie .= '</div>' . "\n";
		
		
		$APP_Sortie .= '<div class="" style="text-align:center;">' . "\n";
		
		$APP_Sortie .= $document['nom'];
		
		$APP_Sortie .= '</div>' . "\n";
		
		
		$APP_Sortie .= '</a>' . "\n";
		
		$compteur ++;
		
		if ($compteur == $colonnes) {
		
			$compteur = 0;
			
			$APP_Sortie .= '<br style="clear:both;" />' . "\n";
		
		}
	
	}

}

$APP_Sortie .= '</ul>' . "\n";
$APP_Sortie .= '</td>' . "\n";

$APP_Sortie .= '</tr>' . "\n";

$APP_Sortie .= '</table>' . "\n";

$APP_Sortie .= '</div>' . "\n";


?>