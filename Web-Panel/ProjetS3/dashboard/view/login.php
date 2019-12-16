<head>
   <title>Apérobot - Connexion</title>
   <link rel="stylesheet" type="text/css" href="./view/css/login.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body>

	<div id="myLI" class="login">
		<h1>Connexion</h1>
                <?php
                    if (!is_null($type) && $type == "connexion") {
                        echo '<p style="color : red;">'.$msg.'</p>';
                    }
                ?>
                <form action="index.php?" method="post">
	    	<input type="text" name="email" placeholder="Email" required="required" />
	        <input type="password" name="pwd" placeholder="Mot de passe" required="required" />
                <input type="hidden" name="controller" value="user"/>
                <input type="hidden" name="action" value="connectUser"/>
	        <button type="submit" class="btn btn-primary btn-block btn-large">Connexion</button>
	    </form>
	    <p class="txtS">vous ne possedez pas de compte ? <a href="#" onclick="javascript:switchInscri()" class="link">S'inscrire</a></p>
	</div>

	<div id="mySI" class="signin hide">
		<h1>Inscription</h1>
                <?php
                    if (!is_null($type) && $type == "inscription") {
                        echo '<p style="color : red;">'.$msg.'</p>';
                    }
                ?>
	    <form action="index.php?" method="post">
	    	<input type="text" name="email" placeholder="Email" required="required" />
	        <input id="password" type="password" name="pwd" placeholder="Mot de passe" required="required" />
	        <input id="confirm_password" type="password" name="pwd2" placeholder="Confirmation Mot de passe" required="required" />
	        <input type="text" name="nom" placeholder="Nom" required="required" />
	        <input type="text" name="prenom" placeholder="Prénom" required="required" />
	        <input type="date" name="dob" placeholder="Date de Naissance" required="required" />
	        <input type="text" name="tel" placeholder="N° Téléphone" required="required" />
                <input type="hidden" name="controller" value="user"/>
                <input type="hidden" name="action" value="createUser"/>
	        <button type="submit" class="btn btn-primary btn-block btn-large">S'incrire</button>
	    </form>
	    <p class="txtS">vous possedez déjà un compte ? <a href="#" onclick="javascript:switchConnect()" class="link">Se connecter</a></p>
	</div>




	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="./view/js/login.js"></script>
        <?php
            if (!is_null($type) && $type == "inscription") {
                echo '<script>javascript:switchInscri()</script>';
            }
        ?>
</body>