function RetourMenu(){
	location.href="menu.php";
}

function BarreDeXp(barre,xp,xpMax){
	quantite = (parseInt(xp.value)*100)/parseInt(xpMax.value);
	barre.style.width= quantite + "%";
	barre.style.backgroundColor = "#01A9DB";
}
function BarreXpInfoDresseur()
{
	let barre = document.querySelector('div#barrexp');
	let xp = document.querySelector('input#xp');
	let xpMax = document.querySelector('input#xpMax');
	//alert(xpMax);
	BarreDeXp(barre,xp,xpMax);
}

function AfficherImage()
{
	let xhr = new XMLHttpRequest();
	let divImage = document.querySelector('div#image'); 
	xhr.open('POST','ajax_infodresseur.php', true);

	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			   	divImage.innerHTML = xhr.responseText;
				console.log("image mise à jour");
			}
	    }
	);

	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("afficherImage="+1);
}


function AfficherInfoDresseur()
{
	let xhr = new XMLHttpRequest();
	let divInfoDresseur = document.querySelector('div#boiteInfoDresseur'); 
	xhr.open('POST','ajax_infodresseur.php', true);

	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			   	divInfoDresseur.innerHTML = xhr.responseText;
				console.log("infos misent à jour");
				BarreXpInfoDresseur();
			}
	    }
	);

	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("afficherInfo="+1);
	
}
AfficherInfoDresseur();
AfficherImage();

function ChangerSexe()
{

	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_infodresseur.php', true);

	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			   	//divInfoDresseur.innerHTML = xhr.responseText;
				console.log("Sexe mis à jour");
			}
	    }
	);

	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("changersexe="+1);
	AfficherInfoDresseur();
	AfficherImage();
}

function confirmerPseudo()
{

	let xhr = new XMLHttpRequest();
	let nvPseudo = document.querySelector('input#nvPseudo').value;

	if (nvPseudo)
	{
		
		xhr.open('POST','ajax_infodresseur.php', true);

		xhr.addEventListener('readystatechange',
			function() {
				if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				   	//divInfoDresseur.innerHTML = xhr.responseText;
					console.log("Pseudo mis à jour");
				}
		    }
		);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("changerpseudo="+nvPseudo);
		AfficherInfoDresseur();
	}
}

function focusMdp2()
{
	if (document.querySelector('input#mdp').value)
	{
		document.querySelector('input#mdp2').focus();
	}
	else
	{
		alert('Veuillez compléter le premier champs');
	}
	
}

function confirmerMdp()
{
	let mdp = document.querySelector('input#mdp').value;

	if (mdp)
	{
		let mdp2 = document.querySelector('input#mdp2').value;

		if (mdp2)
		{
			if (mdp === mdp2)
			{
				let xhr = new XMLHttpRequest();
				xhr.open('POST','ajax_infodresseur.php', true);

				xhr.addEventListener('readystatechange',
					function() {
						if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
						   	//divInfoDresseur.innerHTML = xhr.responseText;
							console.log("Mdp mis à jour");
						}
				    }
				);
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhr.send("changermdp="+mdp+"&changermdp2="+mdp2);
				alert("Mot de passe changé");
				AfficherInfoDresseur();
			}
			else
			{
				alert("Veuillez rentrer deux mots de passe identitiques");
			}
		}
		else
		{
			alert("Veuillez compléter le deuxième champs");
		}
	}
	else
	{
		alert('Veuillez compléter le premier champs');
	}
}	

function SupprimerCompte()
{
	if (confirm('Voulez vraiment supprimer votre compte ? \n (Aucun retour en arrière ne sera possible)'))
	{
		mdp = prompt('Veuillez tapez votre mot de passe :');

		let divInfoDresseur = document.querySelector('div#boiteInfoDresseur'); 
		let xhr = new XMLHttpRequest();
		xhr.open('POST','ajax_infodresseur.php', true);

		xhr.addEventListener('readystatechange',
			function() {
				if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				   	//divInfoDresseur.innerHTML = xhr.responseText;
				   	let $reponse = xhr.responseText;
					console.log("Action de suppression effectuée");
					if ($reponse == 1)
					{
						alert("Votre compte va être supprimer.\nVous allez être redirigé.");
						location.href = "deconnexion.php";
					}
					else
					{
						alert("Mauvais mot de passe rentré.\nAction annulée.");
						//alert($reponse);
					}
				}
		    }
		);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("supprimerCompte="+mdp);
	}
	else
	{
		alert('Annulé');
	}
}
/* ----------------------------------------------------------------------------------------------------------------------------- */
/* Ami */
function AfficherAmiConfirmer(){
		let divOldAmi = document.querySelector('div#oldAmi'); 
		let xhr = new XMLHttpRequest();
		xhr.open('POST','ajax_infodresseur.php', true);

		xhr.addEventListener('readystatechange',
			function() {
				if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				   	divOldAmi.innerHTML = xhr.responseText;
					//console.log("ami");
				}
		    }
		);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

		let chercher = document.querySelector('input#rechercherAmiConfirmer').value;
		//alert(chercher);
		xhr.send("AfficherAmiConfirmer="+chercher);
}
AfficherAmiConfirmer();

function AfficherVoirProfil(numero){
		let divVoirProfil = document.querySelector('div#voirProfil'); 
		let xhr = new XMLHttpRequest();
		xhr.open('POST','ajax_infodresseur.php', true);

		xhr.addEventListener('readystatechange',
			function() {
				if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				   	divVoirProfil.innerHTML = xhr.responseText;
					//console.log("ami");
				}
		    }
		);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		//alert(chercher);
		xhr.send("AfficherVoirProfil="+numero);
}

function AfficherNouveauAmi(){
		let divNewAmi = document.querySelector('div#newAmi'); 
		let xhr = new XMLHttpRequest();
		xhr.open('POST','ajax_infodresseur.php', true);

		xhr.addEventListener('readystatechange',
			function() {
				if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				   	divNewAmi.innerHTML = xhr.responseText;
					//console.log("ami");
				}
		    }
		);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

		let chercher = document.querySelector('input#rechercherNouveauAmi').value;
		//alert(chercher);

		xhr.send("AfficherNouveauAmi="+chercher);
}
AfficherNouveauAmi();

function AjouterAmi(num1,num2)
{
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_infodresseur.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			   	//divNewAmi.innerHTML = xhr.responseText;
				console.log("ami ajouté");

				AfficherNouveauAmi();
				AfficherAmiConfirmer();
				document.querySelector('div#voirProfil').innerHTML = "";
			}
	    }
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("AjouterAmiNum1="+num1+"&AjouterAmiNum2="+num2);

	
}
function SupprimerAmi(num1,num2)
{
	//alert("num1="+num1+"\n num2="+num2)
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_infodresseur.php', true);
	//let divVoirProfil = document.querySelector('div#voirProfil'); 
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			   	//divVoirProfil.innerHTML = xhr.responseText;
				console.log("ami supprimer");

				AfficherNouveauAmi();
				AfficherAmiConfirmer();
				document.querySelector('div#voirProfil').innerHTML = "";
			}
	    }
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("SupprimerAmiNum1="+num1+"&SupprimerAmiNum2="+num2);

	
}