<section class="content">
    <div class="row-fluid ajouter_annonce">
        <h1>Resultats recherche</h1>
        <?php 
        if($annonces || $rayons || $parcours){
            if($annonces){
                //var_dump($annonces);
                foreach($annonces as $annonce): ?>
                    <div class="annonce clearfix">
                        <h4><?php echo $annonce->id ?>
                            <a class="bleu" href="<?php echo base_url().'annonce/fiche/'.$annonce->id ?>">
                                <span class="annonce_date"><?php echo $annonce->date ?></span>
                                <span class="annonce_heure"><?php echo $annonce->heure ?><span class="heure_estime">&nbsp;(heure&nbsp;estimée)</span></span>
                            </a>
                        </h4>
                        <p class="destination"><span class="ville"><?php echo $annonce->$ville_depart_lang ? $annonce->$ville_depart_lang : $annonce->ville_depart_fr ?></span><span class="icon-right-thin"> </span><span class="ville"><?php echo $annonce->$ville_arrivee_lang ? $annonce->$ville_arrivee_lang : $annonce->ville_arrivee_fr ?></span></p>
                        <p class="places"><?php echo $annonce->places ?> place(s) disponible(s)</p>
                    </div>
                <?php endforeach; 
            }
            echo '<hr />';
            echo '<h3>Dans un rayon de 25km</h3>';
            if($rayons){
                //var_dump($annonces);
                foreach($rayons as $annonce): ?>
                    <div class="annonce clearfix">
                        <h4><?php echo $annonce->id ?>
                            <a class="bleu" href="<?php echo base_url().'annonce/fiche/'.$annonce->id ?>">
                                <span class="annonce_date"><?php echo $annonce->date ?></span>
                                <span class="annonce_heure"><?php echo $annonce->heure ?><span class="heure_estime">&nbsp;(heure&nbsp;estimée)</span></span>
                            </a>
                        </h4>
                        <p class="destination"><span class="ville"><?php echo $annonce->$ville_depart_lang ? $annonce->$ville_depart_lang : $annonce->ville_depart_fr ?></span><span class="icon-right-thin"> </span><span class="ville"><?php echo $annonce->$ville_arrivee_lang ? $annonce->$ville_arrivee_lang : $annonce->ville_arrivee_fr ?></span></p>
                        <p class="places"><?php echo $annonce->places ?> place(s) disponible(s)</p>
                    </div>
                <?php endforeach; 
            }
            echo '<hr />';
            echo '<h3>Passe par chez vous</h3>';
            if($parcours){
                //var_dump($annonces);
                foreach($parcours as $annonce): ?>
                    <div class="annonce clearfix">
                        <h4><?php echo $annonce->id ?>
                            <a class="bleu" href="<?php echo base_url().'annonce/fiche/'.$annonce->id ?>">
                                <span class="annonce_date"><?php echo $annonce->date ?></span>
                                <span class="annonce_heure"><?php echo $annonce->heure ?><span class="heure_estime">&nbsp;(heure&nbsp;estimée)</span></span>
                            </a>
                        </h4>
                        <p class="destination"><span class="ville"><?php echo $annonce->$ville_depart_lang ? $annonce->$ville_depart_lang : $annonce->ville_depart_fr ?></span><span class="icon-right-thin"> </span><span class="ville"><?php echo $annonce->$ville_arrivee_lang ? $annonce->$ville_arrivee_lang : $annonce->ville_arrivee_fr ?></span></p>
                        <p class="places"><?php echo $annonce->places ?> place(s) disponible(s)</p>
                    </div>
                <?php endforeach; 
            }
        }
        else{
            echo '<p>Aucun trajet ne correspont à votre recherche.</p>';
        }
        ?>
    
    </div>
</section>
