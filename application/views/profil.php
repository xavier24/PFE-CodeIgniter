<?php
    $input_nom = array('id'=>'nom', 'name'=>'nom', 'type'=>'text', 'value'=>$info_membre->nom, 'class'=>'profil_input');
    $input_email = array('id'=>'email', 'name'=>'email', 'type'=>'email', 'value'=>$info_membre->email, 'class'=>'profil_input');
    
    $data_user_id = array('id'=>'user_id', 'name'=>'user_id', 'type'=>'hidden', 'value'=>$info_membre->user_id);
    $data_submit = array('class' => 'button', 'type' => 'check', 'value' => 'true', 'content' => 'Enregister<span class="bouton_modif"></span>');
?>
<div class="content">
    <div class="row-fluid profil">
        <div class="span3 clearfix">
            <div class="photo">
            <?php
                if($info_membre->photo){
                    echo '<img src="'.base_url().'web/images/membre/'.$info_membre->photo.'" />';
                }
                else{
                    echo '<img src="'.base_url().'web/images/membre/default.jpg"/>';
                }
                if($user_connect){
                    echo '<div id="upload_photo">';
                    echo form_open_multipart('user/upload',array('method'=>'post'));
                    echo '<p><a class="edit_photo">Modifie ta photo...</a></p>';
                    echo form_upload('photo','fichier','id="photo" class="hidden"');
                    echo '<input type="submit" value="upload" class="hidden" />';
                    if($error['upload']){
                        echo '<p>erreur :'.$error['upload'].'</p>';
                    }
                    echo '</div>';
                    echo form_close();
                }
            ?>
            </div>
            <?php if(!$user_connect){ ?>
                <div class="btn_profil">
                    <div class="btn clearfix">
                        <span class="bouton_contour bouton_orange">
                            <span class="button orange"><span class="icon-star"></span>Ajouter aux favoris</span>
                        </span>
                    </div>
                    <div class="btn clearfix">
                        <span class="bouton_contour bouton_bleu">
                            <span class="button bleu"><span class="icon-mail-4"></span>Contacter le covoitureur</span>
                        </span>
                    </div>
                </div>
            <?php } ?>
            <div class="map visible-tablet">
                <img src="http://maps.googleapis.com/maps/api/staticmap?&zoom=8&size=150x150&maptype=roadmap&markers=color:blue%7C<?php echo $info_membre->latitude.','.$info_membre->longitude ;?>&sensor=false"/>
            </div>
            <div class="delais_reponse">
                <p>Taux de réponse : 98%</p>
                <p>Délais moyen de réponse : 2jours</p>  
            </div>
        </div>
        <div class="span9">
            <div class="row-fluid info_profil">
                <div class="span8">
                    <?php if($user_connect){ ?>
                    <?php echo form_open('user/modifier',array('method'=>'post')); ?>
                        <div class="edit_button clearfix">
                            <p class="edit"><span>Modifier</span><span class="icon_modifier"></span></p>
                            <div class="modifier profil_modif">
                                <?php echo form_button($data_submit) ?>
                            </div>  
                        </div>    
                        <h2 class="identite <?php echo $info_membre->sexe? 'rose': 'bleu' ?>">
                            <span class="edit_hidden <?php echo $info_membre->sexe? 'icon-female': 'icon-male' ?>"></span>
                            <label class="profil_modif bleu icon-male"><input type="radio" name="sexe" value="0" <?php if(!$info_membre->sexe){echo 'checked';}?> /></label>
                            <label class="profil_modif rose icon-female"><input type="radio" name="sexe" value="1" <?php if($info_membre->sexe){echo 'checked';}?> /></label>
                            
                            <span class="edit_hidden"><?php echo $info_membre->username ?></span>
                            <input type="text" id="input_username" class="profil_modif" name="input_username" value="<?php echo $info_membre->username ?>" />
                        </h2>
                        <div class="naissance">
                            <span class="age">(<?php echo $info_membre->age ?>ans)</span>
                            <input id="input_naissance" name="input_naissance" class="profil_modif" type="date" value="<?php echo $info_membre->naissance?>"/>    
                            <label for="input_naissance" class="profil_modif"><span class="icone-datepicker"></span><span class="hidden">Modifier votre date de naissance</span></label>
                        </div>
                        <div class="habite">
                            <label for="ville">J'habite à <span class="edit_hidden ville_habite"><?php echo $info_membre->ville ?></span></label>
                            <input id="input_ville" name="input_ville" type="text" class="profil_modif" value="<?php echo $info_membre->ville ?>" />
                            <input id="input_villeID" name="input_villeID" type="hidden" />
                        </div>
                        <div class="langue_parle">
                        <?php 
                            $codeLang = array('fr','nl','en','de','es','autre_lang');
                            $choixLang = array('Français','Neerlandais','Anglais','Allemand','Espagnol','Autre...');
                            $afficheLang = array('Français','Neerlandais','Anglais','Allemand','Espagnol',$info_membre->autre_lang);
                            $lang2 = 0;
                        ?>    
                            <p>Je parle 
                                <span class="langue edit_hidden">
                                <?php for($i=0;$i<count($codeLang);$i++){
                                    if($info_membre->$codeLang[$i]){
                                        
                                        if($lang2){
                                            echo', ';
                                        }
                                        echo $afficheLang[$i];
                                        $lang2 += 1;
                                    }
                                }?>
                                </span>
                            </p>
                            <div class="choix_lang clearfix profil_modif">
                                <input type="hidden" id="form_lang" name="form_lang" value="1"/>
                                <?php for($i=0;$i<count($codeLang);$i++){
                                    if($info_membre->$codeLang[$i]){
                                        echo '<label><input id="lang_'.$codeLang[$i].'" type="checkbox" checked="checked" name="input_'.$codeLang[$i].'" value="1"> '.$choixLang[$i].'</label>';
                                    }
                                    else{
                                        echo '<label><input id="lang_'.$codeLang[$i].'" type="checkbox" name="input_'.$codeLang[$i].'" value="1"> '.$choixLang[$i].'</label>';
                                    }
                                } ?>
                                <textarea id="input_autre_lang" name="autre_lang" class=""><?php echo $info_membre->autre_lang ?></textarea>
                            </div>
                        </div>
                        <p>J'ai <span class="orange"><?php echo $info_membre->voyage ?></span> voyage(s) à mon actif</p>
                        <div class="date_inscription">
                            <p>Inscription le <?php echo $info_membre->created_at ?></p>
                            <p>Dernière visite le <?php echo $info_membre->connected_at ?></p>
                        </div>
                    </form>
                    <?php echo form_open('user/modifier',array('method'=>'post')); ?>
                        <div class="edit_button clearfix">
                            <p class="edit"><span>Modifier</span><span class="icon_modifier"></span></p>
                            <div class="modifier profil_modif">
                                <?php echo form_button($data_submit) ?>
                            </div>  
                        </div>    
                        <div class="bulle_texte">
                            <p class="edit_hidden">
                            <?php if($info_membre->description != ""){ 
                                echo $info_membre->description;
                            }
                            else{
                                echo 'Parlez un peu de vous...' ; 
                            } ?>
                            </p>
                            <textarea id="input_description" name="input_description" class="profil_modif"><?php echo $info_membre->description ?></textarea>
                        </div>
                    </form>
                     <?php }
                    else{?>
                        <h2 class="identite <?php echo $info_membre->sexe? 'rose': 'bleu' ?>">
                            <span class="<?php echo $info_membre->sexe? 'icon-female': 'icon-male' ?>"></span>
                            <?php echo $info_membre->username ? $info_membre->username : 'Anonyme' ; ?>
                        </h2>
                        <div class="naissance">
                            <span class="age">(<?php echo $info_membre->age ?>ans)</span>
                        </div>
                        <div>
                        <?php 
                         $codeLang = array('fr','nl','en','de','es','autre_lang');
                         $choixLang = array('Français','Neerlandais','Anglais','Allemand','Espagnol','Autre...');
                         $afficheLang = array('Français','Neerlandais','Anglais','Allemand','Espagnol',$info_membre->autre_lang);
                         $lang2 = 0;
                        ?>    
                            <?php if(!$info_membre->sexe){
                                echo '<p class="habite">Il habite à <span class="ville_habite">'.$info_membre->ville.'</span> ('.$info_membre->province.'- '.$info_membre->pays.')</p>';
                                echo '<div class="langue_parle">';
                                echo '<p>Il parle ';
                                echo '<span class="langue">';
                                for($i=0;$i<count($codeLang);$i++){
                                    if($info_membre->$codeLang[$i]){
                                        if($lang2){
                                            echo', ';
                                        }
                                        echo $afficheLang[$i];
                                        $lang2 += 1;
                                    }
                                }
                                echo '</span></p></div>';
                                echo '<p>Il a <span class="orange">'.$info_membre->voyage.'</span> voyage(s) à son actif</p>';
                           }
                           else{
                               echo '<p>Elle habite à '.$info_membre->ville.' ('.$info_membre->province.'- '.$info_membre->pays.')</p>';
                               echo '<p>Elle parle </p>';
                               echo '<p>Elle a <span class="orange">'.$info_membre->voyage.'</span> voyage(s) à son actif</p>';
                           } ?>
                        </div>
                        <div class="date_inscription">
                           <p>Inscription le <?php echo $info_membre->created_at ?></p>
                           <p>Dernière visite le <?php echo $info_membre->connected_at ?></p>
                        </div>
                        <div class="bulle_texte">
                        <?php if($info_membre->description != ""){ ?>
                            <p><?php echo $info_membre->description; ?></p>
                        <?php }
                        else{ ?>
                            <p>...</p>
                        <?php } ?>
                        </div>
                  <?php }
                  ?>
                </div>
                <div class="span4">
                    <div class="map visible-desktop">
                        <img src="http://maps.googleapis.com/maps/api/staticmap?&zoom=8&size=250x250&maptype=roadmap&markers=color:blue%7C<?php echo $info_membre->latitude.','.$info_membre->longitude ;?>&sensor=false"/>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span8 clearfix">
                    <div class="preferences clearfix">
                        <?php if($user_connect){ ?>
                        <?php echo form_open('user/modifier',array('method'=>'post','class'=>'clearfix')); ?>    
                            <div class="edit_button clearfix">
                                <p class="edit"><span>Modifier</span><span class="icon_modifier"></span></p>
                                <div class="modifier profil_modif">
                                    <?php echo form_button($data_submit) ?>
                                </div>  
                            </div>
                            <h3>Préférences</h3> 
                            <div class="clearfix">     
                                <div id="fumeur" class="preference">
                                    <label class="pref_fumeur<?php echo $info_membre->fumeur ?>"></label>
                                    <input type="hidden" id="input_fumeur" name="input_fumeur" />
                                    <div id="slider_fumeur" class="pref_slider profil_modif">
                                        <div class="slider_top"></div>
                                        <div class="slider_bottom"></div>
                                    </div>
                                </div>
                                <div id="bagage" class="preference">
                                    <label class="pref_bagage<?php echo $info_membre->bagage ?>"></label>
                                    <input type="hidden" id="input_bagage" name="input_bagage" />
                                    <div id="slider_bagage" class="pref_slider profil_modif">
                                        <div class="slider_top"></div>
                                        <div class="slider_bottom"></div>
                                    </div>
                                </div>
                                <div id="musique" class="preference">
                                    <label class="pref_musique<?php echo $info_membre->musique ?>"></label>
                                    <input type="hidden" id="input_musique" name="input_musique" />
                                    <div id="slider_musique" class="pref_slider profil_modif">
                                        <div class="slider_top"></div>
                                        <div class="slider_bottom"></div>
                                    </div>
                                </div>
                                <div id="discussion" class="preference">
                                    <label class="pref_discussion<?php echo $info_membre->discussion ?>"></label>
                                    <input type="hidden" id="input_discussion" name="input_discussion" />
                                    <div id="slider_discussion" class="pref_slider profil_modif">
                                        <div class="slider_top"></div>
                                        <div class="slider_bottom"></div>
                                    </div>
                                </div>   
                                <div id="animaux" class="preference">
                                    <label class="pref_animaux<?php echo $info_membre->animaux ?>"></label>
                                    <input type="hidden" id="input_animaux" name="input_animaux" />
                                    <div id="slider_animaux" class="pref_slider profil_modif">
                                        <div class="slider_top"></div>
                                        <div class="slider_bottom"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <script>
                            $(function() {
                                var preferences = ['fumeur','bagage','musique','discussion','animaux'];
                                var pref_values = [
                                    '<?php echo $info_membre->fumeur ?>',
                                    '<?php echo $info_membre->bagage ?>',
                                    '<?php echo $info_membre->musique ?>',
                                    '<?php echo $info_membre->discussion ?>',
                                    '<?php echo $info_membre->animaux ?>'
                                ];
                                for( var i=0; i<preferences.length ;i++){
                                    $( "#slider_"+preferences[i] ).slider({
                                        value:pref_values[i],
                                        min: 0,
                                        max: 2,
                                        step: 1,
                                        orientation:"vertical",
                                        slide: function( event, ui ) {
                                            var this_id = $(this).parent().attr('id');
                                            var $oldvalue = $( "#input_"+this_id ).val();
                                            $( "#input_"+this_id ).val(ui.value );
                                            $("label[class*='pref_"+this_id+"']").removeClass('pref_'+this_id+ $oldvalue).addClass('pref_'+this_id+ui.value);
                                        }
                                    });
                                    $( "#input_"+preferences[i] ).val($( "#slider_"+preferences[i] ).slider( "value" ) );
                                }
                            });
                        </script>
                        <?php }
                        else{ ?>
                            <h3>Préférences</h3> 
                            <p class="preference clearfix">
                                <span class="pref_fumeur<?php echo $info_membre->fumeur ?>"></span>
                                <span class="pref_musique<?php echo $info_membre->musique ?>"></span>
                                <span class="pref_bagage<?php echo $info_membre->bagage ?>"></span>
                                <span class="pref_discussion<?php echo $info_membre->discussion ?>"></span>
                                <span class="pref_animaux<?php echo $info_membre->animaux ?>"></span>
                            </p>
                        <?php } ?>
                    </div>
                    <div class="clearfix">
                    <?php if($user_connect){ ?>
                        <?php echo form_open('user/modifier',array('method'=>'post','class'=>'clearfix')); ?>
                            <div class="edit_button clearfix">
                                <p class="edit"><span>Modifier</span><span class="icon_modifier"></span></p>
                                <div class="modifier profil_modif">
                                    <?php echo form_button($data_submit) ?>
                                </div>  
                            </div>
                            <h3>Véhicule</h3>
                            <div class="vehicule">
                                <div class="couleur_vehicule" >
                                    <div class="img_vehicule" style="background-color:<?php echo $info_membre->couleur ?>"></div>
                                    <input id="colorPicker" name="colorPicker" type="text" value="<?php echo $info_membre->couleur; ?>" />
                                </div>
                                <p class="immatriculation edit_hidden clearfix"><span><?php echo $info_membre->immatriculation ?></span></p>
                                <div class="immatriculation">
                                    <input class="profil_modif" name="input_immatriculation" type="text" value="<?php echo $info_membre->immatriculation ?>" />
                                </div>
                            </div>
                            <div class="info_vehicule">
                                <p class="marque edit_hidden"><?php echo $info_membre->vehicule ? $info_membre->vehicule : 'inconnu'; ?></p>
                                <input class="marque profil_modif" name="input_vehicule" type="text" value="<?php echo $info_membre->vehicule; ?>" />
                                <div class="consommation">
                                    <p class="edit_hidden"><span class="icon-fuel"></span> <?php echo $info_membre->consommation ? $info_membre->consommation : '?'; ?>litres/100km</p>
                                    <label class="profil_modif icon-fuel">
                                        <select name="input_consommation">
                                            <?php for($i=0;$i<21;$i++){
                                                echo '<option value="'.$i.'">'.$i.'</option>';
                                            } ?>
                                        </select>    
                                    litres/100km
                                    </label>
                                </div>
                                <div class="confort">
                                <span>Confort&nbsp;:</span>
                                <?php
                                for($i=1;$i<6;$i++){
                                    if( $i < $info_membre->confort ){
                                        echo '<label class="label_confort icon-star-1" for="confort'.$i.'"></label>';
                                        echo '<input class="profil_modif" id="confort'.$i.'" name="input_confort" type="radio" value="'.$i.'"/>';
                                    }
                                    else if($i == $info_membre->confort){
                                        echo '<label class="label_confort icon-star-1" for="confort'.$i.'"></label>';
                                        echo '<input class="profil_modif" id="confort'.$i.'" checked="checked" name="input_confort" type="radio" value="'.$i.'"/>';
                                    }
                                    else{
                                        echo '<label class="label_confort icon-star-empty-1" for="confort'.$i.'"></label>';
                                        echo '<input class="profil_modif" id="confort'.$i.'" name="input_confort" type="radio" value="'.$i.'"/>';
                                    }
                                }?>
                                </p>
                                </div>
                            </div>
                            <div class="commentaire_vehicule">
                            <?php if($info_membre->commentaire){
                                echo '<p class="edit_hidden">'.$info_membre->commentaire.'</p>';
                            }
                            else{
                                echo '<p class="edit_hidden">Précisions supplémentaires...</p>';
                            }
                            ?>
                                <textarea class="profil_modif"><?php echo $info_membre->commentaire; ?></textarea>
                            </div>
                        </form>
                    <?php }
                    else{ ?>
                        <h3>Véhicule</h3>
                        <div class="vehicule">
                            <div class="couleur_vehicule" >
                                <div class="img_vehicule" style="background-color:<?php echo $info_membre->couleur ?>"></div>
                            </div>
                            <p class="immatriculation clearfix"><span><?php echo $info_membre->immatriculation ?></span></p>
                        </div>
                        <div class="info_vehicule">
                            <p class="marque"><?php echo $info_membre->vehicule ?></p>
                            <p class="consommation"><span class="icon-fuel"></span> <?php echo '10' ?>litres/100km</p>
                            <p class="confort">Confort&nbsp;:
                            <?php
                            for($i=1;$i<6;$i++){
                                if( $i <= $info_membre->confort ){
                                    echo '<span class="icon-star-1"></span>';                                    
                                }
                                else{
                                    echo '<span class="icon-star-empty-1"></span>';
                                }
                            }?>
                            </p>
                        </div>
                        <div class="commentaire_vehicule">
                            <p><?php echo $info_membre->commentaire ?></p>
                        </div>
                    <?php } ?>
                    </div>
                </div>
                
                <div class="span4">
                    <h3>Ses prochains trajets<span class="icon-address"></span></h3>
                    <div class="annonces">
                        <?php 
                        if($annonces){
                            //var_dump($annonces);
                            foreach($annonces as $annonce): ?>
                                <div class="annonce">
                                    <h4>
                                        <a class="bleu" href="<?php echo base_url().'annonce/voir/'.$annonce->id ?>">
                                            <span class="annonce_date"><?php echo $annonce->date ?></span>
                                            <span class="annonce_heure"><?php echo $annonce->heure ?><span class="heure_estime">&nbsp;(heure&nbsp;estimée)</span></span>
                                        </a>
                                    </h4>
                                    <p class="destination"><span class="ville"><?php echo $annonce->ville_depart.'</span><span class="icon-right-thin"> </span><span class="ville">'.$annonce->ville_arrivee ?></span></p>
                                    <p class="places"><?php echo $annonce->places ?> place(s) disponible(s)</p>
                                </div>
                            <?php endforeach; 
                        }
                        else{
                            echo '<p>Aucun trajet n\'est à venir pour le moment.</p>';
                        }
                        ?>
                        <p><?php echo anchor( 'accueil/lister',$this->lang->line('retour_liste_annonces'),array('title'=>'Retour à la liste des annonces', 'hreflang'=>'fr' )); ?></p>    
                
                    </div>
                </div>
                <script type="text/javascript">
                    jQuery(document).ready(function($) {
                        $('#colorPicker').colorPicker({
                            pickerDefault: "ffffff", 
                            colors: ["000000","444444","999999","DDDDDD", "FFFFFF","D3BD8C", "940107",
                                    "F80403","FF9707","FCFF00","AAFF00","03C403","016D00",
                                    "009DA0","00BBFF","1262D1","003B7F","9400FF","D800B1"], 
                            transparency: true, 
                            showHexField: false
                        });
                    });
                </script>
                <script type="text/javascript">
                    var villes =[
                     <?php 
                     foreach ($villes as $ville) : 
                         echo '{"label":"'.$ville->fr_FR.' ('.$ville->code_postal.')'.'", "id":'.$ville->id.'},';
                     endforeach; ?>
                     ];

                    $("#input_naissance").datepicker({
                                        autoSize: false,
                                        maxDate: "-18Y",
                                        constrainInput: true, 
                                        changeMonth: true,
                                        changeYear: true
                                        },$.datepicker.regional[ "fr" ]
                                    );
                                    
                    var accentMap = {
                        "á": "a",
                        "é": "e",
                        "è": "e",
                        "ê": "e",
                        "ë": "e",
                        "ï": "i",
                        "î": "i",
                        "ö": "o",
                        "ô": "o",
                        "û": "u",
                        "ü": "u"
                    };
                    var normalize = function( term ) {
                        var ret = "";
                        for ( var i = 0; i < term.length; i++ ) {
                            ret += accentMap[ term.charAt(i) ] || term.charAt(i);
                        }
                        return ret;
                    };
                    $( "#input_ville" ).autocomplete({
                        source: function( request, response ) {
                            var matcher = new RegExp( $.ui.autocomplete.escapeRegex( request.term ), "i" );
                            response( $.grep( villes, function( value ) {
                                value = value.label || value.value || value;
                                return matcher.test( value ) || matcher.test( normalize( value ) );
                            }) );
                        },
                        select: function (event, ui) { $('#input_villeID').val(ui.item.id); }
                    }); 
                </script>
            </div>
        </div>
    </div>
</div>