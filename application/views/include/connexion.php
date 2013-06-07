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