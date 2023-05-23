<?php
 header('Content-type:text/html; charset=iso-8859-1');
function connexion(){

            $host = "127.0.0.1";
            $user = "root";
            $password = "password";
            $dbname = "slam11_gsb";
            $port='3307';


        $mysqli = new mysqli($host, $user, $password, $dbname, $port);
        if ($mysqli->connect_errno) {
            echo "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            return($mysqli->connect_errno);
        }
        return $mysqli;

}
       
function erreurSQL() {
    global $cnxBDD;
    
    $err = mysql_errno($link) . ": " . mysql_error($cnxBDD). "\n";
    return $err;
}

function afficheErreur($sql, $erreur) {

	$uneChaine = "ERREUR SQL : ".date("j M Y - G:i:s.u --> ").$sql." : ($erreur) \r\n";

	ecritRequeteSQL($uneChaine);

	return "Erreur SQL de <b>".$_SERVER["SCRIPT_NAME"].
	"</b>.<br />Dans le fichier : ".__FILE__.
	" a la ligne : ".__LINE__.
	"<br />".$erreur.
	"<br /><br /><b>REQUETE SQL : </b>$sql<br />";

}

function ecritRequeteSQL($uneChaine) {
	$handle=fopen("requete.sql","a");
	fwrite($handle,$uneChaine);
	fclose($handle);
}



$cnxBDD = connexion();
function idSQL($table){
    global $cnxBDD;
    $sql="SELECT id FROM $table;";
    $result= $cnxBDD->query($sql);
    $id=0;
    while ($row = mysqli_fetch_assoc($result)){
            $id=$row['id'];
            
    }
    return ($id+1);
}


function quantforfait($id){
    global $cnxBDD;
    $i=0;
    $select_forfait= "SELECT quantite FROM lignefraisforfait where idfichefrais=$id"  ;
    $result= $cnxBDD->query($select_forfait);
    $lignefraisforfait=[];
    while ($row = mysqli_fetch_assoc($result)){
        
        $lignefraisforfait[$i]=$row['quantite'];
        $i++;
    }
    return $lignefraisforfait;
    /*
    $repas = $lignefraisforfait[0];
    $nuitees = $lignefraisforfait[1];
    $etape = $lignefraisforfait[2];
    $km = $lignefraisforfait[3];
    */
}
