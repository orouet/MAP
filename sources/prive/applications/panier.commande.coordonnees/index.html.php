<?PHP


$html_slogan = "La boutique en ligne.";
$html_titre = "Mes coordonnées";


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

$APP_Sortie .= '<form action="' . URL_APP . '" method="post">' . "\n";

$APP_Sortie .= '<div class="bloc mon_compte">' . "\n";

$APP_Sortie .= '<h2>' . "Mon compte" . '</h2>' . "\n";

$APP_Sortie .= '<table class="formulaire">' . "\n";

$APP_Sortie .= '<tr>' . "\n";
$APP_Sortie .= '<td class="champs">' . "Identifiant :" . '</td>' . "\n";
$APP_Sortie .= '<td>' . $utilisateur['identifiant'] . '</td>' . "\n";
$APP_Sortie .= '</tr>' . "\n";

$APP_Sortie .= '<tr>' . "\n";
$APP_Sortie .= '<td class="champs">' . "Email :" . '</td>' . "\n";
$APP_Sortie .= '<td>';
$APP_Sortie .= '<input type="text" name="compte_email" value="' . "" . '" />';
$APP_Sortie .= '</td>' . "\n";
$APP_Sortie .= '</tr>' . "\n";

$APP_Sortie .= '<tr>' . "\n";
$APP_Sortie .= '<td class="champs">' . "Téléphone :" . '</td>' . "\n";
$APP_Sortie .= '<td>';
$APP_Sortie .= '<input type="text" name="compte_telephone" value="' . "" . '" />';
$APP_Sortie .= '</td>' . "\n";
$APP_Sortie .= '</tr>' . "\n";

$APP_Sortie .= '</table>' . "\n";

$APP_Sortie .= '</div>' . "\n";

$APP_Sortie .= '<br />' . "\n";

$APP_Sortie .= '<table style="width:100%;">' . "\n";
$APP_Sortie .= '<tr>' . "\n";

$APP_Sortie .= '<td style="width:50%;">' . "\n";
$APP_Sortie .= '<h2>' . "Adresse de facturation" . '</h2>' . "\n";

$APP_Sortie .= '<br />' . "\n";

$APP_Sortie .= '<div class="bloc conditions">' . "\n";

$APP_Sortie .= '<table class="formulaire">' . "\n";

$APP_Sortie .= '<tr>' . "\n";
$APP_Sortie .= '<td class="champs">' . "Société :" . '</td>' . "\n";
$APP_Sortie .= '<td>';
$APP_Sortie .= '<input type="text" name="facturation_societe" value="' . "" . '" />';
$APP_Sortie .= '</td>' . "\n";
$APP_Sortie .= '</tr>' . "\n";

$APP_Sortie .= '<tr>' . "\n";
$APP_Sortie .= '<td class="champs">' . "Civilité :" . '</td>' . "\n";
$APP_Sortie .= '<td>' . "\n";
$APP_Sortie .= '<select name="facturation_civilite">' . "\n";
$APP_Sortie .= '<option value="1">' . "Madame" . '</option>' . "\n";
$APP_Sortie .= '<option value="2">' . "Monsieur" . '</option>' . "\n";
$APP_Sortie .= '</select>' . "\n";
$APP_Sortie .= '</td>' . "\n";
$APP_Sortie .= '</tr>' . "\n";

$APP_Sortie .= '<tr>' . "\n";
$APP_Sortie .= '<td class="champs">' . "Nom :" . '</td>' . "\n";
$APP_Sortie .= '<td>';
$APP_Sortie .= '<input type="text" name="facturation_nom" value="' . "" . '" />';
$APP_Sortie .= '</td>' . "\n";
$APP_Sortie .= '</tr>' . "\n";

$APP_Sortie .= '<tr>' . "\n";
$APP_Sortie .= '<td class="champs">' . "Prénom :" . '</td>' . "\n";
$APP_Sortie .= '<td>';
$APP_Sortie .= '<input type="text" name="facturation_prenom" value="' . "" . '" />';
$APP_Sortie .= '</td>' . "\n";
$APP_Sortie .= '</tr>' . "\n";

$APP_Sortie .= '<tr>' . "\n";
$APP_Sortie .= '<td class="champs">' . "N° et rue :" . '</td>' . "\n";
$APP_Sortie .= '<td>';
$APP_Sortie .= '<input type="text" name="facturation_adr1" value="' . "" . '" />';
$APP_Sortie .= '</td>' . "\n";
$APP_Sortie .= '</tr>' . "\n";

$APP_Sortie .= '<tr>' . "\n";
$APP_Sortie .= '<td class="champs">' . "Complément 1 :" . '</td>' . "\n";
$APP_Sortie .= '<td>';
$APP_Sortie .= '<input type="text" name="facturation_adr2" value="' . "" . '" />';
$APP_Sortie .= '</td>' . "\n";
$APP_Sortie .= '</tr>' . "\n";

$APP_Sortie .= '<tr>' . "\n";
$APP_Sortie .= '<td class="champs">' . "Complément 2 :" . '</td>' . "\n";
$APP_Sortie .= '<td>';
$APP_Sortie .= '<input type="text" name="facturation_adr3" value="' . "" . '" />';
$APP_Sortie .= '</td>' . "\n";
$APP_Sortie .= '</tr>' . "\n";

$APP_Sortie .= '<tr>' . "\n";
$APP_Sortie .= '<td class="champs">' . "Code postal :" . '</td>' . "\n";
$APP_Sortie .= '<td>';
$APP_Sortie .= '<input type="text" name="facturation_cp" value="' . "" . '" />';
$APP_Sortie .= '</td>' . "\n";
$APP_Sortie .= '</tr>' . "\n";

$APP_Sortie .= '<tr>' . "\n";
$APP_Sortie .= '<td class="champs">' . "Ville :" . '</td>' . "\n";
$APP_Sortie .= '<td>';
$APP_Sortie .= '<input type="text" name="facturation_ville" value="' . "" . '" />';
$APP_Sortie .= '</td>' . "\n";
$APP_Sortie .= '</tr>' . "\n";

$APP_Sortie .= '</table>' . "\n";

$APP_Sortie .= '</div>' . "\n";
$APP_Sortie .= '</td>' . "\n";

$APP_Sortie .= '<td>' . "\n";
$APP_Sortie .= '<h2>' . "Adresse de livraison" . '</h2>' . "\n";

$APP_Sortie .= '<br />' . "\n";

$APP_Sortie .= '<div class="bloc conditions">' . "\n";

$APP_Sortie .= '<table class="formulaire">' . "\n";

$APP_Sortie .= '<tr>' . "\n";
$APP_Sortie .= '<td class="champs">' . "Société :" . '</td>' . "\n";
$APP_Sortie .= '<td>';
$APP_Sortie .= '<input type="text" name="livraison_societe" value="' . "" . '" />';
$APP_Sortie .= '</td>' . "\n";
$APP_Sortie .= '</tr>' . "\n";

$APP_Sortie .= '<tr>' . "\n";
$APP_Sortie .= '<td class="champs">' . "Civilité :" . '</td>' . "\n";
$APP_Sortie .= '<td>' . "\n";
$APP_Sortie .= '<select name="livraison_civilite">' . "\n";
$APP_Sortie .= '<option value="1">' . "Madame" . '</option>' . "\n";
$APP_Sortie .= '<option value="2">' . "Monsieur" . '</option>' . "\n";
$APP_Sortie .= '</select>' . "\n";
$APP_Sortie .= '</td>' . "\n";
$APP_Sortie .= '</tr>' . "\n";

$APP_Sortie .= '<tr>' . "\n";
$APP_Sortie .= '<td class="champs">' . "Nom :" . '</td>' . "\n";
$APP_Sortie .= '<td>';
$APP_Sortie .= '<input type="text" name="livraison_nom" value="' . "" . '" />';
$APP_Sortie .= '</td>' . "\n";
$APP_Sortie .= '</tr>' . "\n";

$APP_Sortie .= '<tr>' . "\n";
$APP_Sortie .= '<td class="champs">' . "Prénom :" . '</td>' . "\n";
$APP_Sortie .= '<td>';
$APP_Sortie .= '<input type="text" name="livraison_prenom" value="' . "" . '" />';
$APP_Sortie .= '</td>' . "\n";
$APP_Sortie .= '</tr>' . "\n";

$APP_Sortie .= '<tr>' . "\n";
$APP_Sortie .= '<td class="champs">' . "N° et rue :" . '</td>' . "\n";
$APP_Sortie .= '<td>';
$APP_Sortie .= '<input type="text" name="livraison_adr1" value="' . "" . '" />';
$APP_Sortie .= '</td>' . "\n";
$APP_Sortie .= '</tr>' . "\n";

$APP_Sortie .= '<tr>' . "\n";
$APP_Sortie .= '<td class="champs">' . "Complément 1 :" . '</td>' . "\n";
$APP_Sortie .= '<td>';
$APP_Sortie .= '<input type="text" name="livraison_adr2" value="' . "" . '" />';
$APP_Sortie .= '</td>' . "\n";
$APP_Sortie .= '</tr>' . "\n";

$APP_Sortie .= '<tr>' . "\n";
$APP_Sortie .= '<td class="champs">' . "Complément 2 :" . '</td>' . "\n";
$APP_Sortie .= '<td>';
$APP_Sortie .= '<input type="text" name="livraison_adr3" value="' . "" . '" />';
$APP_Sortie .= '</td>' . "\n";
$APP_Sortie .= '</tr>' . "\n";

$APP_Sortie .= '<tr>' . "\n";
$APP_Sortie .= '<td class="champs">' . "Code postal :" . '</td>' . "\n";
$APP_Sortie .= '<td>';
$APP_Sortie .= '<input type="text" name="livraison_cp" value="' . "" . '" />';
$APP_Sortie .= '</td>' . "\n";
$APP_Sortie .= '</tr>' . "\n";

$APP_Sortie .= '<tr>' . "\n";
$APP_Sortie .= '<td class="champs">' . "Ville :" . '</td>' . "\n";
$APP_Sortie .= '<td>';
$APP_Sortie .= '<input type="text" name="livraison_ville" value="' . "" . '" />';
$APP_Sortie .= '</td>' . "\n";
$APP_Sortie .= '</tr>' . "\n";

$APP_Sortie .= '</table>' . "\n";

$APP_Sortie .= '</div>' . "\n";
$APP_Sortie .= '</td>' . "\n";

$APP_Sortie .= '</tr>' . "\n";
$APP_Sortie .= '</table>' . "\n";

$APP_Sortie .= '<br />' . "\n";

$APP_Sortie .= '<div class="bloc livraison_mode">' . "\n";

$APP_Sortie .= '<h2>' . "Mode de livraison" . '</h2>' . "\n";

$APP_Sortie .= '<table class="formulaire" style="width:100%;">' . "\n";
$APP_Sortie .= '<tr>' . "\n";

$APP_Sortie .= '<td style="width:48%;padding:10px 1% 10px 1%;">';

$APP_Sortie .= '<table style="width:100%;">' . "\n";
$APP_Sortie .= '<tr>' . "\n";
$APP_Sortie .= '<td colspan="2">' . "\n";
$APP_Sortie .= '<div style="text-align:center;font-weight:bold;background-color:#888888;padding:5px 0px;">' . "Je souhaite venir retirer mon colis" . '</div>' . "\n";
$APP_Sortie .= '</td>' . "\n";
$APP_Sortie .= '</tr>' . "\n";
$APP_Sortie .= '<tr>' . "\n";
$APP_Sortie .= '<td style="width:50px;vertical-align:middle;">';
$APP_Sortie .= '<input type="radio" name="livraison_mode" />';
$APP_Sortie .= '</td>' . "\n";
$APP_Sortie .= '<td>' . "\n";
$APP_Sortie .= '<div style="font-weight:bold;">' . "Au studio photo" . '</div>' . "\n";
$APP_Sortie .= '<div style="">' . "Frais de port : GRATUIT" . '</div>' . "\n";
$APP_Sortie .= '<div style="">' . "Délai de livraison : sur rendez-vous" . '</div>' . "\n";
$APP_Sortie .= '</td>' . "\n";
$APP_Sortie .= '</tr>' . "\n";
$APP_Sortie .= '</table>' . "\n";

$APP_Sortie .= '</td>' . "\n";

$APP_Sortie .= '<td style="width:48%;padding:10px 1% 10px 1%;">' . "\n";

$APP_Sortie .= '<table style="width:100%;">' . "\n";
$APP_Sortie .= '<tr>' . "\n";
$APP_Sortie .= '<td colspan="2">' . "\n";
$APP_Sortie .= '<div style="text-align:center;font-weight:bold;background-color:#888888;padding:5px 0px;">' . "Je souhaite être livré à domicile" . '</div>' . "\n";
$APP_Sortie .= '</td>' . "\n";
$APP_Sortie .= '</tr>' . "\n";
$APP_Sortie .= '<tr>' . "\n";
$APP_Sortie .= '<td style="width:50px;vertical-align:middle;">';
$APP_Sortie .= '<input type="radio" name="livraison_mode" />';
$APP_Sortie .= '</td>' . "\n";
$APP_Sortie .= '<td>' . "\n";
$APP_Sortie .= '<div style="font-weight:bold;">' . "Par colissimo" . '</div>' . "\n";
$APP_Sortie .= '<div style="">' . "Frais de port : 15,00 €" . '</div>' . "\n";
$APP_Sortie .= '<div style="">' . "Délai de livraison : 48 heures" . '</div>' . "\n";
$APP_Sortie .= '</td>' . "\n";
$APP_Sortie .= '</tr>' . "\n";
$APP_Sortie .= '</table>' . "\n";

$APP_Sortie .= '</td>' . "\n";

$APP_Sortie .= '</tr>' . "\n";

$APP_Sortie .= '</table>' . "\n";

$APP_Sortie .= '</div>' . "\n";

$APP_Sortie .= '<br />' . "\n";
$APP_Sortie .= '<br />' . "\n";

$APP_Sortie .= '<div class="texte">';
$APP_Sortie .= '<input type="hidden" name="action" value="actualiser" />' . "\n";
$APP_Sortie .= '<input type="submit" value="Valider" />' . "\n";
$APP_Sortie .= '</div>';

$APP_Sortie .= '</form>' . "\n";

$APP_Sortie .= '<br />' . "\n";
$APP_Sortie .= '<br />' . "\n";

$APP_Sortie .= '</div>' . "\n";

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