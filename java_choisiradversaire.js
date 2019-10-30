function RetourMenu(){
	location.href="menu.php";
}

function AfficherLesNonAmisConnecter(){
	let xhr = new XMLHttpRequest();
	let divNA = document.querySelector('div#listeNonAmis');
	xhr.open('POST','ajax_choisiradversaire.php', true);
	xhr.addEventListener('readystatechange',
	function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				divNA.innerHTML = xhr.responseText;
			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("AfficherLesNonAmisConnecter="+1);		
}
AfficherLesNonAmisConnecter();

function AfficherLesAmis() {
	let xhr = new XMLHttpRequest();
	let divA = document.querySelector('div#listeAmis');
	xhr.open('POST','ajax_choisiradversaire.php', true);
	xhr.addEventListener('readystatechange',
	function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				divA.innerHTML = xhr.responseText;
			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("AfficherLesAmis="+1);
}
AfficherLesAmis();

function EnvoyerInvitation(adversaire){
	let xhr = new XMLHttpRequest();
	let div = document.querySelector('div#tout');
	xhr.open('POST','ajax_choisiradversaire.php', true);
	xhr.addEventListener('readystatechange',
	function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				div.innerHTML = xhr.responseText;
				interval=setInterval(function(){VerifierDemandeAdversaire(adversaire);},1000);	
			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("EnvoyerInvitation="+adversaire);
}

function VerifierDemandeAdversaire(adversaire){
	let xhr = new XMLHttpRequest();
	let div = document.querySelector('div#tout');
	xhr.open('POST','ajax_choisiradversaire.php', true);
	xhr.addEventListener('readystatechange',
	function() {
		if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				let responseText = parseInt(xhr.responseText);
				if (responseText == 1)
				{
					clearInterval(interval);
					alert('Votre demande a été rejetée');
					AnnulerDemande();
				}
				else if (responseText == 2)
				{
					location.href="combat.php";
				}
			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("VerifierDemandeAdversaire="+adversaire);
}


function AnnulerDemande(){
	let xhr = new XMLHttpRequest();
	let div = document.querySelector('div#tout');
	xhr.open('POST','ajax_choisiradversaire.php', true);
	xhr.addEventListener('readystatechange',
	function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				div.innerHTML = xhr.responseText;
				AfficherLesNonAmisConnecter();
				AfficherLesAmis();
				clearInterval(interval);
			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("AnnulerDemande="+1);
}