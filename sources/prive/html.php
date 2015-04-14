<?PHP


$sortie = '';

//
// $sortie .= '<!doctype html>' . "\n";
// $sortie .= '<html lang="fr">' . "\n";

$sortie .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">' . "\n";
$sortie .= '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" dir="ltr">' . "\n";

$sortie .= '<head>' . "\n";

$sortie .= '<meta http-equiv="content-type" content="text/html; charset=utf-8" />' . "\n";
$sortie .= '<meta http-equiv="content-language" content="fr" />' . "\n";

$sortie .= '<title>' . $APP_Titre . '</title>' . "\n";

$sortie .= '<link rel="icon" href="' . URL_IMAGES . 'favico.ico" />' . "\n";

$sortie .= '<link href="' . URL_STYLES . 'general.css" rel="stylesheet" type="text/css" />' . "\n";
$sortie .= '<link href="' . URL_STYLES . 'albums.css" rel="stylesheet" type="text/css" />' . "\n";
$sortie .= '<link href="' . URL_STYLES . 'surcharges.css" rel="stylesheet" type="text/css" />' . "\n";

$sortie .= '<link href="' . URL_STYLES . 'developpement.css" rel="stylesheet" type="text/css" />' . "\n";

$sortie .= '<script type="text/javascript" src="' . URL_SCRIPTS . 'general.js"></script>' . "\n";

// jQuery
$sortie .= '<script type="text/javascript" src="' . URL_SCRIPTS . 'jquery.js"></script>' . "\n";

// Google Fonts
$sortie .= '<link href="http://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css" />' . "\n";
$sortie .= '<link href="http://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet" type="text/css" />' . "\n";

// prettyPhotos
// $sortie .= '<link href="' . URL_PLUGINS . 'prettyphoto/styles/prettyPhoto.css" rel="stylesheet" type="text/css" />' . "\n";
// $sortie .= '<script type="text/javascript" src="' . URL_PLUGINS . 'prettyphoto/scripts/jquery.prettyPhoto.js"></script>' . "\n";
// $sortie .= '<script type="text/javascript" src="' . URL_PLUGINS . 'prettyphoto/scripts/initialisation.js"></script>' . "\n";

// FancyBox
$sortie .= '<link href="' . URL_PLUGINS . 'fancybox/styles/jquery.fancybox.css" rel="stylesheet" type="text/css" />' . "\n";
$sortie .= '<script type="text/javascript" src="' . URL_PLUGINS . 'fancybox/scripts/jquery.fancybox.pack.js"></script>' . "\n";
$sortie .= '<script type="text/javascript" src="' . URL_PLUGINS . 'fancybox/scripts/initialisation.js"></script>' . "\n";

// iCheck
// $sortie .= '<link href="' . URL_PLUGINS . 'icheck/styles/all.css" rel="stylesheet" type="text/css" />' . "\n";
// $sortie .= '<script type="text/javascript" src="' . URL_PLUGINS . 'icheck/scripts/icheck.js"></script>' . "\n";
// $sortie .= '<script type="text/javascript" src="' . URL_PLUGINS . 'icheck/scripts/initialisation.js"></script>' . "\n";

// MAP
$sortie .= '<script type="text/javascript" src="' . URL_SCRIPTS . 'map.js"></script>' . "\n";
$sortie .= '<script type="text/javascript" src="' . URL_SCRIPTS . 'initialisation.js"></script>' . "\n";

$sortie .= '</head>' . "\n";

$sortie .= '<body>' . "\n";

$sortie .= $APP_Sortie;

$sortie .='<script type="text/javascript" charset="utf-8">$(document).ready(initialisation());</script>' . "\n";

$sortie .= '</body>' . "\n";

$sortie .= '</html>' . "\n";


?>