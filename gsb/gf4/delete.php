<?php
include '../fonctiongenevisiteur.php';

$cnxBDD=connexion();
    $suppr=$_GET['suppr'];

    $result=$cnxBDD->query($suppr) or die ("Requete invalide : ".$suppr); 

    $cnxBDD->close();

    header("location:". $_SERVER['HTTP_REFERER']);

?>