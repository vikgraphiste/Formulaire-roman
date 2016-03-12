<?php
  function genderChecking($gender) {
    return ($gender != 'h' && $gender != 'f');
  }

  function nameChecking($name) {
    return trim($name) == "";
  }

  function ageChecking($age) {
    return ($age < 1920 || $age > 2015);
  }

  function departmentChecking($department) {
    return ($department < 1 || $department > 99);
  }

  function emailChecking($email) {
    return (!preg_match("#^[a-zA-Z0-9._-]+@[a-z]+.[a-z]{2,4}$#", $email));
  }

  function messageChecking($message) {
    return strlen(trim($message)) == 0 || strlen(trim($message)) > 1000;
  }

  function imgChecking($img) {
      if(!is_array($img)) {
        return 'Erreur sur l\'envoi du fichier';
      }

      else if($img['error'] == 0) {
        return fileChecking($img);
      }

      else {
        return errorType($img['error']);
      }
  }

  // Fonction permettant d'envoyer le mail
  function sendEmail($mail, $name, $age, $department, $message, $picture) {
    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn|gmail).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
    {
    $passage_ligne = "\r\n";
    }
    else
    {
    $passage_ligne = "\n";
    }

    //=====Création de la boundary
    $boundary = "-----=".md5(rand());
    $boundary_alt = "-----=".md5(rand());
    //==========

    //=====Création de la pièce jointe
    $file = fopen($picture['tmp_name'], "r");
    $attachment = fread($file, filesize($picture['tmp_name']));
    fclose($file);

    $attachment = chunk_split(base64_encode($attachment));
    //==========

    //=====Définition du sujet.
    $sujet = "My Website";
    //=========

    //=====Destinaire du mail
    // $mail_receiver = "kan.rans93@gmail.com ";
    $mail_receiver = "roman.fourquin@gmail.com ";
    //$mail_receiver = "enzo-ramos@live.com ";

    //=========

    $mail_message = "Prénom : " .$name. "\nAnnée de naissance : " .$age. "\nDépartement : " .$department. "\nEmail : " .$mail. "\n\n" .$message;

    //=====Création du header de l'e-mail.
    $header = "From: \"". $name . "\"<" . $mail .">".$passage_ligne;
    $header.= "Reply-to: \"Randy\" <" .$mail_receiver. ">".$passage_ligne;
    $header.= "MIME-Version: 1.0".$passage_ligne;
    $header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

    $message = $passage_ligne."--".$boundary.$passage_ligne;
    $message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
    $message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
    //==========

    //=====Création du corps de l'email

    $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$mail_message.$passage_ligne;

    $message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;

    $message.= $passage_ligne."--".$boundary.$passage_ligne;

    $message.= "Content-Type: " .$picture['type']. "; name=\"" .$picture['name']. "\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: base64".$passage_ligne;
    $message.= "Content-Disposition: attachment; filename=\"" .$picture['name']. "\"".$passage_ligne;
    $message.= $passage_ligne.$attachment.$passage_ligne.$passage_ligne;

    $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
    //==========

    //=====Envoi de l'e-mail.
    return mail($mail_receiver, $sujet, $message, $header);
    //==========
  }


  /*********************** PRIVATE FUNCTIONS ****************************/

  function fileChecking($file) {
    if($file['size'] > 1024 * 1024 * 5) {
      return 'Votre fichier est trop grand !';
    }

    else {
      $extensions = array('png', 'jpeg', 'jpg');
      $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
      if(in_array($fileExtension, $extensions)) {
        return false;
      }

      else {
        return 'Le fichier n\'a pas la bonne extension !';
      }
    }
  }

  function errorType($value) {
    switch($value) {
      case UPLOAD_ERR_NO_FILE:
        return 'Vous n\'avez pas envoyé de fichier';
        break;
      case UPLOAD_ERR_FORM_SIZE:
        return 'Votre fichier est trop grand !';
        break;
    }
  }
?>
