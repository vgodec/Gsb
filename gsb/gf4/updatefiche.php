<?php
include '../fonctiongenevisiteur.php';
// Connexion    la base de donnes gsb_frais
$cnxBDD = connexion();

$etape=$_GET['ETP'];
$km=$_GET['KM'];
$nuitees=$_GET['NUI'];
$repas=$_GET['REP'];
$idfiche=$_GET['idfiche'];

$sql="UPDATE lignefraisforfait SET quantite = $etape WHERE idForfait = 'ETP' AND idFicheFrais=$idfiche;";
$result=$cnxBDD->query($sql)
or die ("Requete invalide : ".$sql);

$sql="UPDATE lignefraisforfait SET quantite = $km WHERE idForfait = 'KM' AND idFicheFrais=$idfiche;";
$result=$cnxBDD->query($sql)
or die ("Requete invalide : ".$sql);

$sql="UPDATE lignefraisforfait SET quantite = $nuitees WHERE idForfait = 'NUI' AND idFicheFrais=$idfiche;";
$result=$cnxBDD->query($sql)
or die ("Requete invalide : ".$sql);

$sql="UPDATE lignefraisforfait SET quantite = $repas WHERE idForfait = 'REP' AND idFicheFrais=$idfiche;";
$result=$cnxBDD->query($sql)
or die ("Requete invalide : ".$sql);

//javascript pour revenir a la page principale
echo "<script>
window.history.go(-2);
</script>";


?>