<?PHP


//
function efTableauTrier($a, $b)
{

	$sortie = 0;
	
	$comparaison = strcmp($a['code'], $b['code']);
	
	if ($comparaison == 0) {
	
		$sortie = 0;
	
	}
	
	if ($comparaison > 0) {
	
		$sortie = 1;
	
	}
	
	if ($comparaison < 0) {
	
		$sortie = -1;
	
	}
	
	return $sortie;

}


//
function efArbreGenerer($index, $elements)
{

	$sortie = false;
	
	foreach($elements->TemplateTreeItem as $element) {
	
		$template = false;
		$enfants = 0;
		$arborescence = false;
		
		$Id = (string) $element['Id'];
		$IdTemplate = (string) $element['IdTemplate'];
		$enfants = $element->TemplateTreeItemChilds->TemplateTreeItem->count();
		
		// On regarde si le template est indexé
		$template = efModeleChercher($index, $IdTemplate);
		
		if ($template !== false) {
		
			// echo $template['Code'];
			
			//
			if ($enfants > 0) {
			
				$arborescence = efArbreGenerer($index, $element->TemplateTreeItemChilds);
			
			}
			
			$rubrique = array();
			
			$rubrique['id'] = $Id;
			$rubrique['type'] = $template['Type'];
			$rubrique['code'] = $template['Code'];
			$rubrique['nom'] = $template['Name'];
			$rubrique['enfants'] = array();
			
			if ($arborescence !== false) {
			
				$rubrique['enfants'] = $arborescence;
			
			}
			
			$sortie[] = $rubrique;
		
		}
	
	}
	
	return $sortie;

}


//
function efArbreFiltrer($arbre, $filtre)
{

	$sortie = array();
	
	foreach($arbre as $element) {
	
		$correspondances = 0;
		$code = $element['code'];
		$enfants = $element['enfants'];
		$recherche = $filtre;
		
		// On regarde si on trouvé un élément correspondant à notre filtre
		if (($filtre === $code) or ($filtre === false)) {
		
			$recherche = false;
			$correspondances ++;
		
		}
		
		//
		$enfants = efArbreFiltrer($element['enfants'], $recherche);
		$correspondances += count($enfants);
		
		// echo '<div>' . $correspondances . '</div>';
		
		if ($correspondances > 0) {
		
			// Tri des enfants
			uasort($enfants, 'efTableauTrier');
			
			$element['enfants'] = $enfants;
			$sortie[] = $element;
		
		}
	
	}
	
	return $sortie;

}


//
function efModelesParcourir($tableau, $elements)
{

	foreach($elements->TemplateTreeItem as $element) {
	
		$template = false;
		$children = false;
		$enfants = 0;
		
		$enfants = $element->TemplateTreeItemChilds->TemplateTreeItem->count();
		
		$Id = (string) $element['Id'];
		$IdTemplate = (string) $element['IdTemplate'];
		
		$template = efModeleChercher($index, $IdTemplate);
		
		if ($enfants > 0) {
		
			$children = efModelesParcourir($index, $element->TemplateTreeItemChilds);
		
		}
		
		// $tableau[$Id] = array(
		// 'Id' => $Id,
		// 'IdTemplate' => $IdTemplate,
		// 'Type' =>,
		// 'Name' =>,
		// 'Code' =>,
		// 'IsActive' =>,
		// 'ExternalReference' =>,
		// 'Multiplicity' =>,
		// 'Children' => $children,
		// );
	
	}
	
	return $sortie;

}


//
function efModeleChercher($index, $id)
{

	$sortie = false;
	$id = (string) $id;
	
	/*
	
	$requete = '//Datas/Templates/TemplateFolder[@Id="' . $id . '"]';
	$requete = '//*[@Id="' . $id . '"]';
	echo $requete;
	$reponse = $xml->xpath($requete);
	
	if (sizeof($reponse) == 1) {
	 
		$sortie = $reponse[0];
	
	}
	
	 */
	 
	if (isset($index[$id])) {
	
		$sortie = $index[$id];
	
	}
	
	return $sortie;

}


//
function efModeleIndexer($index, $id, $element)
{

	if (isset($element->TemplateFolder) && ($element->TemplateFolder->count() > 0)) {
	
		$index = efFolderIndexer($index, $id, $element);
	
	}
	
	return $index;

}


// Dossier
function efFolderIndexer($index, $ParentId, $templates)
{

	foreach($templates->TemplateFolder as $element) {
	
		$id = (string) $element['Id'];
		$nom = (string) $element['Name'];
		$code = (string) $element['Code'];
		$actif = (string) $element['IsActive'];
		$externe = (string) $element['ExternalReference'];
		
		$index[$id] = array(
			'Id' => $id,
			'Name' => $nom,
			'Code' => $code,
			'IsActive' => $actif,
			'ExternalReference' => $externe,
			'Type' => 'dossier',
			'Multiplicity' => 'N/A',
			'ParentId' => $ParentId
		);
		
		if (isset($element->TemplateFolder) && ($element->TemplateFolder->count() > 0)) {
		
			$index = efFolderIndexer($index, $id, $element);
		
		}
		
		if (isset($element->TemplateSubFolder) && ($element->TemplateSubFolder->count() > 0)) {
		
			$index = efSubfolderIndexer($index, $id, $element);
		
		}
		
		if (isset($element->TemplateNonCaseSubFolder) && ($element->TemplateNonCaseSubFolder->count() > 0)) {
		
			$index = efNonCaseSubfolderIndexer($index, $id, $element);
		
		}
		
		if (isset($element->TemplateDocument) && ($element->TemplateDocument->count() > 0)) {
		
			$index = efDocumentIndexer($index, $id, $element);
		
		}
		
		if (isset($element->TemplateNonCaseDocument) && ($element->TemplateNonCaseDocument->count() > 0)) {
		
			$index = efNonCaseDocumentIndexer($index, $id, $element);
		
		}
	
	}
	
	return $index;

}


// Sous-dossier Sériel
function efSubfolderIndexer($index, $ParentId, $templates)
{

	foreach($templates->TemplateSubFolder as $element) {
	
		$id = (string) $element['Id'];
		$nom = (string) $element['Name'];
		$code = (string) $element['Code'];
		$actif = (string) $element['IsActive'];
		$externe = (string) $element['ExternalReference'];
		
		$index[$id] = array(
			'Id' => $id,
			'Name' => $nom,
			'Code' => $code,
			'IsActive' => $actif,
			'ExternalReference' => $externe,
			'Type' => 'sd-s',
			'Multiplicity' => 'N/A',
			'ParentId' => $ParentId
		);
		
		if (isset($element->TemplateFolder) && ($element->TemplateFolder->count() > 0)) {
		
			$index = efFolderIndexer($index, $id, $element);
		
		}
		
		if (isset($element->TemplateSubFolder) && ($element->TemplateSubFolder->count() > 0)) {
		
			$index = efSubfolderIndexer($index, $id, $element);
		
		}
		
		if (isset($element->TemplateNonCaseSubFolder) && ($element->TemplateNonCaseSubFolder->count() > 0)) {
		
			$index = efNonCaseSubfolderIndexer($index, $id, $element);
		
		}
		
		if (isset($element->TemplateDocument) && ($element->TemplateDocument->count() > 0)) {
		
			$index = efDocumentIndexer($index, $id, $element);
		
		}
		
		if (isset($element->TemplateNonCaseDocument) && ($element->TemplateNonCaseDocument->count() > 0)) {
		
			$index = efNonCaseDocumentIndexer($index, $id, $element);
		
		}
	
	}
	
	return $index;

}


// Sous-dossier Non-Sériel
function efNonCaseSubfolderIndexer($index, $ParentId, $templates)
{

	foreach($templates->TemplateNonCaseSubFolder as $element) {
	
		$id = (string) $element['Id'];
		$nom = (string) $element['Name'];
		$code = (string) $element['Code'];
		$actif = (string) $element['IsActive'];
		$externe = (string) $element['ExternalReference'];
		$multiple = (string) $element['Multiplicity'];
		
		$index[$id] = array(
			'Id' => $id,
			'Name' => $nom,
			'Code' => $code,
			'IsActive' => $actif,
			'ExternalReference' => $externe,
			'Type' => 'sd-ns',
			'Multiplicity' => $multiple,
			'ParentId' => $ParentId
		);
		
		if (isset($element->TemplateFolder) && ($element->TemplateFolder->count() > 0)) {
		
			$index = efFolderIndexer($index, $id, $element);
		
		}
		
		if (isset($element->TemplateSubFolder) && ($element->TemplateSubFolder->count() > 0)) {
		
			$index = efSubfolderIndexer($index, $id, $element);
		
		}
		
		if (isset($element->TemplateNonCaseSubFolder) && ($element->TemplateNonCaseSubFolder->count() > 0)) {
		
			$index = efNonCaseSubfolderIndexer($index, $id, $element);
		
		}
		
		if (isset($element->TemplateDocument) && ($element->TemplateDocument->count() > 0)) {
		
			$index = efDocumentIndexer($index, $id, $element);
		
		}
		
		if (isset($element->TemplateNonCaseDocument) && ($element->TemplateNonCaseDocument->count() > 0)) {
		
			$index = efNonCaseDocumentIndexer($index, $id, $element);
		
		}
	
	}
	
	return $index;

}


// Document Sériel
function efDocumentIndexer($index, $ParentId, $templates)
{

	foreach($templates->TemplateDocument as $element) {
	
		$id = (string) $element['Id'];
		$nom = (string) $element['Name'];
		$code = (string) $element['Code'];
		$actif = (string) $element['IsActive'];
		$externe = (string) $element['ExternalReference'];
		
		$index[$id] = array(
			'Id' => $id,
			'Name' => $nom,
			'Code' => $code,
			'IsActive' => $actif,
			'ExternalReference' => $externe,
			'Type' => 'd-s',
			'Multiplicity' => 'N/A',
			'ParentId' => $ParentId
		);
	
	}
	
	return $index;

}


// Document Non-Sériel
function efNonCaseDocumentIndexer($index, $ParentId, $templates)
{

	foreach($templates->TemplateNonCaseDocument as $element) {
	
		$id = (string) $element['Id'];
		$nom = (string) $element['Name'];
		$code = (string) $element['Code'];
		$actif = (string) $element['IsActive'];
		$externe = (string) $element['ExternalReference'];
		$multiple = (string) $element['Multiplicity'];
		
		$index[$id] = array(
			'Id' => $id,
			'Name' => $nom,
			'Code' => $code,
			'IsActive' => $actif,
			'ExternalReference' => $externe,
			'Type' => 'd-ns',
			'Multiplicity' => $multiple,
			'ParentId' => $ParentId
		);
	
	}
	
	return $index;

}


//
function efHtmlGenerer($chemin, $tableau)
{

	$sortie = array(
		'html' => '',
		'modification' => false,
		'enfants' => 0
	);
	
	foreach($tableau as $element) {
	
		$chaine = '';
		$icone = '';
		
		$enfants = 0;
		$enfants_html = '';
		$my_style = 'font-weight:normal;';
		$style = '';
		$developper = true;
		
		// echo $element['type'];
		
		switch ($element['type']) {
		
			case 'dossier' :
			case 'sd-s' :
			case 'sd-ns' :
			case 'dos' :
			case 'sdos-s' :
			case 'sdos-ns' :
			
				if (count($element['enfants']) > 0) {
				
					// On récupère les informations concernant les enfants
					$resultat = efHtmlGenerer($chemin . '/' . $element['code'], $element['enfants']);
					
					// On regarde si les enfants ont subi des modifications
					if ($resultat['modification'] === true) {
					
						$developper = true;
						$my_style = 'font-weight:bold;';
					
					}
					
					$enfants = $resultat['enfants'];
					$enfants_html = $resultat['html'];
					$sortie['enfants'] += $resultat['enfants'];
				
				}
				
				$icone = 'dossier.png';
			
			break;
			
			
			case 'd-s' :
			case 'doc-s' :
			
				$icone = 'document-s.png';
			
			break;
			
			
			case 'd-ns' :
			case 'doc-ns' :
			
				$icone = 'document-ns.png';
			
			break;
		
		}
		
		$sortie['enfants'] ++;
		
		// On regarde si l'élément actuel a subi des modifications
		if (isset($element['action'])) {
		
			switch ($element['action']) {
			
				case 'creation' :
				
					$style .= 'color:green;';
				
				break;
				
				
				case 'modification' :
				
					$style .= 'color:blue;';
				
				break;
				
				
				case 'suppression' :
				
					$style .= 'color:red;text-decoration:line-through;';
					$sortie['enfants'] --;
				
				break;
				
				
				case 'desactivation' :
				
					$style .= 'color:red;';
				
				break;
			
			}
			
			$style .= 'font-weight:bold;';
			$sortie['modification'] = true;
		
		}
		
		// Chemin complet
		// $chaine .= $chemin. '/' . $element['code'];
		
		$action = '';
		
		if ($enfants > 0) {
		
			$id = 'UUID-' . uuid_v4_generer();
			// $id = 'UUID-' . $element['id'];
			$action = 'onclick="javascript:id_basculer(\'' . $id . '\');"';
		
		}
		
		$chaine .= '<li style="' . $my_style . '">' . "\n";
		
		$chaine .= '<a href="#" ' . $action . ' style="text-decoration:none;">';
		
		$chaine .= '<span class="document">';
		$chaine .= '<img class="icone" src="' . URL_IMAGES . $icone . '" alt="" />';
		$chaine .= '&nbsp;&nbsp;';
		
		$chaine .= '<span style="' . $style . '">';
		$chaine .= $element['code'] . '' . ', ' . $element['nom'];
		// $chaine .= ' (' . $element['type'] . ')'
		
		if ($enfants > 0) {
		
			$chaine .= ' (' . $enfants . ')';
		
		}
		
		$chaine .= '</span>';
		
		$chaine .= '</a>' . "\n";
		
		// Détails
		// $visibilite = 'display:none;';
		
		// if ($developper === true) {
		
			// $visibilite = 'display:block;';
		
		// }
		// $chaine .= '<ul style="' . $visibilite . '">' . "\n";
		
		// if (isset($element['id'])) {
		
			// $chaine .= '<li>ID : ' . $element['id'] . '</li>' . "\n";
		
		// }
		
		// $chaine .= '</ul>' . "\n";
		
		$chaine .= '</span>';
		
		if ($enfants > 0) {
		
			$visibilite = 'display:none;';
			
			if ($developper === true) {
			
				$visibilite = 'display:block;';
			
			}
			
			$chaine .= '<ul id="' . $id . '" style="' . $visibilite . '">' . "\n";
			$chaine .= $enfants_html;
			$chaine .= '</ul>' . "\n";
		
		}
		
		$chaine .= '</li>' . "\n";
		
		$sortie['html'] .= $chaine;
	
	}
	
	return $sortie;

}


?>