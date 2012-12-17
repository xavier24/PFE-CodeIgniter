<section id="col1">

    <p><?php echo anchor( 'accueil/lister','Retour à la liste des annonces',array('title'=>'Retour à la liste des annonces', 'hreflang'=>'fr' )); ?></p>    

    <h1><?php echo $annonce->depart.' - '.$annonce->arrivee ?></h1>
    <h3><?php echo $annonce->date ?></h3>
    <h4><?php echo $annonce->heure ?></h4>
    <p><?php echo $annonce->places ?> place(s) disponible(s)</p>
    
    <hr/>
    <div>
        <h3><?php echo $annonce->depart ?></h3>
        <h3><?php echo $annonce->date ?> à <?php echo $annonce->heure ?></h3>
        <p>Lieu de rendez-vous&nbsp;:</p>
    </div>
    <hr/>
    <div>
        <h3><?php echo $annonce->arrivee ?></h3>
        <h3><?php echo $annonce->heure ?> (heure estimée)</h3>
        <p>Lieu de destination&nbsp;:</p>
    </div>
    <h4>Commentaire sur le trajet</h4>
    
    
    <hr/>
        <?php echo form_open('',array('method'=>'post'));
            $data = array(
                'name' => 'button',
                'id' => 'button',
                'value' => 'true',
                'type' => 'check',
                'content' => '+ selection'
            );
            echo '<div class="boutton">'.form_button($data).'</div>';
            echo form_close(); 
        ?>
        <?php echo form_open('',array('method'=>'post'));
            $data = array(
                'name' => 'button',
                'id' => 'button',
                'value' => 'true',
                'type' => 'check',
                'content' => 'Je réserve ma place au prix de '.$annonce->prix
            );
            echo '<div class="boutton">'.form_button($data).'</div>';
            echo form_close(); 
        ?>
    <hr/>
    <p><?php echo $annonce->description ?></p>
    <hr/>
    <?php if($annonce->conducteur){?>
        <h3>Annonce conducteur</h3>
    <?php }
    else{?>
        <h3>Annonce passager</h3>
    <?php } ?>
    <p><?php echo $annonce->username?> vous propose</p>
    
    <p><?php echo $annonce->flexibilite ?>jour(s)</p>
    <p></p>
</section>
<section id="col2">
    <section id="connexion" class="formulaire">
          <?php if(!$this->session->userdata('logged_in')){
                echo form_open('accueil/login',array('method'=>'post'));
                echo form_fieldset();
                
                $attributes_email = array(
                    'class' => 'icon-user-1',
                );
                echo form_label('adresse email','email',$attributes_email);
                $emailInput = array('name'=>'email','id'=>'email','type'=>'email','placeholder'=>'E-mail');
                echo form_input($emailInput);
                
                $attributes_mdp = array(
                    'class' => 'icon-lock',
                );
                echo form_label('mot de passe','mdp',$attributes_mdp);
                $mdpInput = array('name'=>'mdp','id'=>'mdp','placeholder'=>'Mot de passe');
                echo form_password($mdpInput);
                
                echo form_fieldset_close();
                echo '<p><a href="#">Mot de passe oublié&nbsp;?</a> / <a href="#">Pas encore inscrit&nbsp;?</a></p>';
               $data = array(
                    'name' => 'button',
                    'id' => 'button',
                    'value' => 'true',
                    'type' => 'check',
                    'content' => 'Connexion'
                );
                echo '<div class="boutton">'.form_button($data).'</div>';
                echo form_close();
                echo '<p class="facebook"><a href="#" title="">Connexion via Facebook</a></p>';
            } 
            else{
                echo '<p>Bonjour '.$info_membre->username.'</p>';
                echo '<p>demande(s) en attente</p>';
                echo '<p>trajet(s) vous interesse(ent)</p>';
                echo form_open('accueil/deconnecter',array('method'=>'post'));
                $data = array(
                    'name' => 'button',
                    'id' => 'button',
                    'value' => 'true',
                    'type' => 'check',
                    'content' => 'Déconnexion'
                );
                echo '<div class="boutton">'.form_button($data).'</div>';
                echo form_close();
            } ?>
         
    </section>
    <section id="news">
    </section>
</section>


    
