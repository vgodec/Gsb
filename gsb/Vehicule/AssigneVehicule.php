<!DOCTYPE html>
    <head>
        <title>Assigner un vehicule</title>
        <link href="Vehicule.css" rel="stylesheet">
        <meta charset="UTF-8">
    </head>
<body>
    <center>
    <div class="arriere">
        <h2 class="titre">Assigner un vehicule a un visiteur:</h2>
    <form  action="UpdateVehicule.php" method="GET">
        <label>Visiteur:</label><br/>
        <?php
            include '../fonctiongenevisiteur.php';

            //Connexion à la base de données
            $cnxBDD=connexion();
            //Requete récupérant l'id,nom et prenom du visiteur qui n'a pas son id présent dans la table vehicule
            $req="SELECT id,prenom,nom from visiteur where id NOT IN (SELECT IdVisiteur from vehicule where idVisiteur=visiteur.id) ORDER BY nom ASC;";
            $result=$cnxBDD->query($req);
            //Création de la liste déroulante avec les données récupérées par la requête précédente
            echo'<select required name="Visiteur">';
            while($row=mysqli_fetch_assoc($result)){
                echo"<option value=$row[id]>$row[id] $row[nom] $row[prenom]</option>";
            }
            echo'</select><br/><br/>';
        ?>
            <label>Vehicule:</label><br/>
            <?php
                //Requete récupérant l'immat, le modele et la marque des vehicules qui ne sont pas assigné à un visiteur
                $req="SELECT Immat, Modele, Marque from vehicule where IdVisiteur IS NULL;";
                $result=$cnxBDD->query($req);
                //Création de la liste déroulante avec les données récupérées par la requête précédente
                echo'<select required name="Vehicule">';
                while($row=mysqli_fetch_assoc($result)){
                    echo"<option value=$row[Immat]>$row[Immat] $row[Marque] $row[Modele]</option>"; 
                }
                echo'</select><br/><br/>';
                    
                ?>
            <button class="bouton" type="submit">Assigner le vehicule</button>

    </form>
    </div>
        </center>
</body>

<?php 
    //Fermeture de a connexion à la BDD
    $cnxBDD->close(); 
?>
</html>