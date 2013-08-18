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
            <p>Malheureusement, un covoitureur a décidé d'annuler son voyage et de supprimer une annonce sur laquelle vous aviez reservé des places</p>
            <p><?php echo $annonce->d_fr ?> - <?php echo $annonce->a_fr ?> du <?php echo $annonce->date ?></p>
            <p>Vous pouvez retrouver toutes vos réservations dans <a href="http://www.car-people.be/annonce/mes_reservations">"Mes réservations"</a> accessible depuis votre compte</p>
            <p><a href="http://www.car-people.be/annonce/mes_reservations">"http://www.car-people.be/annonce/mes_reservations"</a></p>
            
            <p>À bientot sur Car people !</p>
            <p><a href="http//www.car-people.be">http//www.car-people.be</a></p>
        </div>
        <div class="footer">
            Copyright © 2013 Car People.
        </div>
    </body>
</html>