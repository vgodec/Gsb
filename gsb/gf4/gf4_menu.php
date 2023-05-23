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
    echo $repas;
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
            <h1>Gestion des Frais <img src="gf4.png" onclick="history.back(-1);"></h1>
            <form action="../gf4/gf4.php" method="get">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="modifier" value="<?php echo $modifier; ?>">
                    <button class="validation">Saisie hors forfait</button>
            </form>
    
            <form action="valider.php" method="get">
                <h2>
                    Saisie
                </h2>
                <br>
                <table>
                    <tr>
                        <td>PERIODE </td>
                        <td >Mois (2 chiffres) :<input type="number" id="mois" value=<?php echo (date("m"));?> name="mois" required maxlength="2" class="saisie_input" readonly="readonly" ></td>
                        <td >Annee (4 chiffres) :<input type="text" id="annee" value=<?php echo (date("Y"));?> name="annee" required maxlength="4" class="saisie_input" readonly="readonly"></td>
                    </tr>
                    <tr>
                        <td>D'ENGAGEMENT</td>
                    </tr>
                </table>
                <h2>
                    frais au forfait
                </h2>
                <br>
                <table class="frais">
                    <?php if($modifier==1){?>
                    <tr>
                        <td>repas midi :</td>
                        <td><input type="number" id="repas" min=0 value=<?php echo $repas?> name="repas" class="saisie_input" ></td>
                    </tr>
                    <tr>
                        <td>Nuitees :</td>
                        <td><input type="number" id="nuitees" min=0 value=<?php echo $nuitees?> name="nuitees" class="saisie_input"></td>
                    </tr>
                    <tr>
                        <td>Etape :</td>
                        <td><input type="number" id="etape" min=0 value=<?php echo $etape?> name="etape" class="saisie_input"></td>
                    </tr>
                    <tr>
                        <td>Km :</td>
                        <td><input type="number" id="km" min=0 value=<?php echo $km?> name="km" class="saisie_input"></td>
                    </tr>

                    <?php }else{?>

                    <tr>
                        <td>repas midi :</td>
                        <td><input type="number" id="repas" min=0 value="" name="repas" class="saisie_input" ></td>
                    </tr>
                    <tr>
                        <td>Nuitees :</td>
                        <td><input type="number" id="nuitees" min=0 value="" name="nuitees" class="saisie_input"></td>
                    </tr>
                    <tr>
                        <td>Etape :</td>
                        <td><input type="number" id="etape" min=0 value="" name="etape" class="saisie_input"></td>
                    </tr>
                    <tr>
                        <td>Km :</td>
                        <td><input type="number" id="km" min=0 value="" name="km" class="saisie_input"></td>
                    </tr>
                    <?php } ?>
                    </table>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="modifier" value="<?php echo $modifier; ?>">
                <input class="validation" type="submit"  id="valider" value="soumettre la requete">
        </form>
        </div>
    </body>