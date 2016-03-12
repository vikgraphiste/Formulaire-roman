// Function aimed to initialize localStorage for each elements

// Ajout d'une fonction au prototype 'Array'
Array.prototype.isEmpty = function() {
	return((this.length == 0) ? true : false);
};


function initialisation() {

	// if(localStorage.getItem('genre') == 'f') {
	// 	checkbox_f.checked = true;
	// 	madame.style.backgroundImage = "url('interface/icon-formulaire-checked.svg')";
	// }
	//
	// else if(localStorage.getItem('genre') == 'h') {
	// 	checkbox_h.checked = true;
	// 	monsieur.style.backgroundImage = "url('interface/icon-formulaire-checked.svg')";
	// }

	if(gotTheNoSaveClass(champ_nom).isEmpty()) {
		champ_nom.value = localStorage.getItem('nom');
	}
	else {
		localStorage.removeItem('nom');
	}

	if(gotTheNoSaveClass(champ_email).isEmpty()) {
		champ_email.value = localStorage.getItem('email');
	}
	else {
		localStorage.removeItem('email');
	}

	if(gotTheNoSaveClass(champ_message).isEmpty()) {
		champ_message.value = localStorage.getItem('message');
	}
	else {
		localStorage.removeItem('message');
	}

	if(gotTheNoSaveClass(champ_age).isEmpty()) {
		champ_age.value = localStorage.getItem('age');
	}
	else {
		localStorage.removeItem('age');
	}

	if(gotTheNoSaveClass(champ_departement).isEmpty()) {
		champ_departement.value = localStorage.getItem('departement');
	}
	else {
		localStorage.removeItem('departement');
	}
}

function gotTheNoSaveClass(element) {
	var search = function(el) {
		return el === 'no_save';
	};

	return element.className.split(' ').filter(search);
}


var checkbox_h        = document.getElementById('h');
var checkbox_f        = document.getElementById('f');
var champ_nom         = document.getElementById('nom');
var champ_email       = document.getElementById('email');
var champ_message     = document.getElementById('message');
var champ_age         = document.getElementById('age');
var champ_departement = document.getElementById('departement');
var bouton_envoyer    = document.getElementById('envoyer');

/* Référence sur les spans dont il faut modifier les backgrounds*/
var monsieur   = document.getElementById("monsieur"); // span Mr.
var madame     = document.getElementById("madame");	  // span "Mlle."

var piecejointe = document.getElementById('realfile'); // Référence au bouton de fichier


//initialization of elements gettings
initialisation();


/*********** EVENT LISTENER FOR INPUT ELEMENTS *************/
checkbox_h.addEventListener('click', function() {
	monsieur.style.backgroundImage = "url('interface/icon-formulaire-checked.svg')";
	madame.style.backgroundImage   = "url('interface/icon-formulaire-empty.svg')";
	// if(localStorage.getItem('genre') != 'h')
	// 	localStorage.setItem('genre', 'h');
});

checkbox_f.addEventListener('click', function() {
	madame.style.backgroundImage   = "url('interface/icon-formulaire-checked.svg')";
	monsieur.style.backgroundImage = "url('interface/icon-formulaire-empty.svg')";
	// if(localStorage.getItem('genre') != 'f')
	// 	localStorage.setItem('genre', 'f');
});

piecejointe.addEventListener('change',function() {

	var LENGTH_LIMIT = 20;
	var fileField = document.getElementById('fakefile');
	var fileName = this.files[0].name.split('.')[0];
	if(fileName.length > LENGTH_LIMIT) {
		var extension = this.files[0].name.split('.')[1];
		var strReplace = fileName.substr(LENGTH_LIMIT);
		var newFileName = fileName.replace(strReplace, '...') + extension;
		fileField.value = newFileName;
	}
	else {
		fileField.value = this.files[0].name;
	}
});

champ_nom.addEventListener('input', function() {
  localStorage.setItem('nom', this.value);
});

champ_email.addEventListener('input', function() {
  localStorage.setItem('email', this.value);
});

champ_message.addEventListener('input', function() {
  localStorage.setItem('message', this.value);
});

champ_age.addEventListener('change', function() {
  localStorage.setItem('age', this.value);
});

champ_departement.addEventListener('change', function() {
  localStorage.setItem('departement', this.value);
});

bouton_envoyer.addEventListener('click', function() {
	var progressBarSending = document.getElementById('progressBarSending');
	progressBarSending.style.display = 'block';
});

/*******************************************************/
