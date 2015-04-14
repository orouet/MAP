<?PHP


$html_slogan = "La boutique en ligne.";
$html_titre = "Paiement";


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