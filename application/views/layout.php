<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Car-People</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="<?php echo base_url(); ?>web/css/normalize.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>web/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>web/css/fontello.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>web/css/animation.css"><!--[if IE 7]>
	<link rel="stylesheet" href="<?php echo base_url(); ?>web/css/fontello-ie7.css"><![endif]-->
                
        <script src="<?php echo base_url(); ?>web/js/modernizr-2.6.1.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <header>
            <img src="<?php echo base_url(); ?>web/images/header.jpg"/>
            <h1>Car-People</h1>
            <img src="<?php echo base_url(); ?>web/images/voyageur.png" class="voyageur"/>
        </header>
        <nav>
            <a href="<?php echo base_url(); ?>">Rechercher une annonce</a><a href="#" class="publier_annonce">Publier mon annonce</a><!--
         --><?php echo (!$this->session->userdata('logged_in'))?  '<a href="'.base_url().'inscription">Inscription</a>': '<a href="'.base_url().'profil">Mon profil</a>' ?><!--
         --><a href="#">Aide&nbsp;-&nbsp;FAQ</a>
        </nav>
        <?php echo $vue ?>

        
        <footer>
            <p>footer</p>
        </footer>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>web/js/jquery-1.8.2.min.js"><\/script>')</script>
        <script src="<?php echo base_url(); ?>web/js/plugins.js"></script>
        <script src="<?php echo base_url(); ?>web/js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>
