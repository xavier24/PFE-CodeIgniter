<h1>Méthode 1</h1>
<p>Grâce à votre compte Facebook en quelques clics.</p>
<p>C'est simple et rapide&nbsp;!</p>
<img src="<?php echo base_url()?>/web/images/facebook-connect-buttons.png"/>
<hr />
<h1>Méthode 2</h1>
<p>Par le formulaire d'inscription et votre e-mail.</p>
<?php
    echo form_open('inscription/inscrire',array('method'=>'post'));

    echo form_label('Adresse email','email');
    $emailInput = array('name'=>'email','id'=>'email','type'=>'email','placeholder'=>'E-mail');
    echo form_input($emailInput);

    echo form_label('Mot de passe','mdp');
    $mdpInput = array('name'=>'mdp','id'=>'mdp','placeholder'=>'Mot de passe');
    echo form_password($mdpInput);

    echo form_label('Confirmez mot de passe','mdp');
    $mdp2Input = array('name'=>'mdp2','id'=>'mdp2','placeholder'=>'Retapez mot de passe');
    echo form_password($mdp2Input);
    $data = array(
        'name'        => 'majeur',
        'id'          => 'majeur',
        'value'       => 'Majeur',
        'checked'     => FALSE,
    );
    echo form_checkbox($data).'Je certifie être majeur.';
    $data = array(
        'name'        => 'condition',
        'id'          => 'condition',
        'value'       => 'Condition générale',
        'checked'     => FALSE,
    );
    echo form_checkbox($data).'J\'accepte les Conditions générales d\'utilisation.';
    
    
    $data = array(
        'name' => 'button',
        'id' => 'button',
        'value' => 'true',
        'type' => 'check',
        'content' => 'Je m\'inscris'
    );
    echo '<div class="boutton">'.form_button($data).'</div>';
    echo form_close();
?>
