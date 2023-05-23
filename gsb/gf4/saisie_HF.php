<?php
#$nom =$_GET['nom'];
#$prenom = $_GET['prenom'];
include '../fonctiongenevisiteur.php';
        // Connexion    la base de donn  es gsb_frais
$cnxBDD = connexion();
$modifier = $_GET['modifier'];
$id = $_GET['id'];
$i=0;
if($modifier==1){
    $id=$_GET['id'];
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
    <link type="text/css" rel="stylesheet" href="Menu.css">

    <body class="arriere">
        
        <div class="saisie">
        <form action="hors_forfait.php?id=<?php $id; ?>" method="get">
                <h1>Gestion des Frais <img src="gf4.png" style="vertical-align:middle; "onclick="history.back(-1);"></h1>
            <h2>
                    Saisie
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
                <table>
                    <tr>
                        <td>
                            <h2>
                                Hors Forfait
                            </h2>
                        </td>
                    <tr>
                        <th>Date</th>
                        <th>Libelle</th>
                        <th>Montant</th>
                    </tr>
                    <tr>
                        <td>
                            <input style="width:100%" type="date" name="Date" required placeholder="Y-M-D">
                        </td>
                        <td>
                            <input style="width:100%" type="text" required name="libelle">
                        </td>
                        <td>
                            <input style="width:100%" type="number" min=0 required name="Montant">
                        </td>

                    </tr>

                    <input type="hidden" id="modifier" name="modifier" value=<?php echo $modifier?>>
                    <input type="hidden" id="id" name="id" value=<?php echo $id?>>
                </table>
                <br/>
                
                <input class="validation" type="submit"  id="valider" value="Valider la fiche de frais">
                <br/>
             <?php 
                echo "<label for='id' hidden>id : </label>";
                echo"<input name='id' value='$id'readonly hidden>";
                echo "<input name='modifier' readonly hidden>";
                ?>
        </form>
    </div>
    </body>