//UPDATE `pokemonseul` SET `vie`=10 WHERE `numero`=6 or `numero`=7 or `numero`=8 or `numero`=9 or `numero`=10 or `numero`=11
formulaire = document.querySelector('form#soin');

vie1 = document.querySelector('div#vie1');
pokevie1 = document.querySelector('input#pokevie1');
pokevieMax1 = document.querySelector('input#pokevieMax1');

vie2 = document.querySelector('div#vie2');
pokevie2 = document.querySelector('input#pokevie2');
pokevieMax2 = document.querySelector('input#pokevieMax2');

vie3 = document.querySelector('div#vie3');
pokevie3 = document.querySelector('input#pokevie3');
pokevieMax3 = document.querySelector('input#pokevieMax3');

//text = document.querySelector('div.');
vie4 = document.querySelector('div#vie4');
pokevie4 = document.querySelector('input#pokevie4');
pokevieMax4 = document.querySelector('input#pokevieMax4');

vie5 = document.querySelector('div#vie5');
pokevie5 = document.querySelector('input#pokevie5');
pokevieMax5 = document.querySelector('input#pokevieMax5');

vie6 = document.querySelector('div#vie6');
pokevie6 = document.querySelector('input#pokevie6');
pokevieMax6 = document.querySelector('input#pokevieMax6');

pointDeVie = 1;
pointDeVieEnCours = 1;



function RetourCentrePokemon(){
	if (pointDeVieEnCours)
	{
		location.href="menu.php";
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
	vie.innerText=pokevie.value+"/"+pokevieMax.value;
}
BarreDeVie(vie1,pokevie1,pokevieMax1);
if (vie2!=null){BarreDeVie(vie2,pokevie2,pokevieMax2);}
if (vie3!=null){BarreDeVie(vie3,pokevie3,pokevieMax3);}
if (vie4!=null){BarreDeVie(vie4,pokevie4,pokevieMax4);}
if (vie5!=null){BarreDeVie(vie5,pokevie5,pokevieMax5);}
if (vie6!=null){BarreDeVie(vie6,pokevie6,pokevieMax6);}

function RemonterVie(vie,pokevie,pokevieMax){

	if ( parseInt(pokevie.value) < parseInt(pokevieMax.value) && pokevie.value!=null)
	{
		pokevie.value = parseInt(pokevie.value) +1;
		BarreDeVie(vie,pokevie,pokevieMax);
		return 1;
	}
	else
	{
		pokevie.value = parseInt(pokevieMax.value);
		return 0;
	}
}



function Soigner3(){
	var xhr = new XMLHttpRequest();
//	let soin = document.querySelector('div#soin');

	xhr.open('POST','ajax_centrepokemon.php', true);

	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				console.log("Le soin a bien été effectué");				    					    	
			}			
	    }
	);

	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send();
}

function Soigner2(){
	pointDeVieEnCours=0;
	pointDeVie=RemonterVie(vie1,pokevie1,pokevieMax1);
	if (vie2!=null){pointDeVie=pointDeVie+RemonterVie(vie2,pokevie2,pokevieMax2);}
	if (vie3!=null){pointDeVie=pointDeVie+RemonterVie(vie3,pokevie3,pokevieMax3);}
	if (vie4!=null){pointDeVie=pointDeVie+RemonterVie(vie4,pokevie4,pokevieMax4);}
	if (vie5!=null){pointDeVie=pointDeVie+RemonterVie(vie5,pokevie5,pokevieMax5);}
	if (vie6!=null){pointDeVie=pointDeVie+RemonterVie(vie6,pokevie6,pokevieMax6);}
	if (pointDeVie==0)
	{
		pointDeVieEnCours=1;
		clearInterval(interval);
		//formulaire.submit();
		Soigner3();
	}
}

function Soigner(){
	interval=setInterval(Soigner2,4);		
}