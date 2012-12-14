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
                <p><?php echo $annonce->username?> vous propose</p>
                <h4><?php echo $annonce->depart ?> -> <?php echo $annonce->arrivee ?></h4>
                <p>Le <?php echo $annonce->date ?> à <?php echo $annonce->heure ?> avec +/- <?php echo $annonce->flexibilite ?>jour(s)</p>
                <p><?php echo $annonce->places ?> place(s) disponible(s)</p>
                <h4>Description</h4>
                <p><?php echo $annonce->description ?></p>
                
                
                <hr/>
            </div>
            <?php endforeach; ?>
        </article>
</section>