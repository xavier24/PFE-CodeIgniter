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
            <p>Bonjour <?php echo isset($user_data->username) ? $user_data->username : $user_data->email ?>,</p>
            <p>Votre demande de réservation de <?php echo $place ?> place(s) pour l'annonce suivante a été acceptée.</p>
            
            <p><a href="http//www.car-people.be/annonce/fiche/<?php echo $annonce->id ?>"><?php echo $annonce->d_fr ?> - <?php echo $annonce->a_fr ?> du <?php echo $annonce->date ?></a></p>
            <p>Retrouvez toutes vos réservations via votre page <a href="http//www.car-people.be/annonce/mes_reservations">mes réservations</a> accessible depuis votre compte</p>            
            <p>Si le lien de l'annonce concernée n'est pas supporté par votre logiciel de messagerie, cliquez sur ce lien ou collez-le dans votre navigateur:</p>
            <p><a href="http//www.car-people.be/annonce/fiche/<?php echo $annonce->id ?>">http//www.car-people.be/annonce/fiche/<?php echo $annonce->id ?></a></p>
            <p>À bientot sur Car people !</p>
            <p><a href="http//www.car-people.be">http//www.car-people.be</a></p>
        </div>
        <div class="footer">
            Copyright © 2013 Car People.
        </div>
    </body>
</html>