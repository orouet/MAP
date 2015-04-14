<?PHP


/* CSV */
$APP_Sortie = '';

$APP_Sortie .= 'NOM';
$APP_Sortie .= ';';
$APP_Sortie .= 'PRENOM';
$APP_Sortie .= ';';
$APP_Sortie .= 'SOCIETE';
$APP_Sortie .= ';';
$APP_Sortie .= 'TEL. PROF';
$APP_Sortie .= ';';
$APP_Sortie .= 'TEL. PERSO';
$APP_Sortie .= ';';
$APP_Sortie .= 'FAX';
$APP_Sortie .= ';';
$APP_Sortie .= 'MOBILE';
$APP_Sortie .= ';';
$APP_Sortie .= 'EMAIL';
$APP_Sortie .= ';';
$APP_Sortie .= 'PERSO 1';
$APP_Sortie .= ';';
$APP_Sortie .= 'PERSO 2';
$APP_Sortie .= ';';
$APP_Sortie .= 'PERSO 3';
$APP_Sortie .= ';';
$APP_Sortie .= 'PERSO 4';
$APP_Sortie .= ';';
$APP_Sortie .= 'PERSO 5';

$APP_Sortie .= "\n";

//
unset($infos['count']);

foreach ($infos as $id => $enregistrement) {

	$nom = $enregistrement['sn'][0];
	$nom = substr($nom, 1);
	
	$prenom = $enregistrement['givenname'][0];
	
	$societe = 'OPH55';
	
	$interne = $enregistrement['telephonenumber'][0];
	
	$pro = '';
	$perso = '';
	
	$fax = '';
	
	$mobile = $enregistrement['mobile'][0];
	$mobile = '0' . $mobile;
	
	$email = '';
	
	$p1 = '';
	$p2 = '';
	$p3 = '';
	$p4 = '';
	$p5 = '';
	
	$APP_Sortie .= $nom;
	$APP_Sortie .= ';';
	$APP_Sortie .= $prenom;
	$APP_Sortie .= ';';
	$APP_Sortie .= $societe;
	$APP_Sortie .= ';';
	$APP_Sortie .= $pro;
	$APP_Sortie .= ';';
	$APP_Sortie .= $perso;
	$APP_Sortie .= ';';
	$APP_Sortie .= $fax;
	$APP_Sortie .= ';';
	$APP_Sortie .= $mobile;
	$APP_Sortie .= ';';
	$APP_Sortie .= $email;
	$APP_Sortie .= ';';
	$APP_Sortie .= $p1;
	$APP_Sortie .= ';';
	$APP_Sortie .= $p2;
	$APP_Sortie .= ';';
	$APP_Sortie .= $p3;
	$APP_Sortie .= ';';
	$APP_Sortie .= $p4;
	$APP_Sortie .= ';';
	$APP_Sortie .= $p5;
	
	$APP_Sortie .= "\n";

}


?>