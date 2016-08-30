<?php

    if(!empty($_POST)) {
        extract($_POST);
        $valid = true;
        if(empty($nom)){
            $valid=false;
            $erreurnom="Vous n'avez pas rempli votre nom";
        }
        if(!preg_match("/^[a-z0-9\-_.]+@[a-z0-9\-_.]+\.[a-z]{2,3}$/i",$email)){
            $valid = false;
            $erreuremail="Votre email n'est pas valide";
        }
        if(empty($email)){
            $valid=false;
            $erreuremail="Vous n'avez pas rempli votre email";
        }
        if(empty($message)){
            $valid=false;
            $erreurmessage="Vous n'avez pas rempli votre message";
        }

        if($valid){
            $to = "stephane.legalliard@gmail.com";
            $sujet = $nom." a contacté le site";
            $header = "From : $nom <$email>";
            if(mail($to,$sujet,$message,$header)){
                $erreur = "Votre message m'est bien parvenu !";
                unset($nom);
                unset($email);
                unset($message);
            }
            else{
                $erreur = "Une erreur est survenue et votre mail n'est pas parti";
            }
        }
    }
?>

<!Doctype html>
<head>
    <meta charset="utf-8">
    <title>Challenge Send_mail</title>
    <link type="text/css" rel="stylesheet" href="style.css" />
    <link <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>
</head>

<body>
    <div id="contenu" class="container-fluid">
    <div class="col-lg-12"></div>
        <div class="container text-center col-lg-12 formulaire_contact  description">
            <h1>Formulaire de contact</h1>
            <hr/>
            <?php
                if(isset($erreur)){ echo "<p>$erreur</p>"; }
            ?>
            <form method="post" action="index.php">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" value="<?php if(isset($nom)) echo $nom; ?>"/>
            <span class="error-message"><?php if(isset($erreurnom)) echo $erreurnom; ?></span>
            <br/>

            <label for="email">Email :</label>
            <input type="text" name="email" id="email" value="<?php if(isset($email)) echo $email; ?>"/>
            <span class="error-message"><?php if(isset($erreuremail)) echo $erreuremail; ?></span>
            <br/><br/>

            <label for="message">Votre message :</label>
            <textarea name="message" maxlength="500" id="message"><?php if(isset($message)) echo $message; ?></textarea><br/>
            <span class="error-message"><?php if(isset($erreurmessage)) echo $erreurmessage; ?></span>
            <br/>
            
            <input type="submit" value="Envoyer">
        </div>
    <div class="col-lg-12"></div>
    </div>
</body>

</html>