<?php

require '../Model/sqlConnect.php' ;
session_start();

//Fonction d'insertion dans la base de données
function save($bdd, $target_file, $user)
{
    if (isset($_SESSION['id'])) {
        $user = $_SESSION['id']; // Récupération Id UtiliSatEuR
        header("location: ../index.php?user=$user");
    } else {
        $user = 3; // UtiliSatEuR "ANONYMOUS"
        header("location: ../index.php?user=$user");
    }
    $name = $_POST['fileName'];
    $date = date('Y-m-d H:i:s');
    $link = md5($name.$date);
    $doc = "../docs/$link";
    $status = true;

    $insert_file = mysqli_query($bdd,
      "INSERT INTO files (file_name, file_date, file_link, file_status, file_usr)
      VALUES ('$name', '$date', '$doc', '$status', '$user')");
    if (! $insert_file) {
    echo mysqli_error($bdd);
    } else {
    return ($doc);
    }
}

if (isset($_POST) AND !empty($_POST)){
  $bdd = connect();
  // Verification de l'ID UtiliSatEuR
  if (isset($_SESSION['id'])) {
      $user = $_SESSION['id'];
  } else {
      $user = 3;
  }
  $failed = ""; // Variable d'erreur
  //Verification taille fichier
  $size_file = $_FILES['file']['size'];
  if(isset($_FILES) AND ($_FILES['file']['error'] == 1)){
    echo "Votre systeme ne vous permet pas d'envoyer un fichier de cette taille...sorry.";
    //Necessite une modif de php.ini > upload_max_size
    $failed = "1";
    header("location: ../index.php?user=$user&error=$failed");
  }
  elseif(isset($_FILES) AND ($user == 3) AND ($size_file > "3145728")){
    //L'Utilisateur "anonymous" ne peux envoyer un fichier > 3Mo
    $failed = "2";
    header("location: ../index.php?user=$user&error=$failed");
  }
  elseif(isset($_FILES) AND ($user != 3) AND ($size_file > "7340032")){
    //L'Utilisateur identifier ne peux envoyer un fichier > 7Mo
    $failed = "3";
    header("location: ../index.php?user=$user&error=$failed");
  }
  else{
    //Déplacement du fichier vers le stockage "docs/"
    $target_dir = "../docs/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    // Fichier renomé avec un nom temporaire
    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
    $link = save($bdd, $target_file, $user);
    $newlink = substr($link, 8);
    rename("$target_file", "$link");
    header("location: ../Vue/lien.php?lien=$newlink&user=$user");
    }
}
