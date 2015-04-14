<?PHP


//
function dossierLister($dossier = '')
{

	// initialisation des variables
	$sortie = false;
	
	// traitement
	if (is_dir($dossier)) {
	
		// Ouverture du dossier
		$pointeur = @opendir($dossier);
		
		// on regarde si le dossier a été ouvert avec succès
		if ($pointeur !== false) {
		
			// intialisation du tableau de sortie
			$sortie = array();
			
			// on parcourt les éléments contenus dans le dossier
			while ($element = @readdir($pointeur)) {
			
				// on élimine les éléments inutiles
				if ($element != '.' && $element != '..') {
				
					// chemin complet
					$courant = $dossier . $element;
					
					// on regarde si l'élément est un dossier
					if (is_dir($courant)) {
					
						$sortie[$element] = dossierLister($courant);
					
					} else {
					
						$sortie[$element] = $element;
					
					}
				
				}
			
			}
			
			closedir($pointeur);
		
		}
	
	}
	
	// sortie
	return $sortie;

}


//
function dossierLister2($dossier = '')
{

	// initialisation des variables
	$sortie = false;
	
	// traitement
	if (is_dir($dossier)) {
	
		// Ouverture du dossier
		$pointeur = @opendir($dossier);
		
		// on regarde si le dossier a été ouvert avec succès
		if ($pointeur !== false) {
		
			// intialisation du tableau de sortie
			$sortie = array();
			
			// on parcourt les éléments contenus dans le dossier
			while ($element = @readdir($pointeur)) {
			
				// on élimine les éléments inutiles
				if ($element != '.' && $element != '..') {
				
					// chemin complet
					$chemin = $dossier . '/' . $element;
					
					// on regarde si l'élément est un dossier
					if (is_dir($chemin)) {
					
						$sortie[$element] = [
							'nom' => $element,
							'chemin' => $chemin,
							'dossier' => $dossier,
							'type' => 'dossier',
							'contenu' => dossierLister2($chemin),
							'informations' => []
						];
					
					} else {
					
						$sortie[$element] = [
							'nom' => $element,
							'chemin' => $chemin,
							'dossier' => $dossier,
							'type' => 'document',
							'contenu' => false,
							'informations' => documentInformationslire($chemin)
						];
					
					}
				
				}
			
			}
			
			closedir($pointeur);
		
		}
	
	}
	
	// sortie
	return $sortie;

}


//
function documentInformationslire($cible) {

	$sortie = false;
	
	if (is_file($cible)) {
	
		$sortie['taille'] = filesize($cible);
		$sortie['empreinte'] = sha1_file($cible);
		
		
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mime = finfo_file($finfo, $cible);
		finfo_close($finfo);
		
		$sortie['mime'] = $mime;
		
		switch ($mime) {
		
			case 'image/jpeg' :
			
				$metas = getimagesize($cible);
				
				if ($metas !== false) {
				
					$sortie['metas'] = $metas;
				
				}
			
			break;
		
		}
	
	}
	
	return $sortie;

}


//
function imagesMiniatureGenerer($image, $miniature, $largeur, $hauteur)
{

	$sortie = false;
	
	$dst_type = 'PNG';
	$dst_type = 'JPEG';
	
	if (file_exists($image)) {
	
		// Dimensions de l'image de destination
		$dst_l = $largeur;
		$dst_h = $hauteur;
		
		
		
		// Source
		$src_dimensions = getimagesize($image);
		$src_l = $src_dimensions[0];
		$src_h = $src_dimensions[1];
		
		
		
		// Création de l'image redimensionnée
		$dst_x = 0;
		$dst_y = 0;
		
		$src_ratio = $src_l / $src_h;
		$dst_ratio = $dst_l / $dst_h;
		
		if ($dst_ratio <= $src_ratio) {
		
			$dim_l = $dst_l;
			$dim_h = ceil($dim_l / $src_ratio);
			
			$vide_y = $dst_h - $dim_h;
			$dst_y = floor($vide_y / 2);
		
		} else {
		
			$dim_h = $dst_h;
			$dim_l = ceil($dim_h * $src_ratio);
			
			$vide_x = $dst_l - $dim_l;
			$dst_x = floor($vide_x / 2);
		
		}
		
		
		
		//
		$src_img = imagecreatefromjpeg($image);
		
		$dst_img = imagecreatetruecolor($largeur, $hauteur);
		
		// $fond_couleur = imagecolorallocate($dst_img, 0, 0, 0);
		$fond_couleur = imagecolorallocate($dst_img, 39, 43, 49);
		
		if ($dst_type == 'PNG') {
		
			imagesavealpha($dst_img, true);
			
			$fond_couleur = imagecolorallocatealpha($dst_img, 255, 255, 255, 127);
		
		}
		
		imagefill($dst_img, 0, 0, $fond_couleur);
		
		// Coordonnées de la zone à copier
		$src_x = 0;
		$src_y = 0;
		
		// Resize
		imagecopyresized(
			$dst_img, $src_img,
			$dst_x, $dst_y,
			$src_x, $src_y,
			$dim_l, $dim_h,
			$src_l, $src_h
		);
		
		// Output
		switch ($dst_type) {
		
			case 'JPEG':
			
				$sortie = imagejpeg($dst_img, $miniature, 75);
			
			break;
			
			
			case 'PNG':
			
				$sortie = imagepng($dst_img, $miniature, 6);
			
			break;
		
		}
		
		
		
		// Free memory
		imagedestroy($dst_img);
	
	}
	
	return $sortie;


}


?>