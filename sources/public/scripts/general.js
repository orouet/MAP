
//
function Eclaircir(id) {
    var element = document.getElementById(id);
    element.style.opacity = '0.80';
}


//
function Assombrir(id) {
    var element = document.getElementById(id);
    element.style.opacity = '1.0';
}


//
function ShowTooltip(evt, mouseovertext) {
    var tooltip = document.getElementById('tooltip');
	var x = evt.clientX + 15;
	var y = evt.clientY + 5;
    tooltip.style.left = '' + x + 'px';
    tooltip.style.top = '' + y + 'px';
    tooltip.firstChild.data = mouseovertext;
	element_montrer(tooltip);
}


//
function HideTooltip(evt) {
    var tooltip = document.getElementById('tooltip');
    element_cacher(tooltip);
}


//
function form_reset(id) {
	var sortie = false;
	if (element = document.getElementById(id)) {
		var selects = element.getElementsByTagName('select');
		for (var i = 0; i < selects.length; i++) {
			selects[i].selectedIndex = 0;
		}
		sortie = true;
	}
	return sortie;
}


//
function element_montrer(element) {
	element.style.display = "block";
	return true;
}


//
function element_cacher(element) {
	element.style.display = "none";
	return true;
}


//
function id_basculer(id) {
	var sortie = false;
	if (element = document.getElementById(id)) {
		if (element.style.display == "block") {
			sortie = element_cacher(element);
		} else {
			sortie = element_montrer(element);
		}
	}
	return sortie;
}

//
function id_cacher(id) {
	var sortie = false;
	if (element = document.getElementById(id)) {
		sortie = element_cacher(element);
	}
	return sortie;
}

//
function id_montrer(id) {
	var sortie = false;
	if (element = document.getElementById(id)) {
		sortie = element_montrer(element);
	}
	return sortie;
}


//
function enfants_masquer(pere_id) {
	var sortie = false;
	if (pere = document.getElementById(pere_id)) {
		if (pere.hasChildNodes()) {
			// alert(pere.id);
			var enfants = pere.childNodes;
			for (var i = 0; i < enfants.length; i++) {
				element = enfants[i];
				// alert('Element : ' + element.id);
				if (element.nodeName == 'div') {
					sortie = element_cacher(element);
				}
			}
		}
	}
	return sortie;
}


//
function enfant_afficher(pere_id, enfant_id) {
	var sortie = false;
	if (pere = document.getElementById(pere_id)) {
		if (pere.hasChildNodes()) {
			// alert(pere.id);
			var enfants = pere.childNodes;
			for (var i = 0; i < enfants.length; i++) {
				element = enfants[i];
				// alert('Element : ' + element.nodeName + '.' + element.id);
				if (element.nodeName == 'div') {
					if (element.id == enfant_id) {
						sortie = element_montrer(element);
					}
				}
			}
		}
	}
	return sortie;
}


//
function onglet_afficher(boite_id, enfant_id) {
	var sortie = false;
	if (boite = document.getElementById(boite_id)) {
		if (boite.hasChildNodes()) {
			// alert(boite.id);
			var enfants = boite.childNodes;
			for (var i = 0; i < enfants.length; i++) {
				element = enfants[i];
				// alert('Element : ' + element.id);
				if (element.nodeName == 'div') {
					// on cherche l'élément contenant les fenetres
					if (element.id == (boite_id + '_F')) {
						// alert('Fenetre : ' + element.id);
						var fenetres = element.childNodes;
						for (var k = 0; k < fenetres.length; k++) {
							fenetre = fenetres[k];
							if (fenetre.nodeName == 'div') {
								// alert(fenetre.id);
								if (fenetre.id == boite_id + '_F' + enfant_id) {
									sortie = element_montrer(fenetre);
								} else {
									sortie = element_cacher(fenetre);
								}
							}
						}
					}
				}
			}
		}
	}
	return sortie;
}


//
function groupe_afficher(boite_id, enfant_id) {
	var sortie = false;
	if (boite = document.getElementById(boite_id)) {
		if (boite.hasChildNodes()) {
			// alert(boite.id);
			var enfants = boite.childNodes;
			for (var i = 0; i < enfants.length; i++) {
				element = enfants[i];
				// alert('Element : ' + element.id);
				if (element.nodeName == 'div') {
					// alert('Fenetre : ' + element.id);
					var fenetres = element.childNodes;
					for (var k = 0; k < fenetres.length; k++) {
						fenetre = fenetres[k];
						if ((fenetre.nodeName == 'div') || (fenetre.nodeName == 'a')){
							// alert(fenetre.id);
							if (fenetre.id == boite_id + '_F' + enfant_id) {
								sortie = element_montrer(fenetre);
							} else {
								sortie = element_cacher(fenetre);
							}
						}
					}
				}
			}
		}
	}
	return sortie;
}


//
function bouton_selectionner(boite_id, enfant_id) {
	var sortie = false;
	if (boite = document.getElementById(boite_id)) {
		var boutons = boite.childNodes;
		for (var j = 0; j < boutons.length; j++) {
			bouton = boutons[j];
			if (bouton.nodeName == 'a') {
				// alert(bouton.id);
				if (bouton.id == enfant_id) {
					bouton.className = "onglet_bouton onglet_bouton_actif";
				} else {
					bouton.className = "onglet_bouton";
				}
			}
		}
	}
	return sortie;
}


//
function appeler_interne(numero, dn, attribut) {
	var fenetre;
	fenetre = window.open("","Appel téléphonique","status=no,toolbar=no,menubar=no,location=no,resizable=yes,width=375,height=150,left=100,top=100");
	fenetre.location.href = "http://192.168.36.109/php-bin/WebClient.php?action=makeCall&calledExt=" + numero + "&calledPersonDn=" + dn + "&calledAttr=" + attribut;
}

//
function appeler_externe(numero) {
	var fenetre;
	fenetre = window.open("","Appel téléphonique","status=no,toolbar=no,menubar=no,location=no,resizable=yes,width=375,height=150,left=100,top=100");
	fenetre.location.href = "http://192.168.36.109/php-bin/WebClient.php?action=makeCall&calledExt=" + numero + "&calledPersonDn=externe&calledAttr=misc1";
}


/* Gestion des panneaux */

//
function panneau_actif(id) {
	sortie = false;
	panneau_id = 'Panneau' + id;
	if (element = document.getElementById(panneau_id)) {
		if (element.style.display == "block") {
			sortie = true;
		}
	}
	return sortie;
}


//
function panneau_afficher(id) {
	sortie = false;
	if (enfants_masquer('Panneaux')) {
		sortie = id_montrer('Panneau' + id);
	}
	return sortie;
}


//
function panneau_basculer(id) {
	sortie = false;
	if (panneau_actif(id)) {
		sortie = panneaux_masquer();
	} else {
		sortie = panneau_afficher(id);
	}
	return sortie;
}

//
function panneau_cacher(id) {
	sortie = false;
	sortie = id_cacher('Panneau' + id);
	return sortie;
}


//
function panneaux_masquer() {
	sortie = false;
	sortie = enfants_masquer('Panneaux');
	return sortie;
}


/* Gestion des menus */

//
function menu_actif(id) {
	sortie = false;
	if (panneau_actif(id)) {
		sortie = true;
	}
	return sortie;
}


//
function menu_basculer(id) {
	sortie = false;
	if (menu_actif(id)) {
		if (enfants_masquer('Panneaux')) {
			if (menus_desactiver()) {
				sortie = panneaux_desactiver();
			}
		}
	} else {
		if (enfants_masquer('Panneaux')) {
			if (menus_desactiver()) {
				sortie = panneaux_desactiver();
			}
		}
		if (menu_activer(id)) {
			sortie = panneau_afficher(id);
		}
	}
	return sortie;
}


//
function menu_activer(id) {
	sortie = false;
	menu_id = 'Menu' + id;
	if (id_montrer('Surcouche')) {
		if (element = document.getElementById(menu_id)) {
			element.className = 'Element CategorieActive';
			sortie = true;
		}
	}
	return sortie;
}

//
function menu_desactiver(id) {
	sortie = false;
	menu_id = 'Menu' + id;
	if (id_cacher('Surcouche')) {
		if (element = document.getElementById(menu_id)) {
			element.className = 'Element Categorie';
			sortie = true;
		}
	}
	return sortie;
}


//
function menus_desactiver() {
	var sortie = false;
	if (id_cacher('Surcouche')) {
		if (pere = document.getElementById('Menus')) {
			if (pere.hasChildNodes()) {
				// alert(pere.id);
				var enfants = pere.childNodes;
				for (var i = 0; i < enfants.length; i++) {
					element = enfants[i];
					// alert('Element : ' + element.id);
					if (element.nodeName == 'div') {
						element.className = 'Element Categorie';
					}
				}
			}
			
		}
	}
	return sortie;
}

/* Gestion des descriptions */

//
function description_cacher(menu_id, description_id) {
	sortie = false;
	defaut_id = 'Menu' + menu_id + 'DescriptionDefaut';
	element_id = 'Menu' + menu_id + 'Description' + description_id;
	if (id_cacher(element_id)) {
		sortie = id_montrer(defaut_id);
	}
	return sortie;
}

//
function description_montrer(menu_id, description_id) {
	sortie = false;
	defaut_id = 'Menu' + menu_id + 'DescriptionDefaut';
	element_id = 'Menu' + menu_id + 'Description' + description_id;
	if (id_cacher(defaut_id)) {
		sortie = id_montrer(element_id);
	}
	return sortie;
}
