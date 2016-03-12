<?php

	session_start();

	require_once('functions.php');

	$genre       = (isset($_POST['genre'])) ? htmlspecialchars($_POST['genre']) : '';
	$nom         = (isset($_POST['nom'])) ? htmlspecialchars($_POST['nom']) : '';
	$age         = (isset($_POST['age'])) ? htmlspecialchars($_POST['age']) : '';
	$departement = (isset($_POST['departement'])) ? htmlspecialchars($_POST['departement']) : '';
	$email       = (isset($_POST['email'])) ? htmlspecialchars($_POST['email']) : '';
	$img         = (isset($_FILES['img'])) ? $_FILES['img'] : '';
	$message     = (isset($_POST['message'])) ? htmlspecialchars($_POST['message']) : '';

	$_SESSION['genreError']       = genderChecking($genre);
	$_SESSION['nomError']         = nameChecking($nom);
	$_SESSION['ageError']         = ageChecking($age);
	$_SESSION['departementError'] = departmentChecking($departement);
	$_SESSION['emailError']       = emailChecking($email);
	$_SESSION['imgError']         = imgChecking($img);
	$_SESSION['messageError']     = messageChecking($message);

	foreach($_SESSION as $key => $value) {
		if($value && $key != 'genreError') {
			header('Location:index.php');
			exit();
		}
	}

	//=====Envoi du mail s'il n'y a pas d'erreurs
	if(sendEmail($email, $nom, $age, $departement, $message, $img)) {
		$_SESSION['sent'] = true;
		header('Location:index.php'); //page winx
		exit();
	}
	else {
		$_SESSION['sent'] = false;
		header('Location:index.php'); //page winx
		exit();
	}
	//=====
?>
