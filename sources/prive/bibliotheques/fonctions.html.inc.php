<?PHP


//
function htmlEnteteGenerer($etapes, $etape)
{

	$sortie = '';
	
	$sortie .= '<div id="Entete" class="entete">' . "\n";
	
	// $sortie .= '<div class="logo">' . "\n";
	// $sortie .= '<img style="width:300px;height:54px;" src="' . URL_IMAGES . 'logo_2014-300x54.png" alt="" />' . "\n";
	// $sortie .= '</div>' . "\n";
	
	// $sortie .= '<div class="slogan">' . "Mariage, portrait, studio, reportage et évènementiel." . '</div>' . "\n";
	
	$sortie .= '<div class="menu">' . "\n";
	
	$sortie .= htmlEtapesGenerer($etapes, $etape);
	
	$sortie .= '</div>' . "\n";
	
	$sortie .= '<br style="clear:both;" />' . "\n";
	
	$sortie .= '</div>' . "\n";
	
	return $sortie;

}


//
function htmlEtapesGenerer($etapes, $active)
{

	$sortie = '';
	
	// Etapes
	$sortie .= '<div id="Etapes" class="" style="">' . "\n";
	$sortie .= '<table class="" style="margin:0px;padding:0px;width:100%;">' . "\n";
	$sortie .= '<tr class="" style="">' . "\n";
	
	$etat = '';
	$url = '#';
	
	if (isset($etapes[1])) {
	
		if ($active == 1) {
		
			$etat .= ' active';
		
		} else {
		
			$etat .= ' disponible';
			$url =  URL_INDEX . '?app=panier.images.lister';
		
		}
	
	}
	
	$sortie .= '<td class="etape ' . $etat . '" style="width:25%">' . "\n";
	$sortie .= '<a class="icone_etape1" href="' . $url . '">' . "\n";
	$sortie .= '<span class="titre">' . ("Etape 1") . '</span>' . "\n";
	$sortie .= '<span class="description">' . ("Sélection des photos") . '</span>' . "\n";
	$sortie .= '</a>' . "\n";
	$sortie .= '</td>' . "\n";
	
	$etat = '';
	$url = '#';
	
	if (isset($etapes[2])) {
	
		if ($active == 2) {
		
			$etat .= ' active';
		
		} else {
		
			$etat .= ' disponible';
			$url =  URL_INDEX . '?app=panier.selection.afficher';
		
		}
	
	}
	
	$sortie .= '<td class="etape ' . $etat . '" style="width:25%">' . "\n";
	$sortie .= '<a class="icone_etape2" href="' . $url . '">' . "\n";
	$sortie .= '<span class="titre">' . ("Etape 2") . '</span>' . "\n";
	$sortie .= '<span class="description">' . ("Choix des tirages") . '</span>' . "\n";
	$sortie .= '</a>' . "\n";
	$sortie .= '</td>' . "\n";
	
	$etat = '';
	$url = '#';
	
	if (isset($etapes[3])) {
	
		if ($active == 3) {
		
			$etat .= ' active';
		
		} else {
		
			$etat .= ' disponible';
			$url =  URL_INDEX . '?app=panier.commande.afficher';
		
		}
	
	}
	
	$sortie .= '<td class="etape ' . $etat . '" style="width:25%">' . "\n";
	$sortie .= '<a class="icone_etape3" href="' . $url . '">' . "\n";
	$sortie .= '<span class="titre">' . ("Etape 3") . '</span>' . "\n";
	$sortie .= '<span class="description">' . ("Validation de la commande") . '</span>' . "\n";
	$sortie .= '</a>' . "\n";
	$sortie .= '</td>' . "\n";
	
	$etat = '';
	$url = '#';
	
	if (isset($etapes[4])) {
	
		if ($active == 4) {
		
			$etat .= ' active';
		
		} else {
		
			$etat .= ' disponible';
			$url =  URL_INDEX . '?app=panier.commande.payer';
		
		}
	
	}
	
	$sortie .= '<td class="etape ' . $etat . '" style="width:25%">' . "\n";
	$sortie .= '<a class="icone_etape4" href="' . $url . '">' . "\n";
	$sortie .= '<span class="titre">' . ("Etape 4") . '</span>' . "\n";
	$sortie .= '<span class="description">' . ("Paiement") . '</span>' . "\n";
	$sortie .= '</a>' . "\n";
	$sortie .= '</td>' . "\n";
	
	$sortie .= '</tr>' . "\n";
	$sortie .= '</table>' . "\n";
	$sortie .= '</div>' . "\n";
	
	return $sortie;

}


?>