<?PHP

$formats = array(
	'10x15' => '10x15',
	'13x19' => '13x19',
	'15x15' => '15x15',
	'15x21' => '15x21',
	'20x20' => '20x20',
	'20x30' => '20x30',
	'30x30' => '30x30',
	'30x45' => '30x45',
	'40x60' => '40x60',
	'50x75' => '50x75',
	'60x90' => '60x90',
);

//
$i = 0;
$tirages = array(
	array(
		'id' => $i++,
		'code' => '10x15',
		'libelle' => "Tirage Classique 10x15cm",
		'format' => '10x15',
		'gamme' => 'Tirage Classique',
		'description' => 'Papier photo prestige',
		'tarif' => 3,
		'delai' => '48 heures'
	),
	array(
		'id' => $i++,
		'code' => '10x15-c',
		'libelle' => "Tirage Classique 10x15cm avec cartonnage",
		'format' => '10x15',
		'gamme' => 'Tirage Classique',
		'description' => 'Papier photo prestige',
		'tarif' => 4,
		'delai' => '48 heures'
	),
	array(
		'id' => $i++,
		'code' => '13x19',
		'libelle' => "Tirage Classique 13x19cm",
		'format' => '13x19',
		'gamme' => 'Tirage Classique',
		'description' => 'Papier photo prestige',
		'tarif' => 5,
		'delai' => '48 heures'
	),
	array(
		'id' => $i++,
		'code' => '13x19-c',
		'libelle' => "Tirage Classique 13x19cm avec cartonnage",
		'format' => '13x19',
		'gamme' => 'Tirage Classique',
		'description' => 'Papier photo prestige',
		'tarif' => 6,
		'delai' => '48 heures'
	),
	array(
		'id' => $i++,
		'code' => '20x30',
		'libelle' => "Tirage Classique 20x30cm",
		'format' => '20x30',
		'gamme' => 'Tirage Classique',
		'description' => 'Papier photo prestige',
		'tarif' => 12,
		'delai' => '48 heures'
	),
	array(
		'id' => $i++,
		'code' => '20x30-c',
		'libelle' => "Tirage Classique 20x30cm avec cartonnage",
		'format' => '20x30',
		'gamme' => 'Tirage Classique',
		'description' => 'Papier photo prestige',
		'tarif' => 15,
		'delai' => '48 heures'
	),
	array(
		'id' => $i++,
		'code' => '30x45',
		'libelle' => "Tirage Classique 30x45cm",
		'format' => '30x45',
		'gamme' => 'Tirage Classique',
		'description' => 'Papier photo prestige',
		'tarif' => 27,
		'delai' => '48 heures'
	),
	array(
		'id' => $i++,
		'code' => '15x21',
		'libelle' => "Tirage Classique 15x21cm",
		'format' => '15x21',
		'gamme' => 'Tirage Classique',
		'description' => 'Papier photo prestige',
		'tarif' => 6,
		'delai' => '48 heures'
	),
	array(
		'id' => $i++,
		'code' => '15x21-c',
		'libelle' => "Tirage Classique 15x21cm avec cartonnage",
		'format' => '15x21',
		'gamme' => 'Tirage Classique',
		'description' => 'Papier photo prestige',
		'tarif' => 8,
		'delai' => '48 heures'
	),
	array(
		'id' => $i++,
		'code' => '15x15',
		'libelle' => "Tirage Classique 15x15cm",
		'format' => '15x15',
		'gamme' => 'Tirage Classique',
		'description' => 'Papier photo prestige',
		'tarif' => 5,
		'delai' => '48 heures'
	),
	array(
		'id' => $i++,
		'code' => '20x20',
		'libelle' => "Tirage Classique 20x20cm",
		'format' => '20x20',
		'gamme' => 'Tirage Classique',
		'description' => 'Papier photo prestige',
		'tarif' => 8,
		'delai' => '48 heures'
	),
	array(
		'id' => $i++,
		'code' => '30x30',
		'libelle' => "Tirage Classique 30x30cm",
		'format' => '30x30',
		'gamme' => 'Tirage Classique',
		'description' => 'Papier photo prestige',
		'tarif' => 18,
		'delai' => '48 heures'
	),
	array(
		'id' => $i++,
		'code' => '40x60',
		'libelle' => "Poster 40x60cm sur papier photo premium brillant",
		'format' => '40x60',
		'gamme' => 'Poster',
		'description' => 'Papier photo premium brillant',
		'tarif' => 36,
		'delai' => '2 semaines'
	),
	array(
		'id' => $i++,
		'code' => '50x75',
		'libelle' => "Poster 50x75cm sur papier photo premium brillant",
		'format' => '50x75',
		'gamme' => 'Poster',
		'description' => 'Papier photo premium brillant',
		'tarif' => 56,
		'delai' => '2 semaines'
	),
	array(
		'id' => $i++,
		'code' => '60x90',
		'libelle' => "Poster 60x90cm sur papier photo premium brillant",
		'format' => '60x90',
		'gamme' => 'Poster',
		'description' => 'Papier photo premium brillant',
		'tarif' => 81,
		'delai' => '2 semaines'
	),
	array(
		'id' => $i++,
		'code' => '20x30',
		'libelle' => "Tirage 'Fine Art' 20x30cm",
		'format' => '20x30',
		'gamme' => "Tirage 'Fine Art'",
		'description' => "Impression haute qualité sur papier d'art",
		'tarif' => 35,
		'delai' => '48 heures'
	),
	array(
		'id' => $i++,
		'code' => '30x45',
		'libelle' => "Tirage 'Fine Art' 30x45cm",
		'format' => '30x45',
		'gamme' => "Tirage 'Fine Art'",
		'description' => "Impression haute qualité sur papier d'art",
		'tarif' => 60,
		'delai' => '48 heures'
	),
	array(
		'id' => $i++,
		'code' => '40x60',
		'libelle' => "Tirage 'Fine Art' 40x60cm",
		'format' => '40x60',
		'gamme' => "Tirage 'Fine Art'",
		'description' => "Impression haute qualité sur papier d'art",
		'tarif' => 85,
		'delai' => '2 semaines'
	),
	array(
		'id' => $i++,
		'code' => '50x75',
		'libelle' => "Tirage 'Fine Art' 50x75cm",
		'format' => '50x75',
		'gamme' => "Tirage 'Fine Art'",
		'description' => "Impression haute qualité sur papier d'art",
		'tarif' => 115,
		'delai' => '2 semaines'
	),
	array(
		'id' => $i++,
		'code' => '60x90',
		'libelle' => "Tirage 'Fine Art' 60x90cm",
		'format' => '60x90',
		'gamme' => "Tirage 'Fine Art'",
		'description' => "Impression haute qualité sur papier d'art",
		'tarif' => 135,
		'delai' => '2 semaines'
	),
	array(
		'id' => $i++,
		'code' => '20x30',
		'libelle' => "Photographie sur toile 20x30cm",
		'format' => '20x30',
		'gamme' => "Photographie sur toile",
		'description' => "Impression haute qualité sur toile",
		'tarif' => 80,
		'delai' => '2 semaines'
	),
	array(
		'id' => $i++,
		'code' => '30x45',
		'libelle' => "Photographie sur toile 30x45cm",
		'format' => '30x45',
		'gamme' => "Photographie sur toile",
		'description' => "Impression haute qualité sur toile",
		'tarif' => 120,
		'delai' => '2 semaines'
	),
	array(
		'id' => $i++,
		'code' => '40x60',
		'libelle' => "Photographie sur toile 40x60cm",
		'format' => '40x60',
		'gamme' => "Photographie sur toile",
		'description' => "Impression haute qualité sur toile",
		'tarif' => 150,
		'delai' => '2 semaines'
	),
	array(
		'id' => $i++,
		'code' => '60x90',
		'libelle' => "Photographie sur toile 60x90cm",
		'format' => '60x90',
		'gamme' => "Photographie sur toile",
		'description' => "Impression haute qualité sur toile",
		'tarif' => 210,
		'delai' => '2 semaines'
	),
	array(
		'id' => $i++,
		'code' => '20x30',
		'libelle' => "Photographie contrecollée sur 'Dibond' 20x30cm",
		'format' => '20x30',
		'gamme' => "Photographie sur 'Dibond'",
		'description' => "Impression haute qualité contrecollée sur 'Dibond'",
		'tarif' => 100,
		'delai' => '2 semaines'
	),
	array(
		'id' => $i++,
		'code' => '30x45',
		'libelle' => "Photographie contrecollée sur 'Dibond' 30x45cm",
		'format' => '30x45',
		'gamme' => "Photographie sur 'Dibond'",
		'description' => "Impression haute qualité contrecollée sur 'Dibond'",
		'tarif' => 150,
		'delai' => '2 semaines'
	),
	array(
		'id' => $i++,
		'code' => '40x60',
		'libelle' => "Photographie contrecollée sur 'Dibond' 40x60cm",
		'format' => '40x60',
		'gamme' => "Photographie sur 'Dibond'",
		'description' => "Impression haute qualité contrecollée sur 'Dibond'",
		'tarif' => 180,
		'delai' => '2 semaines'
	),
	array(
		'id' => $i++,
		'code' => '60x90',
		'libelle' => "Photographie contrecollée sur 'Dibond' 60x90cm",
		'format' => '60x90',
		'gamme' => "Photographie sur 'Dibond'",
		'description' => "Impression haute qualité contrecollée sur 'Dibond'",
		'tarif' => 270,
		'delai' => '2 semaines'
	),
	array(
		'id' => $i++,
		'code' => '20x30',
		'libelle' => "Photographie avec encadrement 20x30cm",
		'format' => '20x30',
		'gamme' => "Photographie avec encadrement",
		'description' => "Impression haute qualité avec encadrement 'Caisse Américaine'",
		'tarif' => 150,
		'delai' => '2 semaines'
	),
	array(
		'id' => $i++,
		'code' => '30x45',
		'libelle' => "Photographie avec encadrement 30x45cm",
		'format' => '30x45',
		'gamme' => "Photographie avec encadrement",
		'description' => "Impression haute qualité avec encadrement 'Caisse Américaine'",
		'tarif' => 230,
		'delai' => '2 semaines'
	),
	array(
		'id' => $i++,
		'code' => '40x60',
		'libelle' => "Photographie avec encadrement 40x60cm",
		'format' => '40x60',
		'gamme' => "Photographie avec encadrement",
		'description' => "Impression haute qualité avec encadrement 'Caisse Américaine'",
		'tarif' => 270,
		'delai' => '2 semaines'
	),
	array(
		'id' => $i++,
		'code' => '60x90',
		'libelle' => "Photographie avec encadrement 60x90cm",
		'format' => '60x90',
		'gamme' => "Photographie avec encadrement",
		'description' => "Impression haute qualité avec encadrement 'Caisse Américaine'",
		'tarif' => 400,
		'delai' => '2 semaines'
	),
);

?>