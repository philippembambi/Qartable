<?php
dl();
?>
ConfidentialitéConfidentialité
PrimFX.com

    Accueil
    Formations
    Forum
    Connexion
    Inscription

Tutos > PHP
Intégrer PayPal Express Checkout à son site en PHP
PrimFX Boris ('PrimFX') Le 10 mars 2018
Sommaire

    Introduction
    Payer via PayPal : Comment ça marche ?
    Rappels sur certaines notions abordées dans ce cours
    Obtenir des Credentials
    Intégration du système de paiement
    Tests du système et passage en Live
    Vendre différents produits

Apprendre à grande vitesse. Les cours vidéo en ligne sont à partir de 9,99 €
Intégration du système de paiement
Création de notre page de paiement (côté client HTML & JS)

Ça y est, nous y sommes, il est (enfin) temps de commencer à intégrer notre système de paiement sur une page web 😀 Commençons par quelque chose d’élémentaire : créer une page HTML, relativement simple, qui se chargera simplement d’afficher un bouton de paiement PayPal (documentation ici).

Pour se faire, PayPal met à notre disposition un script JS tout fait qui nous permettra de générer le bouton automatiquement . Ce script se trouve à l’adresse https://www.paypalobjects.com/api/checkout.js. Nous aurons donc un document HTML dans lequel nous devrons :

    Importer le script JS fourni par PayPal
    Créer une div avec un ID spécifique afin de l’identifier en tant que bouton de paiement
    Ajouter du code JS en fin de document (avant la fermeture de la balise <body>) afin de générer le bouton de paiement

J'appellerai dans mon cas ce fichier "index.html", qui sera à la racine du site internet. Bien sûr, il s'agit-là d'une façon très simple d'afficher et de tester par la suite ce système de paiement. Par la suite, il sera plus logique de l'intégrer sur des pages de votre site spécifiques au paiement d'un produit... Bref, voici à quoi ressemble le code de cette page (que j'ai directement commenté afin qu'il soit compréhensible) :

	<html>
	<head>
	  <title>Page de paiement</title>
	  <meta charset="utf-8">
	  <script src="https://www.paypalobjects.com/api/checkout.js"></script>
	</head>
	<body>
	  <div id="bouton-paypal"></div>
	  <script>
	    paypal.Button.render({
	      env: 'sandbox', // Ou 'production',
	      commit: true, // Affiche le bouton  "Payer maintenant"
	      style: {
	        color: 'gold', // ou 'blue', 'silver', 'black'
	        size: 'responsive' // ou 'small', 'medium', 'large'
	        // Autres options de style disponibles ici : https://developer.paypal.com/docs/integration/direct/express-checkout/integration-jsv4/customize-button/
	      },
	      payment: function(data, actions) {
	        /* 
	         * Création du paiement
	         */
	        console.log('paiement créé');
	      },
	      onAuthorize: function(data, actions) {
	        /* 
	         * Exécution du paiement 
	         */
	      },
	      onCancel: function(data, actions) {
	        /* 
	         * L'acheteur a annulé le paiement
	         */
	      },
	      onError: function(err) {
	        /* 
	         * Une erreur est survenue durant le paiement 
	         */
	      }
	    }, '#bouton-paypal');
	  </script>
	</body>
	</html>

J'ai également volontairement choisi d'appeler ce fichier "index.html" pour bien vous montrer la dissociation des parties client / serveur. En effet, aucun code serveur (PHP dans notre cas) n'est requis sur cette page. Bien sûr, dans la pratique, vous pourrez tout aussi bien intégrer ce code côté client sur une page en PHP ("index.php" par exemple 😉).

Pour résumer le fonctionnement de ce script, le script checkout.js fourni par PayPal nous permet d’assigner une div ayant un id spécifique à ce qui sera finalement un bouton de paiement via PayPal. La fonction principale du code, paypal.Button.render permet de générer ce bouton (comme son nom l’indique) à partir de divers paramètres, dont la plupart sont des fonctions. En effet, Express Checkout repose sur un principe de callbacks (fonctions) client-side qui nous permettront de déclencher différentes actions en fonction de l’interaction qu’aura un internaute avec le bouton. Ainsi, une fonction est prévue au moment du clic sur le bouton, une autre au moment de la validation du paiement, etc.

J’ai volontairement rajouté un petit console.log() dans le callback de « payment », vous pouvez donc tester ce script, et verrez que lorsque vous cliquerez sur le bouton de paiement PayPal, le message « paiement créé » sera automatiquement loggé dans la console JS de votre navigateur : on peut donc bien surveiller ce qui se passe sur notre bouton de paiement, et c’est là la base d’Express Checkout… On se rapproche du but m’voyez 😀
Mise en place de la base de données pour le stockage des informations des paiements

Dans un premier temps, avant de créer le moindre code PHP, il va nous falloir créer dans notre base de données une table intitulée par exemple « paiements » qui nous permettra de stocker diverses informations communiquées par PayPal à l’égard des paiements que nous effectuerons.

Je vais donc vous demander de me faire confiance sur ce coup, puisque l’appellation ou l’utilité de certains champs vous paraîtra certainement un peu abstraite pour l’instant. Ne vous en faites pas, tout s’éclaircira au fur et à mesure que l’on écrira le code PHP pour traiter les paiements. Seulement, le processus de réalisation d’un paiement utilisant la méthode d’intégration server-side REST impose l’utilisation d’une base de données en particulier pour une information très importante : l'id du paiement généré par PayPal… (mais à nouveau, nous parlerons de cela un peu plus tard 😛)

Voici donc la table que je vous propose de créer dans votre base de données : En SQL, ça donne ça :

	CREATE TABLE `paiements` (
	 `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	 `payment_id` varchar(255) NOT NULL,
	 `payment_status` text NOT NULL,
	 `payment_amount` text NOT NULL,
	 `payment_currency` text NOT NULL,
	 `payment_date` datetime NOT NULL,
	 `payer_email` text NOT NULL
	);

Les champs de cette table sont volontairement tous en anglais pour une simple raison : l’API de PayPal nous retournera des valeurs dont les noms seront eux aussi en anglais, et je peux vous assurer qu’il est bien plus agréable de travailler avec des noms similaires entre base de données et API que d’avoir à faire la traduction pour savoir quel champ correspond à quelle donnée envoyée par l’API. Si vous êtes donc assez à l’aise avec l’anglais pour que travailler avec de tels noms de champs ne s’avère pas incompréhensible ou gênant pour vous, je vous invite donc à faire de même en conservant les noms en anglais. Vous avez même le droit à une petite description de chaque champ 😉 :

    id : un identifiant unique pour trier nos entrées dans la table et qui est auto-incrémenté automatiquement par MySQL
    payment_id : l’identifiant unique d’un paiement, généré et renvoyé par PayPal lors de l’initialisation d’un paiement
    payment_status : le statut du paiement (créé, approuvé, annulé, etc.)
    payment_amount : montant du paiement
    payment_currency : la devise du paiement (EUR, USD, etc.)
    payment_date : la date et l’heure de création du paiement, ce sera un simple NOW() dans nos requêtes SQL
    payer_email : l’email PayPal du client (récupéré via l’API PayPal)

Création d'un paiement (PHP)

Lorsqu’un utilisateur cliquera sur notre bouton de paiement, c’est la fonction « payment » qui sera appelée côté client. Il nous faudra ainsi à partir de cette fonction appeler un script côté serveur qui se chargera de créer le paiement, c’est-à-dire indiquer à PayPal que l’on souhaite initialiser un paiement et enregistrer en base de données les informations du paiement une fois celui-ci correctement initialisé. Nous appellerons ce script « paypal_create_payment.php », dans un dossier « php ».

Prenons donc notre code étape par étape :

On commence par inclure nos éventuels fichiers de configuration, essentiels au bon fonctionnement du site. Dans mon cas, en guise d'exemple, j'inclurai simplement un fichier "php/config.php" contenant l'initialisation d'une session (session_start()) dont le classe PayPalPayment aura besoin pour fonctionner correctement ainsi qu'une connexion PDO à la base de données. On peut ensuite directement inclure la classe PayPalPayment dont on aura besoin. Il s'agit de la classe dont je parlais dans un chapitre précédent, toujours disponible sur mon GitHub. On a donc le code qui suit :

	<?php
	require_once "config.php"; // On est déjà dans le dossier "php" à la racine de notre site, on peut donc directement inclure "config.php" qui se trouve dans ce même dossier
	require_once "../class/PayPalPayment.php"; // On inclue les fichiers relativement à la position du fichier actuel, qui est déjà dans le dossier "php"
	

Etant donné que notre communication client/serveur se basera sur du JSON, on pourra une fois notre script terminé envoyer différentes informations à notre côté client. On initialise donc en début de fichiers quelques variables dont :

    success qui sera un booléen (0 ou 1) permettant de savoir si tout s'est passé correctement ou non
    msg qui contiendra un message d'erreur (initialisé par défaut pour une erreur quelconque)
    paypal_response qui contiendra tout ce que PayPal nous enverra via son API 

	$success = 0;
	$msg = "Une erreur est survenue, merci de bien vouloir réessayer ultérieurement...";
	$paypal_response = [];

On peut ensuite initialiser un objet à partir de notre classe PayPalPayment et le configurer correctement à l'aide de quelques fonctions pré-conçues :

	$payer->setSandboxMode(1); // On active le mode Sandbox
	$payer->setClientID("Votre Client ID"); // On indique sont Client ID
	$payer->setSecret("Votre Secret"); // On indique son Secret

On met ensuite en place toutes les informations de paiement requises par PayPal. A noter que les données à fournir à PayPal sont détaillées par ici et qu’il est extrêmement important de respecter la structure de données imposée par PayPal ainsi que d’inclure les données obligatoires afin que le paiement puisse être initialisé sans problème. Vous noterez que les données à renseigner sont globalement assez évidentes, leurs noms respectifs parlants d'eux-mêmes.

	$payment_data = [
	   "intent" => "sale",
	   "redirect_urls" => [
	      "return_url" => "http://localhost/",
	      "cancel_url" => "http://localhost/"
	   ],
	   "payer" => [
	      "payment_method" => "paypal"
	   ],
	   "transactions" => [
	      [
	         "amount" => [
	            "total" => "9.99", // Prix total de la transaction, ici le prix de notre item
	            "currency" => "EUR" // USD, CAD, etc.
	         ],
	         "item_list" => [
	            "items" => [
	               [
	                  "sku" => "1PK5Z9", // Un identifiant quelconque (code / référence) que vous pouvez attribuer au produit que vous vendez
	                  "quantity" => "1",
	                  "name" => "Un produit quelconque",
	                  "price" => "9.99",
	                  "currency" => "EUR"
	               ]
	            ]
	         ],
	         "description" => "Description du paiement..."
	      ]
	   ]
	];

Les "redirect URLs" sont des URLs permettant de rediriger l'utilisateur lorsque le paiement a réussi (return_url) ou lorsque celui-ci a échoué / été annulé (cancel_url). Seulement, ces URLs, bien que toujours obligatoires à préciser, ne sont plus utilisées par le nouveau système Express Checkout. Vous pouvez donc les laisser à la racine de votre site internet par exemple.

On utilise la fonction "createPayment" de la classe PayPalPayment (donc depuis la variable $payer) en lui passant toutes nos données créées ci-dessus pour initialiser le paiement. Cette fonction renvoie la réponse du serveur PayPal. Cette réponse contient des données au format JSON, on doit donc les décoder pour les utiliser comme des tableaux / objets en PHP :

	$paypal_response = $payer->createPayment($payment_data);
	$paypal_response = json_decode($paypal_response);

Si dans la réponse de PayPal on a bien un "id" que PayPal a généré (et qui est l'identifiant unique de notre paiement en cours), alors on peut continuer :

if (!empty($paypal_response->id)) {

On insert ici une nouvelle entrée dans notre table "paiements" afin de stocker le paiement initialisé avec les informations que nous avons déjà (grâce à l'API PayPal).

$insert = $bdd->prepare("INSERT INTO paiements (payment_id, payment_status, payment_amount, payment_currency, payment_date, payer_email, payer_paypal_id, payer_first_name, payer_last_name) VALUES (:payment_id, 😛ayment_status, 😛ayment_amount, 😛ayment_currency, NOW(), '', '', '', '')");

Lors de l'exécution de la requête avec les différentes données, on prend soin de récupérer le statut de l'exécution dans une nouvelle variable. $insert_ok est un booléen qui vaudra 1 si la requête a bien été exécutée, sinon 0.

	$insert_ok = $insert->execute(array(
	         "payment_id" => $paypal_response->id,
	         "payment_status" => $paypal_response->state,
	         "payment_amount" => $paypal_response->transactions[0]->amount->total,
	         "payment_currency" => $paypal_response->transactions[0]->amount->currency,
	      ));

Toutes les données passées en paramètre ici proviennent directement de la réponse du serveur de PayPal. Pour voir à quoi ressemble la structure de l'intégralité des données renvoyées par PayPal lors de cette étape de création du paiement, c'est par ici : https://developer.paypal.com/docs/integration/direct/express-checkout/integration-jsv4/advanced-payments-api/create-express-checkout-payments/#response

Si le paiement initialisé a bien été enregistré en base de données, on peut dire que l'initialisation du paiement a entièrement fonctionné et on peut donc passer $succes à 1. On peut également vider le $msg puisque rien n'aura besoin d'être affiché à notre client si le paiement a été normalement créé.

	if ($insert_ok) {
	   $success = 1;
	   $msg = "";
	}

Pourquoi le $success ne peut-il pas être passé à 1 plus tôt ? Par exemple après la récupération des informations du paiement par PayPal ? Simplement car nous aurons besoin plus tard d'identifier ce paiement via son ID (généré par PayPal) et se trouvant de le champ "payment_id" de notre table. Il faut donc OBLIGATOIREMENT que le paiement ait été ajouté en base de données avant de le considérer comme valide.

Si l'on n'a pas d'ID de paiement communiqué par PayPal (condition créée quelques paragraphes plus haut), on peut éventuellement modifier notre $msg d'erreur afin qu'il corresponde au problème rencontré :

	} else {
	   $msg = "Une erreur est survenue durant la communication avec les serveurs de PayPal. Merci de bien vouloir réessayer ultérieurement.";
	}

Enfin, on affiche un tableau de données qui sera récupéré par notre client-side, encodé en JSON pour des raisons pratiques de communication client/serveur :

echo json_encode(["success" => $success, "msg" => $msg, "paypal_response" => $paypal_response]);

Voici à quoi ressemblera donc notre code de création de paiement en PHP une fois terminé :

	<?php
	require_once "config.php";
	require_once "../class/PayPalPayment.php";
	 
	$success = 0;
	$msg = "Une erreur est survenue, merci de bien vouloir réessayer ultérieurement...";
	$paypal_response = [];
	 
	$payer = new PayPalPayment();
	$payer->setSandboxMode(1);
	$payer->setClientID("Votre Client ID");
	$payer->setSecret("Votre Secret");
	 
	$payment_data = [
	   "intent" => "sale",
	   "redirect_urls" => [
	      "return_url" => "http://localhost/",
	      "cancel_url" => "http://localhost/"
	   ],
	   "payer" => [
	      "payment_method" => "paypal"
	   ],
	   "transactions" => [
	      [
	         "amount" => [
	            "total" => "9.99",
	            "currency" => "EUR"
	         ],
	         "item_list" => [
	            "items" => [
	               [
	                  "sku" => "1PK5Z9",
	                  "quantity" => "1",
	                  "name" => "Un produit quelconque",
	                  "price" => "9.99",
	                  "currency" => "EUR"
	               ]
	            ]
	         ],
	         "description" => "Description du paiement..."
	      ]
	   ]
	];
	 
	$paypal_response = $payer->createPayment($payment_data);
	$paypal_response = json_decode($paypal_response);
	 
	if (!empty($paypal_response->id)) {
	   $insert = $bdd->prepare("INSERT INTO paiements (payment_id, payment_status, payment_amount, payment_currency, payment_date, payer_email, payer_paypal_id, payer_first_name, payer_last_name) VALUES (:payment_id, 😛ayment_status, 😛ayment_amount, 😛ayment_currency, NOW(), '', '', '', '')");
	   
	   $insert_ok = $insert->execute(array(
	         "payment_id" => $paypal_response->id,
	         "payment_status" => $paypal_response->state,
	         "payment_amount" => $paypal_response->transactions[0]->amount->total,
	         "payment_currency" => $paypal_response->transactions[0]->amount->currency,
	      ));
	 
	   if ($insert_ok) {
	      $success = 1;
	      $msg = "";
	   }
	} else {
	   $msg = "Une erreur est survenue durant la communication avec les serveurs de PayPal. Merci de bien vouloir réessayer ultérieurement.";
	}
	 
	echo json_encode(["success" => $success, "msg" => $msg, "paypal_response" => $paypal_response]);
	

Exécution du paiement

Sur le même principe que le script de création de paiement appelé lors du clic sur le bouton de paiement via la fonction côté client "payment", la fonction "onAuthorize" sera automatiquement appelée côté client lorsqu'un utilisateur confirmera (autorisera) le paiement créé plus tôt. Dans cette fonction "onAuthorize", il va nous falloir appeler un nouveau script côté serveur qui se chargera de valider et finaliser le paiement. Nous appellerons ce script "paypal_execute_payment", toujours dans le dossier "php".

A nouveau, décomposons notre script d'exécution :

Dans un premier temps, tout comme pour le script de création d'un paiement, il va nous falloir importer quelques ressources et initialiser un certain nombre de variables, rien de nouveau pour l'instant :

	<?php
	require_once "config.php";
	require_once "../class/PayPalPayment.php";
	 
	$success = 0;
	$msg = "Une erreur est survenue, merci de bien vouloir réessayer ultérieurement...";
	$paypal_response = [];
	

Dans le script de création de paiement, on demandait simplement à PayPal d'initialiser un paiement. On n'avait donc besoin d'aucun paramètre dans notre script. Dans le cas de l'exécution d'un paiement, les choses sont un peu différentes. En effet, a présent, PayPal se chargera via notre script côté client (en JS) de nous faire parvenir deux paramètres importants via la méthode POST : "paymentID" et "payerID". Ces deux paramètres sont essentiels au bon déroulement de la finalisation de notre paiement : ils nous permettront dans un premier temps de récupérer le paiement créé plus tôt dans notre base de données (via le paymentID, appelé "payment_id" dans notre base de données) et par la suite d'envoyer la demande de finalisation à PayPal dont l'API nécessite les deux paramètres réunis (paymentID et payerID).

Nous pouvons donc dès à présent vérifier que ces paramètres contiennent bien quelque chose, et si c'est le cas les sécuriser un minimum en les plaçant dans de nouvelles variables :

	if (!empty($_POST['paymentID']) AND !empty($_POST['payerID'])) {
	   $paymentID = htmlspecialchars($_POST['paymentID']);
	   $payerID = htmlspecialchars($_POST['payerID']);

On peut à présent initialiser une instance de la classe PayPalPayment, comme pour la création du paiement :

	   $payer = new PayPalPayment();
	   $payer->setSandboxMode(1);
	   $payer->setClientID("Votre Client ID");
	   $payer->setSecret("Votre Secret");

On tente maintenant de récupérer le paiement à exécuter dans notre base de données à partir de son "payment_id", correspondant au paramètre POST "paymendID" passé en paramètre par PayPal (et que l on a enregistré un peu plus haut dans la variable $paymentID) :

	   $payment = $bdd->prepare('SELECT * FROM paiements WHERE payment_id = ?');
	   $payment->execute(array($paymentID));
	   $payment = $payment->fetch();

Si le paiement est bien trouvé dans notre base de données, on peut continuer :

   if ($payment) {

On exécute le paiement via la fonction "executePayment" dans laquelle on doit passer les paramètres paymentID et payerID. Cette fonction de la classe PayPalPayment se chargera pour nous de contacter les serveurs de PayPal via leur API et de nous donner quelques informations en retour que nous traiterons par la suite. On peut d'ailleurs par la même occasion décoder ces données reçues au format JSON :

	      $paypal_response = $payer->executePayment($paymentID, $payerID);
	      $paypal_response = json_decode($paypal_response);

Maintenant que nous avons la réponse de PayPal enregistrée dans $paypal_response avec toutes les informations sur le paiement, on peut mettre à jour ce paiement dans notre base de données. On se chargera notamment de mettre à jour le statut du paiement (qui nous permettra de savoir si le paiement a bien été validé ou bien s'il a échoué) ainsi que l'email PayPal de notre client, toujours en se basant sur le "payment_id" pour savoir quel champ mettre à jour :

	      $update_payment = $bdd->prepare('UPDATE paiements SET payment_status = ?, payer_email = ? WHERE payment_id = ?');
	      $update_payment->execute(array($paypal_response->state, $paypal_response->payer->payer_info->email, $paymentID));

Et si je veux récupérer d'autres informations sur le paiement / le client ? Les données stockées dans "$paypal_response" et provenant de la requête d'exécution de paiement de l'API PayPal sont détaillées dans la documentation de PayPal. Vous y trouverez le détail de la structure renvoyée par l'API.

A présent, on vérifie si le paiement a bien été approuvé, grâce à la donnée stockée dans "$paypal_response->state" :

      if ($paypal_response->state == "approved") {

A ce stade, le paiement a été entièrement validé, on peut envoyer à l'utilisateur le produit commandé, lui envoyer un email contenant une facture du paiement, etc. En particulier, on peut passer notre variable $success à 1 pour indiquer que le paiement à bien réussi à notre côté client, et vider notre $msg d'erreur potentiel (puisqu'il n'y a plus d'erreur à ce stade du paiement) :

	         $success = 1;
	         $msg = "";

Si le paiement n'a pas été approuvé, on modifie le message d'erreur pour informer l'utilisateur du problème rencontré :

	      } else {
	         $msg = "Une erreur est survenue durant l'approbation de votre paiement. Merci de réessayer ultérieurement ou contacter un administrateur du site.";
	      }

De même, si le paiement n'a pas été trouvé dans notre base de données, on en informe l'utilisateur :

	   } else {
	      $msg = "Votre paiement n'a pas été trouvé dans notre base de données. Merci de réessayer ultérieurement ou contacter un administrateur du site. (Votre compte PayPal n'a pas été débité)";
	   }

Finalement, on peut fermer l'accolade de notre première condition sur la présence des paramètres "$_POST['paymentID']" et "$_POST['payerID']" et terminer par afficher quelques informations en JSON qui seront récupérées par notre code JS côté client, de la même façon que nous l'avions fait pour le script de création de paiement :

	}
	echo json_encode(["success" => $success, "msg" => $msg, "paypal_response" => $paypal_response]);

Voici à quoi ressemblera donc le script d\exécution de paiement dans sa totalité :

	<?php
	require_once "config.php";
	require_once "../class/PayPalPayment.php";
	 
	$success = 0;
	$msg = "Une erreur est survenue, merci de bien vouloir réessayer ultérieurement...";
	$paypal_response = [];
	 
	if (!empty($_POST['paymentID']) AND !empty($_POST['payerID'])) {
	   $paymentID = htmlspecialchars($_POST['paymentID']);
	   $payerID = htmlspecialchars($_POST['payerID']);
	 
	   $payer = new PayPalPayment();
	   $payer->setSandboxMode(1);
	   $payer->setClientID("Votre Client ID");
	   $payer->setSecret("Votre Secret");
	 
	   $payment = $bdd->prepare('SELECT * FROM paiements WHERE payment_id = ?');
	   $payment->execute(array($paymentID));
	   $payment = $payment->fetch();
	 
	   if ($payment) {
	      $paypal_response = $payer->executePayment($paymentID, $payerID);
	      $paypal_response = json_decode($paypal_response);
	 
	      $update_payment = $bdd->prepare('UPDATE paiements SET payment_status = ?, payer_email = ? WHERE payment_id = ?');
	      $update_payment->execute(array($paypal_response->state, $paypal_response->payer->payer_info->email, $paymentID));
	 
	      if ($paypal_response->state == "approved") {
	         $success = 1;
	         $msg = "";
	      } else {
	         $msg = "Une erreur est survenue durant l'approbation de votre paiement. Merci de réessayer ultérieurement ou contacter un administrateur du site.";
	      }
	   } else {
	      $msg = "Votre paiement n'a pas été trouvé dans notre base de données. Merci de réessayer ultérieurement ou contacter un administrateur du site. (Votre compte PayPal n'a pas été débité)";
	   }
	}
	echo json_encode(["success" => $success, "msg" => $msg, "paypal_response" => $paypal_response]);
	

Liaison client/serveur

Il ne nous reste à présent plus qu'à permettre à nos scripts côtés client et serveur de communiquer entre eux. Dans la pratique, la seule chose à modifier sera notre script JS côté client afin que celui-ci effectue des requêtes sur nos scripts PHP pour ensuite récupérer les informations que nous avons passé dans nos "echo" (vous savez, les fameux tableaux encodés en JSON). Je vous propose donc de vous afficher directement le script JS que nous avions créé auparavant mais avec les modifications permettant la communication client/serveur, et avec bien sûr pas mal de commentaires histoire que le code soit compréhensible :

	paypal.Button.render({
	      env: 'sandbox', // Ou 'production',
	      commit: true, // Affiche le bouton  "Payer maintenant"
	      style: {
	        color: 'gold', // ou 'blue', 'silver', 'black'
	        size: 'responsive' // ou 'small', 'medium', 'large'
	        // Autres options de style disponibles ici : https://developer.paypal.com/docs/integration/direct/express-checkout/integration-jsv4/customize-button/
	      },
	      payment: function() {
	        // On crée une variable contenant le chemin vers notre script PHP côté serveur qui se chargera de créer le paiement
	        var CREATE_URL = '/php/paypal_create_payment.php';
	        // On exécute notre requête pour créer le paiement
	        return paypal.request.post(CREATE_URL)
	          .then(function(data) { // Notre script PHP renvoie un certain nombre d'informations en JSON (vous savez, grâce à notre echo json_encode(...) dans notre script PHP !) qui seront récupérées ici dans la variable "data"
	            if (data.success) { // Si success est vrai (<=> 1), on peut renvoyer l'id du paiement généré par PayPal et stocké dans notre data.paypal_reponse (notre script en aura besoin pour poursuivre le processus de paiement)
	               return data.paypal_response.id;   
	            } else { // Sinon, il y a eu une erreur quelque part. On affiche donc à l'utilisateur notre message d'erreur généré côté serveur et passé dans le paramètre data.msg, puis on retourne false, ce qui aura pour conséquence de stopper net le processus de paiement.
	               alert(data.msg);
	               return false;   
	            }
	         });
	      },
	      onAuthorize: function(data, actions) {
	        // On indique le chemin vers notre script PHP qui se chargera d'exécuter le paiement (appelé après approbation de l'utilisateur côté client).
	        var EXECUTE_URL = '/php/paypal_execute_payment.php';
	        // On met en place les données à envoyer à notre script côté serveur
	        // Ici, c'est PayPal qui se charge de remplir le paramètre data avec les informations importantes :
	        // - paymentID est l'id du paiement que nous avions précédemment demandé à PayPal de générer (côté serveur) et que nous avions ensuite retourné dans notre fonction "payment"
	        // - payerID est l'id PayPal de notre client
	        // Ce couple de données nous permettra, une fois envoyé côté serveur, d'exécuter effectivement le paiement (et donc de recevoir le montant du paiement sur notre compte PayPal).
	        // Attention : ces données étant fournies par PayPal, leur nom ne peut pas être modifié ("paymentID" et "payerID").
	        var data = {
	          paymentID: data.paymentID,
	          payerID: data.payerID
	        };
	        // On envoie la requête à notre script côté serveur
	        return paypal.request.post(EXECUTE_URL, data)
	          .then(function (data) { // Notre script renverra une réponse (du JSON), à nouveau stockée dans le paramètre "data"
	          if (data.success) { // Si le paiement a bien été validé, on peut par exemple rediriger l'utilisateur vers une nouvelle page, ou encore lui afficher un message indiquant que son paiement a bien été pris en compte, etc.
	            // Exemple : window.location.replace("Une url quelconque");
	            alert("Paiement approuvé ! Merci !");
	          } else {
	            // Sinon, si "success" n'est pas vrai, cela signifie que l'exécution du paiement a échoué. On peut donc afficher notre message d'erreur créé côté serveur et stocké dans "data.msg".
	            alert(data.msg);
	          }
	        });
	      },
	      onCancel: function(data, actions) {
	        alert("Paiement annulé : vous avez fermé la fenêtre de paiement.");
	      },
	      onError: function(err) {
	        alert("Paiement annulé : une erreur est survenue. Merci de bien vouloir réessayer ultérieurement.");
	      }
	    }, '#bouton-paypal');

Et voilà ! Nous en avons terminé avec l'intégration de notre système de paiement ! Vous pouvez tester, le système est entièrement fonctionnel (du moins si vous avez bien suivi le cours et que vous n'avez fait aucune erreur dans son intégration 😅)...

Cependant, il ne sera peut-être pas très viable pour vous de vendre un unique produit sur notre site. On pourrait en effet imaginer un système avec une vente de plusieurs produits stockés en base de données et des comptes membres pour les acheteurs. Pour ça, il va falloir jeter un coup d’œil à la partie suivante 😉
Partager ce contenu
Rejoindre la Newsletter
Obtenir des Credentials
Tests du système et passage en Live
A propos de l'auteur
PrimFX
Boris ('PrimFX')

Je m'appelle Boris, j'ai 20 ans et je suis passionné d'informatique et de technologie. Diplômé d'une Licence Informatique de l'Université de Strasbourg, j'ai co-fondé en 2019 l'entreprise Single Quote et je profite de mon temps libre pour partager ma passion à travers des vidéos & articles sur PrimFX.com 😃
PrimFX.com

Programmation, développement web, high-tech, etc. Je partage ma passion pour l'informatique à travers des tutos vidéos et articles en espérant qu'ils vous soient utiles ;-)
Articles / Vidéos

    Tous les articles
    Tutos PHP
    Tutos C

Échange

    Chat (Discord)
    Forum
    Créer un topic

Ressources

    Rejoindre la newsletter
    Mentions légales & CGU
    Contact

© 2020 PrimFX.com. Tous droits réservés. Propulsé par Single Quote.

