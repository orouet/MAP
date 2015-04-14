<?PHP


//
class MAP_Panier
{

	//
	public $etapes;
	
	//
	public $photos;
	
	//
	public $tirages;
	
	//
	public $commande;
	
	//
	public $documents;
	
	//
	public $produits;
	
	
	//
	public function __construct ($produits)
	{
	
		$this->documents = array();
		$this->etapes = array();
		$this->photos = array();
		$this->tirages = array();
		$this->commande = array(
			'lignes' => array(),
			'delai' => array(
				'id' => false,
				'libelle' => '',
			),
			'conditions' => array(
				'delai' => false,
				'retractation' => false,
				'cgv' => false,
			),
		);
		$this->produits = $produits;
	
	}
	
	
	//
	public function commandeCalculer()
	{
	
		$formats = $this->produits['formats'];
		$delais = $this->produits['delais'];
		$tirages = $this->produits['tirages'];
		
		$delai_retenu = 0;
		$total_horsport = 0;
		
		$bdc = array();
		
		// calculs
		// $images = $this->photos;
		// ksort($images);
		
		$images = $this->documents;
		
		// On parcourt les images
		foreach($images as $image_id => $image_etat) {
		
			// On regarde si l'image est sélectionnée
			if ($this->photoEtat($image_id) === true) {
			
				// On regarde si il existe des tirages
				if (isset($this->tirages[$image_id])) {
				
					// On parcourt les tirages de l'image
					$lignes = $this->tirages[$image_id];
					
					foreach ($lignes as $tirage_id => $quantite) {
					
						$ligne = array();
						
						$document = $this->documents[$image_id];
						
						$l = $tirages[$tirage_id];
						
						$t = $l['tarif'];
						$f = $l['format'];
						$d = $l['delai'];
						
						if ($d > $delai_retenu) {
						
							$delai_retenu = $d;
						
						}
						
						$montant = $t * $quantite;
						
						$total_horsport += $montant;
						
						$ligne['document_libelle'] = $document['libelle'];
						$ligne['photo'] = $image_id;
						$ligne['libelle'] = $l['libelle'];
						$ligne['description'] = $l['description'];
						$ligne['delai'] = $delais[$d];
						$ligne['tarif'] = $l['tarif'];
						$ligne['quantite'] = $quantite;
						$ligne['montant'] = $montant;
						
						$bdc[] = $ligne;
					
					}
				
				}
			
			}
		
		}
		
		// var_dump($bdc);
		
		$this->commande['totaux']['horsport'] = $total_horsport;
		
		$this->commande['delai']['id'] = $delai_retenu;
		$this->commande['delai']['libelle'] = $delais[$delai_retenu];
		
		$this->commande['lignes'] = $bdc;
	
	}
	
	
	//
	public function photoAjouter($image)
	{
	
		if (isset($this->photos[$image])) {
		
			if ($this->photos[$image] === false) {
			
				$this->photos[$image] = true;
			
			}
		
		} else {
		
			$this->photos[$image] = true;
		
		}
		
		$this->verifier();
	
	}
	
	
	//
	public function photoBasculer($image)
	{
	
		if (isset($this->photos[$image])) {
		
			if ($this->photos[$image] === false) {
			
				$this->photoAjouter($image);
			
			} else {
			
				$this->photoSupprimer($image);
			
			}
		
		} else {
		
			$this->photoAjouter($image);
		
		}
		
		$this->verifier();
	
	}
	
	
	//
	public function photoEtat($id)
	{
	
		$sortie = false;
		
		if (isset($this->photos[$id])) {
		
			$photo = $this->photos[$id];
			
			if ($photo === true) {
			
				$sortie = true;
			
			}
		
		}
		
		return $sortie;
	
	}
	
	
	//
	public function photoSupprimer($image)
	{
	
		if (isset($this->photos[$image])) {
		
			if ($this->photos[$image] === true) {
			
				$this->photos[$image] = false;
			
			}
		
		} else {
		
			$this->photos[$image] = false;
		
		}
		
		$this->verifier();
	
	}
	
	
	//
	public function photosCompter()
	{
	
		$sortie = 0;
		
		foreach ($this->photos as $ligne) {
		
			if ($ligne === true) {
			
				$sortie ++;
			
			}
		
		}
		
		return $sortie;
	
	}
	
	
	//
	public function tirageAjouter($image, $tirage)
	{
	
		if ($tirage !== false) {
		
			if (!isset($this->tirages[$image])) {
			
				$this->tirages[$image] = array();
			
			}
			
			$this->tirages[$image][$tirage] = 1;
		
		}
		
		$this->verifier();
	
	}
	
	
	//
	public function tirageModifier($image_id, $tirage_id, $quantite)
	{
	
		if ($quantite == '0') {
		
			$this->tirageSupprimer($image_id, $tirage_id);
		
		} else {
		
			$this->tirages[$image_id][$tirage_id] = $quantite;
		
		}
	
	}
	
	
	//
	public function tirageRecalculer($image, $tirages)
	{
	
		if ($image !== false) {
		
			if (isset($this->tirages[$image])) {
			
				foreach($tirages as $tirage_id => $nombre) {
				
					$this->tirageModifier($image, $tirage_id, $nombre);
				
				}
			
			}
		
		}
	
	}
	
	
	//
	public function tirageSupprimer($image_id, $tirage_id)
	{
	
		if (isset($this->tirages[$image_id])) {
		
			$image = $this->tirages[$image_id];
			
			if (isset($image[$tirage_id])) {
			
				unset($image[$tirage_id]);
				
				$this->tirages[$image_id] = $image;
			
			}
		
		}
		
		$this->verifier();
	
	}
	
	
	//
	public function tiragesCompter()
	{
	
		$sortie = 0;
		
		foreach ($this->tirages as $photo => $ligne) {
		
			if ($this->photoEtat($photo) === true) {
			
				$nombre = count($ligne);
				
				if ($nombre > 0) {
				
					$sortie += $nombre;
				
				}
			
			}
		
		}
		
		return $sortie;
	
	}
	
	
	//
	public function tiragesPhotosCompter()
	{
	
		$sortie = 0;
		
		// var_dump($this->photos);
		// var_dump($this->tirages);
		
		foreach ($this->photos as $photo_id => $photo_etat) {
		
			if ($photo_etat === true) {
			
				if (isset($this->tirages[$photo_id])) {
				
					if (count($this->tirages[$photo_id]) > 0) {
					
						$sortie ++;
					
					}
				
				}
			
			}
		
		}
		
		return $sortie;
	
	}
	
	
	//
	public function tiragesRecalculer()
	{
	
		$formats = $this->produits['formats'];
		$tirages = $this->produits['tirages'];
		
		// initialisation du tableau récapitulatif
		$recap = array(
			'formats' => array(),
			'tirages' => 0,
			'total' => 0,
		);
		
		// initialisation des compteurs de formats
		foreach ($formats as $ligne) {
		
			// var_dump($ligne);
			$recap['formats'][$ligne] = array(
				'quantite' => 0,
				'total' => 0,
			);
		
		}
		
		// calculs
		foreach($this->documents as $document) {
		
			$id = $document['id'];
			
			if ($this->photoEtat($id) === true) {
			
				if (isset($this->tirages[$id])) {
				
					$tableau = $this->tirages[$id];
					
					foreach ($tableau as $i => $quantite) {
					
						$recap['tirages'] += $quantite;
						
						$l = $tirages[$i];
						
						$t = $l['tarif'];
						$f = $l['format'];
						
						// comptage des formats
						$recap['formats'][$f]['quantite'] += $quantite;
						$recap['formats'][$f]['total'] += $quantite * $t;
						
						$montant = $t * $quantite;
						
						$recap['total'] += $montant;
					
					}
				
				}
			
			}
		
		}
		
		return $recap;
	
	}
	
	
	//
	public function tiragesVider()
	{
	
		$this->tirages = array();
		$this->verifier();
	
	}
	
	
	//
	public function verifier()
	{
	
		$this->etapes = array(
			1 => false,
			2 => false,
			3 => false,
			4 => false,
			5 => false,
		);
		
		$this->etapes[1] = true;
		
		//
		$photos = $this->photosCompter();
		// var_dump($photos);
		
		if ($photos > 0) {
		
			$this->etapes[2] = true;
		
		}
		
		if ($this->etapes[2] == true) {
		
			if ($this->tiragesCompter() > 0) {
			
				$this->etapes[3] = true;
			
			}
		
		}
		
		
		if ($this->etapes[3] == true) {
		
			$erreurs = 0;
			
			foreach ($this->commande['conditions'] as $condition) {
			
				if ($condition != 'oui') {
				
					$erreurs ++;
				
				}
			
			}
			
			if ($erreurs == 0) {
			
				$this->etapes[4] = true;
			
			}
		
		}
	
	}
	
	
	//
	public function vider()
	{
		$this->photos = array();
		$this->tirages = array();
		
		$this->verifier();
	
	}


}


?>