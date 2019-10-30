function RetourMenu(){
	location.href="menu.php";
}

function ordi_afficher_equipe(){
	let xhr = new XMLHttpRequest();
	let div = document.querySelector('div#eqPokemon');

	//xhr.open('POST','ajax_ordi_AffEquipe.php', true);
	xhr.open('POST','ajax_ordinateur.php', true);

	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			   	div.innerHTML = xhr.responseText;
				//console.log("Equipe modifiée");				    					    	
			}			
	    }
	);

	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("AffEquipe="+1);
}

function ordi_afficher_ordinateur(){
	let xhr = new XMLHttpRequest();
	let div = document.querySelector('div#ordinateur');

	//xhr.open('POST','ajax_ordi_AffOrdinateur.php', true);
	xhr.open('POST','ajax_ordinateur.php', true);

	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			   	div.innerHTML = xhr.responseText;
				//console.log("Equipe modifiée");				    					    	
			}			
	    }
	);

	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("affOrdi="+1);
}

function ordi_info_pokemon($numero){
	let xhr = new XMLHttpRequest();
	let div = document.querySelector('div#InfoPokemon');

	//xhr.open('POST','ajax_ordi_info.php', true);
	xhr.open('POST','ajax_ordinateur.php', true);

	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			   	div.innerHTML = xhr.responseText;
				//console.log("Le soin a bien été effectué");				    					    	
			}			
	    }
	);

	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("infoPoke="+$numero);
}

function ordi_monter_pokemon($numero){
	let xhr = new XMLHttpRequest();
	//let div = document.querySelector('div#eqPokemon');

	//xhr.open('POST','ajax_ordi_monter.php', true);
	xhr.open('POST','ajax_ordinateur.php', true);

	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			   	//div.innerHTML = xhr.responseText;
				console.log("Pokémon monté");				    					    	
			}

			ordi_afficher_equipe();			
	    }
	);

	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("pokmonter="+$numero);
}

function ordi_descendre_pokemon($numero){
	let xhr = new XMLHttpRequest();
	//let div = document.querySelector('div#eqPokemon');

	//xhr.open('POST','ajax_ordi_descendre.php', true);
	xhr.open('POST','ajax_ordinateur.php', true);

	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			   	//div.innerHTML = xhr.responseText;
				console.log("Pokémon descendu");				    					    	
			}			

			ordi_afficher_equipe();		
	    }
	);

	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("pokdescendre="+$numero);
}

function ordi_pokOrdiEquipe($numero){
	let xhr = new XMLHttpRequest();
	//let div = document.querySelector('div#eqPokemon');

	//xhr.open('POST','ajax_ordi_action_Ordi_vers_Equipe.php', true);
	xhr.open('POST','ajax_ordinateur.php', true);

	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			   	//div.innerHTML = xhr.responseText;
				console.log("Pokémon Transféré dans l'équipe");				    					    	
			}			

			ordi_afficher_equipe();
			ordi_afficher_ordinateur();
	    }
	);

	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("pokOrdiEquipe="+$numero);
}

function ordi_pokEquipeOrdi($numero){
	let xhr = new XMLHttpRequest();
	//let div = document.querySelector('div#InfoPokemon');


	//xhr.open('POST','ajax_ordi_action_Equipe_vers_Ordi.php', true);
	xhr.open('POST','ajax_ordinateur.php', true);

	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			   	//div.innerHTML = xhr.responseText;
				console.log("Pokémon Transféré dans l'ordinateur");				    					    	
			}			

			ordi_afficher_equipe();
			ordi_afficher_ordinateur();
	    }
	);

	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("pokEquipeOrdi="+$numero);
}

function ordi_Liberer($numero){
	if (confirm('Voulez vraiment vous séparer de ce pokémon ?'))
	{
		let xhr = new XMLHttpRequest();
		//let div = document.querySelector('div#InfoPokemon');


		//xhr.open('POST','ajax_ordi_action_Equipe_vers_Ordi.php', true);
		xhr.open('POST','ajax_ordinateur.php', true);

		xhr.addEventListener('readystatechange',
			function() {
				if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				   	//div.innerHTML = xhr.responseText;
					console.log("Pokémon a bien été libéré");				    					    	
				}			

				ordi_afficher_ordinateur();
		    }
		);

		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("libérer="+$numero);
	}
}

function ChangerSurnom(pokemon) {
	let nvNom = document.querySelector('input#changerSurnom').value;
	let xhr = new XMLHttpRequest();
	if (nvNom)
	{				
		xhr.open('POST','ajax_ordinateur.php', true);
		xhr.addEventListener('readystatechange',
			function() {
				if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
					console.log("Surnom Pokémon changé");
					ordi_info_pokemon(pokemon);
					ordi_afficher_equipe();
					ordi_afficher_ordinateur();
					alert('Surnom mis à jour');
				}

				ordi_afficher_ordinateur();
		    }
		);

		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("ChangerSurnom="+nvNom+"&ChangerSurnomPokemon="+pokemon);
	}
	else
	{
		alert('Vous devez lui donner un surnom');
	}
}

function ChangerAttaquePreciser(pokemon,numero,nvAttaque)
{
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_ordinateur.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				ordi_info_pokemon(pokemon);
				ordi_afficher_equipe();
				ordi_afficher_ordinateur();
				/*let div = document.querySelector('div#ordinateur');
				div.innerHTML = xhr.responseText;*/

			}
	    }
	);

	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("ChangerAttaquePreciser="+numero+"&ChangerAttaquePreciserPokemon="+pokemon+"&ChangerAttaquePreciserNvAttaque="+nvAttaque);
}

function ChangerAttaqueSuppression(pokemon,numero)
{
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_ordinateur.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				ordi_info_pokemon(pokemon);
				ordi_afficher_equipe();
				ordi_afficher_ordinateur();
				/*let div = document.querySelector('div#ordinateur');
				div.innerHTML = xhr.responseText;*/

			}
	    }
	);

	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("ChangerAttaqueSuppression="+numero+"&ChangerAttaqueSuppressionPokemon="+pokemon);
}

function ChangerAttaque(pokemon,numero)
{
	let div = document.querySelector('div#ordinateur');
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_ordinateur.php', true);
		xhr.addEventListener('readystatechange',
			function() {
				if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
					ordi_info_pokemon(pokemon);
					ordi_afficher_equipe();
					div.innerHTML = xhr.responseText;
				}
		    }
		);

		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("ChangerAttaque="+numero+"&ChangerAttaquePokemon="+pokemon);
}

ordi_afficher_ordinateur();
ordi_afficher_equipe();