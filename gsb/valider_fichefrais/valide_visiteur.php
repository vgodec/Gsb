<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <title>valide fiche</title>
        <link rel="stylesheet" type="text/css" href="../gsb.css"/>
    </head>
    <body>
        <div class="valide">
            <h1>Selectionner un visiteur et une date:</h1>
            <form method="get" action="valide_fiche_site.php">
                <table style="padding-right:10%">
                    <tr>
                        
                        <td>
                            <?php
                            
                                include '../fonctiongenevisiteur.php';

                                $cnxBDD= connexion();

                                //récupère les prenom des visiteur dont l'idEtat est cloturée
                                $select = 'SELECT DISTINCT visiteur.id,nom,prenom FROM visiteur,fichefrais WHERE fichefrais.idVisiteur=visiteur.id AND idEtat="CL";';
                                
                                //exécution de la requete select
                                $result = $cnxBDD->query($select);
                                echo '<label for="Visiteur">Choix du visiteur :</label>'; 
                                echo'<td>';
                                    echo '<select name="visiteur" id="visiteur" required>';
                                    echo '<option value=""></option>'; 
                                    
                                    //affichage des noms des visiteurs dans une liste
                                    while($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='$row[id]'>($row[id]) $row[prenom] $row[nom]</option>";
                                    }
                                    echo '</select>';  
                                echo'<td>';

                                $cnxBDD->close();
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="mois">Mois : </label>
                        </td>
                        <td>
                            <?php
                                $sql="SELECT mois,annee FROM fichefrais WHERE idVisiteur=$"
                            ?>
                            <select name="mois" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                            <select name="annee" required>
                                <?php
                                    $anneeactuelle = date("Y");
                                    for($i=2018;$i<=$anneeactuelle;$i++){
                                        echo("<option value=$i>$i</option>");
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                </table>
                
                <table>
                    <tr>
                        <td class="bg_bouton">
                            <button type="submit" name="bouton" value="True">valider visiteur</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
    <footer>

    </footer>
</html>