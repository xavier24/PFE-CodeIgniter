<nav>
    <ul>
        <li class="current">
            <a href="<?php echo base_url(); ?>">
                <span class="visible-desktop">Rechercher</span>
                <span class="hidden-desktop nav_search"></span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url().'annonce/ajouter'; ?>" class="publier_annonce">
                <span class="visible-desktop">Ajouter<span class="add_trajet"> un trajet</span></span>
                <span class="hidden-desktop nav_add"></span>
            </a>
        </li>
        <li>
            <?php 
            echo (!$this->session->userdata('logged_in'))?  
                '<a href="'.base_url().'inscription">
                    <span class="visible-desktop">Inscription</span>
                    <span class="hidden-desktop nav_register"></span>
                </a>': 
                '<a href="'.base_url().'user/profil/'.$this->session->userdata('logged_in')->user_id.'">
                    <span class="visible-desktop">Mon profil</span>
                    <span class="hidden-desktop nav_register"></span>
                </a>' 
            ?>
        </li>
        <li>
            <a href="#">
                <span class="visible-desktop">Aide&nbsp;-&nbsp;FAQ</span>
                <span class="hidden-desktop nav_help"></span>
            </a>
        </li>
        <li class="nav_compte">
            <div class="degrade_compte clearfix">
                <span class="mon_compte slide_compte">Mon compte</span>
                
                
            
                <?php if($this->session->userdata('logged_in')){
                    if($user_data->photo != ""){
                        echo '<span class="nav_pict_user slide_compte"><img src="'.base_url().'web/images/membre/thumb/thumb_'.$user_data->photo.'" width="40" height="40"/></span>';
                    }
                    else{
                        echo '<span class="nav_pict_user slide_compte"><img src="'.base_url().'web/images/membre/thumb/thumb_default.jpg" width="40" height="40"/></span>';
                    }
                    echo form_open('user/deconnecter',array('method'=>'post'));
                    $data = array(
                        'class' => 'logout',
                        'value' => 'true',
                        'type' => 'check',
                        'content' => 'Déconnexion'
                    );
                    echo form_button($data);
                    echo form_close();                  
                }
                else{
                    echo '<span class="nav_user slide_compte"></span>
                        <span class="nav_facebook"></span>';
                }?>
            </div>
            <?php include('connexion.php');?>
        </li>
    </ul>
</nav>
