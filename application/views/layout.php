<?php
//setcookie('car_people', 'M@teo21', time() + 365*24*3600, null, null, false, true); // On écrit un cookie
?>

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
        <link rel="stylesheet" href="<?php echo base_url(); ?>web/css/fontello.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>web/css/animation.css">
        <!--[if IE 7]>
            <link rel="stylesheet" href="<?php echo base_url(); ?>web/css/fontello-ie7.css">
        <![endif]-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>web/css/jquery-ui-1.10.3.custom.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>web/css/responsive.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>web/css/style.css">
        
        <script src="<?php echo base_url(); ?>web/js/jquery-1.8.2.min.js"></script>
        <!--[if lt IE 9]>
            <script type="text/javascript" src="<?php echo base_url(); ?>web/js/html5shiv.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>web/js/css3-mediaqueries.js"></script>
	<![endif]-->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3bDuQVr6LId7sm9l83B9yQYHUPDtgqxs&sensor=false&language=fr&region=BE" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>web/js/jquery.googlemap.js"></script>
        <script src="<?php echo base_url(); ?>web/js/facebook_init.js"></script>
        <!--<script src="//connect.facebook.net/fr_FR/all.js"></script>-->
        <script src="<?php echo base_url(); ?>web/js/jquery-ui-1.10.3.custom.js"></script>
        <script src="<?php echo base_url(); ?>web/js/jquery.ui.datepicker-fr.js"></script>
        <script src="<?php echo base_url(); ?>web/js/jquery-ui-timepicker-addon.js"></script>
        <script src="<?php echo base_url(); ?>web/js/colorPicker.js"></script>
        <script src="<?php echo base_url(); ?>web/js/plugins.js"></script>
        <script src="<?php echo base_url(); ?>web/js/appel.googlemap.js"></script>
        <script src="<?php echo base_url(); ?>web/js/main.js"></script>
        
    </head>
    <body <?php if(isset($body)){echo 'class="'.$body.'"';} ?> >
        <div id="fb-root"></div>
        <!-- A SUPPRIMER SI TOUT LES TEST SONT OK SINON LIER SCRIPT DIRECT DANS HEAD
        <script>
          (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1";
                fjs.parentNode.insertBefore(js, fjs);
          }(document, 'script', 'facebook-jssdk'));
        </script>--> 
        
        <div class="wrapper">
            <header class="clearfix">
                <?php include('include/banner.php');?>
                <?php include('include/menu.php');?>
            </header>
                                    
            <?php echo $vue ?>
            <div class="push"></div>
        </div>   
        <?php include('include/footer.php');?>
        
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <!--
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>-->
    </body>
</html>
