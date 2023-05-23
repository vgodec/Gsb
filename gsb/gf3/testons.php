<?php 
include '../fonctiongenevisiteur.php';
// Connexion    la base de donn  es gsb_frais
$cnxBDD = connexion();

$username=$_GET['unlogin'];
$nomprenom="SELECT nom,prenom FROM visiteur WHERE login='$username'";
$result= $cnxBDD->query($nomprenom);
while ($row = mysqli_fetch_assoc($result)){  
    $nomvisiteur=$row['nom'];
    $prenomvisiteur=$row['prenom'];
}

$montant= "SELECT idVisiteur FROM fichefrais,etat where idVisiteur in (select id from visiteur where nom='$nomvisiteur' and prenom='$prenomvisiteur')";
$result= $cnxBDD->query($montant);
while ($row = mysqli_fetch_assoc($result)){  
    $idvisite=$row['idVisiteur'];
}


?>
<html>
    <head>
        <title>fiche de frais</title>
    </head>
    
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles.css">

    <body>
        <div style=" width: 1000px;margin: 0 auto;">
            <h1>fiche de frais de : <?php echo " $nomvisiteur  $prenomvisiteur    " ?> <a href="../gf4/gf4_menu.php?nom=<?php echo $nomvisiteur;?> & prenom=<?php echo $prenomvisiteur;?> & id=<?php echo $idvisite;?> & modifier=0">  ajouter<img src="ajouter.png" class="image" ></a></h1>
            <table>
            <thead>
                <tr>
                    <td>Date</td>
                    <td>Supprimer</td>
                    <td>Modifier</td>
                    <td>Voir</td>
                </tr>
            </thead>
            <?php
                $montant= "SELECT fichefrais.id,mois,annee,montantValide,libelle,idEtat FROM fichefrais,etat where idVisiteur in (select id from visiteur where nom='$nomvisiteur' and prenom='$prenomvisiteur') and fichefrais.idEtat=etat.id ORDER BY annee DESC ,mois DESC ; " ;
                $result= $cnxBDD->query($montant);
                while ($row = mysqli_fetch_assoc($result)){
                    $id = $row['id'];
                    ?>
                        <tr>
                            <td class="ligne"><?php print($row['mois'] ."/". $row['annee']." ". $row['montantValide'] ." ". $row['libelle']); ?></td>

                            <td class="ligne">
                                <?php if ($row['idEtat']=="CR"){?>
                                    <a href="suprimer.php?id=<?php echo $row['id'];?>"><img src="supprimer.jpg"class="image"></a>
                                <?php } ?>
                            </td>

                            <td class="ligne">
                                <?php if ($row['idEtat']=="CR"){?>
                                    <a href="../gf4/gf4.php?modifier=1 & id=<?php echo $row['id'];?> & annee=<?php echo $row['annee'];?> & mois=<?php echo $row['mois'];?>">
                                    <img src="modifier.jpg" class="image" ></td>
                                <?php } ?>

                            <td class="ligne"><a href="../gf5/gf5.php?id=<?php echo $row['id'];?> & nom=<?php echo $nomvisiteur;?> & prenom=<?php echo $prenomvisiteur;?> & mois=<?php echo $row['mois'];?> & annee=<?php echo $row['annee'];?>"><img src="voir.jpg" class="image" ></td>
                        </tr>
                <?php } ?>
            </table>
        </div>        
    </body>
</html>