


<!DOCTYPE html>
<html>
    <head>
        <title>IPEXpress Paramettres</title>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <link rel='stylesheet' type='text/css' href='dashboard.css' />
        <link href='http://fonts.googleapis.com/css?family=Droid+Sans+Mono' rel='stylesheet' type='text/css'>
        <script type='text/javascript' src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script type='text/javascript' src='panneau.js' ></script>
    </head>
    <body>

        <a href="https://github.com/S3LLL/IPEXpress"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://camo.githubusercontent.com/652c5b9acfaddf3a9c326fa6bde407b87f7be0f4/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f6f72616e67655f6666373630302e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_orange_ff7600.png"></a>

        <div id="param" >
            <h1>Ajouter un utilisateur</h1>
            <form action="Utilisateurs.php" method="post">
                    <div>
                        <label for="identifiant">Identifiant :</label>
                        <input type="text" id="nom" name="nom"/>
                </div>
                    <div>
                        <label for="Mot de passe">Mot de passe :</label>
                        <input type="password" id="password" name="password"/>
                    </div>
                    <div>
                        <label for="Mot de passe">confirmer le Mot de passe :</label>
                        <input type="password" name="password2" id="password2"/>
                    </div>
                    <div>
                        <input type="submit" id="submit" name="soumettre">
                    </div>
            </form>

<?php
if((!empty($_POST['nom'])) && (!empty($_POST['password']))&& (!empty( $_POST['password2']))){
    if($_POST['password']==$_POST['password2']){
        //encryption du mot de passe et mise dans le .htaccess
        //$clearTextPassword = $_POST['password'];
        //$password = crypt($clearTextPassword, base64_encode($clearTextPassword));
        //echo $password;
        shell_exec("htpasswd -b /etc/ipexpress/user.pass " . $_POST['nom']." ".$_POST['password']);
        echo("Cet utilisateur à bien été enregistré !");
    }
    else{
        echo "Les deux mots de passes ne sont pas identiques";  
    }
}



?>
        </div>

        <div id="nav">

            <h1>IPEXpress</h1>

            Panneau<br /><br />

            <a href="index.html">Retour</a>
        </div>




    </body>
</html>
