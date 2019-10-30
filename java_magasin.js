function RetourMenu(){
	location.href="menu.php";
}
function AcheterDesChoses(){
	let xhr = new XMLHttpRequest();
	let div = document.querySelector('div#acheterVendre');

	let boutonAcheter = document.querySelector('div#acheter');
	let boutonVendre = document.querySelector('div#vendre');
	boutonAcheter.style.opacity = "1";
	boutonVendre.style.opacity = "0.6";
	boutonAcheter.innerHTML = "<h1>Acheter</h1>";
	boutonVendre.innerHTML = "Vendre";

	xhr.open('POST','ajax_magasin.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			    div.innerHTML = xhr.responseText;	    
			   	//alert(xhr.responseText);					    	
			}			
	    }
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("AcheterDesChoses="+1);
}

function VendreDesChoses(){
	let xhr = new XMLHttpRequest();
	let div = document.querySelector('div#acheterVendre');

	let boutonAcheter = document.querySelector('div#acheter');
	let boutonVendre = document.querySelector('div#vendre');
	boutonAcheter.style.opacity = "0.6";
	boutonVendre.style.opacity = "1";
	boutonAcheter.innerHTML = "Acheter";
	boutonVendre.innerHTML = "<h1>Vendre</h1>";

	xhr.open('POST','ajax_magasin.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			   	div.innerHTML = xhr.responseText;	    					    	
			}			
	    }
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("VendreDesChoses="+1);
}
function AfficherArgent(){
	let xhr = new XMLHttpRequest();
	let div = document.querySelector('div#argent');

	xhr.open('POST','ajax_magasin.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			   	div.innerHTML = xhr.responseText;	    					    	
			}			
	    }
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("AfficherArgent="+1);
}
AfficherArgent();

function Velo(){
	alert("Vous n'avez pas assez d'argent");
}

/* ----------------------------------------------------------------------------------------------------------------------------------------- */
// ACHETER
function AcheterCT(numA){
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_magasin.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			   	let argent = parseInt(xhr.responseText);
			   	if (argent < 0)
			   	{
			   		alert("Vous n'avez pas assez d'argent");
			   	}
			   	else
			   	{
			   		xhr = new XMLHttpRequest();
			   		xhr.open('POST','ajax_magasin.php', true);
					xhr.addEventListener('readystatechange',
						function() {
							if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
								console.log("CT achetée");
							}
						}
					);
					xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					xhr.send("AcheterCT="+numA);
					AcheterDesChoses();
					AcheterDesChoses();
					AfficherArgent();
					AfficherArgent();
			   	}
			}			
	    }
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("AssezDArgent="+2000);
}
function Acheter(initiales,value) {
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_magasin.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				console.log("Achat effectué")
			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("AcheterInitiales="+initiales+"&AcheterValeur="+value);
	AcheterDesChoses();
	AcheterDesChoses();
	AfficherArgent();
	AfficherArgent();
}

function AcheterPB(){
	let input = document.querySelector('input#achatPB');
	let xhr = new XMLHttpRequest();
	//alert("input.value="+input.value+"\ninput.max = "+input.max+3+4);
	if (parseInt(input.value) > parseInt(input.max))
	{
		alert("Vous n'avez pas assez d'argent");
	}
	else if ( parseInt(input.value) >= parseInt(input.min) && parseInt(input.value) <= parseInt(input.max) )
	{
		xhr.open('POST','ajax_magasin.php', true);
		xhr.addEventListener('readystatechange',
			function() {
				if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
					let assez = parseInt(xhr.responseText);
					if ( assez == 0)
					{
						alert("N'essaye pas de tricher toi -_-");
					}
					else
					{
						Acheter('PB',parseInt(input.value));
					}
				}
			}
		);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("AcheterPB="+parseInt(input.value));
			
	}
	else
	{
		alert('Le nombre indiqué doit être positif');
	}
}
function AcheterSB(){
	let input = document.querySelector('input#achatSB');
	let xhr = new XMLHttpRequest();
	if (parseInt(input.value) > parseInt(input.max))
	{
		alert("Vous n'avez pas assez d'argent");
	}
	else if ( parseInt(input.value) >= parseInt(input.min) && parseInt(input.value) <= parseInt(input.max) )
	{
		xhr.open('POST','ajax_magasin.php', true);
		xhr.addEventListener('readystatechange',
			function() {
				if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
					let assez = parseInt(xhr.responseText);
					if ( assez == 0)
					{
						alert("N'essaye pas de tricher toi -_-");
					}
					else
					{
						Acheter('SB',parseInt(input.value));
					}
				}
			}
		);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("AcheterSB="+parseInt(input.value));
			
	}
	else
	{
		alert('Le nombre indiqué doit être positif');
	}
}
function AcheterHB(){
	let input = document.querySelector('input#achatHB');
	let xhr = new XMLHttpRequest();
	if (parseInt(input.value) > parseInt(input.max))
	{
		alert("Vous n'avez pas assez d'argent");
	}
	else if ( parseInt(input.value) >= parseInt(input.min) && parseInt(input.value) <= parseInt(input.max) )
	{
		xhr.open('POST','ajax_magasin.php', true);
		xhr.addEventListener('readystatechange',
			function() {
				if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
					let assez = parseInt(xhr.responseText);
					if ( assez == 0)
					{
						alert("N'essaye pas de tricher toi -_-");
					}
					else
					{
						Acheter('HB',parseInt(input.value));
					}
				}
			}
		);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("AcheterHB="+parseInt(input.value));
			
	}
	else
	{
		alert('Le nombre indiqué doit être positif');
	}
}
function AcheterP(){
	let input = document.querySelector('input#achatP');
	let xhr = new XMLHttpRequest();
	if (parseInt(input.value) > parseInt(input.max))
	{
		alert("Vous n'avez pas assez d'argent");
	}
	else if ( parseInt(input.value) >= parseInt(input.min) && parseInt(input.value) <= parseInt(input.max) )
	{
		xhr.open('POST','ajax_magasin.php', true);
		xhr.addEventListener('readystatechange',
			function() {
				if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
					let assez = parseInt(xhr.responseText);
					if ( assez == 0)
					{
						alert("N'essaye pas de tricher toi -_-");
					}
					else
					{
						Acheter('P',parseInt(input.value));
					}
				}
			}
		);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("AcheterP="+parseInt(input.value));
			
	}
	else
	{
		alert('Le nombre indiqué doit être positif');
	}
}
function AcheterSP(){
	let input = document.querySelector('input#achatSP');
	let xhr = new XMLHttpRequest();
	if (parseInt(input.value) > parseInt(input.max))
	{
		alert("Vous n'avez pas assez d'argent");
	}
	else if ( parseInt(input.value) >= parseInt(input.min) && parseInt(input.value) <= parseInt(input.max) )
	{
		xhr.open('POST','ajax_magasin.php', true);
		xhr.addEventListener('readystatechange',
			function() {
				if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
					let assez = parseInt(xhr.responseText);
					if ( assez == 0)
					{
						alert("N'essaye pas de tricher toi -_-");
					}
					else
					{
						Acheter('SP',parseInt(input.value));
					}
				}
			}
		);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("AcheterSP="+parseInt(input.value));
			
	}
	else
	{
		alert('Le nombre indiqué doit être positif');
	}
}
function AcheterHP(){
	let input = document.querySelector('input#achatHP');
	let xhr = new XMLHttpRequest();
	if (parseInt(input.value) > parseInt(input.max))
	{
		alert("Vous n'avez pas assez d'argent");
	}
	else if ( parseInt(input.value) >= parseInt(input.min) && parseInt(input.value) <= parseInt(input.max) )
	{
		xhr.open('POST','ajax_magasin.php', true);
		xhr.addEventListener('readystatechange',
			function() {
				if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
					let assez = parseInt(xhr.responseText);
					if ( assez == 0)
					{
						alert("N'essaye pas de tricher toi -_-");
					}
					else
					{
						Acheter('HP',parseInt(input.value));
					}
				}
			}
		);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("AcheterHP="+parseInt(input.value));
			
	}
	else
	{
		alert('Le nombre indiqué doit être positif');
	}
}




/* ----------------------------------------------------------------------------------------------------------------------------------------- */
// VENDRE
function VendreCT(numA){
	let xhr = new XMLHttpRequest();
	//let div = document.querySelector('div#argent');
	xhr.open('POST','ajax_magasin.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				//div.innerHTML = xhr.responseText;
				console.log("CT vendue");
			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("VendreCT="+numA);
	VendreDesChoses();
	VendreDesChoses();
	AfficherArgent();
	AfficherArgent();
}


function Vendre(initiales,value) {
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_magasin.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				console.log("Vente effectué")
			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("VendreInitiales="+initiales+"&VendreValeur="+value);
	VendreDesChoses();
	VendreDesChoses();
	AfficherArgent();
	AfficherArgent();
}

function VendrePB(){
	let input = document.querySelector('input#vendrePB');
	let xhr = new XMLHttpRequest();
	//alert("input.value="+input.value+"\ninput.max = "+input.max+3+4);
	if (parseInt(input.value) > parseInt(input.max))
	{
		alert("Vous n'en possédez pas assez");
	}
	else if ( parseInt(input.value) > parseInt(input.min) && parseInt(input.value) <= parseInt(input.max) )
	{
		xhr.open('POST','ajax_magasin.php', true);
		xhr.addEventListener('readystatechange',
			function() {
				if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
					let assez = parseInt(xhr.responseText);
					if ( assez == 0)
					{
						alert("N'essaye pas de tricher toi -_-");
					}
					else
					{
						Vendre('PB',parseInt(input.value));
					}
				}
			}
		);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("VendrePB="+parseInt(input.value));
			
	}
	else
	{
		alert('Le nombre indiqué doit être positif');
	}
}
function VendreSB(){
	let input = document.querySelector('input#vendreSB');
	let xhr = new XMLHttpRequest();
	if (parseInt(input.value) > parseInt(input.max))
	{
		alert("Vous n'en possédez pas assez");
	}
	else if ( parseInt(input.value) > parseInt(input.min) && parseInt(input.value) <= parseInt(input.max) )
	{
		xhr.open('POST','ajax_magasin.php', true);
		xhr.addEventListener('readystatechange',
			function() {
				if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
					let assez = parseInt(xhr.responseText);
					if ( assez == 0)
					{
						alert("N'essaye pas de tricher toi -_-");
					}
					else
					{
						Vendre('SB',parseInt(input.value));
					}
				}
			}
		);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("VendreSB="+parseInt(input.value));
			
	}
	else
	{
		alert('Le nombre indiqué doit être positif');
	}
}
function VendreHB(){
	let input = document.querySelector('input#vendreHB');
	let xhr = new XMLHttpRequest();
	if (parseInt(input.value) > parseInt(input.max))
	{
		alert("Vous n'en possédez pas assez");
	}
	else if ( parseInt(input.value) > parseInt(input.min) && parseInt(input.value) <= parseInt(input.max) )
	{
		xhr.open('POST','ajax_magasin.php', true);
		xhr.addEventListener('readystatechange',
			function() {
				if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
					let assez = parseInt(xhr.responseText);
					if ( assez == 0)
					{
						alert("N'essaye pas de tricher toi -_-");
					}
					else
					{
						Vendre('HB',parseInt(input.value));
					}
				}
			}
		);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("VendreHB="+parseInt(input.value));
			
	}
	else
	{
		alert('Le nombre indiqué doit être positif');
	}
}
function VendreP(){
	let input = document.querySelector('input#vendreP');
	let xhr = new XMLHttpRequest();
	if (parseInt(input.value) > parseInt(input.max))
	{
		alert("Vous n'en possédez pas assez");
	}
	else if ( parseInt(input.value) > parseInt(input.min) && parseInt(input.value) <= parseInt(input.max) )
	{
		xhr.open('POST','ajax_magasin.php', true);
		xhr.addEventListener('readystatechange',
			function() {
				if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
					let assez = parseInt(xhr.responseText);
					if ( assez == 0)
					{
						alert("N'essaye pas de tricher toi -_-");
					}
					else
					{
						Vendre('P',parseInt(input.value));
					}
				}
			}
		);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("VendreP="+parseInt(input.value));
			
	}
	else
	{
		alert('Le nombre indiqué doit être positif');
	}
}
function VendreSP(){
	let input = document.querySelector('input#vendreSP');
	let xhr = new XMLHttpRequest();
	if (parseInt(input.value) > parseInt(input.max))
	{
		alert("Vous n'en possédez pas assez");
	}
	else if ( parseInt(input.value) > parseInt(input.min) && parseInt(input.value) <= parseInt(input.max) )
	{
		xhr.open('POST','ajax_magasin.php', true);
		xhr.addEventListener('readystatechange',
			function() {
				if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
					let assez = parseInt(xhr.responseText);
					if ( assez == 0)
					{
						alert("N'essaye pas de tricher toi -_-");
					}
					else
					{
						Vendre('SP',parseInt(input.value));
					}
				}
			}
		);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("VendreSP="+parseInt(input.value));
			
	}
	else
	{
		alert('Le nombre indiqué doit être positif');
	}
}
function VendreHP(){
	let input = document.querySelector('input#vendreHP');
	let xhr = new XMLHttpRequest();
	if (parseInt(input.value) > parseInt(input.max))
	{
		alert("Vous n'en possédez pas assez");
	}
	else if ( parseInt(input.value) > parseInt(input.min) && parseInt(input.value) <= parseInt(input.max) )
	{
		xhr.open('POST','ajax_magasin.php', true);
		xhr.addEventListener('readystatechange',
			function() {
				if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
					let assez = parseInt(xhr.responseText);
					if ( assez == 0)
					{
						alert("N'essaye pas de tricher toi -_-");
					}
					else
					{
						Vendre('HP',parseInt(input.value));
					}
				}
			}
		);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("vendreHP="+parseInt(input.value));
			
	}
	else
	{
		alert('Le nombre indiqué doit être positif');
	}
}