<section id="col1">
    <h1>Recherche rapide</h1>
    <?php echo form_open('annonce/lister',array('method'=>'post')); ?>
        <div id="recherche" class="formulaire">
            <p>Je suis </p>
            <label class="radio"><input id="passager" class="champ" type="radio" name="pass-cond" /><img src="<?php echo base_url(); ?>web/images/passager.png" title="" alt=""/></label>
            <label class="radio"><input id="conducteur" class="champ" type="radio" name="pass-cond" /><img src="<?php echo base_url(); ?>web/images/conducteur.png" title="" alt=""/></label>
            <label>voyageant de<input type="text" class="champ" name="depart" id="depart" placeholder="ville de départ" /></label>
            <label>à<input type="text" class="champ" name="arrivee" id="arrivee" placeholder="ville d'arrivée"/></label>
            <label>le<input type="date" class="champ" name="date" id="date" placeholder="JJ/MM/AAAA"/></label>
            <label>+/- <input type="number" class="champ" name="flex" id="flex" min="0" max="5"> jour(s)</label>
            <?php $data = array(
                    'name' => 'button',
                    'id' => 'button',
                    'value' => 'true',
                    'type' => 'check',
                    'content' => 'Rechercher'
                );
                echo '<div id="lancer_recherche"><div class="boutton">'.form_button($data).'</div></div>';?>
            <div class="avancee">
                <label>Avec <input type="number" class="champ" name="places" id="places" min="0" max="5">place(s) et +</label>
            </div>
        </div>
    <?php echo form_close(); ?>       
    <section id="resultat">
        <?php foreach($annonces as $annonce): ?>
            <div class="annonce">
                <div class="profil">
                    <img src="<?php echo base_url(); ?>web/images/profil.jpg" alt="" title=""/><!--
                --><p class="icon-mail icon30">Contacter</p><!--
                --><p class="icon-user-add icon30 ajout_ami">Ajouter à mes amis</p><!--
                --><img src="" alt="etoiles" title=""/><!--
                --><p>32 avis</p>
                </div>
                <div class="trajet">
                    <p><?php echo anchor('user/profil/'.$annonce->user_id,$annonce->username, array('title'=>'voir le profil de'.$annonce->username, 'hreflang'=>'fr')) ?> 
                        vous propose pour <?php echo $annonce->prix ?>&nbsp;€</p>
                    <p><?php echo anchor( 'annonce/voir/'.$annonce->id,
                                    $annonce->depart.' -> '.$annonce->arrivee,
                                    array('title'=>'voir l\'annonce '.$annonce->depart.'-'.$annonce->arrivee, 'hreflang'=>'fr' )); ?>
                    </p>
                    <p><?php echo $annonce->places ?> place(s) disponible(s)</p>
                </div>
                <div class="ajout">
                    <p><?php echo $annonce->date ?></p>
                    <p><?php echo $annonce->heure ?> (heure estimée)</p>
                    <button>Ca m'intéresse</button>
                    <button>+</button>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
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
                echo '<p><a href="'.base_url().'redefinition">Mot de passe oublié&nbsp;?</a> / <a href="'.base_url().'inscription">Pas encore inscrit&nbsp;?</a></p>';
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