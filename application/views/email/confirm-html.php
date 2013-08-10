<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Car-People<?php if(isset($titre)){echo " - ".$titre;} ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link type="image/x-icon" href="favicon.ico" rel="icon">
        <link type="image/x-icon" href="favicon.ico" rel="shortcut icon">

        <link rel="stylesheet" href="<?php echo base_url(); ?>web/css/reset.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>web/css/email.css">
    </head>
    <body>
        <h1>Car-People<?php if(isset($titre)){echo " - ".$titre;} ?></h1>
        <div class="contenu">
            <p>Bonjour <?php echo isset($username) ? $username : $email ?>,</p>
            <p>Veuillez <a href="http//www.car-people.be/email/confirm?str=<?php echo $lien_confirm ?>&id=<?php echo $id ?>">cliquer ici</a> afin de confirmer votre e-mail. Une fois votre adresse email confirmé, vous serez en mesure d'ajouter des annonces ainsi que de contacter les membres.</p>
            <p>Si le lien "cliquez ici" n'est pas supporté par votre logiciel de messagerie, cliquez sur ce lien ou collez-le dans votre navigateur:</p>
            <p><a href="http//www.car-people.be/email/confirm?str=<?php echo $lien_confirm ?>&id=<?php echo $id ?>">http//www.car-people.be/email/confirm?str=<?php echo $lien_confirm ?>&id=<?php echo $id ?></a></p>
            <p>À bientot sur Car people !</p>
            <p><a href="http//www.car-people.be">http//www.car-people.be</a></p>
        </div>
        <div class="footer">
            Copyright © 2013 Car People.
        </div>
    </body>
</html>