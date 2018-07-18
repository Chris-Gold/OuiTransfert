<?php

require '../Model/sqlConnect.php';
session_start();
$user = $_SESSION['name'];
$bdd = connect();

function list_fichiers($bdd, $user){
    //Listing de tous les fichiers d'un UtiliSatEuR inscrit
    $query = mysqli_query($bdd, "SELECT * FROM files
        INNER JOIN users ON files.file_usr=users.id_usr
        WHERE usr_name='".$user."' ORDER BY files.file_date DESC");

    return($query);
}
