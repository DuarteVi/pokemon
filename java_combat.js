/* -------------------------------------------------------------------------------------------------------------------------------------------- */

//Action d'un joueur pour que l'autre sache ce qu'il fait

//ACTION 1: potion
//ACTION 2: super potion
//ACTION 3: hyper potion
//ACTION 4: attaque 1
//ACTION 5: attaque 2
//ACTION 6: attaque 3
//ACTION 7: attaque 4
//ACTION 8: pokemon 1
//ACTION 9: pokemon 2
//ACTION 10: pokemon 3
//ACTION 11: pokemon 4
//ACTION 12: pokemon 5
//ACTION 13: pokemon 6
//ACTION 14:ABANDONNER ou PAGE QUITTé
//ACTION 15: PASSER SON TOUR
//ACTION 16: CHOISIR UN NOUVEAU POKEMON APRèS LA MORT D'UN
//ACTION 17:
//ACTION 18: FAIRE RECHARGEMENT DE PAGE SANS ENTRER LA VALEUR 14 (SIGNIFIANT QUITTER)

var vieEnnemie = document.querySelector('div#vieEnnemie');
var pokevieEnnemie = document.querySelector('input#pokevieEnnemie');
var pokevieMaxEnnemie = document.querySelector('input#pokevieMaxEnnemie');

var vieEquipe = document.querySelector('div#vieEquipe');
var pokevieEquipe = document.querySelector('input#pokevieEquipe');
var pokevieMaxEquipe = document.querySelector('input#pokevieMaxEquipe');

divPokemonMoi = document.querySelector('div#pokemonMoi');
divPokemonAdversaire = document.querySelector('div#pokemonAdversaire');

divBasMenu = document.querySelector('div#PartieMenu');
divBasSoin = document.querySelector('div#PartieSoin');
divBasAttaque = document.querySelector('div#PartieAttaque');
divBasPokemon = document.querySelector('div#PartiePokemon');
divBasTexte = document.querySelector('div#partieTexte');

divTemps = document.querySelector('div#temps');
var temps = 100;

var actionMoi = 1;
var actionAdversaire = 1;
var actionAdversaireEffectuer = 0;

var vitesseMoi = 0;
var vitesseAdversaire = 0;
var vieMoi = 1;
var vieAdversaire = 1;

var nombrePokemonEncoreEnVieMoi = 1;
var nombrePokemonEncoreEnVieAdversaire = 1;

var getpokemonAdversaire = 0;

var actionPossibleMoi = 1;
var actionPossibleAdversaire = 1;

var joueurMoi = 0;

/* --------------------------------------------------------------------------------------------------------------------------------------------- */
/* LE TEMPS */
function AfficherChrono(){
	divTemps.style.width = temps+"%";
	if (temps < 10)
	{
		divTemps.style.backgroundColor = "red";
	}
	else if ( temps < 30)
	{
		divTemps.style.backgroundColor = "orange";
	}
	else
	{
		divTemps.style.backgroundColor = "green";
	}
}

AfficherChrono();
var chrono=setInterval(Chrono,18.75);	
var toursuivant;
var ActionAdverseOuNon;

function Chrono(){
	temps = temps - 0.125 ;
	AfficherChrono();
	if (temps <= 0)
	{
		clearInterval(chrono);
		SetActionMoi(15);
		TourSuivantVerification();
	}
}

//SetActionMoi(0); // On initialise
//SetActionAversaire(0);




/* --------------------------------------------------------------------------------------------------------------------------------------------- */
/* GESTION AFFICHAGE BAS */
function CacherBas(){
	divBasMenu.style.display = "none";
	divBasAttaque.style.display = "none";
	divBasPokemon.style.display = "none";
	divBasSoin.style.display = "none";
	divBasTexte.style.display = "none";
}
function AfficherMenu(){
	CacherBas();
	divBasMenu.style.display = "";
}
function AfficherAttaque(){
	AttaqueAffichageAjax();
	CacherBas();
	divBasAttaque.style.display = "";
}
function AfficherPokemon(){
	PokemonAffichageAjax();
	CacherBas();
	divBasPokemon.style.display = "";
}
function AfficherSoin(){
	PotionAffichageAjax();
	CacherBas();
	divBasSoin.style.display = "";
}
function AfficherTexte(){
	CacherBas();
	divBasTexte.style.display = "";
}
AfficherMenu();

function EcrireMessage(message)
{
	divBasTexte.innerHTML = message;
	AfficherTexte();
}

/* ----------------------------------------------------------------------------------------------------------------------- */
/*-- PARTIE CLIGNOTEMENT -- */
function FaireClignoterPokemonAdversaire()
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

function FaireClignoterPokemonMoi()
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


/* --------------------------------------------------------------------------------------------------------------------------------------------- */
/* Fonction Utile */
function GetActionAdversaire(){
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combat.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				actionAdversaire = parseInt(xhr.responseText);
				//alert(parseInt(xhr.responseText));
				//alert(actionAdversaire);
			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("GetActionAdversaire="+1);
}
function GetpokemonAdversaire(){
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combat.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				getpokemonAdversaire = parseInt(xhr.responseText);
				//alert(parseInt(xhr.responseText));
				//alert(actionAdversaire);
			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("GetpokemonAdversaire="+1);
}

function EcrireRecompense(){
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combat.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				EcrireMessage(xhr.responseText);
			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("EcrireRecompense="+1);
}

function SetActionMoi(valeur){
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combat.php', true);
		xhr.addEventListener('readystatechange',
			function() {
				if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
					//alert(xhr.responseText);
					console.log("Action "+valeur+" effectuée");	
					actionMoi = valeur;
				}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("SetActionMoi="+valeur);
}
function SetActionAversaire(valeur){
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combat.php', true);
		xhr.addEventListener('readystatechange',
			function() {
				if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
					//alert(xhr.responseText);
					console.log("Action adverse "+valeur+" effectuée");	
				}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("SetActionAversaire="+valeur);
}

function Abandonner(){
	if (confirm("Voulez-vous vraiment abandonner ?\n(Vous perdrez de l'argents)"))
	{
		SetActionMoi(14);		
		QuitterPage();
		setTimeout(function(){location.href="choisiradversaire.php";},500);
	}
}

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

function QuitterPage(){
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combat.php', true);
		xhr.addEventListener('readystatechange',
			function() {
				if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
					//alert(xhr.responseText);
					console.log("Page Quitté");	
				}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("QuitterPage="+1);
}
window.onbeforeunload = function (){QuitterPage()};

function JoueurMoi() //Savoir si on est j1 ou j2 en cas de vitesse de pokemon égal
{
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combat.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				joueurMoi = parseInt(xhr.responseText);	
			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("JoueurMoi="+1);
}
JoueurMoi();


function SetPokemonMoi(valeur){
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combat.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				console.log("PokemonMoi mis à jour")
			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("SetPokemonMoi="+valeur);
}

function SetPokemonAdversaire(valeur){
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combat.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				console.log("PokemonAdversaire mis à jour")
			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("SetPokemonAdversaire="+valeur);
}


/* --------------------------------------------------------------------------------------------------------------------------------------------- */
/* TOUR SUIVANT */
function TourSuivantVerification(){
	ActionAdversaire();
	ActionAdverseOuNon = setInterval(function(){ActionAdversaire();},500);
}
function TourSuivant()
{
	GetActionAdversaire();
	setTimeout(function(){
		if (actionAdversaire!=0 && actionAdversaireEffectuer == 1)
		{
			//clearInterval(toursuivant);
			clearInterval(ActionAdverseOuNon);
			TourSuivantBis();
		}
	},500);
}
function TourSuivantBis(){
	AfficherVieMoi();
	AfficherVieAdversaire();

	SetActionAversaire(0);
	actionAdversaire=0;
	setTimeout(function(){
		temps = 100;
		AfficherChrono();
		chrono=setInterval(Chrono,18.75);
		AfficherMenu();
		actionAdversaireEffectuer = 1;
		actionMoi = 1;
		SetActionMoi(18);
		setTimeout(function(){ location.href = "combat.php"; },200);
	},1000);
	

}

/* --------------------------------------------------------------------------------------------------------------------------------------------- */
/* GAGNER PAR ABANDON */
function GagnerParAbandon()
{
	clearInterval(ActionAdverseOuNon);
	xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combat.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				EcrireMessage(xhr.responseText);

				setTimeout(EcrireRecompense,1000);
				setTimeout(QuitterPage,2000);
				setTimeout(function(){location.href="choisiradversaire.php";},2500);					
			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("Abandon="+1);
}

/* --------------------------------------------------------------------------------------------------------------------------------------------- */
/* ACTION ADVERSAIRE */
function ActionAdversaire(){
	GetActionAdversaire();
	setTimeout(DecisionAdversaire,200);
}

function DecisionAdversaire()
{
	actionAdversaireEffectuer = 1;
	if (actionAdversaire == 0 || actionAdversaire > 15)		//L'adversaire n'a rien fait ou chosi un nouveau pokemon
	{
		actionAdversaireEffectuer = 0;
		EcrireMessage("En attente d'une réponse adverse");
	}
	else if (actionAdversaire == 14)		//L'adversaire abandonne
	{
		GagnerParAbandon();
	}
	else
	{
		clearInterval(ActionAdverseOuNon);
		AgirTousLesDeux(actionMoi,actionAdversaire);
	}

	/*if (actionAdversaireEffectuer == 1)
	{
		TourSuivant();
	}*/
}
//ActionAdversaire();

/* -------------------------------------------------------------------------------------------------------------------------- */
/* ACTION MOI */
function ActionMoi(valeur)
{
	clearInterval(chrono);
	temps = 100;
	SetActionMoi(valeur);
	TourSuivantVerification();
}

/* ------------------------------------------------------------------------------------------------------------------------- */
/* POKEMON MORT */
function AppelerNouveauPokemon(valeur)
{
	SetActionMoi(0);
	SetActionMoi(valeur);
	SetPokemonMoi(valeur);
	ChangerPokemonMoi(valeur);
	setTimeout(AfficherVieMoi,500);
	
	setTimeout(function(){ TourSuivantBis(); },1000);
}

function AttendreNouveauPokemon(){
	GetActionAdversaire();
	setTimeout(function(){
		if ( actionAdversaire != 16 )
		{
			//alert('ok');
			//alert('actionAdversaire='+actionAdversaire);
			//clearInterval(attendreNouveauPokemon);
			/*GetpokemonAdversaire();
			setTimeout(function(){ChangerPokemonAdversaire(getpokemonAdversaire);},200);
			setTimeout(AfficherVieAdversaire,500);*/
			//setTimeout(TourSuivantBis,1000);
			location.href  ="combat.php";
		}
		else if ( actionAdversaire == 14 )
		{
			GagnerParAbandon();
		}
		else
		{
			AttendreNouveauPokemon();
		}
	},1000);
}

