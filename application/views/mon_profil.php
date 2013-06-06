<section id="col1">
    <h1>Mon profil</h1>
	<h3>Veuillez remplir votre profil</h3>
	<a  id="modif">modifier</a>
	
	<?php
            $data_input = array();
            $input_nom = array('id'=>'nom', 'name'=>'nom', 'type'=>'text', 'value'=>$info_membre->nom, 'class'=>'profil_input');
            $input_username = array('id'=>'username', 'name'=>'username', 'type'=>'text', 'value'=>$info_membre->username, 'class'=>'profil_input');
            $input_email = array('id'=>'email', 'name'=>'email', 'type'=>'email', 'value'=>$info_membre->email, 'class'=>'profil_input');
            $input_naissance = array('id'=>'naissance', 'name'=>'naissance', 'type'=>'date', 'value'=> date('d-m-Y',strtotime($info_membre->naissance)), 'class'=>'profil_input' );
            $input_fumeur = array('id'=>'fumeur','name'=>'fumeur','checked'=>$info_membre->fumeur,'value'=>1, 'class'=>'profil_input');
            $input_bagage = array('id'=>'bagage','name'=>'bagage','checked'=>$info_membre->bagage,'value'=>1, 'class'=>'profil_input');
            $input_musique = array('id'=>'musique','name'=>'musique','checked'=>$info_membre->musique,'value'=>1, 'class'=>'profil_input');
            $input_discussion = array('id'=>'discussion','name'=>'discussion','checked'=>$info_membre->discussion,'value'=>1, 'class'=>'profil_input');
            $input_vehicule = array('id'=>'vehicule','name'=>'vehicule','type'=>'text','value'=>$info_membre->vehicule, 'class'=>'profil_input');
            $input_immatriculation = array('id'=>'immatriculation','name'=>'immatriculation','type'=>'text','value'=>$info_membre->immatriculation,'class'=>'profil_input');
            $colorPicker = array('id'=>'colorPicker','name'=>'colorPicker','type'=>'text','value'=>$info_membre->couleur);
            $input_confort = array('name'=>'confort','type'=>'radio');
            
            $data_user_id = array('id'=>'user_id', 'name'=>'user_id', 'type'=>'hidden', 'value'=>$info_membre->user_id);
            $data_submit = array('id' => 'button', 'name' => 'button', 'type' => 'check', 'value' => 'true', 'content' => 'modifier mon profil');


            echo form_open_multipart('mon_profil/upload',array('method'=>'post'));
            if($info_membre->photo){
                    echo '<img src="'.base_url().$info_membre->photo.'" />';
            }
            else{
                    echo '<img src="'.base_url().'web/images/membre/default.jpg"/>';
            }
            echo form_label('photo','photo');
            echo form_upload('photo').'<br />';
            echo '<input type="submit" value="upload" />';
            echo form_close();

            echo form_open('mon_profil/modifier',array('method'=>'post'));
            echo form_label('Nom : <span>'.$info_membre->nom.'</span>','nom');
            echo form_input($input_nom)."<br />";
            echo form_label('Prénom : <span>'.$info_membre->username.'</span>','username');
            echo form_input($input_username)."<br />";
            echo form_label('Email : <span>'.$info_membre->email.'</span>','email');
            echo form_input($input_email)."<br />";
            echo form_label('Date de naissance : <span>'.$info_membre->naissance.'</span>','naissance');
            echo form_input($input_naissance);
            echo '<input type="button" onclick="displayDatePicker(\'naissance\');" value="select">'."<br />";
            echo form_label('Fumeur','fumeur');
            echo '<img src="'.base_url().'web/images/smoke'.$info_membre->fumeur.'.png" />';
            echo form_checkbox($input_fumeur)."<br />";
            echo form_label('Bagage','bagage');
            echo '<img src="'.base_url().'web/images/bag'.$info_membre->bagage.'.png" />';
            echo form_checkbox($input_bagage)."<br />";
            echo form_label('Musique','musique');
            echo '<img src="'.base_url().'web/images/mus'.$info_membre->musique.'.png" />';
            echo form_checkbox($input_musique)."<br />";
            echo form_label('Discussion','discussion');
            echo '<img src="'.base_url().'web/images/bla'.$info_membre->discussion.'.png" />';
            echo form_checkbox($input_discussion)."<br />";


            echo '<p>véhicule : <span>'.$info_membre->vehicule.'</span></p><br />';
            echo form_input($input_vehicule);
            echo '<p>immatriculation :<span>'.$info_membre->immatriculation.'</span></p><br />';
            echo form_input($input_immatriculation);
            echo '<p>couleur :'.'</p><br />';
            echo form_input($colorPicker);
            echo '<p>confort :'.'</p><br />';
            for($i=1;$i<6;$i++){
                if( $i != $info_membre->confort ){
                    echo form_input($input_confort,$i);
                }
                else{
                    echo form_input($input_confort,$i,"checked=checked");
                }
                
            }
            echo '<p>commentaire :'.'</p><br />';


            echo form_input($data_user_id);
            echo '<div id="modifier"><div class="boutton">'.form_button($data_submit).'</div></div>';
            echo form_close();
	?>
            <script>
                jQuery(document).ready(function($) {
                    $('#colorPicker').colorPicker({
                        pickerDefault: "ffffff", 
                        colors: ["000000","444444","999999","DDDDDD", "FFFFFF","940107",
                                "F80403","FF9707","FCFF00","AAFF00","03C403","016D00",
                                "009DA0","00BBFF","1262D1","003B7F","9400FF","D800B1"], 
                        transparency: true, 
                        showHexField: false
                    });
                });
            </script>
	</form>
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