<?PHP


$bdc = $Panier->commande['lignes'];

$html_slogan = "La boutique en ligne.";
$html_titre = "Validation de la commande";


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

$compteur = 0;

$APP_Sortie .= '<div class="bloc details">' . "\n";

$APP_Sortie .= '<h2>' . "Détails des tirages choisis" . '</h2>';

if (count($bdc) > 0) {

	$APP_Sortie .= '<form action="' . URL_APP . '" method="post">' . "\n";
	
	$APP_Sortie .= '<table class="commande">' . "\n";
	
	$APP_Sortie .= '<tr>' . "\n";
	
	$APP_Sortie .= '<th class="">';
	$APP_Sortie .= "Photo";
	$APP_Sortie .= '</th>' . "\n";
	
	$APP_Sortie .= '<th class="">';
	// $APP_Sortie .= "Tirage" . "\n";
	$APP_Sortie .= "&nbsp;";
	$APP_Sortie .= '</th>' . "\n";
	
	$APP_Sortie .= '<th class="">';
	$APP_Sortie .= "Délai de réalisation";
	$APP_Sortie .= '</th>' . "\n";
	
	$APP_Sortie .= '<th class="">';
	$APP_Sortie .= "Prix Unitaire";
	$APP_Sortie .= '</th>' . "\n";
	
	$APP_Sortie .= '<th class="">';
	$APP_Sortie .= "Quantité";
	$APP_Sortie .= '</th>' . "\n";
	
	$APP_Sortie .= '<th class="">';
	$APP_Sortie .= "Prix Total";
	$APP_Sortie .= '</th>' . "\n";
	
	$APP_Sortie .= '</tr>' . "\n";
	
	$total = 0;
	
	foreach ($bdc as $ligne) {
	
		$total += $ligne['montant'];
		
		$APP_Sortie .= '<tr class="">' . "\n";
		
		$APP_Sortie .= '<td class="action">';
		$APP_Sortie .= $ligne['document_libelle'];
		$APP_Sortie .= '</td>' . "\n";
		
		$APP_Sortie .= '<td class="libelle">' . "\n";
		
		$APP_Sortie .= '<div class="gamme">';
		$APP_Sortie .= $ligne['libelle'];
		$APP_Sortie .= '</div>' . "\n";
		
		$APP_Sortie .= '<div class="description">';
		$APP_Sortie .= $ligne['description'];
		$APP_Sortie .= '</div>' . "\n";
		
		$APP_Sortie .= '</td>' . "\n";
		
		$APP_Sortie .= '<td class="delai">';
		$APP_Sortie .= $ligne['delai'];
		$APP_Sortie .= '</td>' . "\n";
		
		$APP_Sortie .= '<td class="tarif">';
		$APP_Sortie .= number_format($ligne['tarif'], 2, ',', ' ') . " €";
		$APP_Sortie .= '</td>' . "\n";
		
		$APP_Sortie .= '<td class="quantite">';
		$APP_Sortie .= $ligne['quantite'];
		$APP_Sortie .= '</td>' . "\n";
		
		$APP_Sortie .= '<td class="montant">';
		$APP_Sortie .= number_format($ligne['montant'], 2, ',', ' ') . " €";
		$APP_Sortie .= '</td>' . "\n";
		
		$APP_Sortie .= '</tr>' . "\n";
	
	}
	
	$APP_Sortie .= '<tr>';
	$APP_Sortie .= '<td colspan="6">';
	$APP_Sortie .= '<hr style="border-width:2px 0px 0px 0px;border-style:solid;border-color:#ffffff;" />';
	$APP_Sortie .= '</td>';
	$APP_Sortie .= '</tr>';
	
	$APP_Sortie .= '<tr class="font-weight:bold;">' . "\n";
	
	$APP_Sortie .= '<td colspan="5">' . "\n";
	$APP_Sortie .= "&nbsp;";
	$APP_Sortie .= '</td>' . "\n";
	
	$APP_Sortie .= '<td class="montant">';
	$APP_Sortie .= number_format($total, 2, ',', ' ') . " €";
	$APP_Sortie .= '</td>' . "\n";
	
	$APP_Sortie .= '</tr>' . "\n";
	
	$APP_Sortie .= '</table>' . "\n";
	
	$APP_Sortie .= '</form>' . "\n";

}

$APP_Sortie .= '</div>' . "\n";

$APP_Sortie .= '<br />' . "\n";

$APP_Sortie .= '<div class="bloc resume">' . "\n";

$APP_Sortie .= '<h2>' . "Résumé de la commande" . '</h2>';

$APP_Sortie .= '<div class="texte">';
$APP_Sortie .= "Nombre de photos utilisées : " . $Panier->photosCompter();
$APP_Sortie .= '</div>';

$APP_Sortie .= '<div class="texte">';
$APP_Sortie .= "Nombre de tirages : " . $Panier->tiragesCompter();
$APP_Sortie .= '</div>';

$APP_Sortie .= '<div class="texte">';
$APP_Sortie .= "Délai de réalisation : " . $Panier->commande['delai']['libelle'];
$APP_Sortie .= '</div>';

$APP_Sortie .= '<div class="texte">';
$APP_Sortie .= "Montant total hors frais de port : " . number_format($Panier->commande['totaux']['horsport'], 2, ',', ' ');
$APP_Sortie .= '</div>';

$APP_Sortie .= '</div>';

$avertissements = 0;
$avertissements_html = '';

// Photos exploitées
$selectionnees = $Panier->photosCompter();
$utilisees = $Panier->tiragesPhotosCompter();

// var_dump($utilisees);
// var_dump($selectionnees);

if ($utilisees < $selectionnees) {

	$texte = "qu'une photo";
	
	if ($utilisees > 1) {
	
		$texte = "que " . $utilisees . " photos";
	
	}
	
	$avertissements_html .= '<div class="texte">';
	$avertissements_html .= "Vous n'avez utilisé " . $texte . " sur les " . $selectionnees . " photos sélectionnées.";
	$avertissements_html .= '</div>';
	
	$avertissements ++;

}

if ($avertissements > 0) {

	$APP_Sortie .= '<br />' . "\n";
	
	$APP_Sortie .= '<div class="bloc avertissements">' . "\n";
	
	$APP_Sortie .= '<h2>' . "Avertissements" . '</h2>';
	
	$APP_Sortie .= $avertissements_html;
	
	$APP_Sortie .= '</div>';

}

$APP_Sortie .= '<br />' . "\n";
$APP_Sortie .= '<br />' . "\n";

$APP_Sortie .= '<div class="bloc conditions">' . "\n";

$APP_Sortie .= '<h2>' . "Confirmation des conditions" . '</h2>';

$APP_Sortie .= '<form action="' . URL_APP . '" method="post">' . "\n";

$coche = '';

if ($Panier->commande['conditions']['delai'] == 'oui') {

	$coche = 'checked="checked"';

}

$APP_Sortie .= '<div class="texte">';
$APP_Sortie .= '<input ' . $coche . ' type="checkbox" name="case_delai" value="oui" />';
$APP_Sortie .= '<span style="padding:0px 0px 0px 10px;">' . "J'ai pris connaissance des délais de réalisation." . '</span>';
$APP_Sortie .= '</div>';

$coche = '';

if ($Panier->commande['conditions']['retractation'] == 'oui') {

	$coche = 'checked="checked"';

}

$APP_Sortie .= '<div class="texte">';
$APP_Sortie .= '<input ' . $coche . ' type="checkbox" name="case_retractation" value="oui" />';
$APP_Sortie .= '<span style="padding:0px 0px 0px 10px;">' . "J'ai pris connaissance qu'aucun droit de rétractation ne s'applique (Article L.121-20-2 du code de la consommation)." . '</span>';
$APP_Sortie .= '</div>';

$coche = '';

if ($Panier->commande['conditions']['cgv'] == 'oui') {

	$coche = 'checked="checked"';

}

$APP_Sortie .= '<div class="texte">';
$APP_Sortie .= '<input ' . $coche . ' type="checkbox" name="case_cgv" value="oui" />';
$APP_Sortie .= '<span style="padding:0px 0px 0px 10px;">' . "J'accepte les Conditions Générales de Vente." . '</span>';
$APP_Sortie .= '</div>';

$APP_Sortie .= '<br />' . "\n";

$APP_Sortie .= '<div class="texte">';
$APP_Sortie .= '<input type="hidden" name="action" value="actualiser" />' . "\n";
$APP_Sortie .= '<input type="submit" value="Valider" />' . "\n";
$APP_Sortie .= '</div>';

$APP_Sortie .= '</form>';

$APP_Sortie .= '<br />' . "\n";

$APP_Sortie .= '</div>';

$APP_Sortie .= '<br />' . "\n";

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