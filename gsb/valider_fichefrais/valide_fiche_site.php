<!DOCTYPE html>
<html lang="fr">
    <head>
    <meta charset="UTF-8">
        <title>valide fiche</title>
        <link rel="stylesheet" type="text/css" href="../gsb.css"/>
    </head>
    <body>
        <div class="valide">
            <h1>Validation des frais par visiteur</h1>
            <form method="get" action="valide_fiche.php?data<=?=$visiteur?>">
                <table style="padding-right:10%">
                    <tr>
                        <td>
                            <?php
                            
                                include '../fonctiongenevisiteur.php';
                                //Connexion à la base de données
                                $cnxBDD= connexion();
                                //Récupération de l'id du visiteur, du mois et de l'année 
                                $visiteur=$_GET["visiteur"];
                                $mois=$_GET["mois"];
                                $annee=$_GET["annee"];
                                $idvisiteur=$visiteur;

                                //Affichage de l'id du visiteur 
                                echo '<label for="visiteur">ID du visiteur :</label>'; 
                                echo'<td>';
                                    echo "<input type='text' name='visiteur' value='$visiteur' readonly></input>"; 
                                echo'<td>';

                            ?>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="date">Date : </label>
                        </td>
                        <td>
                            <?php
                                //Création des combos année et mois avec les valeurs choisie précédemment
                                echo"<select name='mois'>";
                                    echo"<option value=$mois>$mois</option>";
                                    echo"</select>";
                                    echo"<select name='annee'>";
                                    echo"<option value=$annee>$annee</option>";
                                    echo"</select>";
                            ?>
                        </td>
                    </tr>
                </table>
                <h2>Frais au forfait</h2>
                <table border="1" class="tablo">
                    <tr>
                        <td class="espacement">Repas midi</td>
                        <td class="espacement">Nuitée</td>
                        <td class="espacement">Etape</td>
                        <td class="espacement">Km</td>
                        <td>Situation</td>
                    </tr>
                    
                    <tr>
                        <?php
                            echo'<td width="75px" class="carre">';
                            
                                //Récupération des repas, nuitée, km et quantité de la fiche de frais
                                $visiteur=$_GET['visiteur'];

                                $repas="SELECT DISTINCT quantite
                                FROM visiteur,fichefrais,lignefraisforfait
                                WHERE visiteur.id = fichefrais.idVisiteur
                                AND fichefrais.id=lignefraisforfait.idFicheFrais
                                AND visiteur.id=$visiteur
                                AND mois=$mois
                                AND annee=$annee
                                AND idForfait='REP';";

                                $result = $cnxBDD->query($repas);

                                while($row = mysqli_fetch_assoc($result)) {
                                    echo"<input class='carre' value='$row[quantite]' readonly<br/>";
                                }

                                //$cnxBDD ->close();
                            
                            echo'</td>';
                            echo'<td width="75px">';
                                $nuitee="SELECT DISTINCT quantite
                                FROM visiteur,fichefrais,lignefraisforfait
                                WHERE visiteur.id = fichefrais.idVisiteur
                                AND fichefrais.id=lignefraisforfait.idFicheFrais
                                AND visiteur.id=$visiteur
                                AND mois=$mois
                                AND annee=$annee
                                AND idForfait='NUI';";

                                $result = $cnxBDD->query($nuitee);

                                while($row = mysqli_fetch_assoc($result)) {
                                    echo"<input class='carre' value='$row[quantite]' readonly><br/>";
                                }
                            echo'</td>';
                            echo'<td width="75px" class="carre">';
                                $etape="SELECT DISTINCT quantite
                                FROM visiteur,fichefrais,lignefraisforfait
                                WHERE visiteur.id = fichefrais.idVisiteur
                                AND fichefrais.id=lignefraisforfait.idFicheFrais
                                AND visiteur.id=$visiteur
                                AND mois=$mois
                                AND annee=$annee
                                AND idForfait='ETP';";

                                $result = $cnxBDD->query($etape);
                                
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo"<input class='carre' value='$row[quantite]' readonly><br/>";
                                }
                            echo'</td>';
                            echo'<td width="75px" class="carre">';
                                $km="SELECT DISTINCT quantite
                                FROM visiteur,fichefrais,lignefraisforfait
                                WHERE visiteur.id = fichefrais.idVisiteur
                                AND fichefrais.id=lignefraisforfait.idFicheFrais
                                AND visiteur.id=$visiteur
                                AND mois=$mois
                                AND annee=$annee
                                AND idForfait='KM';";

                                $result = $cnxBDD->query($km);
                                    while($row = mysqli_fetch_assoc($result)) {
                                        echo"<input class='carre' value='$row[quantite]' readonly<br/>";
                                    }
                            echo'</td>';
                        ?>
                        <td class="cellule">
                            <?php //Création de bouton radio permettant de valider ou non les fiches de frais?>
                            <input type="radio" name="valide" value="valide" required/>
                            <label for="Situation">Valide</label>
                            <input type="radio" name="valide" value="non valide" required/>
                            <label for="Situation">Non Valide</label>
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td>
                            <label for="justificatifs">Nb justificatifs :</label>
                            <input style="width:50px" type="text" name="nb_justificatifs"/>
                        </td>
                        <td class="bg_bouton">
                            <button class="bouton" type="submit" name="bouton" value="True">Soumettre la requete</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
    <footer>

    </footer>
</html>