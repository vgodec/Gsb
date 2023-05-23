<?php 
$nomvisiteur=$_GET['nom'];
$prenomvisiteur=$_GET['prenom'];
$id =$_GET['id'];
$mois=$_GET['mois'];
$annee =$_GET['annee'];
?>


<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Gestion des frais</title>
    </head>

    
    <link rel="stylesheet" type="text/css" href="gf5.css">

        <body style="color: white";>
            <form action="valider.php" method="get">
                <div style="width: 600px;margin: 0 auto;color:rgb(70, 155, 224);">

                    <div>
                        <h1 >Suivi de remboursement des frais <img src="gf4.png" style="vertical-align:middle;" onclick="history.back(-1);"></h1>
                    </div>

                    <div style="background-color: #defaff">
                            <h2>fiche de frais de :<?php echo " $nomvisiteur  $prenomvisiteur    " ;?></h2>
                        

                        <div style="background-color: rgb(0, 174, 255); width: 600px;margin: 0 auto;color:white">
                            <div style="width: 600px;margin: 0 auto;">
                                <table >
                                    <tr>
                                        <th>periode</th>
                                        <td style="width: 50px"> </td>
                                        <td> mois/annee: <input type="text" value="<?php echo($mois)?>" readonly="readonly"> <input type="text" value="<?php echo($annee)?>" readonly="readonly"></td>
                                    </tr>
                                </table>

                            </div>

                            <br/>

                            <div style="padding-bottom: 1px;">
                                <h2>frais au forfait<h2>
                                <table class="tablefrais" >
                                    <thead class=frais>
                                        <tr class=frais>
                                            <td class=frais>repas midi</td>
                                            <td class=frais>nuitee</td>
                                            <td class=frais>etape</td>
                                            <td class=frais>km</td>
                                            <td class=frais>situation</td>
                                            <td class=frais>date operation</td>
                                            <td class=frais>remboursement</td>
                                        </tr>
                                    </thead>
                                    <?php

                                        include '../fonctiongenevisiteur.php';
                                        // Connexion    la base de donn  es gsb_frais

                                        
                                        $quantite=[];
                                        $quantite=quantforfait($id);
                                        
                                        $montant= "SELECT mois,annee,montantValide,libelle FROM fichefrais,etat where fichefrais.id=$id and fichefrais.idEtat=etat.id;" ;
                                        $result= $cnxBDD->query($montant);
                                        while ($row = mysqli_fetch_assoc($result)){



                                            ?>
                                    <tr>
                                        <td><?php echo $quantite[3]; ?></td>
                                        <td><?php echo $quantite[2]; ?></td>
                                        <td><?php echo $quantite[0]; ?></td>
                                        <td><?php echo $quantite[1]; ?></td>
                                        <td><?php echo $row['libelle']; ?></td>
                                        <td><?php echo $row['mois']."/".$row['annee']; ?></td>
                                        <td><?php echo $row['montantValide']; ?></td>      
                                    </tr>
                                    <?php } ?>
                                </table>
                                <h2>Hors Forfait<h2>
                                    <table class="tablefrais" >
                                        <thead class=frais>
                                            <tr class=frais>
                                                <td class=frais>Date</td>
                                                <td class=frais>Libellé</td>
                                                <td class=frais>Montant</td>
                                                <td class=frais>Situation</td>
                                            </tr>
                                        </thead>
                                            <?php 
                                                $sql="SELECT DTE,LIBELLE,MONTANT,ETA_ID FROM ligne_frais_hors_forfait WHERE MONTH(DTE) = $mois AND YEAR(DTE) = $annee;";
                                                $result=$cnxBDD->query($sql);
                                                while($row=mysqli_fetch_assoc($result)){
                                                ?>
                                            <tr>
                                                <td><?php echo $row['DTE'] ?></td>
                                                <td><?php echo $row['LIBELLE'] ?></td>
                                                <td><?php echo $row['MONTANT'] ?></td>
                                                <td><?php echo $row['ETA_ID'] ?></td>
                                            </tr>
                                            <?php } ?>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </body>
    </html>