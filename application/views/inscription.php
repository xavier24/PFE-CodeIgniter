<div id="inscription" class="formulaire">
    <?php echo form_open('inscription/inscrire',array('method'=>'post')); 
        echo validation_errors();?>
    <h1>Comment s'inscrire&nbsp;?</h1>
    <div class="methode1">
        <h2 class="methode">Méthode 1</h2>
        <p class="methode_texte">Grâce à votre compte Facebook en quelques clics.</p>
        <p class="methode_texte">C'est simple et rapide&nbsp;!</p>
        <img src="<?php echo base_url()?>/web/images/facebook-connect-buttons.png"/>
    </div><!--
 --><div class="methode2">
     <div>
        <h2 class="methode">Méthode 2</h2>
        <p class="methode_texte">Par le formulaire d'inscription et votre e-mail.</p>
        <?php 
		    echo form_label('Adresse email','email');
            $emailInput = array('name'=>'email','id'=>'email','type'=>'email','placeholder'=>'E-mail','class'=>'champ','value'=>$donnee["email"]);
            echo form_input($emailInput);
			if($message['error_email']){
				echo ('<p class="erreur_inscription">'.$message["error_email"].'</p>');
			}
			if($message['error_exist']){
				echo ('<p class="erreur_inscription">'.$message["error_exist"].'</p>');
			}
            
			echo form_label('Mot de passe','mdp');
            $mdpInput = array('name'=>'mdp','id'=>'mdp','placeholder'=>'Mot de passe','class'=>'champ');
            echo form_password($mdpInput);
			if($message['error_mdp']){
				echo ('<p class="erreur_inscription">'.$message["error_mdp"].'</p>');
			}
            
			echo form_label('Confirmez mot de passe','mdp2');
            $mdp2Input = array('name'=>'mdp2','id'=>'mdp2','placeholder'=>'Retapez mot de passe','class'=>'champ');
            echo form_password($mdp2Input);
			if($message['error_mdp2']){
				echo ('<p class="erreur_inscription">'.$message["error_mdp2"].'</p>');
			}
		?>
     </div>      
    </div><!-- 
 --><div class="inscript_valid">
        <?php    
        	$majeur_data = array(
								'name' => 'majeur',
								'id' => 'majeur',
								'value' => 'Majeur',
								'checked' => $donnee['majeur']
							);
			$condition_data = array(
								'name' => 'condition',
								'id' => 'condition',
								'value' => 'Condition générale',
								'checked' => $donnee['condition']
							);
			$button_data = array(
                'name' => 'button',
                'id' => 'button',
                'value' => 'true',
                'type' => 'check',
                'content' => 'Je m\'inscris'
            );
            echo '<p>';
			echo form_checkbox($majeur_data);
            echo form_label('Je certifie être majeur.*','majeur');
			echo '</p><p>';
		
			echo form_checkbox($condition_data);
            echo form_label('J\'accepte les Conditions générales d\'utilisation.*','condition');
			echo '</p>';
        
			if($message['error_majeur']){
				echo ('<p class="erreur_inscription">'.$message["error_majeur"].'</p>');
			}
			echo '<div class="boutton">'.form_button($button_data).'</div>';
			echo form_close();
        ?>
	</div>
</div>