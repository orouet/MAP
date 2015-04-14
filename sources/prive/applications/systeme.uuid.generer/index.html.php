<?PHP


/* VUE */

// Définition des valeurs par défaut
$APP_Sortie = '';

$APP_Sortie .= '<h1>Générateur de UUIDS</h1>' . "\n";

// Etape 1
if ($donnees['etape'] == 1) {

	$APP_Sortie .= '<h2>Paramètres</h2>' . "\n";
	
	$APP_Sortie .= '<form action="' . URL_APP . '" method="post">' . "\n";
	
	$APP_Sortie .= '<table>' . "\n";
	
	$APP_Sortie .= '<tr>' . "\n";
	$APP_Sortie .= '<td>Nombre de UUID :</td>' . "\n";
	$APP_Sortie .= '<td><input type="text" name="nombre" value="' . $donnees['nombre'] . '" /></td>' . "\n";
	$APP_Sortie .= '</tr>' . "\n";
	
	$APP_Sortie .= '</table>' . "\n";
	
	$APP_Sortie .= '<p>' . "\n";
	$APP_Sortie .= '<input type="hidden" name="etape" value="2" />' . "\n";
	$APP_Sortie .= '<input type="submit" value="Valider" />' . "\n";
	$APP_Sortie .= '</p>' . "\n";
	
	$APP_Sortie .= '</form>' . "\n";

}


// Etape 2
if ($donnees['etape'] == 2) {

	$APP_Sortie .= '<h2>Résultat</h2>' . "\n";
	
	$APP_Sortie .= '<table>' . "\n";
	
	$APP_Sortie .= '<tr>' . "\n";
	$APP_Sortie .= '<th>N°</th>' . "\n";
	$APP_Sortie .= '<th>UUID</th>' . "\n";
	$APP_Sortie .= '</tr>' . "\n";
	
	foreach ($donnees['uuids'] as $i => $chaine ) {
	
		$APP_Sortie .= '<tr>' . "\n";
		$APP_Sortie .= '<td>' . $i . '</td>' . "\n";
		$APP_Sortie .= '<td>' . htmlspecialchars($chaine) . '</td>' . "\n";
		$APP_Sortie .= '</tr>' . "\n";
	
	}
	
	$APP_Sortie .= '</table>' . "\n";
	
	$APP_Sortie .= '<p>' . "\n";
	$APP_Sortie .= '<a href="' . URL_APP . '"><button>Changer les paramètres</button></a>' . "\n";
	$APP_Sortie .= '</p>' . "\n";

}


?>