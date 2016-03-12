<?php
  	session_start();
?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link href='http://manro007.on-web.fr/font/marck.css' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href='http://manro007.on-web.fr/css/style.css' type="text/css">
<title>Votre fiche</title>


</head>

<body>

<div id="contact-form">

<!--formulaire-->

<?php
    if(isset($_SESSION['sendError']) && $_SESSION['sendError']) {
      echo '<p>Erreur envoi mail</p>';
    }
?>

<form action="http://manro007.on-web.fr/send_email.php" method="post" enctype="multipart/form-data" name="envoi" id="envoi" class="styleform">

<!--infos diverses-->
	<div class="bloc_curseur" >
 
  	<label for="h">
  		<span>Mr.</span>
  		<span id="monsieur"><input type="radio" id="h" name="genre" value="h" /></span>
  	</label>

    <label id="mlle" for="f">
  		<span>Mlle.</span>
  		<span id="madame"><input type="radio" id="f" name="genre" value="f" /></span>
  	</label>
  
  </div>

	<div class="bloc">
	    <span id="bold">Prénom</span>
		<?php
			if(isset($_SESSION['nomError']) && $_SESSION['nomError'])
			{
		?>
		<input type="text" name="nom" id="nom" autocomplete="off" class="fond blue_error no_save" />
		<?php
			}
			else
			{
		?>
		<input type="text" name="nom" id="nom" autocomplete="off" class="fond" />
		<?php
			}
		?>
	</div>

	<div class="bloc">
    <label id="bold">Année de naissance</label>

		<?php
		if(isset($_SESSION['ageError']) && $_SESSION['ageError'])
		{
		?>
		<span class="select-wrapper fond blue_error">
    	<select name="age" class="no_save" id="age">
	    	<option value="" class="disabled" selected="selected"></option>
	     	<?php
	     		for($i = 2015; $i > 1940; $i--) {
	     			echo '<option value="' .$i. '">' .$i. '</option>';
	     		}
	     	?>
   		</select>
    </span>

		<?php
		}
		else
		{
		?>

		<span class="select-wrapper fond">
			<select name="age" id="age">
				<option value="" class="disabled" selected="selected"></option>
				<?php
					for($i = 2015; $i > 1940; $i--) {
						echo '<option value="' .$i. '">' .$i. '</option>';
					}
				?>
			</select>
		</span>
		<?php
		}
		?>
	</div>

	<div class="bloc">

	  <label id="bold">Département</label>
		<?php
		if(isset($_SESSION['departementError']) && $_SESSION['departementError'])
		{
		?>
		<span class="select-wrapper fond blue_error">
	    <select name="departement" class="no_save" id="departement">
	    	<option value="" selected="selected" class="disabled"></option>
	 			<?php
		     		for($j = 1; $j <= 95; $j++) {
		     			if($j < 10) {
		     				echo '<option value="' .$j. '">0' .$j. '</option>';
		     			}

		     			else {
		     				echo '<option value="' .$j. '">' .$j. '</option>';
		     			}
		     		}
		     	?>
	   	</select>
	    </span>

			<?php
			}
			else
			{
			?>

			<span class="select-wrapper fond">
		    <select name="departement" id="departement">
		    	<option value="" selected="selected" class="disabled"></option>
		 			<?php
			     		for($j = 1; $j <= 95; $j++) {
			     			if($j < 10) {
			     				echo '<option value="' .$j. '">0' .$j. '</option>';
			     			}

			     			else {
			     				echo '<option value="' .$j. '">' .$j. '</option>';
			     			}
			     		}
			     	?>
		   	</select>
		    </span>
			<?php
			}
			?>
	</div>

	<?php
	if(isset($_SESSION['emailError']) && $_SESSION['emailError'])
	{
	?>
	<div class="bloc">
    <span id="bold">Mail</span>
	<input class="fond blue_error no_save" name="email" placeholder="" autocomplete="off" type="text" id="email" />
    </div>
	<?php
	}
	else
	{
	?>
	<div class="bloc">
		<span id="bold">Mail</span>
	<input class="fond" name="email" placeholder="" autocomplete="off" type="text" id="email" />
		</div>
	<?php
	}
	?>


  <div class="bloc">
    <?php
      if(isset($_SESSION['imgError']) && $_SESSION['imgError'])
      {
    ?>
		<div class="fileinputs">
			<input type="file" name="img" class="file" id="realfile"/>
			<div class="fakefile">
				<span>chargez une photo</span></br>
	            <input class="fond blue_error" id="fakefile"/>
			</div>
		</div>
    <span class="blue_error_text"><?php echo $_SESSION['imgError']; ?></span>
    <?php
    }
    else
    {
    ?>
    <div class="fileinputs">
      <input type="file" name="img" class="file" id="realfile"/>
      <div class="fakefile">
        <span>chargez une photo</span></br>
              <input class="fond" id="fakefile"/>
      </div>
    </div>
    <?php
    }
    ?>
  </div>

  <div id="progressBarSending">
      <img class="progressBarLoading" src="interface/progressBar.gif" alt="#" />
      <div class="waitingSentence">Veuillez patientez...</div>
  </div>
  
                  <?php
	                if(isset($_SESSION['sent'])){
	               	 	if($_SESSION['sent']){
		        ?>
		                <span id="form_pres">Email envoyé avec succès. </span>
	            <?php
		            }else{
			    ?>
			           	<span id="form_pres">Nous avons rencontré une erreur lors de l'envoi de votre email. </span>
				<?php	   	
		            }}
		        ?>

<!--champ de message-->

	<div id="blocmessage" class="bloc">
    <span id="bold">Un mot pour celle ou celui qui vous attend :</span><br/>
		<?php
		if(isset($_SESSION['messageError']) && $_SESSION['messageError'])
		{
		?>
		<textarea class="message blue_error no_save" name="message" id="message" maxlength="1000"></textarea>
		<?php
		}
		else
		{
		?>
		<textarea class="message" name="message" id="message" maxlength="1000"></textarea>
		<?php
		}
		?>
  </div>

<!--Vrai Bouton envoyer message-->
	<div id="submit">
	<input id="envoyer" onmouseover="this.src='interface/enveloppe3.svg'" onmouseout="this.src='interface/enveloppe2.svg'" class="bouton-envoyer" type="image" src="interface/enveloppe2.svg" alt="Submit"/>
	</div>

</form>

<?php
	session_destroy();
?>

<!--fin du formulaire-->

<script src="http://manro007.on-web.fr/js/storage.js" type="text/javascript"></script>

</div>


</body>
</html>
