<div>
    <?php if($annonce->conducteur){?>
        <h3>Annonce conducteur</h3>
    <?php }
    else{?>
        <h3>Annonce passager</h3>
    <?php } ?>
    <p><?php echo $annonce->username?> vous propose</p>
    <h4><?php echo $annonce->depart.' -> '.$annonce->arrivee ?></h4>
    <p>Le <?php echo $annonce->date ?> à <?php echo $annonce->heure ?> avec +/- <?php echo $annonce->flexibilite ?>jour(s)</p>
    <p><?php echo $annonce->places ?> place(s) disponible(s)</p>
    <h4>Description</h4>
    <p><?php echo $annonce->description ?></p>


    <hr/>
</div>