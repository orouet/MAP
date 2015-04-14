<?PHP

$developper = false;

/* HTML */
$APP_Sortie = '';

$APP_Sortie .= '<h1>' . "GED" . '</h1>' . "\n";


$APP_Sortie .= '<h2>' . "Importer des documents" . '</h2>' . "\n";


$APP_Sortie .= '<h3>' . "Dossiers présents dans le sas d'entrée" . '</h3>' . "\n";

$APP_Sortie .= '<div class="">' . "\n";

$APP_Sortie .= '<table class="" style="width:100%;">' . "\n";

$APP_Sortie .= '<tr style="vertical-align:top;">' . "\n";

$APP_Sortie .= '<th style="width:80px;text-align:center;">' . "\n";
$APP_Sortie .= '<span>' . "ID"  . '</span>' . "\n";
$APP_Sortie .= '</th>' . "\n";

$APP_Sortie .= '<th style="">' . "\n";
$APP_Sortie .= '<span>' . "Nom"  . '</span>' . "\n";
$APP_Sortie .= '</th>' . "\n";

$APP_Sortie .= '<th style="width:100px;">' . "\n";
$APP_Sortie .= '<span>' . "Documents"  . '</span>' . "\n";
$APP_Sortie .= '</th>' . "\n";

$APP_Sortie .= '</tr>' . "\n";

$compteur = 1;

foreach($dossiers as $dossier_cle => $dossier) {

	if (is_array($dossier)) {
	
		$style = '';
		$my_style = '';
		$enfants = count($dossier['contenu']);
		
		$action = '';
		
		if ($enfants > 0) {
		
			$uuid = 'UUID-' . uuid_v4_generer();
			$action = 'onclick="javascript:id_basculer(\'' . $uuid . '\');"';
		
		}
		
		$APP_Sortie .= '<tr style="vertical-align:top;">' . "\n";
		
		$APP_Sortie .= '<td style="text-align:center;">' . "\n";
		$APP_Sortie .= $compteur;
		$APP_Sortie .= '</td>' . "\n";
		
		$APP_Sortie .= '<td style="">' . "\n";
		$APP_Sortie .= '<a href="#" ' . $action . ' style="text-decoration:none;">';
		$APP_Sortie .= $dossier['nom'];
		$APP_Sortie .= '</a>' . "\n";
		$APP_Sortie .= '</td>' . "\n";
		
		$APP_Sortie .= '<td style="text-align:center;">' . "\n";
		$APP_Sortie .= $enfants;
		$APP_Sortie .= '</td>' . "\n";
		
		$APP_Sortie .= '</tr>' . "\n";
		
		$APP_Sortie .= '<tr style="vertical-align:top;">' . "\n";
		
		$APP_Sortie .= '<td colspan="3" style="">' . "\n";
		
		if ($enfants > 0) {
		
			$visibilite = 'display:none;';
			
			if ($developper === true) {
			
				$visibilite = 'display:block;';
			
			}
			
			$APP_Sortie .= '<ul id="' . $uuid . '" style="' . $visibilite . '">' . "\n";
			
			foreach($dossier['contenu'] as $photo) {
			
				$APP_Sortie .= '<li>' . "\n";
				
				$APP_Sortie .= '<div>' . "Nom : " . $photo['nom'] . '</div>' . "\n";
				$APP_Sortie .= '<div>' . "Chemin : " . $photo['chemin'] . '</div>' . "\n";
				$APP_Sortie .= '<div>' . "Empreinte SHA1 : " . $photo['informations']['empreinte'] . '</div>' . "\n";
				$APP_Sortie .= '<div>' . "Taille : " . $photo['informations']['taille'] . " octets" . '</div>' . "\n";
				$APP_Sortie .= '<div>' . "Type MIME : " . $photo['informations']['mime'] . '</div>' . "\n";
				// $APP_Sortie .= '<div>' . "Metas : " . print_r($photo['informations']['metas'], true) . '</div>' . "\n";
				
				$APP_Sortie .= '<br />' . "\n";
				
				$APP_Sortie .= '</li>' . "\n";
			
			}
			
			$APP_Sortie .= '</ul>' . "\n";
			
			
		
		}
		
		$APP_Sortie .= '</td>' . "\n";
		
		$APP_Sortie .= '</tr>' . "\n";
		
		$compteur++;
	
	}

}

$APP_Sortie .= '</table>' . "\n";

$APP_Sortie .= '</div>' . "\n";


$APP_Sortie .= '<br />' . "\n";


$APP_Sortie .= '<h3>' . "Lots disponibles" . '</h3>' . "\n";

$APP_Sortie .= '<div class="">' . "\n";

$APP_Sortie .= '<table class="" style="width:100%;">' . "\n";

$APP_Sortie .= '<tr style="vertical-align:top;">' . "\n";

$APP_Sortie .= '<th style="width:80px;">' . "\n";
$APP_Sortie .= '<span>' . "ID"  . '</span>' . "\n";
$APP_Sortie .= '</th>' . "\n";

$APP_Sortie .= '<th style="">' . "\n";
$APP_Sortie .= '<span>' . "Nom"  . '</span>' . "\n";
$APP_Sortie .= '</th>' . "\n";

$APP_Sortie .= '<th style="width:100px;">' . "\n";
$APP_Sortie .= '<span>' . "Documents"  . '</span>' . "\n";
$APP_Sortie .= '</th>' . "\n";

$APP_Sortie .= '</tr>' . "\n";

foreach($lots as $lot_id => $lot) {

	if (is_array($lot)) {
	
		$APP_Sortie .= '<tr style="vertical-align:top;">' . "\n";
		
		$APP_Sortie .= '<td style="text-align:center;">' . "\n";
		$APP_Sortie .= $lot['id'];
		$APP_Sortie .= '</td>' . "\n";
		
		$APP_Sortie .= '<td style="">' . "\n";
		$APP_Sortie .= $lot['nom'];
		$APP_Sortie .= '</td>' . "\n";
		
		$APP_Sortie .= '<td style="text-align:center;">' . "\n";
		$APP_Sortie .= $lot['documents'];
		$APP_Sortie .= '</td>' . "\n";
		
		$APP_Sortie .= '</tr>' . "\n";
	
	}

}

$APP_Sortie .= '</table>' . "\n";

$APP_Sortie .= '</div>' . "\n";


$APP_Sortie .= '<br />' . "\n";


$APP_Sortie .= '<h3>' . "Albums disponibles" . '</h3>' . "\n";

$APP_Sortie .= '<div class="">' . "\n";

$APP_Sortie .= '<table class="" style="width:100%;">' . "\n";

$APP_Sortie .= '<tr style="vertical-align:top;">' . "\n";

$APP_Sortie .= '<th style="width:80px;">' . "\n";
$APP_Sortie .= '<span>' . "ID"  . '</span>' . "\n";
$APP_Sortie .= '</th>' . "\n";

$APP_Sortie .= '<th style="">' . "\n";
$APP_Sortie .= '<span>' . "Nom"  . '</span>' . "\n";
$APP_Sortie .= '</th>' . "\n";

$APP_Sortie .= '<th style="width:100px;">' . "\n";
$APP_Sortie .= '<span>' . "Photos"  . '</span>' . "\n";
$APP_Sortie .= '</th>' . "\n";

$APP_Sortie .= '</tr>' . "\n";

foreach($albums as $album) {

	if (is_array($album)) {
	
		$APP_Sortie .= '<tr style="vertical-align:top;">' . "\n";
		
		$APP_Sortie .= '<td style="text-align:center;">' . "\n";
		$APP_Sortie .= $album['id'];
		$APP_Sortie .= '</td>' . "\n";
		
		$APP_Sortie .= '<td style="">' . "\n";
		$APP_Sortie .= $album['nom'];
		$APP_Sortie .= '</td>' . "\n";
		
		$APP_Sortie .= '<td style="text-align:center;">' . "\n";
		$APP_Sortie .= $album['photos'];
		$APP_Sortie .= '</td>' . "\n";
		
		$APP_Sortie .= '</tr>' . "\n";
	
	}

}

$APP_Sortie .= '</table>' . "\n";

$APP_Sortie .= '</div>' . "\n";


$APP_Sortie .= '<br />' . "\n";


$APP_Sortie .= '<h3>Comptes</h3>' . "\n";

$APP_Sortie .= '<div>' . "\n";

$APP_Sortie .= '<table class="" style="width:100%;">' . "\n";

$APP_Sortie .= '<tr style="vertical-align:top;">' . "\n";

$APP_Sortie .= '<th style="width:80px;">' . "\n";
$APP_Sortie .= '<span>' . "ID"  . '</span>' . "\n";
$APP_Sortie .= '</th>' . "\n";

$APP_Sortie .= '<th style="">' . "\n";
$APP_Sortie .= '<span>' . "Identifiant"  . '</span>' . "\n";
$APP_Sortie .= '</th>' . "\n";

$APP_Sortie .= '<th style="">' . "\n";
$APP_Sortie .= '<span>' . "Mot de passe"  . '</span>' . "\n";
$APP_Sortie .= '</th>' . "\n";

$APP_Sortie .= '<th style="">' . "\n";
$APP_Sortie .= '<span>' . "Album"  . '</span>' . "\n";
$APP_Sortie .= '</th>' . "\n";

$APP_Sortie .= '<th style="">' . "\n";
$APP_Sortie .= '<span>' . "Action"  . '</span>' . "\n";
$APP_Sortie .= '</th>' . "\n";

$APP_Sortie .= '</tr>' . "\n";

foreach($comptes as $compte) {

	if (is_array($compte)) {
	
		$APP_Sortie .= '<tr style="vertical-align:top;">' . "\n";
		
		$APP_Sortie .= '<td style="text-align:center;">' . "\n";
		$APP_Sortie .= '<span>' . $compte['id']  . '</span>' . "\n";
		$APP_Sortie .= '</td>' . "\n";
		
		$APP_Sortie .= '<td style="">' . "\n";
		$APP_Sortie .= '<span>' . $compte['identifiant']  . '</span>' . "\n";
		$APP_Sortie .= '</td>' . "\n";
		
		$APP_Sortie .= '<td style="">' . "\n";
		$APP_Sortie .= '<span>' . $compte['motdepasse']  . '</span>' . "\n";
		$APP_Sortie .= '</td>' . "\n";
		
		$APP_Sortie .= '<td style="">' . "\n";
		$APP_Sortie .= '<span>' . $compte['album_nom']  . '</span>' . "\n";
		$APP_Sortie .= '</td>' . "\n";
		
		$url = URL_LOGIN . '?identifiant=' . urlencode($compte['identifiant']) . '&motdepasse=' . urlencode($compte['motdepasse']);
		
		$APP_Sortie .= '<td style="">' . "\n";
		$APP_Sortie .= '<a href="' . $url . '" style="text-decoration:none;">';
		$APP_Sortie .= "Se connecter";
		$APP_Sortie .= '</a>' . "\n";
		$APP_Sortie .= '</td>' . "\n";
		
		$APP_Sortie .= '</tr>' . "\n";
	
	}

}

$APP_Sortie .= '</table>' . "\n";

$APP_Sortie .= '</div>' . "\n";


?>