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
           <?php echo form_label('Adresse email','email');
            $emailInput = array('name'=>'email','id'=>'email','type'=>'email','placeholder'=>'E-mail','class'=>'champ');
            echo form_input($emailInput);

            echo form_label('Mot de passe','mdp');
            $mdpInput = array('name'=>'mdp','id'=>'mdp','placeholder'=>'Mot de passe','class'=>'champ');
            echo form_password($mdpInput);

            echo form_label('Confirmez mot de passe','mdp2');
            $mdp2Input = array('name'=>'mdp2','id'=>'mdp2','placeholder'=>'Retapez mot de passe','class'=>'champ');
            echo form_password($mdp2Input);
        foreach($message as $error){
            if($error){?>
           <p class="erreur_inscription"><?php echo $error ?></p>
        <?php   }
         }?>
     </div>      
    </div><!-- 
 --><div class="inscript_valid">
        <p><?php    
            $data = array(
                'name'        => 'majeur',
                'id'          => 'majeur',
                'value'       => 'Majeur',
                'checked'     => FALSE,
            );
            echo form_checkbox($data);
            echo form_label('Je certifie être majeur.','majeur');
            $data = array(
                'name'        => 'condition',
                'id'          => 'condition',
                'value'       => 'Condition générale',
                'checked'     => FALSE,
            );?>
        </p>
        <p>
            <?php
            echo form_checkbox($data);
            echo form_label('J\'accepte les Conditions générales d\'utilisation.','condition');

            $data = array(
                'name' => 'button',
                'id' => 'button',
                'value' => 'true',
                'type' => 'check',
                'content' => 'Je m\'inscris'
            );?>
        </p>    
         <?php
            echo '<div class="boutton">'.form_button($data).'</div>';
            echo form_close();
        ?>
    </div>
</div>