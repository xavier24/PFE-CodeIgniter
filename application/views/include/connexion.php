<!-- PAS CONNECTE -->
<?php if(!$this->session->userdata('logged_in') && !get_cookie('logged_in')){
        echo form_open('user/login',array('method'=>'post','class'=>'connex','id'=>'login_form'));
            echo '<div class="slideBlock">';
                echo form_fieldset();

                    $attributes_email = array('class' => 'icon-user');
                    $emailInput = array('name'=>'email','id'=>'email','type'=>'email','placeholder'=>'E-mail');
                    $attributes_mdp = array('class' => 'icon-lock');
                    $mdpInput = array('name'=>'mdp','id'=>'mdp','placeholder'=>lang('password'));
                    echo form_label(lang('email'),'email',$attributes_email);
                    echo form_input($emailInput);
                    echo form_label(lang('password'),'mdp',$attributes_mdp);
                    echo form_password($mdpInput);
                    echo '<input id="current_url" name="current_url" type="hidden" value="'.current_url().'"/>';
                echo form_fieldset_close();
                if($message['error_login']!=""){
                    echo '<p class="erreur_inscription">'.$message['error_login'].'</p>';
                }                
                echo '<div class="souvenir_moi">';
                    $input_souvenir = array('name'=>'souvenir', 'id'=>'souvenir', 'value'=>true);
                    echo form_checkbox($input_souvenir);
                    echo form_label(lang('souvenir_moi'),'souvenir');
                echo '</div>';

                $data = array(
                        'name' => 'button',
                        'id' => 'button',
                        'class' => 'orange',
                        'value' => 'true',
                        'type' => 'submit',
                        'content' => lang('connexion')
                );
                echo '<div class="btn clearfix">
                        <span class="bouton_contour bouton_orange">'
                            .form_button($data).
                        '</span>
                      </div>';
                echo '<p><a href="'.base_url().'redefinition">'.lang("mdp_oublie").'&nbsp;?</a> / <a href="'.base_url().'inscription">'.lang("pas_inscrit").'&nbsp;?</a></p>';
            echo '</div>';
        echo form_close();
}

// <!-- CONNECTE -->
else{
    echo '<div class="connex">
            <div class="slideBlock">
                <p>Bonjour '.$user_data->username.'</p>
                <p>demande(s) en attente</p>
                <p>trajet(s) vous interesse(ent)</p>
            </div>
          </div>';
} ?>