<h1><?php echo $page ?></h1>

<p><?php echo $info_profil->username ?></p>
<h2><?php echo $titre ?></h2>
<?php foreach($annonces as $annonce): ?>
            <div>
               <h4><?php echo $annonce->depart.' -> '.$annonce->arrivee ?></h4>
                
                <hr/>
            </div>
            <?php endforeach; ?>
<p><?php echo anchor( 'accueil/lister',$this->lang->line('retour_liste_annonces'),array('title'=>'Retour à la liste des annonces', 'hreflang'=>'fr' )); ?></p>    
