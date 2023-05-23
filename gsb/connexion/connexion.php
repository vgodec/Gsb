<?php
    include '../fonctiongenevisiteur.php';
    
    session_start();
    if(isset($_GET['username']) && isset($_GET['password'])){
        $cnxBDD= connexion();
        
        $username=$_GET['username'];
        $password=$_GET['password'];

        if($username !== "" && $password !== ""){
            $requete = "SELECT count(*) AS existe FROM comptable WHERE 
            username = '$username' AND mdp = '$password';";
            $result = $cnxBDD->query($requete);
            $row=mysqli_fetch_assoc($result);
            $existe=$row['existe'];
            if($existe==1) // nom d'utilisateur et mot de passe correctes
            {
                $_SESSION['username'] = $username;
                header('Location: ../comptable.html');
            }
            else
            {
                $requete = "SELECT count(*) AS existe FROM visiteur WHERE 
                login = '$username' AND motdepasse = '$password';";
            
                $result = $cnxBDD->query($requete);
                $row=mysqli_fetch_assoc($result);
                $existe=$row['existe'];
                if($existe==1) // nom d'utilisateur et mot de passe correctes
                {
                    $_SESSION['username'] = $username;
                    header("Location: ../gf3/testons.php?unlogin=$username");
                }else{
                    echo"<script>";
                    echo"alert('Login/Password incorrect');";
                    echo"history.back(-1);";
                    echo"</script>";       
        }
    }
}else{
    echo"<script>";
    echo"alert('Veuillez renseigner tout les champs');";
    echo"history.back(-1);";
    echo"</script>";
}
    }
        $cnxBDD->close();
    


?>