var getAttaquePremier = 0;

function GetAttaquePremier(){
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combatTexte.php', true);

	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			   	getAttaquePremier = parseInt(xhr.responseText);
			}
	    }
	);

	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("GetAttaquePremier="+1);
}

var getViePokemonChoisie = 1;
function GetViePokemonChoisie(){
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combatTexte.php', true);

	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			   	getViePokemonChoisie = parseInt(xhr.responseText);
			}
	    }
	);

	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("GetViePokemonChoisie="+1);
}

var getViePokemonApparu = 1;
function GetViePokemonApparu(){
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combatTexte.php', true);

	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			   	getViePokemonApparu = parseInt(xhr.responseText);
			}
	    }
	);

	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("getViePokemonApparu="+1);
}


/* ----------------------------------------------------------------------------------------------------------------------- */
/*-- PARTIE ATTAQUE -- */
function LancerAttaqueBis(divAttaque,numeroAttaque)
{
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_safari.php', true);

	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			   	divAttaque.innerHTML = xhr.responseText;
				console.log("Attaque utilisée");	
				EcrireAttaqueUtilise(numeroAttaque);
			}
	    }
	);

	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("LancerAtt="+numeroAttaque);
}

function LancerAttaque(numeroAttaque)
{
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_safari.php', true);

	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			   	let NbDePp = parseInt(xhr.responseText);

			   	if ( NbDePp > 0 )
			   	{
			   		GetAttaquePremier();
			   		setTimeout(function(){
			   			if ( getAttaquePremier == 1 )
			   			{
					   		if ( numeroAttaque == 0 ){ 
								LancerAttaqueBis(document.querySelector('div#attaque0'),numeroAttaque);
							}
							if ( numeroAttaque == 1 ){ 
								LancerAttaqueBis(document.querySelector('div#attaque1'),numeroAttaque);
							}
							if ( numeroAttaque == 2 ){ 
								LancerAttaqueBis(document.querySelector('div#attaque2'),numeroAttaque);
							}
							if ( numeroAttaque == 3 ){
								LancerAttaqueBis(document.querySelector('div#attaque3'),numeroAttaque);
							}
							setTimeout(function(){
													PokemonApparuMort();
													setTimeout(function(){
														if (getViePokemonApparu > 0)
														{
															CombatDegatAvC();
															setTimeout(function(){
																GetViePokemonChoisie();
																setTimeout(function(){
																	if (getViePokemonChoisie > 0)
																	{
																		AfficherMenu();
																	}
																	else
																	{
																		ChoisirPokemonSurvivant();
																	}
																	
																},2000);
															},2000);
														}
													}
													,2000);
												},2000);
						}
						else
						{
							CombatDegatAvC();
							setTimeout(function(){
								GetViePokemonChoisie();
									setTimeout(function(){
							   			if ( getViePokemonChoisie > 0 )
							   			{
											if ( numeroAttaque == 0 ){ 
												LancerAttaqueBis(document.querySelector('div#attaque0'),numeroAttaque);
											}
											if ( numeroAttaque == 1 ){ 
												LancerAttaqueBis(document.querySelector('div#attaque1'),numeroAttaque);
											}
											if ( numeroAttaque == 2 ){ 
												LancerAttaqueBis(document.querySelector('div#attaque2'),numeroAttaque);
											}
											if ( numeroAttaque == 3 ){
												LancerAttaqueBis(document.querySelector('div#attaque3'),numeroAttaque);
											}
											setTimeout(AfficherMenu,2000);
										}
										else
										{
											ChoisirPokemonSurvivant();
										}
									},2000);
							},2000);
						}

					},1000);
			   	}
			}
	    }
	);

	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("LancerAttOuiOuNon="+numeroAttaque);
}


/* ----------------------------------------------------------------------------------------------------------------------- */
/* -- PARTIE MESSAGE -- */
function EcrireMessage(message)
{
	divBasTexte.innerHTML = message;
	AfficherTexte();
}

function EcrireUtiliserPotion(numPotion)
{
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combatTexte.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				EcrireMessage(xhr.responseText);
			}			
	    }
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("EcrireUtiliserPotion="+numPotion);

	//setTimeout(AfficherMenu,2000);
	setTimeout(function(){
		CombatDegatAvC();
		setTimeout(function(){GetViePokemonChoisie();},3000)
		},2000);
	setTimeout(function(){	if ( getViePokemonChoisie == 0 )
							{
								ChoisirPokemonSurvivant();
							}
							else
							{
								AfficherMenu();
							}
	},6000);
	//setTimeout(AfficherMenu,4000);
}
function EcrireUtilisationPokeball(numBall)
{
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combatTexte.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				EcrireMessage(xhr.responseText);
			}			
	    }
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("EcrireUtilisationPokeball="+numBall);

	setTimeout(AfficherMenu,2000);
}
function EcrirePokemonSeRetire()
{
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combatTexte.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				EcrireMessage(xhr.responseText);
			}			
	    }
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("EcrirePokemonSeRetire="+1);
}
function EcrirePokemonRentreAuCombat()
{
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combatTexte.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				EcrireMessage(xhr.responseText);
			}			
	    }
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("EcrirePokemonRentreAuCombat="+1);

	
	setTimeout(function(){
		CombatDegatAvC();
		setTimeout(function(){GetViePokemonChoisie();},3000)
		},2000);
	setTimeout(function(){	if ( getViePokemonChoisie == 0 )
							{

								ChoisirPokemonSurvivant();
							}
							else
							{

								AfficherMenu();
							}
	},6000);
}

function EcrireAttaqueUtilise(numeroAttaque)
{
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combatTexte.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				EcrireMessage(xhr.responseText);
				setTimeout(function(){CombatDegatCvA(numeroAttaque);},1000);
			}			
	    }
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("EcrireAttaqueUtilise="+numeroAttaque);

	//FaireClignoterPokemonApparu();
	//setTimeout(AfficherMenu,4000);
}
function EcrirePokemonSortDeLaPokeball()
{
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combatTexte.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				EcrireMessage(xhr.responseText);
			}			
	    }
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("EcrirePokemonSortDeLaPokeball="+1);

	//setTimeout(AfficherMenu,2000);
	setTimeout(function(){
		CombatDegatAvC();
		setTimeout(function(){GetViePokemonChoisie();},3000)
		},2000);
	setTimeout(function(){	if ( getViePokemonChoisie == 0 )
							{
								ChoisirPokemonSurvivant();
							}
							else
							{
								AfficherMenu();
							}
	},6000);
}



/* ----------------------------------------------------------------------------------------------------------------------- */
/*-- PARTIE CLIGNOTEMENT -- */
function FaireClignoterPokemonApparu()
{
	let pokemon = document.querySelector('img#imgPokemonApparu');

	let variable = 1;

	let clignotement = setInterval(function(){
										variable = variable * (-1);
										if (variable > 0)
										{
											pokemon.style.visibility = "visible";
										}
										else
										{
											pokemon.style.visibility = "hidden";
										}

										},100);

	setTimeout(function(){clearInterval(clignotement);
							pokemon.style.visibility = "visible";
						},1000);
}

function FaireClignoterPokemonChoisi()
{
	let pokemon = document.querySelector('img#imgPokemonChoisi');
	let variable = 1;

	let clignotement = setInterval(function(){
										variable = variable * (-1);
										if (variable > 0)
										{
											pokemon.style.visibility = "visible";
										}
										else
										{
											pokemon.style.visibility = "hidden";
										}

										},100);

	setTimeout(function(){clearInterval(clignotement);
							pokemon.style.visibility = "visible";
						},1000);
}



/* ----------------------------------------------------------------------------------------------------------------------- */
/* -- MESSAGES DU DEBUT -- */
function Debut()
{
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combatTexte.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			   	EcrireMessage(xhr.responseText);
			}			
	    }
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("messageDebut1="+1);

	setTimeout(function(){
							let xhr = new XMLHttpRequest();
							xhr.open('POST','ajax_combatTexte.php', true);
							xhr.addEventListener('readystatechange',
								function() {
									if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
									   	EcrireMessage(xhr.responseText);
									   	setTimeout(AfficherMenu,1000);
									}			
							    }
							);
							xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
							xhr.send("messageDebut2="+1);
						}, 1000);
	


}
Debut();



/* ----------------------------------------------------------------------------------------------------------------------- */
/*-- PARTIE TOUR PAR TOUR -- */
function Action(action,donnee)
{
	if (action == 1) // Prendre une potion
	{
		Potion(donnee); 			//Potion(numPotion);
	}
	else if (action == 2) // Lancer une pokeball
	{
		LancerPokeball(donnee);		//LancerPokeball(numBall);
	}
	else if (action == 3) // Faire une attaque
	{			
		LancerAttaque(donnee);		//LancerAttaque(numeroAttaque);
	}
	else if (action == 4) // Changer de Pokemon
	{
		PokemonChoisie(donnee);		//PokemonChoisie(pokemon);
	}
}


/* ----------------------------------------------------------------------------------------------------------------------- */





function CombatDegatCvA(attaque){

	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combatTexte.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				EcrireMessage(xhr.responseText);
				FaireClignoterPokemonApparu();

				xhr = new XMLHttpRequest();
				xhr.open('POST','ajax_combatTexte.php', true);
				xhr.addEventListener('readystatechange',
					function() {
						if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
							//alert('test');
							//EcrireMessage(xhr.responseText);
							pokevieEnnemie.value = parseInt(xhr.responseText);
							BarreDeVie(vieEnnemie,pokevieEnnemie,pokevieMaxEnnemie);
							PokemonApparuMort();
							
						}			
				    }
				);
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhr.send("GetViePA="+1);
			}			
	    }
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("CombatDegatCvA="+attaque);
}

function PokemonApparuMort()
{
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combatTexte.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				let vie = parseInt(xhr.responseText);
				getViePokemonApparu = vie;
				if (vie == 0)
				{
					xhr = new XMLHttpRequest();
					xhr.open('POST','ajax_combatTexte.php', true);
					xhr.addEventListener('readystatechange',
						function() {
							if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
								let gain = xhr.responseText;
								EcrireMessage("Le pokemon sauvage a été vaincu");
								setTimeout(function(){EcrireMessage(xhr.responseText);},1000);
								setTimeout(function(){
									//EvolutionOuNon(1);
									/*while (Evolution(2)){}
									while (Evolution(3)){}
									while (Evolution(4)){}
									while (Evolution(5)){}
									while (Evolution(6)){}*/
									location.href="safariCapture.php";
									//EcrireMessage(xhr.responseText);
									//alert(xhr.responseText);
									},3000);		
							}
						}
					);
					xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					xhr.send("PokemonApparuVaincu="+1);
				}
				
			}
		}	
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("GetViePA="+1);
}
/*
function EvolutionOuNon(valeur){
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combatTexte.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				let evo = parseInt(xhr.responseText);
				if ( evo == 1 )
				{
					Evolution(valeur);
				}
			}
		}	
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("EvolutionOuNon="+valeur);
}

function Evolution(valeur)
{
	if (confirm('test'))
	{
		alert('ok');
	}
}*/

function CombatDegatAvC(){

	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combatTexte.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				attaqueEnnemi = parseInt(xhr.responseText);

				
				xhr = new XMLHttpRequest();
				xhr.open('POST','ajax_combatTexte.php', true);
				xhr.addEventListener('readystatechange',
					function() {
						if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
							EcrireMessage(xhr.responseText);
						}			
	    			}
				);
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhr.send("CombatDegatAvCBis="+attaqueEnnemi);



				setTimeout(function(){

					let xhr = new XMLHttpRequest();
					xhr.open('POST','ajax_combatTexte.php', true);
					xhr.addEventListener('readystatechange',
						function() {
							if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
								EcrireMessage(xhr.responseText);

								FaireClignoterPokemonChoisi();

								xhr = new XMLHttpRequest();
								xhr.open('POST','ajax_combatTexte.php', true);
								xhr.addEventListener('readystatechange',
									function() {
										if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
											//alert('test');
											//EcrireMessage(xhr.responseText);
											pokevieEquipe.value = parseInt(xhr.responseText);
											BarreDeVie(vieEquipe,pokevieEquipe,pokevieMaxEquipe);
										}			
								    }
								);
								xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
								xhr.send("GetViePC="+1);
							}			
		    			}
					);
					xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					xhr.send("CombatDegatAvCTer="+attaqueEnnemi);


					

				},1000)

			}			
	    }
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("CombatDegatAvC="+1);

}

var nbPokemonEnVie=1;
function NbPokemonEnVie(){
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combatTexte.php', true);

	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			   	nbPokemonEnVie = parseInt(xhr.responseText);
			}
	    }
	);

	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("NbPokemonEnVie="+1);
}

function ChoisirPokemonSurvivant(){
	NbPokemonEnVie();
	setTimeout(function(){
		if (nbPokemonEnVie > 0)
		{
			ChoisirPokemonSurvivantBis();
		}
		else
		{
			location.href="centrepokemon.php";
		}
	},500);
}

function ChoisirPokemonSurvivantBis(){
	let divPoke = document.querySelector('div#partiePokemon');
	//let pokemon = document.querySelector('input#pokemonChoisie').value;
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combatTexte.php', true);

	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			   	divPoke.innerHTML = xhr.responseText;
				//console.log("Attaque utilisée");
				AfficherPokemon();
			}
	    }
	);

	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("ChoisirPokemonSurvivantBis="+1);
}
/*
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
*/