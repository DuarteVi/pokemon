function PotionAffichageAjax(){
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combat.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				divBasSoin.innerHTML=xhr.responseText;
			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("PotionAffichageAjax="+1);
}

function AttaqueAffichageAjax(){
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combat.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				divBasAttaque.innerHTML=xhr.responseText;
			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("AttaqueAffichageAjax="+1);
}

function PokemonAffichageAjax(){
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combat.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				divBasPokemon.innerHTML=xhr.responseText;
			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("PokemonAffichageAjax="+1);
}

/* --------------------------------------------------------------------------------------------------------------------------------------------- */
/* Utiliser Potion */
function UtiliserPotionMoi(valeur){
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combat.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				EcrireMessage(xhr.responseText);

				/*xhr = new XMLHttpRequest();
				xhr.open('POST','ajax_combat.php', true);
				xhr.addEventListener('readystatechange',
					function() {
						if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
							pokevieEquipe.value = parseInt(xhr.responseText);
							BarreDeVie(vieEquipe,pokevieEquipe,pokevieMaxEquipe);
						}
					}
				);
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhr.send("SoignerPokemonMoi="+valeur);*/
			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("UtiliserPotionMoi="+valeur);
}

function UtiliserPotionAdversaire(valeur){
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combat.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				EcrireMessage(xhr.responseText);

				/*xhr = new XMLHttpRequest();
				xhr.open('POST','ajax_combat.php', true);
				xhr.addEventListener('readystatechange',
					function() {
						if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
							pokevieEnnemie.value = parseInt(xhr.responseText);
							BarreDeVie(vieEnnemie,pokevieEnnemie,pokevieMaxEnnemie);
						}
					}
				);
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhr.send("SoignerPokemonAdversaire="+valeur);*/
			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("UtiliserPotionAdversaire="+valeur);
}

/* --------------------------------------------------------------------------------------------------------------------------------------------- */
/* Utiliser Attaque */
function UtiliserAttaqueMoi(valeur){
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combat.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				EcrireMessage(xhr.responseText);

				FaireClignoterPokemonAdversaire();

				/*xhr = new XMLHttpRequest();
				xhr.open('POST','ajax_combat.php', true);
				xhr.addEventListener('readystatechange',
					function() {
						if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
							pokevieEnnemie.value = parseInt(xhr.responseText);
							BarreDeVie(vieEnnemie,pokevieEnnemie,pokevieMaxEnnemie);
						}
					}
				);
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhr.send("GetViePokemonAdversaire="+1);*/
			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("UtiliserAttaqueMoi="+valeur);
}

function UtiliserAttaqueAdversaire(valeur){
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combat.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				EcrireMessage(xhr.responseText);

				FaireClignoterPokemonMoi();

				/*xhr = new XMLHttpRequest();
				xhr.open('POST','ajax_combat.php', true);
				xhr.addEventListener('readystatechange',
					function() {
						if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
							pokevieEquipe.value = parseInt(xhr.responseText);
							BarreDeVie(vieEquipe,pokevieEquipe,pokevieMaxEquipe);
						}
					}
				);
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhr.send("GetViePokemonMoi="+1);*/
			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("UtiliserAttaqueAdversaire="+valeur);
}

/* --------------------------------------------------------------------------------------------------------------------------------------------- */
/* CHANGER POKEMON */
function ChangerPokemonMoi(valeur)
{
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
	xhr.send("ChangerPokemonMoi="+valeur);

	setTimeout(function(){
		let xhr = new XMLHttpRequest();
		xhr.open('POST','ajax_combat.php', true);
		xhr.addEventListener('readystatechange',
			function() {
				if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
					divPokemonMoi.innerHTML = xhr.responseText;
				}
			}
		);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("AfficherPokemonMoi="+1);
	},500);
}

function ChangerPokemonAdversaire(valeur)
{
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
	xhr.send("ChangerPokemonAdversaire="+valeur);

	setTimeout(function(){
		let xhr = new XMLHttpRequest();
		xhr.open('POST','ajax_combat.php', true);
		xhr.addEventListener('readystatechange',
			function() {
				if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
					divPokemonAdversaire.innerHTML = xhr.responseText;
				}
			}
		);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("AfficherPokemonAdversaire="+1);
	},500);
}
/* --------------------------------------------------------------------------------------------------------------------------------------------- */
/* AFFICHER VIE */
function AfficherVieMoi()
{
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combat.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				let pv = parseInt(xhr.responseText);
				//alert(pv);
				vieMoi = parseInt(pv);

				vieEquipe = document.querySelector('div#vieEquipe');
				pokevieEquipe = document.querySelector('input#pokevieEquipe');
				pokevieMaxEquipe = document.querySelector('input#pokevieMaxEquipe');

				pokevieEquipe.value = parseInt(pv);
				if (parseInt(pokevieEquipe.value) > parseInt(pokevieMaxEquipe.value) )
				{
					pokevieEquipe.value = parseInt(pokevieMaxEquipe.value);
				}

				BarreDeVie(vieEquipe,pokevieEquipe,pokevieMaxEquipe);
			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("GetViePokemonMoi="+1);
}
function AfficherVieAdversaire()
{
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combat.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				let pv = parseInt(xhr.responseText);

				vieAdversaire = parseInt(pv);

				vieEnnemie = document.querySelector('div#vieEnnemie');
				pokevieEnnemie = document.querySelector('input#pokevieEnnemie');
				pokevieMaxEnnemie = document.querySelector('input#pokevieMaxEnnemie');

				pokevieEnnemie.value = parseInt(pv);

				if (parseInt(pokevieEnnemie.value) > parseInt(pokevieMaxEnnemie.value) )
				{
					pokevieEnnemie.value = parseInt(pokevieMaxEnnemie.value);
				}

				BarreDeVie(vieEnnemie,pokevieEnnemie,pokevieMaxEnnemie);
			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("GetViePokemonAdversaire="+1);
}
/* --------------------------------------------------------------------------------------------------------------------------------------------- */
/* GET VITESSE */
function GetVitesseMoi()
{
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combat.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				vitesseMoi = parseInt(xhr.responseText);
			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("GetVitesseMoi="+1);
}
function GetVitesseAdversaire()
{
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combat.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				vitesseAdversaire = parseInt(xhr.responseText);
			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("GetVitesseAdversaire="+1);
}
/* --------------------------------------------------------------------------------------------------------------------------------------------- */
/* POKEMON ENCORE EN VIE */
function NombrePokemonEncoreEnVieMoi()
{
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combat.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				nombrePokemonEncoreEnVieMoi = parseInt(xhr.responseText);
			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("NombrePokemonEncoreEnVieMoi="+1);
}
function NombrePokemonEncoreEnVieAdversaire()
{
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combat.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				nombrePokemonEncoreEnVieAdversaire = parseInt(xhr.responseText);
			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("NombrePokemonEncoreEnVieAdversaire="+1);
}

/* --------------------------------------------------------------------------------------------------------------------------------------------- */
/* PLUS DE VIE */
function ChoisirNouveauPokemon()
{
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_combat.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				divBasPokemon.innerHTML = xhr.responseText;
				CacherBas();
				divBasPokemon.style.display = "";

			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("ChoisirNouveauPokemon="+1);
}

/* --------------------------------------------------------------------------------------------------------------------------------------------- */
/* PROCHAIN POKEMON */
function ChoisirPokemonApresMort(){
	actionPossibleMoi = 0;
	actionPossibleAdversaire = 0;
	SetActionMoi(16);
	ChoisirNouveauPokemon();
}
function AttendrePokemonApresMort(){
	actionPossibleMoi = 0;
	actionPossibleAdversaire = 0;
	actionAdversaire = 16;
	EcrireMessage("Attendre un nouveau pokemon adverse");
	setTimeout(AttendreNouveauPokemon,1000);	
}
/* --------------------------------------------------------------------------------------------------------------------------------------------- */
/* AGIR */
function AgirMoi(valeur)
{
	if (vieMoi > 0 )
	{
		if (valeur >= 1 && valeur <= 3)
		{
			UtiliserPotionMoi(valeur);
			setTimeout(AfficherVieMoi,200);
			setTimeout(AfficherVieAdversaire,200);
		}
		else if (valeur >= 4 && valeur <= 7)
		{
			UtiliserAttaqueMoi(valeur);
			setTimeout(AfficherVieMoi,200);
			setTimeout(AfficherVieAdversaire,200);
		}
		else if (valeur >= 8 && valeur <= 13)
		{
			ChangerPokemonMoi(valeur);
			setTimeout(AfficherVieMoi,200);
			setTimeout(AfficherVieAdversaire,200);
		}
	}
	else
	{
		actionPossibleMoi = 0;
		actionPossibleAdversaire = 0;
		NombrePokemonEncoreEnVieMoi();
		setTimeout(function(){
			if ( nombrePokemonEncoreEnVieMoi > 0 )
			{
				ChoisirPokemonApresMort();
			}
			else
			{
				TourSuivantBis();
			}
		},200);
	}
}

function AgirAdversaire(valeur)
{
	if (vieAdversaire > 0 )
	{
		if (valeur >= 1 && valeur <= 3)
		{
			UtiliserPotionAdversaire(valeur);
			setTimeout(AfficherVieMoi,200);
			setTimeout(AfficherVieAdversaire,200);
		}
		else if (valeur >= 4 && valeur <= 7)
		{
			UtiliserAttaqueAdversaire(valeur);
			setTimeout(AfficherVieMoi,200);
			setTimeout(AfficherVieAdversaire,200);
		}
		else if (valeur >= 8 && valeur <= 13)
		{
			ChangerPokemonAdversaire(valeur);
			setTimeout(AfficherVieMoi,200);
			setTimeout(AfficherVieAdversaire,200);
		}
		else if (valeur == 15)
		{
			xhr = new XMLHttpRequest();
			xhr.open('POST','ajax_combat.php', true);
			xhr.addEventListener('readystatechange',
				function() {
					if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
						EcrireMessage(xhr.responseText);
					}
				}
			);
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xhr.send("PasserSonTour="+1);
		}
	}
	else
	{
		actionPossibleMoi = 0;
		actionPossibleAdversaire = 0;
		NombrePokemonEncoreEnVieAdversaire();
		setTimeout(function(){
			if ( nombrePokemonEncoreEnVieAdversaire > 0 )
			{
				AttendrePokemonApresMort();
			}
			else
			{
				TourSuivantBis();
			}
		},300);
	}
}

function AgirTousLesDeux(valeurMoi,valeurAdversaire)
{
	if ((valeurMoi < 4 || valeurMoi > 7) && (valeurAdversaire < 4 || valeurAdversaire > 7)) //Personne attaque
	{
		AgirMoi(valeurMoi);
		setTimeout(function(){
			if (actionPossibleAdversaire == 1)
			{
				AgirAdversaire(valeurAdversaire);
				
			}
		},2000);
		setTimeout(function(){
			/*AfficherVieMoi();
			setTimeout(function(){*/
				if ( actionPossibleMoi == 1 &&	actionPossibleAdversaire == 1 && vieMoi > 0)
				{
					TourSuivant();
				}
				else if (vieMoi <= 0)
				{
					ChoisirPokemonApresMort();
				}

			//},500);
		},4000);
	}
	else if ((valeurMoi < 4 || valeurMoi > 7) && (valeurAdversaire >= 4 || valeurAdversaire <= 7)) // Il attaque et pas moi
	{
		AgirMoi(valeurMoi);
		setTimeout(function(){
			if (actionPossibleAdversaire == 1)
			{
				AgirAdversaire(valeurAdversaire);

			}
		},2000);
		setTimeout(function(){
			/*AfficherVieMoi();
			setTimeout(function(){*/
				if ( actionPossibleMoi == 1 &&	actionPossibleAdversaire == 1 && vieMoi > 0)
				{
					TourSuivant();
				}
				else if (vieMoi <= 0)
				{
					ChoisirPokemonApresMort();
				}
			//},500);
		},4000);
	}
	else if ((valeurMoi >= 4 || valeurMoi <= 7) && (valeurAdversaire < 4 || valeurAdversaire > 7)) // J'attaque et pas lui
	{
		AgirAdversaire(valeurAdversaire);
		setTimeout(function(){
			if (actionPossibleMoi == 1)
			{
				AgirMoi(valeurMoi);
			}
		},2000);
		setTimeout(function(){
			/*AfficherVieAdversaire();
			setTimeout(function(){*/
				if ( actionPossibleMoi == 1 &&	actionPossibleAdversaire == 1 && vieAdversaire > 0)
				{
					TourSuivant();
				}
				else if (vieAdversaire <= 0)
				{
					AttendreNouveauPokemon();
				}
			//},500);
		},4000);
	}
	else // On attaque tous les deux
	{
		GetVitesseMoi();
		GetVitesseAdversaire();
		setTimeout(function(){
			if ( (vitesseMoi > vitesseAdversaire) || (vitesseMoi == vitesseAdversaire && joueurMoi == 1) )
			{
				AgirMoi(valeurMoi);
				setTimeout(function(){
					if (actionPossibleAdversaire == 1)
					{
						AgirAdversaire(valeurAdversaire);
					}
				},2000);
				setTimeout(function(){
					/*AfficherVieMoi();
					setTimeout(function(){*/
						if ( actionPossibleMoi == 1 &&	actionPossibleAdversaire == 1 && vieMoi > 0)
						{
							TourSuivant();
						}
						else if (vieMoi <= 0)
						{
							ChoisirPokemonApresMort();
						}
					//},500);
				},4000);
			}
			else
			{
				AgirAdversaire(valeurAdversaire);
				setTimeout(function(){
					if (actionPossibleMoi == 1)
					{
						AgirMoi(valeurMoi);
					}
				},2000);
				setTimeout(function(){
					/*AfficherVieAdversaire();
					setTimeout(function(){*/
						if ( actionPossibleMoi == 1 &&	actionPossibleAdversaire == 1 && vieAdversaire > 0)
						{
							TourSuivant();
						}
						else if (vieAdversaire <= 0)
						{
							AttendreNouveauPokemon();
						}
					//},500);
				},4000);
			}
		},500);
	}
}


/* --------------------------------------------------------------------------------------------------------------------------------------------- */
/* PERDU OU GAGNER */

NombrePokemonEncoreEnVieMoi();
NombrePokemonEncoreEnVieAdversaire();
AfficherVieMoi();
AfficherVieAdversaire();
GetActionAdversaire();

function Perdu(){
	let xhr = new XMLHttpRequest();
	if (nombrePokemonEncoreEnVieMoi <= 0)
	{
		clearInterval(chrono);
		xhr.open('POST','ajax_combat.php', true);
		xhr.addEventListener('readystatechange',
			function() {
				if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
					EcrireMessage(xhr.responseText);
					QuitterPage();
					setTimeout(function(){location.href="choisiradversaire.php";},2000);
				}
			}
		);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("Perdu="+1);
	}
	else if ( vieMoi <= 0)
	{
		ChoisirNouveauPokemon();
	}
}

function Gagner(){
	if (nombrePokemonEncoreEnVieAdversaire <= 0)
	{
		clearInterval(chrono);
		let xhr = new XMLHttpRequest();
		xhr.open('POST','ajax_combat.php', true);
		xhr.addEventListener('readystatechange',
			function() {
				if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
					EcrireMessage(xhr.responseText);
					QuitterPage();
					setTimeout(function(){location.href="choisiradversaire.php";},2000);
				}
			}
		);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("Gagner="+1);
	}
	else if ( actionAdversaire == 14)
	{
		GagnerParAbandon();
	}
	else if ( vieAdversaire <= 0)
	{
		AttendrePokemonApresMort();
	}
}

setTimeout(Perdu,500);
setTimeout(Gagner,500);