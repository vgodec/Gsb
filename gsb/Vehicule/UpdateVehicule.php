<?php
    include '../fonctiongenevisiteur.php';

    //connexion à la BDD
    $cnxBDD=connexion();

    //Récupère les données envoyé par le formulaire de AssigneVehicule.php
    $idVisiteur=$_GET['Visiteur'];
    $ImmatVehicule=$_GET['Vehicule'];

    //Requete permettant de mettre à jour la table véhicule avec l'id du visiteur qui a été assigner a un vehicule
    $req="UPDATE vehicule SET IdVisiteur='$idVisiteur' WHERE Immat='$ImmatVehicule';";
    $result = $cnxBDD->query($req)
            or die ("Requete invalide : ".$req);

    //Retour à la page AssigneVehicule.php
    header('location: AssigneVehicule.php');
    
    //Fermeture de a connexion à la BDD
    $cnxBDD->close();
?>