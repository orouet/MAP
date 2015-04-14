//
function MAP_imageBasculer(url, data) {

	// alert('debut');
	
	$(document.body).css({ 'cursor': 'wait' });
	
	$.getJSON(url, data, MAP_imageActualiser);
	
	$(document.body).css({ 'cursor': 'default' });
	
	// alert('fin');

}

//
function MAP_imageActualiser(data, textStatus, jqXHR) {

	var image, id, etat, dom_id, dom_class;
	var selections;
	
	image = data['image'];
	// alert(image);
	
	selections = data['selections'];
	// alert(selections);
	
	
	// MAJ de la photo
	id = image['id'];
	// alert(id);
	
	dom_id = '#Photo' + id;
	dom_input = dom_id + '_coche';
	
	etat = image['etat'];
	// alert(etat);
	
	dom_class = 'photo';
	coche = false;
	
	if (etat == true) {
	
		dom_class = 'photo selectionnee';
		coche = true;
	
	}
	
	$(dom_id).attr('class', dom_class);
	$(dom_input).prop('checked', coche);
	
	
	MAP_compteurActualiser(selections);

}

//
function MAP_compteurActualiser(selections) {

	var message;
	
	if (selections == 0) {
	
		message = 'Pas de photo sélectionnée';
	
	} else if (selections == 1) {
	
		message = selections + ' photo sélectionnée';
	
	} else {
	
		message = selections + ' photos sélectionnées';
	
	}
	
	$("#Compteur").text(message);

}

//
function MAP_albumSelections() {

	$("#Album div.photo").css("display", "none");
	$("#Album div.selectionnee").css("display", "block");
	
	$("#Selection").attr("class", "actif");
	$("#SelectionCoche").prop('checked', true);
	
	$("#Tout").attr("class", "");
	$("#ToutCoche").prop('checked', false);

}


//
function MAP_albumTout() {

	$("#Album div.photo").css("display", "block");
	
	$("#Selection").attr("class", "");
	$("#SelectionCoche").prop('checked', false);
	
	$("#Tout").attr("class", "actif");
	$("#ToutCoche").prop('checked', true);

}