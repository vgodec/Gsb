<?php
setlocale(LC_CTYPE, 'fr_FR');

//récupère les fonction du fichier fonctionsql.php
include '../fonctiongenevisiteur.php';

//connection à la base de donnée
$cnxBDD = connexion();

$visiteur=$_GET['visiteur'];
$mois=$_GET["mois"];
$annee=$_GET["annee"];
$situation=$_GET["valide"];
$nbrjustificatifs=$_GET["nb_justificatifs"];
$requete=$_GET["bouton"];



//Initialisation pour la récupération de l'id du visiteur sélectionné
$idvisiteur="SELECT visiteur.id FROM visiteur,fichefrais WHERE fichefrais.idVisiteur=visiteur.id AND idVisiteur=$visiteur;";
$requeteid = $cnxBDD->query($idvisiteur)
	or die ("Requete invalide : ".$idvisiteur);

//Valide l'état fichefrais grace à l'id visiteur
if($situation=="valide"){
	//récupération de l'id du visiteur
	while($row = mysqli_fetch_assoc($requeteid)) {
    	$justif="UPDATE fichefrais SET nbJustificatifs=$nbrjustificatifs,idEtat='VA', datemodif=now() WHERE idVisiteur=$visiteur AND mois='$mois' AND annee='$annee';";
    $result = $cnxBDD->query($justif)
        or die ("Requete invalide : ".$justif);
	}
}

//N e valide pas l'état fichefrais grace à l'id visiteur
if($situation=="non valide"){

	//récupération de l'id du visiteur
	while($row = mysqli_fetch_assoc($requeteid)) {
    	$justif="UPDATE fichefrais SET nbJustificatifs=$nbrjustificatifs,idEtat='NV', datemodif=now() WHERE idVisiteur=$visiteur AND mois='$mois' AND annee='$annee';";
    	$result = $cnxBDD->query($justif)
        or die ("Requete invalide : ".$justif); 
	}
	
	    
}

$cnxBDD->close();

echo "<script>
window.history.go(-2);
</script>";

?>