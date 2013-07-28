<section class="content">
    <div class="row-fluid ajouter_annonce">
        <h1>Publier une annonce</h1>
        <?php if(!$user_data){ ?>
            <p>pas connecter</p>
        <?php }
        else{?>
        <?php echo form_open('annonce/poster',array('method'=>'post')); ?>
        <?php if($error){
            echo'<div class="error"><p>Veuillez préciser '.$error.' du voyage</p></div>';
        }?>
        <div id="recherche" class="formulaire">
            <h2>Je suis </h2>
            <div class="clearfix row-fluid">
                <div class="span4">
                    <div class="choix_conducteur">
                        <div class="row-fluid clearfix">
                            <div class="span4"><span class="choix_conducteur0 ico-passager"></span></div>
                            <div class="span4"><span class="choix_conducteur1 ico-passager-conducteur"></span></div>
                            <div class="span4"><span class="choix_conducteur2 ico-conducteur"></span></div>
                        </div>
                        <input type="hidden" id="input_conducteur" name="input_conducteur" value="<?php echo isset($donnee['conducteur']) ? $donnee['conducteur'] : "1" ; ?>" />
                        <div id="slider_conducteur">
                        </div>
                    </div> 
                </div>
            </div>
            
            <div class="clearfix row-fluid">
                <div class="span6">
                    <h2>De</h2>
                    <div class="depart clearfix">
                        <label class="ico-depart"></label>
                        <div class="input">
                            <input type="text" class="champ" name="input_depart" id="input_depart" placeholder="ville de départ" <?php echo isset($donnee['depart']) ? 'value="'.$donnee['depart'].'"' : "" ; ?> />
                        </div>
                        <input id="input_departID" name="input_departID" type="hidden" <?php echo isset($donnee['departID']) ? 'value="'.$donnee['departID'].'"' : "" ; ?> />
                        <input id="input_depart_lat" name="input_depart_lat" type="hidden" <?php echo isset($donnee['depart_lat']) ? 'value="'.$donnee['depart_lat'].'"' : "" ; ?> />
                        <input id="input_depart_lng" name="input_depart_lng" type="hidden" <?php echo isset($donnee['depart_lng']) ? 'value="'.$donnee['depart_lng'].'"' : "" ; ?> />
                        <div class="description">
                            <label for="input_description_depart">Infos lieu rendez-vous</label>
                            <textarea id="input_description_depart" name="input_description_depart"><?php echo isset($donnee['description_depart']) ? $donnee['description_depart'] : "" ; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <h2>à</h2>
                    <div class="arrivee clearfix">
                        <label class="ico-arrivee"></label>
                        <div class="input">
                            <input type="text" class="champ" name="input_arrivee" id="input_arrivee" placeholder="ville d'arrivée" <?php echo isset($donnee['arrivee']) ? 'value="'.$donnee['arrivee'].'"' : "" ; ?>/>
                        </div>
                        <input id="input_arriveeID" name="input_arriveeID" type="hidden" <?php echo isset($donnee['arriveeID']) ? 'value="'.$donnee['arriveeID'].'"' : "" ; ?> />
                        <input id="input_arrivee_lat" name="input_arrivee_lat" type="hidden" <?php echo isset($donnee['arrivee_lat']) ? 'value="'.$donnee['arrivee_lat'].'"' : "" ; ?> />
                        <input id="input_arrivee_lng" name="input_arrivee_lng" type="hidden" <?php echo isset($donnee['arrivee_lng']) ? 'value="'.$donnee['arrivee_lng'].'"' : "" ; ?> />
                        <div class="description">
                            <label for="input_description_arrivee">Infos lieu arrivée</label>
                            <textarea id="input_description_arrivee" name="input_description_arrivee"><?php if(isset($donnee['description_arrivee'])){ echo $donnee['description_arrivee'];} ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="etapes clearfix">
                <h2>Etapes <span id="more_step" class="icon-plus-squared"></span></h2>
                <p>Rajoutez des étapes afin d'adapter votre parcours ou si vous faites des arrêts (<span class="nb_etape">1</span>/5)</p>
                <?php if(isset($donnee['etapes'])){
                    for($i=0;$i<count($donnee['etapes']);$i++){?>
                        <div class="etape">
                            <div class="clearfix etape_inputs">
                                <span class="icon-right-big"></span>
                                <input class="input_etape" name="input_etape_<?php echo $i ?>" type="text" value="<?php echo $donnee['etapes'][$i]['ville'] ?>" placeholder="ville étape" />
                                <input class="input_etapeID" name="input_etapeID_<?php echo $i ?>" type="hidden" value="<?php echo $donnee['etapes'][$i]['villeID'] ?>"/>
                                <input class="input_etape_lat" name="input_etape_lat_<?php echo $i ?>" type="hidden" value="<?php echo $donnee['etapes'][$i]['lat'] ?>" />
                                <input class="input_etape_lng" name="input_etape_lng_<?php echo $i ?>" type="hidden" value="<?php echo $donnee['etapes'][$i]['lng'] ?>" />
                                <span class="min_step icon-minus-squared"></span>
                            </div>
                            <div class="stop clearfix">
                                <label>S'y arreter ?<input class="input_stop" <?php echo $donnee['etapes'][$i]['stop'] ? 'checked="checked"' : "" ?>type="checkbox" name="input_stop_<?php echo $i ?>" value="1"/></label>
                                <label><input class="input_duree" type="text" name="input_duree_0" value="<?php echo $donnee['etapes'][$i]['duree'] ?>"/>min</label>
                            </div>
                        </div> 
                <?php }
                }
                else{ ?>
                <div class="etape">
                    <div class="clearfix etape_inputs">
                       <span class="icon-right-big"></span>
                        <input class="input_etape" name="input_etape_0" type="text" placeholder="ville étape" />
                        <input class="input_etapeID" name="input_etapeID_0" type="hidden" />
                        <input class="input_etape_lat" name="input_etape_lat_0" type="hidden" />
                        <input class="input_etape_lng" name="input_etape_lng_0" type="hidden" />
                        <span class="min_step icon-minus-squared"></span>
                    </div>
                    <div class="stop clearfix">
                       <label>S'y arreter ?<input class="input_stop" type="checkbox" name="input_stop_0" value="1"/></label>
                       <label><input class="input_duree" type="text" name="input_duree_0" />min</label>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="clearfix">    
                <div id="recalculer_trajet" class="btn clearfix">
                    <div class="bouton_contour bouton_gris">
                        <span class="button gris">
                            <span class="icon-arrows-cw"></span>
                            Recalculer le trajet
                        </span>
                    </div>
                </div>
            </div>
            <div class="row-fluid visible-desktop">
                <div class="span3">
                    <h2>Date</h2>
                </div>
                <div class="span3">
                    <h2>Fléxibilité</h2>
                </div>
                <div class="span3">
                    <h2>Heure</h2>
                </div>
                <div class="span3">
                    <h2>Places</h2>
                </div>
            </div>
            <div class="row-fluid date_heure clearfix">
                <div class="span6">
                    <div class="date clearfix">
                        <h2 class="hidden-desktop">Date</h2>
                        <label for="input_date"><span class="ico-date"></span></label>
                        <input id="input_date" <?php if(isset($donnee['date'])){echo 'value="'.$donnee['date'].'"';} ?> name="input_date" class="champ" type="date" placeholder="JJ/MM/AAAA" />
                    </div>
                    <div class="flexibilite clearfix">
                        <h2 class="hidden-desktop">Fléxibilité</h2>
                        <label><span class="ico-flexible"></span></label>
                        <div class="select_flexible">
                            <span>+/-</span>
                            <select name="input_flexibilite">
                                <?php for($i=0;$i<15;$i++){
                                    if($i == $donnee['flexibilite']){
                                        echo'<option selected="selected">'.$i.'</option>';
                                    }
                                    else{
                                        echo'<option>'.$i.'</option>';
                                    }
                                } ?>
                            </select>
                            <span>jour(s)</span>
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <div class="heure clearfix">
                        <h2 class="hidden-desktop">Heure</h2>
                        <label for="input_heure"><span class="ico-heure"></span></label>
                        <input id="input_heure" class="input_heure" <?php if(isset($donnee['heure'])){echo 'value="'.$donnee['heure'].'"'; } ?> type="text" value="" name="input_heure" placeholder="HH:MM" />
                    </div>
                    <div class="places clearfix">
                        <h2 class="hidden-desktop">Places</h2>
                        <label><span class="ico-place"></span></label>
                        <div class="select_place">
                            <select id="input_places" name="input_places">
                                <?php for($i=1;$i<8;$i++){
                                    if($donnee['places']){
                                        if($i == $donnee['places']){
                                            echo'<option selected="selected" value="'.$i.'">'.$i.'</option>';
                                        }
                                        else{
                                            echo'<option value="'.$i.'">'.$i.'</option>';
                                        }
                                    }
                                    else{
                                        if($i == $user_data->places){
                                            echo'<option selected="selected" value="'.$i.'">'.$i.'</option>';
                                        }
                                        else{
                                            echo'<option value="'.$i.'">'.$i.'</option>';
                                        }
                                    }
                                } ?>
                            </select>
                            <span>place(s)</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span6">
                    <div class="clearfix">
                        <div class="btn clearfix btn_check">
                            <label class="bouton_contour bouton_gris" for="input_retour">
                                <span class="button gris">
                                    <span class="icon-loop-alt-1"></span>
                                    Allée-retour
                                </span>
                            </label>
                            <input id="input_retour" class="hidden show_retour" type="checkbox" name="input_retour" value="1" <?php if($donnee['retour']){ echo 'checked="checked"';} ?>/>
                        </div>
                        <div class="btn clearfix btn_check">
                            <label class="bouton_contour bouton_gris" for="input_regulier">
                                <span class="button gris">
                                    <span class="icon-back-in-time"></span>
                                    Régulier
                                </span>
                            </label>
                            <input id="input_regulier" class="hidden show_calendar" type="checkbox" name="input_regulier" value="1" <?php if($donnee['regulier']){ echo 'checked="checked"';} ?>/>
                        </div>
                    </div>
                    <div class="clearfix row-fluid regulier calendar">
                        <table>
                            <thead>
                                <tr>
                                    <td></td>
                                    <td>Lu.</td>
                                    <td>Ma.</td>
                                    <td>Me.</td>
                                    <td>Je.</td>
                                    <td>Ve.</td>
                                    <td>Sa.</td>
                                    <td>Di.</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="table_allee">
                                    <td>Allée</td>
                                    <?php
                                    $day = array("l","m","me","j","v","s","d");
                                    if(isset($donnee['calendar']['0']->allee)){
                                        for($i=0;$i<7;$i++){
                                            echo '<td><input class="input_heure" value="'.$donnee['calendar']['0']->allee->$day[$i].'" id="input_allee'.$i.'" name="input_allee'.$i.'" placeholder="-" /></td>';
                                        }
                                    }
                                    else{                            
                                        for($i=0;$i<7;$i++){
                                            echo '<td><input class="input_heure" id="input_allee'.$i.'" name="input_allee'.$i.'" placeholder="-" /></td>';
                                        }
                                    }?>
                                </tr>
                                <tr class="table_retour">
                                    <td>Retour</td>
                                    <?php
                                    if(isset($donnee['calendar']['0']->retour)){
                                        for($i=0;$i<7;$i++){
                                            echo '<td><input class="input_heure" value="'.$donnee['calendar']['0']->retour->$day[$i].'" id="input_retour'.$i.'" name="input_retour'.$i.'" placeholder="-" /></td>';
                                        } 
                                    }
                                    else{
                                        for($i=0;$i<7;$i++){
                                            echo '<td><input class="input_heure" id="input_retour'.$i.'" name="input_retour'.$i.'" placeholder="-" /></td>';
                                        }
                                    }?>
                                </tr>
                            </tbody>
                        </table>                
                    </div>
                    <div class="commentaire">
                        <h2>Commentaire sur le trajet</h2>
                        <textarea id="input_commentaire" name="input_commentaire"><?php echo isset($donnee['commentaire']) ? $donnee['commentaire'] : "" ; ?></textarea>
                    </div>
                </div>
                <div class="span6">
                    <div class="calculateur">
                        <h2>Calculateur de prix par passager</h2>
                        <h3>Le prix sera calculer pour 3places minimum</h3>
                        <p>Consommation: <span><?php echo $user_data->consommation; ?></span> l/100km</p>
                        <label>Prix carburant :<input id="input_carbu" type="text" name="input_carbu" value="<?php echo isset($donnee['carbu']) ? $donnee['carbu'] : 1.5 ; ?>"/>€/L</label>
                        <p>Distance: <span id="distance">?</span> km</p>
                        <p>Durée: <span id="duree">?</span></p>
                        <p>Prix conseillé :<span id="prix"><?php echo isset($donnee['prix_conseil']) ? $donnee['prix_conseil'] : "Créez votre itinéaire" ; ?></span></p>
                        <p>Prix choisi :<input id="input_prix" type="text" name="input_prix" value="<?php echo isset($donnee['prix']) ? $donnee['prix'] : "0" ; ?>" />€</p>
                        
                        
                        <input id="input_consomme" type="hidden" name="input_consomme" value="<?php echo $user_data->consommation; ?>"/>
                        <input id="input_distance" type="hidden" name="input_distance" />
                        <input id="input_prix_conseil" type="hidden" name="input_prix_conseil" value="<?php echo isset($donnee['prix_conseil']) ? $donnee['prix_conseil'] : "" ; ?>" />
                        <div id="recalculer_prix" class="btn clearfix">
                            <div class="bouton_contour bouton_gris">
                                <span class="button gris">
                                    Recalculer le prix
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            
            
            <div>
                <input id="input_coord" type="text" name="input_coord" <?php echo isset($donnee['parcours']) ? 'value="'.$donnee['parcours'].'"' : "" ; ?>/>
            </div>
            
        </div>
	<?php $data = array(
            'name' => 'button',
            'id' => 'button',
            'value' => 'true',
            'type' => 'check',
            'content' => 'Publier'
        );
        echo '<div id="lancer_recherche"><div class="boutton">'.form_button($data).'</div></div>';?>				
        <?php echo form_close(); ?>
        <div class="row-fluid clearfix">
            <div class="span8">
                <div id="map"></div>
            </div>
            <div class="span4">
                <div id="way"></div>
            </div>
        </div>
        <?php } ?>
        
    </div>
    <script type="text/javascript">
        $( "#slider_conducteur" ).slider({
                value:$( "#input_conducteur" ).val(),
                min: 0,
                max: 2,
                step: 1,
                slide: function( event, ui ) {
                    var $oldvalue = $( "#input_conducteur" ).val();
                    $( "#input_conducteur" ).val(ui.value );
                    $(".choix_conducteur"+$oldvalue).removeClass('select');
                    $(".choix_conducteur"+ui.value).addClass('select');
                }
            });
        $("#input_date").datepicker({
                autoSize: true,
                minDate: 0,
                constrainInput: true
                },$.datepicker.regional[ "fr" ]
            );
        $('.input_heure').timepicker({
                minuteGrid: 10,
                currentText: 'Maintenant',
                closeText: 'Valider',
                amNames: ['AM', 'A'],
                pmNames: ['PM', 'P'],
                timeFormat: 'HH:mm',
                timeSuffix: '',
                timeOnlyTitle: 'Choissez l\'heure',
                timeText: 'Temps',
                hourText: 'Heure',
                minuteText: 'Minute',
                timezoneText: 'Time Zone'
            });
    </script>
    
</section>