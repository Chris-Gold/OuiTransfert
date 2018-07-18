<?php

require '../Controller/UploadController.php';

include '../includes/header2.html';

$link = $_GET['lien'];
$user = $_GET['user'];

echo '<section class="container titre">' ;
    echo '<h2 class="text-center">Voici le lien vers votre document :</h2>';
echo '</section>';

echo '<section class="container">' ;
    echo '<div class="bloc">';
        echo '<a href="../docs/' . "$link" . '" download="../docs/' . "$link" . '">'. "localhost/exoWetransfert/docs/$link" . '</a>';
    echo '</div>';
    echo '<div class="row text-center">';
      echo '<span class="col-6"><a href="../index.php"><button class="btn btn-primary">Retour Accueil</button></a></span>';
      if($user!= 3){
        echo '<span class="col-6"><a href="../Vue/table.php"><button class="btn btn-primary">Historique</button></a></span>';
      }
    echo '</div>';
echo '</section>';

include '../includes/base_js.html';
