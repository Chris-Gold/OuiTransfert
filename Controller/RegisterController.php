<?php

require 'ConnectionController.php';
//Ajout d'un UtiliSatEuR
function addUser($bdd) {
  if(isset($_POST['nom']) && isset($_POST['pass'])){
    $user = $_POST['nom']; // Récupération du Nom
    $password = $_POST['pass']; // Récupération du Mot de Passe
    //(Id auto-incrémentée dans la BDD)
    // Insertion de l'UtiliSatEuR dans la Base de Données
    $query = "INSERT INTO users (usr_name, usr_pass) VALUES('$user', '$password')";
    $result = mysqli_query($bdd, $query);
    if($result){
      // Ajout d'UtiliSatEuR réussie
      $msg = "Registered Successfully";
      echo $msg;
      connection($bdd);
    }
    else{
      // Echec de l'ajout
      $msg = "Error Registering";
      echo $msg;
    }
  }
}
// Appel de la fonction
addUser($bdd);
