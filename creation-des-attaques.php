<?php 
	include('bdd.php'); 
?>
<!DOCTYPE html>
<head>
	<title>base de données</title>
	<meta charset="utf-8">
</head>
<body>
	<?php
	if ($link)
	{
		$resultat=mysqli_query($link,'TRUNCATE Attaque;'); //vide initialement la table attaque au cas où elle serait déjà rempli pour des tuples

		$nombre = 0;
		$nombreTotal = 0;
		//nom,dégat,pp,type,description
		$liste = array(	'Escalade'=>array('Escalade',90,20,10,'Le lanceur se jette violemment sur l’ennemi. Peut aussi le rendre confus.'),
/*Normal*/				'Uppercut'=>array('Uppercut',70,10,10,'Un enchaînement de coups de poing cadencés. Peut aussi rendre confus.'),
						'Attrition'=>array('Attrition',70,20,10,'Une attaque puissante quand l’ennemi baisse sa garde. Inflige des dégâts sans tenir compte des changements de stats.'),
						'Vitesse Extrême'=>array('Vitesse Extrême',80,5,10,'Le lanceur charge à une vitesse renversante. Cette attaque a toujours lancer en premier.'),
						'Tranche'=>array('Tranche',70,20,10,'Un coup de griffe ou autre tranche l’ennemi. Taux de critiques élevé.'),
						'Plaquage'=>array('Plaquage',85,15,10,'Le lanceur se laisse tomber sur l’ennemi de tout son poids. Peut le paralyser.'),
						'Charge'=>array('Charge',50,35,10,'Le lanceur charge l’ennemi et le percute de tout son corps.'),
						'Force Poigne'=>array('Force Poigne',55,30,10,'L’ennemi est attrapé et compressé par les côtés.'),
						'Griffe'=>array('Griffe',40,35,10,'Lacère l’ennemi avec des griffes acérées pour lui infliger des dégâts.'),
						'Ultimapoing'=>array('Ultimapoing',80,20,10,'L’ennemi reçoit un coup de poing d’une puissance incroyable.'),
						'Coupe'=>array('Coupe',50,30,10,'Coupe l’ennemi avec des lames ou des griffes. Hors combat, permet de couper des arbres fins.'),
						'Furie'=>array('Furie',15,20,10,'Frappe l’ennemi 2 à 5 fois d’affilée avec un bec ou une corne.'),
						'Coup de Boule'=>array('Coup de Boule',70,15,10,'Le lanceur donne un coup de tête. Peut apeurer l’ennemi.'),
						'Ultimawashi'=>array('Ultimawashi',120,5,10,'Un coup de pied superpuissant et intense qui frappe l’ennemi.'),
						'Souplesse'=>array('Souplesse',80,75,10,'Fouette l’ennemi avec la queue, une liane, etc. pour infliger des dégâts.'),
						'Écras Face'=>array('Écras Face',40,35,10,'	Écrase l’ennemi avec les pattes avant, la queue, etc.'),
						'Vive-Attaque'=>array('Vive-Attaque',40,30,10,'Le lanceur fonce sur l’ennemi si rapidement qu’on parvient à peine à le discerner. Frappe en premier.'),
						'Force'=>array('Force',80,15,10,'Le lanceur cogne l’ennemi de toutes ses forces. Permet aussi de déplacer des rochers.'),
/*COMBAT*/				'Dynamopoing'=>array('Dynamopoing',100,5,2,'Le lanceur rassemble ses forces et envoie un coup de poing à l’ennemi. S’il est touché, il est confus.'),
						'Double Pied'=>array('Double Pied',30,30,2,'Deux coups de pied qui frappent l’ennemi deux fois d’affilée.'),
						'Éclate-Roc'=>array('Éclate-Roc',40,15,2,'Porte un coup dévastateur à l’ennemi. Peut briser des rochers fissurés. Peut baisser la Défense.'),
						'Poing-Karaté'=>array('Poing-Karaté',50,25,2,'L’ennemi est tranché violemment. Taux de critiques élevé.'),
						'Coup-Croix'=>array('Coup-Croix',100,5,2,'Le lanceur délivre un coup double en croisant les avant-bras. Taux de critiques élevé.'),
						'Onde Vide'=>array('Onde Vide',40,30,2,'Le lanceur agite son poing pour projeter une onde de vide. Frappe toujours en premier.'),
						'Mawashi Geri'=>array('Mawashi Geri',60,15,2,'Le lanceur effectue un coup de pied tournoyant et extrêmement rapide. Peut apeurer l’ennemi.'),
						'Poing Boost'=>array('Poing Boost',40,20,2,''),
						'Stratopercut'=>array('Stratopercut',85,15,2,'Le lanceur attaque avec un uppercut. Il envoie son poing vers le ciel de toutes ses forces.'),
						'Aurasphère'=>array('Aurasphère',80,20,2,'Le lanceur dégage une aura et projette de l’énergie. N’échoue jamais.'),
						'Mach Punch'=>array('Mach Punch',40,30,2,'Coup de poing fulgurant. Frappe en premier.'),
						'Forte-Paume'=>array('Forte-Paume',60,10,2,'Une onde de choc frappe l’ennemi. Peut aussi paralyser la cible.'),
						'Casse-Brique'=>array('Casse-Brique',75,15,2,'Permet aussi de briser les barrières comme Mur Lumière et Protection.'),
						'Exploforce'=>array('Exploforce',120,5,2,'Le lanceur rassemble ses forces et laisse éclater son pouvoir. Peut aussi baisser la Défense Spéciale de l’ennemi.'),
						'Balayage'=>array('Balayage',40,20,2,'Un puissant coup de pied bas qui fauche l’ennemi.'),
						'Frappe Atlas'=>array('Frappe Atlas',70,20,2,'L’ennemi est projeté grâce au pouvoir de la gravité.'),
						'Pied Voltige'=>array('Pied Voltige',130,10,2,'Le lanceur s’élance pour effectuer un coup de genou sauté. S’il échoue, le lanceur se blesse.'),
						'Mitra-Poing'=>array('Mitra-Poing',150,20,2,'Le lanceur se concentre avant d’attaquer. Échoue s’il est touché avant d’avoir frappé.'),
/*VOL*/					'Aéropique'=>array('Aéropique',60,20,18,'Le lanceur prend l’ennemi de vitesse et le lacère. N’échoue Jamais.'),
						'Tranch Air'=>array('Tranch Air',60,25,18,'Le lanceur appelle des vents tranchants qui lacèrent l’ennemi. Taux de critiques élevé.'),
						'Lame dAir'=>array('Lame dAir',75,15,18,'Le lanceur attaque avec une lame d’air qui fend tout. Peut aussi apeurer l’ennemi.'),
						'Picpic'=>array('Picpic',35,35,18,'Frappe l’ennemi d’un bec pointu ou d’une corne pour infliger des dégâts.'),
						'Chute Libre'=>array('Chute Libre',60,10,18,'Le lanceur emmène l’ennemi dans les airs et le lâche dans le vide.'),
						'Bec Vrille'=>array('Bec Vrille',80,20,18,'Une attaque utilisant le bec comme une perceuse.'),
						'Acrobatie'=>array('Acrobatie',55,15,18,'Attaque agile. Si le lanceur ne tient pas d’objet, l’attaque inflige davantage de dégâts.'),
						'Vent Violent'=>array('Vent Violent',110,10,18,'Le lanceur déclenche une tempête de vents violents qui s’abat sur l’ennemi. Peut aussi le rendre confus.'),
						'Piqué'=>array('Piqué',140,5,18,'Une attaque au taux de critiques élevé. Peut aussi apeurer l’ennemi.'),
						'Vol'=>array('Vol',90,15,18,'Le lanceur s’envole et frappe. Permet aussi de voler jusqu’à une ville déjà visitée.'),
						'Cru-Aile'=>array('Cru-Aile',60,35,18,'L’ennemi est frappé par de larges ailes déployées pour infliger des dégâts.'),
						'Tornade'=>array('Tornade',40,35,18,''),
						'Aéroblast'=>array('Aéroblast',100,5,18,'Le lanceur projette une tornade sur l’ennemi pour infliger des dégâts. Taux de critiques élevé.'),
						'Rebond'=>array('Rebond',85,5,18,'Le lanceur bondit très haut et plonge sur l’ennemi au 2è tour. Peut aussi paralyser l’ennemi.'),
						'Picore'=>array('Picore',60,20,18,'Le lanceur picore la cible. Si cette dernière tient une Baie, le lanceur la mange et profite de ses effets.'),
						'Rapace'=>array('Rapace',120,15,18,'Le lanceur replie ses ailes et charge en rase-mottes. Le lanceur subit aussi de graves dégâts.'),
/*POISON*/				'Acide'=>array('Acide',40,30,12,'Le lanceur attaque l’ennemi avec un jet d’acide corrosif. Peut aussi baisser la Défense Spéciale de l’ennemi.'),
						'Détricanon'=>array('Détricanon',120,5,12,'Le lanceur envoie des détritus sur l’ennemi. Peut aussi l’empoisonner.'),
						'Poison-Croix'=>array('Poison-Croix',70,20,12,'Un coup tranchant qui peut empoisonner l’ennemi. Taux de critiques élevé.'),
						'Bain de Smog'=>array('Bain de Smog',50,15,12,'Le lanceur jette un tas de détritus spéciaux sur la cible. Les changements de stats de la cible sont annulés.'),
						'Gaz Toxik'=>array('Gaz Toxik',60,40,12,'Un nuage de gaz toxique est projeté au visage de l’ennemi. Peut l’empoisonner.'),
						'Direct Toxik'=>array('Direct Toxik',80,20,12,'Attaque l’ennemi avec un tentacule ou un bras plein de poison. Peut aussi l’empoisonner.'),
						'Purédpois'=>array('Purédpois',30,20,12,'Le lanceur attaque à l’aide d’une éruption de gaz répugnants. Peut aussi empoisonner l’ennemi.'),
						'Détritus'=>array('Détritus',65,20,12,'Des détritus toxiques sont projetés sur l’ennemi. Peut aussi l’empoisonner.'),
						'Crochet Venin'=>array('Crochet Venin',50,15,12,'Le lanceur mord l’ennemi de ses crocs toxiques. Peut aussi l’empoisonner gravement.'),
						'Bombe Acide'=>array('Bombe Acide',40,20,12,'Un liquide acide qui fait fondre l’ennemi. Sa Défense Spéciale diminue beaucoup.'),
						'Bomb-Beurk'=>array('Bomb-Beurk',90,10,12,'Des détritus toxiques sont projetés sur l’ennemi. Peut aussi l’empoisonner.'),
						'Choc Venin'=>array('Choc Venin',65,10,12,'L’effet est doublé si l’ennemi est déjà empoisonné.'),
						'Cradovague'=>array('Cradovague',95,10,12,'Une vague de détritus attaque tous les Pokémon autour du lanceur. Peut aussi empoisonner.'),
						'Queue-Poison'=>array('Queue-Poison',50,25,12,'Attaque à taux de critiques élevé. Peut aussi empoisonner l’ennemi.'),
						'Dard-Venin'=>array('Dard-Venin',15,35,12,'Un dard toxique qui transperce l’ennemi. Peut aussi l’empoisonner.'),
						'Pics Toxik'=>array('Pics Toxik',40,20,12,'Lance des pics autour de l’ennemi. Ils empoisonnent les ennemis.'),
						'Suc Digestif'=>array('Suc Digestif',65,10,12,'Le lanceur répand ses sucs digestifs sur l’ennemi. Le fluide neutralise la capacité spéciale de l’ennemi.'),
						'Piège de Venin'=>array('Piège de Venin',40,20,12,''),
/*SOL*/					'Boue-Bombe'=>array('Boue-Bombe',65,10,15,'Le lanceur attaque à l’aide d’une boule de boue solidifiée. Peut aussi baisser la Précision de l’ennemi.'),
						'Telluriforce'=>array('Telluriforce',90,10,15,'Des éruptions volcaniques ont lieu sous l’ennemi. Peut aussi baisser la Défense Spéciale de l’ennemi.'),
						'Massd Os'=>array('Massd Os',65,20,15,'Le lanceur frappe l’ennemi à grands coups d’os. Peut aussi apeurer l’ennemi.'),
						'Osmerang'=>array('Osmerang',50,10,15,'Le lanceur projette son os comme un boomerang. Cette attaque frappe à l’aller et au retour.'),
						'Force Chtonienne'=>array('Force Chtonienne',90,10,15,''),
						'Tunnelier'=>array('Tunnelier',80,10,15,'le lanceur tourne sur lui-même comme une perceuse et se jette sur l’ennemi. Taux de critiques élevé.'),
						'Piétisol'=>array('Piétisol',60,20,15,'Le lanceur piétine le sol et inflige des dégâts à tous les Pokémon autour de lui. Baisse aussi la Vitesse.'),
						'Tir de Boue'=>array('Tir de Boue',55,15,15,'Le lanceur attaque en projetant de la boue sur l’ennemi. Réduit aussi la Vitesse de la cible.'),
						'Tourbi-Sable'=>array('Tourbi-Sable',35,15,15,'Le lanceur emprisonne l’ennemi dans une tempête de sable terrifiante.'),
						'Charge-Os'=>array('Charge-Os',25,10,15,'Le lanceur frappe l’ennemi avec un os.'),
						'Coud Boue'=>array('Coud Boue',20,10,15,'Le lanceur envoie de la boue au visage de l’ennemi pour infliger des dégâts et baisser sa Précision.'),
						'Séisme'=>array('Séisme',100,10,15,'Le lanceur provoque un tremblement de terre touchant tous les Pokémon autour de lui.'),
						'Myria-Flèches'=>array('Myria-Flèches',90,10,15,''),
						'Myria-Vagues'=>array('Myria-Vagues',90,10,15,''),
						'Tunnel'=>array('Tunnel',80,10,15,'Le lanceur creuse puis frappe. Permet aussi de s’échapper d’un donjon.'),
						'Ampleur'=>array('Ampleur',50,30,15,'Un tremblement de terre d’intensité variable qui affecte tous les Pokémon alentour. L’efficacité varie.'),
						'Abîme'=>array('Abîme',150,5,15,'	Le lanceur fait tomber l’ennemi dans une crevasse.'),
						'Picots'=>array('Picots',40,20,15,'Le lanceur disperse des piquants sur le sol pour blesser tout ennemi.'),
/*ROCHE*/				'Roulade'=>array('Roulade',30,20,14,'Un rocher roule sur l’ennemi.'),
						'Rayon Gemme'=>array('Rayon Gemme',80,20,14,'Le lanceur attaque avec un rayon de lumière qui scintille comme s’il était composé de gemmes.'),
						'Jet-Pierres'=>array('Jet-Pierres',50,15,14,'	Le lanceur lâche une pierre sur l’ennemi.'),
						'Tomberoche'=>array('Tomberoche',60,15,14,'Des rochers frappent l’ennemi. Réduit aussi sa Vitesse en l’empêchant de se déplacer.'),
						'Boule Roc'=>array('Boule Roc',25,10,14,'Le lanceur projette un rocher sur l’ennemi.'),
						'Lame de Roc'=>array('Lame de Roc',100,5,14,'Fait surgir des pierres aiguisées sous l’ennemi. Taux de critiques élevé.'),
						'Orage Adamantin'=>array('Orage Adamantin',100,5,14,''),
						'Éboulement'=>array('Éboulement',75,10,14,'Envoie de gros rochers sur l’ennemi pour infliger des dégâts. Peut aussi l’apeurer.'),
						'Roc-Boulet'=>array('Roc-Boulet',150,5,14,'Le lanceur attaque en projetant un gros rocher sur l’ennemi.'),
						'Pouvoir Antique'=>array('Pouvoir Antique',60,5,14,'Une attaque préhistorique qui peut augmenter toutes les stats du lanceur d’un seul coup.'),
						'Fracass Tête'=>array('Fracass Tête',150,5,14,'Le lanceur assène un coup de tête désespéré.'),
						'Piège de Roc'=>array('Piège de Roc',80,20,14,'Lance des pierres flottantes autour de l’ennemi qui le blesse'),
						'Tempête de Sable'=>array('Tempête de Sable',75,10,14,'Une tempête de sable qui blesse.'),
						'Anti-Air'=>array('Anti-Air',50,15,14,'Le lanceur jette toutes sortes de projectiles à un ennemi. Si ce dernier vole, il tombe au sol.'),
/*INSECTE*/				'Harcèlement'=>array('Harcèlement',20,20,9,'Le lanceur attaque sans répit.'),
						'Demi-Tour'=>array('Demi-Tour',70,20,9,'Après son attaque, le lanceur revient à toute vitesse.'),
						'Dard-Nuée'=>array('Dard-Nuée',75,20,9,'Envoie une rafale de dards.'),
						'Double-Dard'=>array('Double-Dard',50,20,9,'Un double coup de dard qui transperce l’ennemi 2 fois d’affilée. Peut aussi l’empoisonner.'),
						'Dard Mortel'=>array('Dard Mortel',30,25,9,''),
						'Rayon Signal'=>array('Rayon Signal',75,15,9,'Le lanceur projette un rayon de lumière sinistre. Peut aussi rendre l’ennemi confus.'),
						'Vent Argenté'=>array('Vent Argenté',60,5,9,'Vent qui projette des écailles poudreuses sur l’ennemi. Peut aussi monter toutes les stats du lanceur.'),
						'Plaie-Croix'=>array('Plaie-Croix',80,15,9,'Le lanceur taillade l’ennemi en utilisant ses faux ou ses griffes comme une paire de ciseaux.'),
						'Piqûre'=>array('Piqûre',60,20,9,'Le lanceur pique l’ennemi. Si ce dernier tient une Baie, le lanceur la dévore et obtient son effet.'),
						'Appel Attak'=>array('Appel Attak',90,15,9,'Le lanceur appelle ses sous-fifres pour frapper l’ennemi. Taux de critiques élevé.'),
						'Survinsecte'=>array('Survinsecte',50,20,9,'Le lanceur se débat de toutes ses forces, et baisse l’Attaque Spéciale de l’ennemi.'),
						'Taillade'=>array('Taillade',40,20,9,'Un coup de faux ou de griffe dont la force augmente quand il touche plusieurs fois d’affilée.'),
						'Vampirisme'=>array('Vampirisme',20,15,9,'Une attaque qui aspire le sang de l’ennemi.'),
						'Mégacorne'=>array('Mégacorne',120,10,9,'Le lanceur utilise ses gigantesques cornes pour charger l’ennemi.'),
						'Bourdon'=>array('Bourdon',90,10,9,'Le lanceur fait vibrer ses ailes pour lancer une vague sonique. Peut aussi baisser la Défense Spéciale de l’ennemi.'),
						'Bulldoboule'=>array('Bulldoboule',65,20,9,'Le lanceur se roule en boule et écrase son ennemi. Peut aussi apeurer l’ennemi.'),
						'Nuée de Poudre'=>array('Nuée de Poudre',20,20,9,'Lance un nuage de poudre.'),
						'Toile'=>array('Toile',80,10,9,'	Le lanceur enserre l’ennemi à l’aide d’une fine soie gluante.'),
/*SPECTRE*/				'Revenant'=>array('Revenant',120,5,16,'Le lanceur disparaît puis frappe l’ennemi. Fonctionne même si l’ennemi se protège.'),
						'Hantise'=>array('Hantise',90,10,16,'Le lanceur disparaît puis frappe. Cete attaque passe outre les protections.'),
						'Ball Ombre'=>array('Ball Ombre',80,15,16,'Projette une grande ombre. Peut aussi faire baisser sa Défense Spéciale.'),
						'Vent Mauvais'=>array('Vent Mauvais',60,5,16,'Le lanceur crée une violente bourrasque. Peut aussi augmenter toutes ses stats.'),
						'Châtiment'=>array('Châtiment',65,10,16,'Attaque acharnée qui cause davantage de dégâts à l’ennemi s’il a un problème de statut.'),
						'Léchouille'=>array('Léchouille',30,30,16,'Un grand coup de langue qui inflige des dégâts à l’ennemi. Peut aussi le paralyser.'),
						'Griffe Ombre'=>array('Griffe Ombre',70,15,16,'Attaque avec une griffe puissante faite d’ombres. Taux de critiques élevé.'),
						'Ombre Portée'=>array('Ombre Portée',40,30,16,'Le lanceur étend son ombre pour frapper par derrière. Frappe toujours en premier.'),
						'Poing Ombre'=>array('Poing Ombre',60,20,16,'Le lanceur surgit des ombres et donne un coup de poing. N’échoue jamais.'),
						'Étonnement'=>array('Étonnement',30,15,16,'Le lanceur attaque l’ennemi en poussant un cri terrifiant. Peut aussi l’apeurer.'),
/*ACIER*/				'Gyroballe'=>array('Gyroballe',120,5,1,'Le lanceur effectue une rotation et frappe l’ennemi. Plus le lanceur est lent, plus il fait de dégâts.'),
						'Lancécrou'=>array('Lancécrou',80,15,1,'Le lanceur jette deux écrous d’acier qui frappent l’ennemi deux fois d’affilée.'),
						'Pisto-Poing'=>array('Pisto-Poing',40,30,1,'Le lanceur envoie des coups de poing aussi rapides que des balles de revolver. Frappe toujours en premier.'),
						'Tacle Lourd'=>array('Tacle Lourd',65,10,1,'Le lanceur se jette sur l’ennemi de tout son poids. S’il est plus lourd que l’ennemi, l’effet augmente en conséquence.'),
						'Bombaimant'=>array('Bombaimant',60,20,1,'Le lanceur projette des bombes d’acier qui collent à l’ennemi. N’échoue jamais.'),
						'Tête de Fer'=>array('Tête de Fer',80,15,1,'Le lanceur heurte l’ennemi avec sa tête dure comme de l’acier. Peut aussi apeurer l’ennemi'),
						'Miroi-Tir'=>array('Miroi-Tir',65,10,1,'Le corps poli du lanceur libère un éclair d’énergie.'),
						'Luminocanon'=>array('Luminocanon',80,10,1,'Le lanceur concentre son énergie lumineuse et la fait exploser.'),
						'Fulmifer'=>array('Fulmifer',70,10,1,'Le lanceur attaque le dernier ennemi l’ayant blessé durant le même tour en frappant plus fort.'),
						'Carnareket'=>array('Carnareket',140,5,1,'Le lanceur génère une sphère lumineuse qu’il projette'),
						'Strido-Son'=>array('Strido-Son',40,40,1,'Un cri horrible tel un crissement métallique;'),
						'Griffe Acier'=>array('Griffe Acier',50,35,1,'Attaque avec des griffes d’acier. Peut aussi augmenter l’Attaque du lanceur.'),
						'Queue de Fer'=>array('Queue de Fer',100,15,1,'Attaque l’ennemi avec une queue de fer. Peut aussi baisser la Défense de l’ennemi.'),
						'Poing Météor'=>array('Poing Météor',90,10,1,'Un coup de poing lancé à la vitesse d’un météore. Peut aussi augmenter l’Attaque du lanceur.'),
						'Aile dAcier'=>array('Aile dAcier',70,25,1,'Le lanceur frappe l’ennemi avec des ailes d’acier. Peut aussi augmenter la Défense du lanceur.'),
/*FEU*/					'Incendie'=>array('Incendie',100,5,7,'Des flammes rougeoyantes s’abattent sur tous les Pokémon autour du lanceur. Peut aussi brûler.'),
						'Flamme Bleue'=>array('Flamme Bleue',130,5,7,'De magnifiques et redoutables flammes bleues fondent sur l’ennemi. Peut aussi le brûler.'),
						'Crocs Feu'=>array('Crocs Feu',65,15,7,'Le lanceur utilise une morsure enflammée. Peut aussi brûler ou apeurer l’ennemi.'),
						'Rafale Feu'=>array('Rafale Feu',150,5,7,'Une explosion ardente souffle l’adversaire.'),
						'Danse Flamme'=>array('Danse Flamme',35,15,7,'Un tourbillon de flammes.'),
						'Flamme Croix'=>array('Flamme Croix',100,5,7,'Projette une boule de feu gigantesque. L’effet augmente sous l’influence d’Éclair Croix.'),
						'Éruption'=>array('Éruption',150,5,7,'Le lanceur laisse exploser sa colère. Plus ses PV sont bas et moins l’attaque est puissante'),
						'Danse du Feu'=>array('Danse du Feu',80,10,7,'Le lanceur enveloppe l’ennemi de flammes. Peut aussi augmenter l’Attaque Spéciale du lanceur.'),
						'Feu Ensorcelé'=>array('Feu Ensorcelé',65,10,7,'Attaque avec des flammes brûlantes soufflées de la bouche du lanceur.'),
						'Vortex Magma'=>array('Vortex Magma',100,5,7,'L’ennemi est pris dans un tourbillon de feu.'),
						'Lance-Flammes'=>array('Lance-Flammes',90,15,7,'L’ennemi reçoit un torrent de flammes. Peut aussi le brûler.'),
						'Calcination'=>array('Calcination',60,15,7,'Des flammes calcinent l’ennemi. S’il tient une Baie, elle est brûlée et devient inutilisable.'),
						'Rebondifeu'=>array('Rebondifeu',70,15,7,'Quand l’attaque atteint sa cible, elle projette des flammes qui touchent tout ennemi situé à côté.'),
						'Flammèche'=>array('Flammèche',40,25,7,'L’ennemi est attaqué par de faibles flammes. Peut aussi le brûler.'),
						'Nitrocharge'=>array('Nitrocharge',50,100,7,'Le lanceur s’entoure de flammes pour attaquer l’ennemi. Il se concentre et sa Vitesse augmente.'),
						'Déflagration'=>array('Déflagration',110,5,7,'Un déluge de flammes ardentes submerge l’ennemi. Peut aussi le brûler.'),
						'Feu dEnfer'=>array('Feu dEnfer',100,5,7,'L’ennemi est entouré d’un torrent de flammes ardentes qui le brûlent.'),
						'Poing de Feu'=>array('Poing de Feu',75,15,7,'Un coup de poing enflammé vient frapper l’ennemi. Peut le brûler.'),
/*EAU*/					'Écume'=>array('Écume',40,30,4,'Des bulles frappent l’ennemi. Peut réduire sa Vitesse.'),
						'Plongée'=>array('Plongée',80,10,4,'Le lanceur plonge sous l’eau puis frappe. Permet aussi de plonger au fond de l’eau.'),
						'Claquoir'=>array('Claquoir',70,15,4,'Le lanceur piège l’ennemi dans sa dure coquille puis l’écrase.'),
						'Hydrocanon'=>array('Hydrocanon',110,5,4,'Un puissant jet d’eau est dirigé sur l’ennemi.'),
						'Cascade'=>array('Cascade',80,15,4,'Le lanceur charge l’ennemi à une vitesse remarquable, ce qui peut l’apeurer. Permet aussi de franchir une cascade.'),
						'Siphon'=>array('Siphon',70,15,4,'Piège l’ennemi dans une trombe d’eau.'),
						'Sheauriken'=>array('Sheauriken',60,20,4,'Lance un sheauriken en eau.'),
						'Surf'=>array('Surf',90,15,4,'Une énorme vague s’abat sur le champ de bataille. Permet aussi de voyager sur l’eau.'),
						'Pistolet à O'=>array('Pistolet à O',40,25,4,'De l’eau est projetée sur l’ennemi en arc de cercle.'),
						'Bulles dO'=>array('Bulles dO',65,20,4,'Des bulles sont envoyées avec puissance sur l’ennemi. Peut aussi baisser sa Vitesse.'),
						'Hydroqueue'=>array('Hydroqueue',90,10,4,'Le lanceur attaque en balançant sa queue comme une lame de fond en pleine tempête.'),
						'Vibraqua'=>array('Vibraqua',60,20,4,'Le lanceur envoie un puissant jet d’eau sur l’ennemi. Peut rendre l’ennemi confus.'),
						'Aqua-Jet'=>array('Aqua-Jet',40,20,4,'Le lanceur fonce sur l’ennemi si rapidement qu’on parvient à peine à le discerner. Frappe en premier.'),
						'Jet de Vapeur'=>array('Jet de Vapeur',110,5,4,''),
						'Octazooka'=>array('Octazooka',65,10,4,'Le lanceur attaque en projetant de l’encre au visage de l’ennemi. Peut aussi baisser la Précision de l’ennemi.'),
						'Pince-Masse'=>array('Pince-Masse',100,10,4,'Une grande pince martèle l’ennemi. Taux de critiques élevé.'),
						'Coquilame'=>array('Coquilame',75,10,4,'Un coquillage aiguisé lacère l’ennemi. Peut aussi baisser sa Défense.'),
						'Aire dEau'=>array('Aire dEau',80,10,4,'Une masse d’eau s’abat sur l’ennemi. En l’utilisant avec Aire de Feu, l’effet augmente et un arc-en-ciel apparaît.'),
/*PLANTE*/				'Phytomixeur'=>array('Phytomixeur',65,10,11,'L’ennemi est pris dans un tourbillon de feuilles acérées. Peut aussi baisser la Précision de l’ennemi.'),
						'Fouet Lianes'=>array('Fouet Lianes',45,25,11,'Fouette l’ennemi avec de fines lianes pour infliger des dégâts.'),
						'Feuille Magik'=>array('Feuille Magik',60,20,11,'Le lanceur disperse d’étranges feuilles qui poursuivent l’ennemi. N’échoue jamais.'),
						'Végé-Attak'=>array('Végé-Attak',150,5,11,'Un violent coup de racines s’abat sur l’ennemi.'),
						'Aire dHerbe'=>array('Aire dHerbe',80,10,11,'Une masse végétale s’abat sur l’ennemi. En l’utilisant avec Aire d’Eau, l’effet augmente et un marécage apparaît.'),
						'Balle Graine'=>array('Balle Graine',75,30,11,'Le lanceur mitraille l’ennemi avec une rafale de graines.'),
						'Fulmigraine'=>array('Fulmigraine',120,5,11,'Le corps du lanceur émet une onde de choc. Peut aussi baisser grandement la Défense Spéciale de la cible.'),
						'Mégafouet'=>array('Mégafouet',120,10,11,'Le lanceur fait virevolter violemment ses lianes ou ses tentacules pour fouetter l’ennemi.'),
						'Tempête Verte'=>array('Tempête Verte',130,5,11,'Invoque une tempête de feuilles acérées. Le contrecoup réduit fortement l’Attaque Spéciale du lanceur.'),
						'Éco-Sphère'=>array('Éco-Sphère',90,10,11,'Utilise les pouvoirs de la nature pour attaquer l’ennemi. Peut aussi baisser la Défense Spéciale de l’ennemi.'),
						'Danse-Fleur'=>array('Danse-Fleur',120,10,11,'Le lanceur attaque en projetant des pétales.'),
						'Lame-Feuille'=>array('Lame-Feuille',90,15,11,'Une feuille coupante comme une lame entaille l’ennemi. Taux de critiques élevé.'),
						'Tempête Florale'=>array('Tempête Florale',90,15,11,'Déclenche une violente tempête de fleurs qui inflige des dégâts à tous les Pokémon alentour.'),
						'Lance-Soleil'=>array('Lance-Soleil',120,10,11,'Absorbe la lumière puis envoie un rayon puissant.'),
						'Tranch Herbe'=>array('Tranch Herbe',55,95,11,'Des feuilles aiguisées comme des rasoirs entaillent l’ennemi. Taux de critiques élevé.'),
						'Poing Dard'=>array('Poing Dard',60,15,11,'Le lanceur attaque en fouettant l’ennemi de ses bras épineux. Peut aussi l’apeurer.'),
						'Canon Graine'=>array('Canon Graine',80,15,11,'Le lanceur fait pleuvoir un déluge de graines solides sur l’ennemi.'),
						'Martobois'=>array('Martobois',120,15,11,'Le lanceur heurte l’ennemi de son corps robuste. Inflige de sérieux dégâts au lanceur aussi.'),
/*ELECTRIK*/			'Poing-Éclair'=>array('Poing-Éclair',75,100,5,'Un coup de poing électrique vient frapper l’ennemi. Peut le paralyser.'),
						'Éclair'=>array('Éclair',40,30,5,'Une décharge électrique tombe sur l’ennemi. Peut aussi le paralyser.'),
						'Crocs Éclair'=>array('Crocs Éclair',65,15,5,'Le lanceur utilise une morsure électrifiée. Peut aussi paralyser ou apeurer l’ennemi.'),
						'Frotte-Frimousse'=>array('Frotte-Frimousse',20,100,5,'Le lanceur attaque en frottant ses bajoues chargées d’électricité. Paralyse l’ennemi.'),
						'Onde de Choc'=>array('Onde de Choc',60,20,5,'Le lanceur envoie un choc électrique rapide à l’ennemi. Impossible à esquiver.'),
						'Étincelle'=>array('Étincelle',65,20,5,'Lance une charge électrique sur l’ennemi. Peut aussi le paralyser.'),
						'Électacle'=>array('Électacle',120,15,5,'Le lanceur électrifie son corps avant de charger. Le choc blesse aussi beaucoup le lanceur et peut paralyser l’ennemi.'),
						'Élecanon'=>array('Élecanon',120,5,5,'Un boulet de canon électrifié qui inflige des dégâts et paralyse l’ennemi.'),
						'Parabocharge'=>array('Parabocharge',50,20,5,'Soigne l’utilisateur pour la moitié des dégâts infligés à l’ennemi.'),
						'Éclair Croix'=>array('Éclair Croix',100,5,5,'Projette un orbe électrique gigantesque. L’effet augmente sous l’influence de Flamme Croix.'),
						'Change Éclair'=>array('Change Éclair',70,20,5,'Après son attaque, le lanceur revient à toute vitesse et change de place avec un Pokémon de l’équipe prêt au combat.'),
						'Tonnerre'=>array('Tonnerre',90,15,5,'Une grosse décharge électrique tombe sur l’ennemi. Peut aussi le paralyser.'),
						'Rayon Chargé'=>array('Rayon Chargé',50,10,5,'Le lanceur tire un rayon chargé d’électricité. Peut aussi augmenter son Attaque Spéciale.'),
						'Charge Foudre'=>array('Charge Foudre',130,5,5,'S’enveloppe d’une charge électrique surpuissante et se jette sur l’ennemi. Peut aussi le paralyser.'),
						'Fatal-Foudre'=>array('Fatal-Foudre',110,10,5,'La foudre tombe sur l’ennemi pour lui infliger des dégâts. Peut aussi le paralyser.'),
						'Coup dJus'=>array('Coup dJus',80,15,5,'Un flamboiement d’électricité frappe tous les Pokémon autour du lanceur. Peut aussi paralyser.'),
						'Éclair Fou'=>array('Éclair Fou',90,15,5,'Une charge électrique violente qui blesse aussi légèrement le lanceur.'),
						'Toile Élek'=>array('Toile Élek',55,15,5,'Attrape l’ennemi dans un filet électrique. Baisse aussi la Vitesse de l’ennemi.'),
/*PSY*/					'Psyko'=>array('Psyko',90,10,13,'Une puissante force télékinésique frappe l’ennemi. Peut aussi faire baisser sa Défense Spéciale.'),
						'Frappe Psy'=>array('Frappe Psy',100,10,13,'Le lanceur matérialise des ondes mystérieuses qu’il projette sur l’ennemi. Inflige des dégâts physiques.'),
						'Choc Mental'=>array('Choc Mental',50,25,13,'Une faible vague télékinésique frappe l’ennemi. Peut aussi le plonger dans la confusion.'),
						'Crève-Cœur'=>array('Crève-Cœur',60,25,13,'Déconcentre l’ennemi avec des mouvements mignons avant de le frapper violemment. Peut apeurer l’ennemi.'),
						'Rafale Psy'=>array('Rafale Psy',65,20,13,'Un étrange rayon frappe l’ennemi. Peut aussi le rendre confus.'),
						'Dévorêve'=>array('Dévorêve',100,15,13,'Le lanceur récupère en PV la moitié des dégâts infligés.'),
						'Coupe Psycho'=>array('Coupe Psycho',70,20,13,'Le lanceur entaille l’ennemi grâce à des lames faites de pouvoir psychique. Taux de critiques élevé.'),
						'Psykoud Boul'=>array('Psykoud Boul',80,90,13,'Le lanceur concentre sa volonté et donne un coup de tête. Peut aussi apeurer l’ennemi.'),
						'Prescience'=>array('Prescience',120,10,13,'De l’énergie psychique vient frapper l’ennemi l’utilisation de cette capacité.'),
						'Lumi-Éclat'=>array('Lumi-Éclat',70,5,13,'Le lanceur libère un éclair lumineux. Peut aussi baisser la Défense Spéciale de l’ennemi.'),
						'Ball Brume'=>array('Ball Brume',70,5,13,'Une bulle de brume inflige des dégâts à l’ennemi. Peut aussi réduire son Attaque Spéciale.'),
						'Extrasenseur'=>array('Extrasenseur',80,20,13,'Le lanceur attaque avec un pouvoir étrange et invisible. Peut aussi apeurer l’ennemi.'),
						'Psycho Boost'=>array('Psycho Boost',140,5,13,'Attaque l’ennemi à pleine puissance. Le contrecoup baisse énormément l’Attaque Spéciale du lanceur.'),
						'Synchropeine'=>array('Synchropeine',120,10,13,'Des ondes mystérieuses blessent tous les Pokémon alentour qui sont du même type que le lanceur.'),
						'Choc Psy'=>array('Choc Psy',80,10,13,'Le lanceur matérialise des ondes mystérieuses qu’il projette sur l’ennemi. Inflige des dégâts physiques.'),
						'Force Ajoutée'=>array('Force Ajoutée',20,100,13,'Le lanceur attaque l’ennemi avec une force accumulée. Plus les stats du lanceur sont augmentées, plus le coup est efficace.'),
						'Gravité'=>array('Gravité',120,5,13,'	La gravité augmente et plaque l’adversaire au sol.'),
						'TrouDimensionnel'=>array('TrouDimensionnel',80,5,13,''),
/*GLACE*/				'Crocs Givre'=>array('Crocs Givre',65,15,8,'Le lanceur utilise une morsure glaciale. Peut aussi geler ou apeurer l’ennemi.'),
						'Avalanche'=>array('Avalanche',60,10,8,'Une attaque deux fois plus puissante si le lanceur a été blessé par l’ennemi durant le tour.'),
						'Ball Glace'=>array('Ball Glace',60,20,8,'Envoie une balle de glace.'),
						'Ère Glaciaire'=>array('Ère Glaciaire',65,10,8,'Un souffle de vent qui congèle tout sur son passage s’abat sur l’ennemi. Réduit aussi sa Vitesse.'),
						'Éclats Glace'=>array('Éclats Glace',40,30,8,'Le lanceur crée des éclats de glace qu’il envoie sur l’ennemi. Frappe toujours en premier.'),
						'Chute Glace'=>array('Chute Glace',85,10,8,'Envoie de gros blocs de glace sur l’ennemi pour lui infliger des dégâts. Peut aussi l’apeurer.'),
						'Stalagtite'=>array('Stalagtite',75,30,8,'Le lanceur jette des pics de glace sur l’ennemi, '),
						'Feu Glacé'=>array('Feu Glacé',140,5,8,'Au second tour, le lanceur projette un souffle de vent glacial dévastateur sur l’ennemi. Peut le brûler.'),
						'Blizzard'=>array('Blizzard',110,5,8,'Une violente tempête de neige est déclenchée sur l’ennemi. Peut aussi le geler.'),
						'Onde Boréale'=>array('Onde Boréale',65,20,8,'Envoie un rayon arc-en-ciel sur l’ennemi. Peut aussi baisser son Attaque'),
						'Vent Glace'=>array('Vent Glace',55,15,8,'Une bourrasque de vent froid blesse l’ennemi. Réduit aussi sa Vitesse.'),
						'Éclair Gelé'=>array('Éclair Gelé',140,5,8,'Projette un bloc de glace électrifié sur l’ennemi. Peut aussi le paralyser.'),
						'Poing-Glace'=>array('Poing-Glace',75,15,8,'Un coup de poing glacé vient frapper l’ennemi. Peut le geler.'),
						'Souffle Glacé'=>array('Souffle Glacé',60,10,8,'Un souffle froid blesse l’ennemi. L’effet est toujours critique.'),
						'Lyophilisation'=>array('Lyophilisation',70,20,8,''),
						'Poudreuse'=>array('Poudreuse',40,25,8,'Le lanceur projette de la neige poudreuse. Peut aussi geler l’ennemi.'),
						'Laser Glace'=>array('Laser Glace',90,10,8,'Un rayon de glace frappe l’ennemi. Peut aussi le geler.'),
						'Glaciation'=>array('Glaciation',140,5,8,'Une vague de froid glacial frappe l’ennemi.'),
/*DRAGON*/				'Dracocharge'=>array('Dracocharge',100,10,3,'Le lanceur frappe l’ennemi d’un air menaçant. Peut aussi apeurer l’ennemi.'),
						'Dracochoc'=>array('Dracochoc',85,10,3,'Le lanceur ouvre la bouche pour envoyer une onde de choc qui frappe l’ennemi.'),
						'Colère'=>array('Colère',120,10,3,'Le lanceur laisse éclater sa rage et attaque.'),
						'Dracosouffle'=>array('Dracosouffle',60,20,3,'Le lanceur souffle fort sur l’ennemi pour infliger des dégâts. Peut aussi le paralyser.'),
						'Spatio-Rift'=>array('Spatio-Rift',100,5,3,'Le lanceur déchire l’ennemi et l’espace autour de lui. Taux de critiques élevé.'),
						'Hurle-Temps'=>array('Hurle-Temps',150,5,3,'Le lanceur frappe si fort qu’il affecte le cours du temps.'),
						'Double Baffe'=>array('Double Baffe',70,15,3,'Le lanceur frappe l’ennemi deux fois d’affilée avec les parties les plus robustes de son corps.'),
						'Draco-Queue'=>array('Draco-Queue',60,90,3,'Un coup puissant qui blesse la cible et l’envoie balader. '),
						'Dracogriffe'=>array('Dracogriffe',80,15,3,'Le lanceur lacère l’ennemi de ses grandes griffes aiguisées.'),
						'Draco Météor'=>array('Draco Météor',130,5,3,'Le lanceur invoque des comètes. Le contrecoup réduit fortement son Attaque Spéciale.'),
						'Ouragan'=>array('Ouragan',40,20,3,'	Déclenche un terrible ouragan sur l’ennemi. Peut aussi l’apeurer.'),
/*FEE*/					'Éclat Magique'=>array('Éclat Magique',80,10,6,'Libère une puissante décharge lumineuse qui inflige des dégâts à l’ennemi.'),
						'Câlinerie'=>array('Câlinerie',90,10,6,'Attaque l’ennemi avec un câlin. Peut diminuer son Attaque.'),
						'Vent Féérique'=>array('Vent Féérique',40,30,6,'Le lanceur crée une bourrasque féerique et frappe la cible avec.'),
						'Pouvoir Lunaire'=>array('Pouvoir Lunaire',95,15,6,''),
						'Vampibaiser'=>array('Vampibaiser',70,10,6,''),
						'Voix Enjôleuse'=>array('Voix Enjôleuse',40,15,6,'Laisse s’échapper une voix enchanteresse qui inflige des dégâts psychiques à l’ennemi. Touche à coup sûr.'),
						'Lumière du Néant'=>array('Lumière du Néant',140,5,6,''),
						'Géo-Contrôle'=>array('Géo-Contrôle',90,10,6,''),
						'Garde Florale'=>array('Garde Florale',100,10,6,''),
						'Brume Capiteuse'=>array('Brume Capiteuse',70,20,6,''),
						'Rayon Lune'=>array('Rayon Lune',110,5,6,''),
						'Doux Baiser'=>array('Doux Baiser',80,10,6,'Le lanceur envoie un bisou si mignon et désarmant qu’il plonge l’ennemi dans la confusion.')
					);

		foreach($liste as $attaque)
		{
			$query = "INSERT INTO Attaque  (nom,degat,pp,type,description)VALUES (
			'".$attaque['0']."',".$attaque['1'].",".$attaque['2'].",'".$attaque['3']."','".$attaque['4']."');";

			$resultat=mysqli_query($link,$query);

			if($resultat)
			{
				$nombre = $nombre + 1;
			}
			else
			{
				echo "<p><font color='red'>ERREUR</font> : ".$query."</p><br/>";
			}
			$nombreTotal = $nombreTotal + 1;
			
		}
		echo "<p>".$nombre." attaque(s) <font color='green'>OK</font> sur ".$nombreTotal."</p>";
	}
	?>
	<a href="creation-de-un-dresseur.php">Suite</a>
</body>
</html>