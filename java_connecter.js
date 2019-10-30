function ConnecterOui()
{
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_menu.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				console.log("connecté");
			}
	    }
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("FenetreOuverte="+1);
}

function ConnecterNon()
{
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_menu.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				console.log("deconnecté");
			}
	    }
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("fermerFenetre="+1);
}
ConnecterOui();
window.onbeforeunload = function (){ConnecterNon()};


function DemandeCombatRecu()
{
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_menu.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {

				let demande = parseInt(xhr.responseText);

				if (demande > 0)
				{
					xhr = new XMLHttpRequest();
					xhr.open('GET', 'ajax_menu.php?demandeAdversaire='+demande, false);
					xhr.send();
					if (confirm(xhr.responseText))
					{
						xhr = new XMLHttpRequest();
						xhr.open('POST','ajax_menu.php', true);
						xhr.addEventListener('readystatechange',
							function() {
								if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
									let reponse = parseInt(xhr.responseText);
									//let reponse = 0;
									//alert(xhr.responseText);
									if (reponse == 1)
									{
										location.href="combat.php";
									}
									else
									{
										alert("La demande a été annulée")
									}
								}
							}
						);
						xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
						xhr.send("DemandeConfirmer="+demande);
					}
					else
					{
						xhr = new XMLHttpRequest();
						xhr.open('POST','ajax_menu.php', true);
						xhr.addEventListener('readystatechange',
							function() {
								if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
									console.log("Demande annulé")
								}
							}
						);
						xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
						xhr.send("RefuserDemande="+demande);
					}
				}
			}
	    }
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("DemandeCombatRecu="+1);
}

setInterval(DemandeCombatRecu,5000);




function BonusQuotidien(){
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_menu.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				//document.querySelector('div#tout').innerHTML=(xhr.responseText);
				let resultat = parseInt(xhr.responseText);
				//alert("resultat="+resultat);
				if (resultat == 1)
				{
					alert("BONUS QUOTIDIEN\nVous recevez 50 pokédollars\nVous recevez 5 pokéballs\nVos Pokémons ont récupéré toute leur vie");
				}
			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("BonusQuotidien="+1);
}
BonusQuotidien();