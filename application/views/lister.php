<section id="container">
	<h1>Bienvenue sur Car-People</h1>
        <h2<?php echo $page ?></h2>
        <h3><?php echo $titre ?></h3>
        <arcticle>
            <?php foreach($annonces as $annonce): ?>
            <div>
                <?php if($annonce->conducteur){?>
                    <h3>Annonce conducteur</h3>
                <?php }
                else{?>
                    <h3>Annonce passager</h3>
                <?php } ?>
                <p><?php echo anchor('annonce/user/'.$annonce->user_id,$annonce->username, array('title'=>'voir le profil de'.$annonce->username, 'hreflang'=>'fr')) ?> vous propose</p>
                <?php echo anchor( 'annonce/voir/'.$annonce->id,
                                   '<h4>'.$annonce->depart.' -> '.$annonce->arrivee.'</h4>',
                                   array('title'=>'voir l\'annonce '.$annonce->depart.'-'.$annonce->arrivee, 'hreflang'=>'fr' )); ?>    
                        
                
                <p>Le <?php echo $annonce->date ?> à <?php echo $annonce->heure ?> avec +/- <?php echo $annonce->flexibilite ?>jour(s)</p>
                <p><?php echo $annonce->places ?> place(s) disponible(s)</p>
                <h4>Description</h4>
                <p><?php echo $annonce->description ?></p>
                
                
                <hr/>
            </div>
            <?php endforeach; ?>
        </article>
</section>