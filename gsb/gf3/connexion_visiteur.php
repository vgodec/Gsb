<!DOCTYPE html>
<html>
    <head>
        <title>Connexion Visiteur</title>
        <link rel="stylesheet" href="../connexion/connexion.css"></link>
    </head>
    <body>
        <center>
        <form style="padding: 5px 0px 5px 0px"action="testons.php" method="get" class="connexion">
        <h1>Connexion Visiteur :</h1>  
        <table>
            <tr>
                <td>          
                    <label for="nom">nom:</label>
                </td>
                <td>
                    <input type="text" value="Humbert" id="nom" name="nom">
                </td>
            </tr>
                    <br/><br/>
            <tr>
                <td>
                    <label for="prenom">prenom:</label>
                </td>
                <td>
                    <input type="text" value="Mohamed" id="prenom" name="prenom">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <center>
                        <input type="submit"  id="valider" value="connexion">
                    </center>
                </td>
            </tr>
        </form>
</center>
    </body>
</html>