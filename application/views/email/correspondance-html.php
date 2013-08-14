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
            <p>Bonjour <?php echo isset($annonces[0]->username) ? $annonces[0]->username : $annonces[0]->email ?>,</p>
                     
            <p>Une <a href="<?php echo base_url() ?>annonce/fiche/<?php echo $annonces[0]->correspondance ?>">nouvelle annonce</a> a été enregistée et pourrait correspondance à l'une de vos recherche suivante : </p>
            
            <?php for($i=0;$i<count($annonces);$i++){?>
            <div class="annonce">
                <h3><?php echo $annonces[$i]->d_fr ?> - <?php echo $annonces[$i]->a_fr ?></h3>
                <p><?php echo $annonces[$i]->date ?> à <?php echo $annonces[$i]->heure ?></p>
            </div>
            <?php } ?>
            
            <p>Retrouvez l'annonce ici :</p>
            <p><a href="http//www.car-people.be/annonce/fiche/<?php echo $annonces[0]->correspondance ?>">http//www.car-people.be/annonce/fiche/<?php echo $annonces[0]->correspondance ?></a></p>
            <p>À bientot sur Car people !</p>
            <p><a href="http//www.car-people.be">http//www.car-people.be</a></p>
        </div>
        <div class="footer">
            Copyright © 2013 Car People.
        </div>
    </body>
</html>