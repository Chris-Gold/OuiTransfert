<?php
session_save_path('/var/lib/php/sessions');
session_start();

require '../Model/sqlConnect.php';
$bdd = connect();

//Authentification de l'UtiliSatEuR
function connection($bdd) {
    $bdd = connect();
    $req = mysqli_query($bdd, "SELECT * FROM users
    WHERE users.usr_name='" . $_POST['nom'] . "' ");
    $userData = mysqli_fetch_assoc($req);
    if (!$userData){
      // Aucun Nom UtiliSatEuR correspondant dans la BDD
      echo 'Identifiant inconnu !';
    }
    else{
      // Verification du Mot de Passe
      if ($_POST['pass'] === $userData['usr_pass']){
          session_start(); // Lancement de la session
          // Recuperation Id UtiliSatEuR
          $_SESSION['id'] = $userData['id_usr'];
          // Recuperation Nom UtiliSatEuR
          $_SESSION['name'] = $userData['usr_name'];
          echo "Bienvenue " . $userData['usr_name'] . "!";
          // Renvoie vers index.php
          header("location: ../index.php");
      }
      else{ // Erreur dans le Mot de Passe
          header("location: ../Vue/erreur.php");
      }
    }
}
//Appel de la fonction d'authentification
connection($bdd);
