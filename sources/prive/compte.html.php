<?PHP


$selections = $Panier->photosCompter();

// Hack d'activation de toutes les étapes
// $Panier->etapes = array(
	// 1 => true,
	// 2 => true,
	// 3 => true,
	// 4 => true,
	// 5 => true,
// );

// Compte
$APP_Sortie .= '<div id="Compte">' . "\n";

// Panier
$APP_Sortie .= '<div class="fenetre">' . "\n";

// $APP_Sortie .= '<div class="bloc">';
// $APP_Sortie .= '<div class="titre">' . "Compte : " . $utilisateur['identifiant'] . '</div>' . "\n";
// $APP_Sortie .= '</div>' . "\n";

// $APP_Sortie .= '<br />' . "\n";
// $APP_Sortie .= '<br />' . "\n";

$APP_Sortie .= '<div class="bloc">';

$etat = ' active';
$url =  '#';

if ($Panier->etapes[1]) {

	if ($active == 1) {
	
		$etat .= ' active';
	
	} else {
	
		$etat .= ' disponible';
		$url =  URL_INDEX . '?app=panier.images.lister';
	
	}

}


$APP_Sortie .= '<div class="etape ' . $etat . '">' . "\n";
$APP_Sortie .= '<a class="icone_etape1" href="' . $url . '">' . "\n";
$APP_Sortie .= '<span class="titre">' . ("Etape 1") . '</span>' . "\n";
$APP_Sortie .= '<span class="description">' . ("Sélection des photos") . '</span>' . "\n";
$APP_Sortie .= '</a>' . "\n";
$APP_Sortie .= '</div>' . "\n";

if ($active == 1) {

	$APP_Sortie .= '<br />' . "\n";
	
	$APP_Sortie .= '<div class="texte">';
	$APP_Sortie .= "Choisissez les photos qui vous souhaitez tirer";
	$APP_Sortie .= '</div>' . "\n";
	
	$APP_Sortie .= '<br />' . "\n";
	
	// $APP_Sortie .= '<div class="titre">' . "Récapitulatif" . '</div>' . "\n";
	
	$APP_Sortie .= '<div id="Compteur" class="texte">' . "\n";
	
	if ($selections == 0) {
	
		$APP_Sortie .= 'Pas de photo sélectionnée';
	
	} else if ($selections == 1) {
	
		$APP_Sortie .= $selections . ' photo sélectionnée';
	
	} else {
	
		$APP_Sortie .= $selections . ' photos sélectionnées';
	
	}
	
	$APP_Sortie .= '</div>' . "\n";
	
	$APP_Sortie .= '<br />' . "\n";
	
	$APP_Sortie .= '<div class="" style="padding:5px 0px 0px 0px;font-weight:normal;text-align:center;">' . "\n";
	
	$url = URL_INDEX . '?app=panier.selection.afficher';
	$APP_Sortie .= '<a class="valider" href="' . $url . '" style="">';
	$APP_Sortie .= '<button style="width:120px;">' . "Valider" . '</button>' . "\n";
	$APP_Sortie .= '</a>' . "\n";
	
	$url = URL_INDEX . '?app=panier.images.lister&amp;action=reinitialiser';
	$APP_Sortie .= '<a class="supprimer" href="' . $url . '" style="">';
	$APP_Sortie .= '<button style="width:120px;">' . "Supprimer" . '</button>' . "\n";
	$APP_Sortie .= '</a>' . "\n";
	
	$APP_Sortie .= '</div>' . "\n";

}

$APP_Sortie .= '</div>' . "\n";

if ($active == 1) {

	$APP_Sortie .= '<br />' . "\n";

}

if ($active == 2) {

	$APP_Sortie .= '<br />' . "\n";

}

$APP_Sortie .= '<div class="bloc">' . "\n";

$etat = '';
$url = '#';

if ($Panier->etapes[2]) {

	if ($active == 2) {
	
		$etat .= ' active';
	
	} else {
	
		$etat .= ' disponible';
		$url =  URL_INDEX . '?app=panier.selection.afficher';
	
	}

}

$APP_Sortie .= '<div class="etape ' . $etat . '">' . "\n";
$APP_Sortie .= '<a class="icone_etape2" href="' . $url . '">' . "\n";
$APP_Sortie .= '<span class="titre">' . ("Etape 2") . '</span>' . "\n";
$APP_Sortie .= '<span class="description">' . ("Choix des tirages") . '</span>' . "\n";
$APP_Sortie .= '</a>' . "\n";
$APP_Sortie .= '</div>' . "\n";

if ($active == 2) {

	$APP_Sortie .= '<br />' . "\n";

	$APP_Sortie .= '<div class="texte">' . "\n";
	$APP_Sortie .= "Sur cet écran, choisissez le format de votre tirage, le nombre d'exemplaires ainsi que le support";
	$APP_Sortie .= '</div>' . "\n";

	$APP_Sortie .= '<br />' . "\n";

	// $APP_Sortie .= '<div class="titre">' . "Récapitulatif" . '</div>' . "\n";

	$APP_Sortie .= '<table class="" style="width:100%;">';

	foreach($recap['formats'] as $cle => $ligne) {

		if ($ligne['quantite'] > 0) {
		
			$APP_Sortie .= '<tr>' . "\n";
			
			if ($ligne['quantite'] > 1) {
			
				$APP_Sortie .= '<td>';
				$APP_Sortie .= $ligne['quantite'] . " tirages " . $cle;
				$APP_Sortie .= '</td>' . "\n";
				$APP_Sortie .= '<td style="width:80px;text-align:right;">';
				$APP_Sortie .= number_format($ligne['total'], 2, ',', ' ')  . " €";
				$APP_Sortie .= '</td>' . "\n";
			
			} else {
			
				$APP_Sortie .= '<td>';
				$APP_Sortie .= $ligne['quantite'] . " tirage " . $cle;
				$APP_Sortie .= '</td>' . "\n";
				$APP_Sortie .= '<td style="width:80px;text-align:right;">';
				$APP_Sortie .= number_format($ligne['total'], 2, ',', ' ')  . " €";
				$APP_Sortie .= '</td>' . "\n";
			
			}
			
			$APP_Sortie .= '</tr>' . "\n";
		
		}

	}

	$APP_Sortie .= '<tr>';
	$APP_Sortie .= '<td colspan="2">';
	$APP_Sortie .= '<hr style="border-width:2px 0px 0px 0px;border-style:solid;border-color:#ffffff;" />';
	$APP_Sortie .= '</td>';
	$APP_Sortie .= '</tr>';

	$APP_Sortie .= '<tr class="" style="font-weight:bold;">';

	if ($recap['tirages'] > 1) {

		$APP_Sortie .= '<td style="">';
		$APP_Sortie .= $recap['tirages'] . " tirages";
		$APP_Sortie .= '</td>' . "\n";
		$APP_Sortie .= '<td style="width:80px;text-align:right;">';
		$APP_Sortie .= number_format($recap['total'], 2, ',', ' ')  . " €";
		$APP_Sortie .= '</td>' . "\n";

	} else {

		$APP_Sortie .= '<td style="">';
		$APP_Sortie .= $recap['tirages'] . " tirage";
		$APP_Sortie .= '</td>' . "\n";
		$APP_Sortie .= '<td style="width:80px;text-align:right;">';
		$APP_Sortie .= number_format($recap['total'], 2, ',', ' ')  . " €";
		$APP_Sortie .= '</td>' . "\n";

	}

	$APP_Sortie .= '</tr>' . "\n";

	$APP_Sortie .= '</table>' . "\n";

	$APP_Sortie .= '<br />' . "\n";

	// $APP_Sortie .= '<div class="" style="padding:5px 0px 0px 0px;font-weight:normal;text-align:center;">' . "\n";
	// $APP_Sortie .= '<a href="' . URL_INDEX . '?app=panier.selection.afficher" style="">';
	// $APP_Sortie .= '<button style="width:150px;">' . "Recalculer" . '</button>' . "\n";
	// $APP_Sortie .= '</a>' . "\n";
	// $APP_Sortie .= '</div>' . "\n";

	$APP_Sortie .= '<div class="" style="padding:5px 0px 0px 0px;font-weight:normal;text-align:center;">' . "\n";
	
	$url = URL_INDEX . '?app=panier.commande.afficher';
	$APP_Sortie .= '<a class="valider" href="' . $url . '" style="">';
	$APP_Sortie .= '<button style="width:150px;">' . "Valider" . '</button>' . "\n";
	$APP_Sortie .= '</a>' . "\n";
	
	$url = URL_INDEX . '?app=panier.selection.afficher&amp;action=reinitialiser';
	$APP_Sortie .= '<a class="supprimer" href="' . $url . '" style="">';
	$APP_Sortie .= '<button style="width:150px;">' . "Supprimer" . '</button>' . "\n";
	$APP_Sortie .= '</a>' . "\n";
	
	$APP_Sortie .= '</div>' . "\n";

}

$APP_Sortie .= '</div>' . "\n";

if ($active == 2) {

	$APP_Sortie .= '<br />' . "\n";

}

if ($active == 3) {

	$APP_Sortie .= '<br />' . "\n";

}

$APP_Sortie .= '<div class="bloc">' . "\n";

$etat = '';
$url = '#';

if ($Panier->etapes[3]) {

	if ($active == 3) {
	
		$etat .= ' active';
	
	} else {
	
		$etat .= ' disponible';
		$url =  URL_INDEX . '?app=panier.commande.afficher';
	
	}

}

$APP_Sortie .= '<div class="etape ' . $etat . '">' . "\n";
$APP_Sortie .= '<a class="icone_etape3" href="' . $url . '">' . "\n";
$APP_Sortie .= '<span class="titre">' . ("Etape 3") . '</span>' . "\n";
$APP_Sortie .= '<span class="description">' . ("Validation de la commande") . '</span>' . "\n";
$APP_Sortie .= '</a>' . "\n";
$APP_Sortie .= '</div>' . "\n";

if ($active == 3) {

	$APP_Sortie .= '<br />' . "\n";

	$APP_Sortie .= '<div class="texte">' . "\n";
	$APP_Sortie .= "Sur cet écran, ";
	$APP_Sortie .= '</div>' . "\n";
	
	$APP_Sortie .= '<br />' . "\n";
	
	$APP_Sortie .= '<div class="" style="padding:5px 0px 0px 0px;font-weight:normal;text-align:center;">' . "\n";
	
	$url = URL_INDEX . '?app=panier.commande.afficher&amp;action=valider';
	$APP_Sortie .= '<a class="valider" href="' . $url . '" style="">';
	$APP_Sortie .= '<button style="width:150px;">' . "Valider" . '</button>' . "\n";
	$APP_Sortie .= '</a>' . "\n";
	
	$url = URL_INDEX . '?app=panier.commande.afficher&amp;action=reinitialiser';
	$APP_Sortie .= '<a class="supprimer" href="' . $url . '" style="">';
	$APP_Sortie .= '<button style="width:150px;">' . "Supprimer" . '</button>' . "\n";
	$APP_Sortie .= '</a>' . "\n";
	
	$APP_Sortie .= '</div>' . "\n";

}

$APP_Sortie .= '</div>' . "\n";

if ($active == 3) {

	$APP_Sortie .= '<br />' . "\n";

}

if ($active == 4) {

	$APP_Sortie .= '<br />' . "\n";

}

$APP_Sortie .= '<div class="bloc">' . "\n";

$etat = '';
$url = '#';

if ($Panier->etapes[4]) {

	if ($active == 4) {
	
		$etat .= ' active';
	
	} else {
	
		$etat .= ' disponible';
		$url =  URL_INDEX . '?app=panier.commande.coordonnees';
	
	}

}

$APP_Sortie .= '<div class="etape ' . $etat . '">' . "\n";
$APP_Sortie .= '<a class="icone_etape4" href="' . $url . '">' . "\n";
$APP_Sortie .= '<span class="titre">' . ("Etape 4") . '</span>' . "\n";
$APP_Sortie .= '<span class="description">' . ("Mes coordonnées") . '</span>' . "\n";
$APP_Sortie .= '</a>' . "\n";
$APP_Sortie .= '</div>' . "\n";

if ($active == 4) {

	$APP_Sortie .= '<br />' . "\n";

	$APP_Sortie .= '<div class="texte">' . "\n";
	$APP_Sortie .= "Sur cet écran, ";
	$APP_Sortie .= '</div>' . "\n";
	
	$APP_Sortie .= '<br />' . "\n";
	
	$APP_Sortie .= '<div class="" style="padding:5px 0px 0px 0px;font-weight:normal;text-align:center;">' . "\n";
	
	$url = URL_INDEX . '?app=panier.commande.coordonnees&amp;action=valider';
	$APP_Sortie .= '<a class="valider" href="' . $url . '" style="">';
	$APP_Sortie .= '<button style="width:150px;">' . "Valider" . '</button>' . "\n";
	$APP_Sortie .= '</a>' . "\n";
	
	$url = URL_INDEX . '?app=panier.commande.coordonnees&amp;action=reinitialiser';
	$APP_Sortie .= '<a class="supprimer" href="' . $url . '" style="">';
	$APP_Sortie .= '<button style="width:150px;">' . "Supprimer" . '</button>' . "\n";
	$APP_Sortie .= '</a>' . "\n";
	
	$APP_Sortie .= '</div>' . "\n";

}

$APP_Sortie .= '</div>' . "\n";

if ($active == 4) {

	$APP_Sortie .= '<br />' . "\n";

}

if ($active == 5) {

	$APP_Sortie .= '<br />' . "\n";

}

$APP_Sortie .= '<div class="bloc">' . "\n";

$etat = '';
$url = '#';

if ($Panier->etapes[5]) {

	if ($active == 5) {
	
		$etat .= ' active';
	
	} else {
	
		$etat .= ' disponible';
		$url =  URL_INDEX . '?app=panier.commande.payer';
	
	}

}

$APP_Sortie .= '<div class="etape ' . $etat . '">' . "\n";
$APP_Sortie .= '<a class="icone_etape5" href="' . $url . '">' . "\n";
$APP_Sortie .= '<span class="titre">' . ("Etape 5") . '</span>' . "\n";
$APP_Sortie .= '<span class="description">' . ("Paiement") . '</span>' . "\n";
$APP_Sortie .= '</a>' . "\n";
$APP_Sortie .= '</div>' . "\n";

if ($active == 5) {

	$APP_Sortie .= '<br />' . "\n";

	$APP_Sortie .= '<div class="texte">' . "\n";
	$APP_Sortie .= "Sur cet écran, ";
	$APP_Sortie .= '</div>' . "\n";
	
	$APP_Sortie .= '<br />' . "\n";

}

$APP_Sortie .= '</div>' . "\n";


$APP_Sortie .= '</div>' . "\n";
// Panier


$APP_Sortie .= '</div>' . "\n";
// Compte


?>