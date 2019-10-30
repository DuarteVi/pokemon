vieEnnemie = document.querySelector('div#vieEnnemie');
pokevieEnnemie = document.querySelector('input#pokevieEnnemie');
pokevieMaxEnnemie = document.querySelector('input#pokevieMaxEnnemie');

vieEquipe = document.querySelector('div#vieEquipe');
pokevieEquipe = document.querySelector('input#pokevieEquipe');
pokevieMaxEquipe = document.querySelector('input#pokevieMaxEquipe');

//suite = document.querySelector('div#suite');
//capturer = document.querySelector('form#capturer');
pokeball = document.querySelector('img#fond2');
fond = document.querySelector('div#tout');
fond.style.visibility = "visible";
pokeball.style.visibility = 'hidden';



divBasMenu = document.querySelector('div#partieMenu');
divBasSac = document.querySelector('div#partieSac');
divBasAttaque = document.querySelector('div#partieAttaque');
divBasPokemon = document.querySelector('div#partiePokemon');
divBasPotion = document.querySelector('div#partieSoin');
divBasPokeball = document.querySelector('div#partiePokeball');
divBasTexte = document.querySelector('div#partieTexte');

/* --------------------------------------------------------------------------------------------------------------------- */
function CacherBas(){
	divBasMenu.style.display = "none";
	divBasSac.style.display = "none";
	divBasAttaque.style.display = "none";
	divBasPokemon.style.display = "none";
	divBasPotion.style.display = "none";
	divBasPokeball.style.display = "none";
	divBasTexte.style.display = "none";
}
function AfficherMenu(){
	CacherBas();
	divBasMenu.style.display = "";
}
function AfficherSac(){
	CacherBas();
	divBasSac.style.display = "";
}
function AfficherAttaque(){
	CacherBas();
	divBasAttaque.style.display = "";
}
function AfficherPokemon(){
	CacherBas();
	divBasPokemon.style.display = "";
}
function AfficherPotion(){
	CacherBas();
	divBasPotion.style.display = "";
}
function AfficherPokeball(){
	CacherBas();
	divBasPokeball.style.display = "";
}
function AfficherTexte(){
	CacherBas();
	divBasTexte.style.display = "";
}
CacherBas();

function Fuite(){
	location.href="carte.php";
}
/*function Suite(){
	location.href="safari.php";
}*/

/* --------------------------------------------------------------------------------------------------------------------- */
function BarreDeVie(vie,pokevie,pokevieMax){
	
	sante = (parseInt(pokevie.value)*100)/parseInt(pokevieMax.value);
	vie.style.width= sante + "%";
	if (sante < 30)
	{
		vie.style.backgroundColor = "red";
	}
	else if ( sante < 60)
	{
		vie.style.backgroundColor = "orange";
	}
	else
	{
		vie.style.backgroundColor = "green";
	}

	vie.innerText=parseInt(pokevie.value)+"/"+parseInt(pokevieMax.value);
	//console.log("Vie mise à jour");
}

BarreDeVie(vieEnnemie,pokevieEnnemie,pokevieMaxEnnemie);
BarreDeVie(vieEquipe,pokevieEquipe,pokevieMaxEquipe);

/*function ResteDesPotionsOuNon(numPotion)
{
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_safari.php', true);
	return xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				return xhr.responseText;
			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("ResteDesPotionsOuNon="+numPotion);
	alert(reponse);
	return reponse;
}*/

function Potion(numPotion){
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_safari.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			   	let pv = xhr.responseText;
			   	//alert(xhr.responseText);
			   	//let pv = 0;
			   	//let t = parseInt(pokevieEquipe.value)+parseInt(pv); 
			   	//alert(t);
				pokevieEquipe.value = parseInt(pokevieEquipe.value)+parseInt(pv); 
				BarreDeVie(vieEquipe,pokevieEquipe,pokevieMaxEquipe);

				xhr = new XMLHttpRequest();
				xhr.open('POST','ajax_safari.php', true);
				xhr.addEventListener('readystatechange',
					function() {
						if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
							let reponse = parseInt(xhr.responseText);
							if (reponse > 0)
							{
								let divPotion = document.querySelector('div#normalSoin');
								if (numPotion == 2)
								{
									divPotion = document.querySelector('div#superSoin');
								}
								else if (numPotion == 3)
								{
									divPotion = document.querySelector('div#hyperSoin');
								}
							   	xhr = new XMLHttpRequest();
								xhr.open('POST','ajax_safari.php', true);
								xhr.addEventListener('readystatechange',
									function() {
										if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
											divPotion.innerHTML = xhr.responseText;
											EcrireUtiliserPotion(numPotion);
										}			
								    }
								);
								xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
								xhr.send("SoignerReecrire="+numPotion);
							}
						}
					}
				);
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhr.send("ResteDesPotionsOuNon="+numPotion);
			}			
	    }
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("SoignerQuelleQuantite="+numPotion);
	
}
/* --------------------------------------------------------------------------------------------------------------------- */
function AfficherAttaques(){
	let divAtt = document.querySelector('div#partieAttaque');
	//let pokemon = document.querySelector('input#pokemonChoisie').value;

	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_safari.php', true);

	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			   	divAtt.innerHTML = xhr.responseText;
				//console.log("Attaque utilisée");
			}
	    }
	);

	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("afficherAttaques="+1);
}
AfficherAttaques();

/* --------------------------------------------------------------------------------------------------------------------- */
function AfficherPokemonsRestant(){
	let divPoke = document.querySelector('div#partiePokemon');
	//let pokemon = document.querySelector('input#pokemonChoisie').value;
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_safari.php', true);

	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			   	divPoke.innerHTML = xhr.responseText;
				//console.log("Attaque utilisée");
			}
	    }
	);

	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("afficherPokemonsRestant="+1);
}
AfficherPokemonsRestant();

/* --------------------------------------------------------------------------------------------------------------------- */
function PokemonChoisie(pokemon){
	let divPokeChoisi = document.querySelector('div#pokemonEquipeDiv');
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_safari.php', true);

	EcrirePokemonSeRetire();

	setTimeout(function(){
		xhr.addEventListener('readystatechange',
			function() {
				if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				   	divPokeChoisi.innerHTML = xhr.responseText;
					console.log("Pokemon Changé");
					AfficherPokemonsRestant();
					AfficherAttaques();

					let vieEq = document.querySelector('div#vieEquipe');
					let pokevieEq = document.querySelector('input#pokevieEquipe');
					let pokevieMaxEq = document.querySelector('input#pokevieMaxEquipe');

					vieEquipe = vieEq;
					pokevieEquipe = pokevieEq;
					pokevieMaxEquipe = pokevieMaxEq;

					BarreDeVie(vieEquipe,pokevieEquipe,pokevieMaxEquipe);

					EcrirePokemonRentreAuCombat();
				}
		    }
		);

		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("PokemonChoisie="+pokemon);
	}, 2000);
}
//	PokemonChoisie(document.querySelector('input#pokemonChoisie').value);

/* --------------------------------------------------------------------------------------------------------------------- */
function ResultatAttraperPokemon(resultat)
{
	if (resultat == 1)
	{
		alert('Capture réussite !!');
		fond.style.visibility = "visible";
		pokeball.style.visibility = "hidden"; 
		//capturer.submit();

		let xhr = new XMLHttpRequest();

		xhr.open('POST','ajax_safari.php', true);

		xhr.addEventListener('readystatechange',
			function() {
				if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				 //	EcrireMessage( xhr.responseText);
					console.log("Capture réussite");				    					    	
				}			
		    }
		);
		//alert(numBall);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("CaptureReussite="+1);
		//alert('stop');
		location.href="safariCapture.php";
	}
	else
	{
		fond.style.visibility = "visible";
		pokeball.style.visibility = "hidden"; 
		EcrirePokemonSortDeLaPokeball();
	}
}

function EssayerAttraperPokemon(numBall){
	let proba = 25 * numBall;

	/*fond.style.visibility = "hidden";
	pokeball.style.visibility = "visible";*/
	//let resultat = Math.floor(Math.random() * 100);
	
	
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_safari.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			   	let resultat = xhr.responseText;
				//console.log("pokeball lancé");
				//alert(resultat);
				EcrireUtilisationPokeball(numBall);
				setTimeout(function(){
										fond.style.visibility = "hidden";
										pokeball.style.visibility = "visible";
										setTimeout(function(){ResultatAttraperPokemon(resultat);}, 3000);
									}, 2000);
				//setTimeout(ResultatAttraperPokemon(resultat),500000);
			}			
	    }
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("EssayerAttraperPokemon="+numBall);			

}

/* --------------------------------------------------------------------------------------------------------------------- */
function LancerPokeball(numBall){
	
	//let nbpokeball = document.querySelector("input#pokeball"+numBall).value;

	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_safari.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				let nbpokeball = parseInt(xhr.responseText);

				let divBall = document.querySelector('div#normalBall');
				if (numBall == 2)
				{
					divBall = document.querySelector('div#superBall');
				}
				else if (numBall == 3)
				{
					divBall = document.querySelector('div#hyperBall');
				}

				//alert(nbpokeball);
				if (nbpokeball > 0)
				{

					xhr = new XMLHttpRequest();
					
					xhr.open('POST','ajax_safari.php', true);

					xhr.addEventListener('readystatechange',
						function() {
							if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
							   	divBall.innerHTML = xhr.responseText;
								//console.log("Le soin a bien été effectué");
								EssayerAttraperPokemon(numBall);
							}			
					    }
					);
					//alert(numBall);
					xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					xhr.send("LancerPokeball="+1+"&numBall="+numBall);

					
				}			
	  		}
	  	}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("PreLancerPokeball="+numBall);			
}
	//capturer.submit();

//suite.onclick = Suite;
//attraper.onclick = Attraper;
