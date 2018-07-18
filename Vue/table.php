<?php

require '../Controller/FileListController.php';

include '../includes/header2.html';

$list = list_fichiers($bdd, $user);
echo '<section class="container">' ;
    echo '<h1 class="text-center">Vos fichiers partagés :</h1>';
echo '</section>';

echo '<section class="container">' ;
    echo '<div class="bloc">';
        echo '<table class="col-12 text-center">';
            echo "<tr>";
                echo "<td>Nom du fichier</td>";
                echo "<td>Date de téléchargement</td>";
                echo "<td>Lien du fichier</td>";
            echo "</tr>";
            while ($resultat = mysqli_fetch_assoc($list)) {
            echo "<tr>";
                echo '<td>' . $resultat['file_name'] . '</td>';
                echo '<td>' . $resultat['file_date'] . '</td>';
                echo '<td><a href="' . $resultat['file_link'] . '" download="' . $resultat['file_link'] . '">lien</a></td>';
            echo "</tr>";
            }
        echo "</table>";
    echo '</div>';
    echo '<span><a href="../index.php"><button class="btn btn-primary">Retour Accueil</button></a></span>';
echo '</section>';

include '../includes/base_js.html';
