<head>
   <title>Apérobot - Connexion</title>
   <link rel="stylesheet" type="text/css" href="./view/css/login.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body>

	<div id="myLI" class="login">
		<h1>Connexion</h1>
	    <form method="post">
	    	<input type="text" name="email" placeholder="Email" required="required" />
	        <input type="password" name="pwd" placeholder="Mot de passe" required="required" />
	        <button type="submit" class="btn btn-primary btn-block btn-large">Connexion</button>
	    </form>
	    <p>vous ne possedez pas de compte ? <a href="#" onclick="javascript:switchInscri()" class="link">S'inscrire</a></p>
	</div>

	<div id="mySI" class="signin hide">
		<h1>Inscription</h1>
	    <form method="post">
	    	<input type="text" name="email" placeholder="Email" required="required" />
	        <input type="password" name="pwd" placeholder="Mot de passe" required="required" />
	        <input type="password" name="pwd2" placeholder="Confirmation Mot de passe" required="required" />
	        <input type="text" name="nom" placeholder="Nom" required="required" />
	        <input type="text" name="prenom" placeholder="Prénom" required="required" />
	        <input type="date" name="dob" placeholder="Date de Naissance" required="required" />
	        <input type="text" name="tel" placeholder="N° Téléphone" required="required" />
	        <button type="submit" class="btn btn-primary btn-block btn-large">S'incrire</button>
	    </form>
	    <p>vous possedez déjà un compte ? <a href="#" onclick="javascript:switchConnect()" class="link">Se connecter</a></p>
	</div>




	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="./view/js/login.js"></script>
</body>