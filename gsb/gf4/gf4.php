<?php
#$nom =$_GET['nom'];
#$prenom = $_GET['prenom'];
include '../fonctiongenevisiteur.php';
        // Connexion    la base de donnes gsb_frais
$cnxBDD = connexion();
$modifier = $_GET['modifier'];
$id = $_GET['id'];
$i=0;
if($modifier==1){
    $annee= $_GET['annee'];
    $mois= $_GET['mois'];
    $select_forfait= "SELECT quantite FROM lignefraisforfait where idfichefrais=$id"  ;
    $result= $cnxBDD->query($select_forfait);
    $lignefraisforfait=[];
    while ($row = mysqli_fetch_assoc($result)){
        $i++;
        $lignefraisforfait[$i]=$row['quantite'];
    }
    $repas =$lignefraisforfait[1];
    $nuitees =$lignefraisforfait[2];
    $etape =$lignefraisforfait[3];
    $km =$lignefraisforfait[4];
}
?>
<html>
    <head>
        <title>Gestion des frais</title>
    </head>

    <meta charset="utf-8">
    <link rel="stylesheet" href="Menu.css">

    <body class="arriere">
            <div class="saisie">
                <h2>
                    Saisie :
                </h2>
                <br>
                <table>
                    <tr>
                        <td style="width: 180px;">PERIODE D'ENGAGEMENT</td>
                        <td >Mois (2 chiffres) :<input type="number" id="mois" value=<?php echo (date("m"));?> name="mois" required maxlength="2" class="saisie_input" readonly="readonly" ></td>
                        <td >Annee (4 chiffres) :<input type="text" id="annee" value=<?php echo (date("Y"));?> name="annee" required maxlength="4" class="saisie_input" readonly="readonly"></td>
                    </tr>
                </table>
                <br>
                <hr/>
                <table>
                <?php if($modifier==1){ ?>
                    <h3>Modifier la fiche de frais du : <?php echo $mois."/".$annee;?></h3>
                    <form action="updatefiche.php" method="get">

                    <?php
                        $sql="SELECT * FROM lignefraisforfait where idfichefrais=$id";
                        $result=$cnxBDD->query($sql);
                        foreach($result as $row){
                            ?>
                            <table>
                                    <label><?php echo "<th>". $row['idForfait']. "</th>";?></label>
                                    <?php echo "<td>"?><input type="number" name="<?php echo $row['idForfait']; ?>" value="<?php echo $row['quantite']; ?>" /><?php echo "</td>"?>
                        <br/>
                           <table>
                <?php   }  ?>
                <br/><br/>
                            <input type="hidden" name="idfiche" value="<?php echo $id; ?>">
                        <button>modifier</button>
                    </form>
                    <?php }else{ ?>
                        <tr>
                        <td>
                            <h2>
                                Hors Forfait
                            </h2>
                        </td>
                        
                        <td colspan="4" align="right">
                            <form action="saisie_HF.php?id=<?php $id; ?>+&modifier=<?php $modifier; ?>">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="hidden" name="modifier" value="<?php echo $modifier; ?>">
                                <button class="bouton"> + </button>
                            </form>
                        <td>
                            
                    <tr>
                        <th style="padding-right:50px">Date</th>
                        <th style="padding-right:50px">Libelle</th>
                        <th colspan="2" style="padding-right:50px">Montant</th>
                    </tr>
                    <?php
                    $sql="SELECT ID,DTE, LIBELLE, MONTANT FROM ligne_frais_hors_forfait;";
                    $result=$cnxBDD->query($sql);
                    while($row=mysqli_fetch_assoc($result)){
                    ?>
                    <tr class="celluletab">
                        <td><label><?php echo "$row[DTE]" ?></label></td>
                        <td><label><?php echo "$row[LIBELLE]" ?></label></td>
                        <td><label><?php echo "$row[MONTANT]" ?></label></td>
                        <td><form action="delete.php"><span><button class="bouton" name="suppr" value='DELETE FROM ligne_frais_hors_forfait WHERE ID=<?php echo $row['ID']?>'>-</button></form></td>
                    </tr>
                    <?php } ?>
                </table>
                <?php } ?>   
                
            </div>
    </body>
</html>