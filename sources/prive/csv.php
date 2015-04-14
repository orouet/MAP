<?PHP


$sortie = '';

// entête
header('Pragma: public');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Cache-Control: private', false);
header('Content-Encoding: UTF-8');

header('Content-type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename=export.csv');

// on force l'encodage UTF-8 BOM
// $sortie .= pack('CCC', 0xef, 0xbb, 0xbf);

$sortie .= $APP_Sortie;


?>