<section id="col1">
    <h1>Publier une annonce</h1>
    
	<!-- FORMULAIRE DE RECHERCHE -->
	<?php echo form_open('annonce/lister',array('method'=>'post')); ?>
        <div id="recherche" class="formulaire">
            <p>Je suis </p>
            <label class="radio"><input id="passager" class="champ" type="radio" name="pass-cond" /><img src="<?php echo base_url(); ?>web/images/passager.png" title="" alt=""/></label>
            <label class="radio"><input id="conducteur" class="champ" type="radio" name="pass-cond" /><img src="<?php echo base_url(); ?>web/images/conducteur.png" title="" alt=""/></label>
            <label>voyageant de<input type="text" data-provide="typeahead" class="champ typeahead" name="depart" id="depart" placeholder="ville de départ" /></label>
            <label>à<input type="text" data-provide="typeahead" class="champ typeahead" name="arrivee" id="arrivee" placeholder="ville d'arrivée"/></label>
            <label>le<input type="date" class="champ" name="date" id="date" placeholder="JJ/MM/AAAA"/></label>
            <label>+/- <input type="number" class="champ" name="flex" id="flex" min="0" max="5"> jour(s)</label>
            <?php $data = array(
                    'name' => 'button',
                    'id' => 'button',
                    'value' => 'true',
                    'type' => 'check',
                    'content' => 'Publier'
                );
                echo '<div id="lancer_recherche"><div class="boutton">'.form_button($data).'</div></div>';?>
            <div class="avancee">
                <label>Avec <input type="number" class="champ" name="places" id="places" min="0" max="5">place(s) et +</label>
            </div>
        </div>
					
    <?php echo form_close(); ?>
	<script>
		var villes = [
			<?php foreach ($villes as $ville) : 
				echo '"'.$ville->fr_FR.'",';
			endforeach; ?>
		];
		$('.typeahead').typeahead({
		 source : villes,
		 items : 5
		});
	</script>
	<!-- RESULTATS DE RECHERCHE -->
    <section id="resultat">
        
    </section>
</section>
<section id="col2">

	<!-- FORMULAIRE DE CONNEXION -->
    <section id="connexion" class="formulaire">
          <!-- PAS CONNECTE -->
		  <?php if(!$this->session->userdata('logged_in')){
                echo form_open('user/login',array('method'=>'post'));
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
			// <!-- CONNECTE -->
            else{
                echo '<p>Bonjour '.$info_membre->username.'</p>';
                echo '<p>demande(s) en attente</p>';
                echo '<p>trajet(s) vous interesse(ent)</p>';
                echo form_open('user/deconnecter',array('method'=>'post'));
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