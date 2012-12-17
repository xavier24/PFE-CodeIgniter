<h1><?php echo $page ?></h1>
<h2><?php echo $titre ?></h2>
<p><?php echo $annonces->username ?></p>

<?php foreach($annonces as $annonce): ?>
            <div>
               <h4><?php echo $annonce->depart.' -> '.$annonce->arrivee ?></h4>
                
                <hr/>
            </div>
            <?php endforeach; ?>
<p><?php echo anchor( 'annonce/lister','Retour à la liste des annonces',array('title'=>'Retour à la liste des annonces', 'hreflang'=>'fr' )); ?></p>    
