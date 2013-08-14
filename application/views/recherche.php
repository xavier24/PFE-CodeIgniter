<section class="content">
    <div class="row-fluid resultat">
        <h1><?php echo $titre ?></h1>
        <?php echo form_open('accueil/recherche',array('method'=>'post', 'class'=>'clearfix')); ?>
        <?php if(isset($error)){
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
                <div class="span3">
                    <h2>De</h2>
                    <div class="depart clearfix">
                        <label class="ico-depart"></label>
                        <div class="input">
                            <input type="text" class="champ" name="input_depart" id="input_depart" placeholder="ville de départ" <?php echo isset($donnee['depart']) ? 'value="'.$donnee['depart'].'"' : "" ; ?> />
                        </div>
                        <?php if(isset($message['error_search']['departID'])){ ?>
                        <p class="erreur">Veuillez spécifier la ville de depart</p>
                        <?php } ?>
                        <input id="input_departID" name="input_departID" type="hidden" <?php echo isset($donnee['departID']) ? 'value="'.$donnee['departID'].'"' : "" ; ?> />
                        <input id="input_depart_lat" name="input_depart_lat" type="hidden" <?php echo isset($donnee['depart_lat']) ? 'value="'.$donnee['depart_lat'].'"' : "" ; ?> />
                        <input id="input_depart_lng" name="input_depart_lng" type="hidden" <?php echo isset($donnee['depart_lng']) ? 'value="'.$donnee['depart_lng'].'"' : "" ; ?> />
                    </div>
                </div>
                <div class="span3">
                    <h2>à</h2>
                    <div class="arrivee clearfix">
                        <label class="ico-arrivee"></label>
                        <div class="input">
                            <input type="text" class="champ" name="input_arrivee" id="input_arrivee" placeholder="ville d'arrivée" <?php echo isset($donnee['arrivee']) ? 'value="'.$donnee['arrivee'].'"' : "" ; ?>/>
                        </div>
                        <?php if(isset($message['error_search']['arriveeID'])){ ?>
                        <p class="erreur">Veuillez spécifier la ville d'arrivée</p>
                        <?php } ?>
                        <input id="input_arriveeID" name="input_arriveeID" type="hidden" <?php echo isset($donnee['arriveeID']) ? 'value="'.$donnee['arriveeID'].'"' : "" ; ?> />
                        <input id="input_arrivee_lat" name="input_arrivee_lat" type="hidden" <?php echo isset($donnee['arrivee_lat']) ? 'value="'.$donnee['arrivee_lat'].'"' : "" ; ?> />
                        <input id="input_arrivee_lng" name="input_arrivee_lng" type="hidden" <?php echo isset($donnee['arrivee_lng']) ? 'value="'.$donnee['arrivee_lng'].'"' : "" ; ?> />
                    </div>
                </div>
                <div class="span3">
                    <div class="date clearfix">
                        <h2 class=>Date</h2>
                        <label for="input_date" class="ico-date"></label>
                        <div class="input">
                            <input id="input_date" <?php if(isset($donnee['date'])){echo 'value="'.$donnee['date'].'"';} ?> name="input_date" class="champ" type="date" placeholder="JJ/MM/AAAA" />
                        </div>
                    </div>
                </div>
                <div class="span3">
                    <div class="clearfix">
                        <div class="flexibilite clearfix">
                            <h2>Fléxibilité</h2>
                            <div class="select_flexible">
                                <span>+/- </span>
                                <select name="input_flexibilite">
                                    <?php for($i=0;$i<15;$i++){
                                        if($donnee['flexibilite']==$i){
                                            echo'<option value="'.$i.'" selected="selected">'.$i.'</option>';
                                        }
                                        else{
                                           echo'<option value="'.$i.'">'.$i.'</option>'; 
                                        }
                                        
                                    } ?>
                                </select>
                                <span> jours</span>
                            </div>
                        </div>
                        <div class="btn clearfix btn_check">
                            <label class="bouton_contour bouton_gris" for="input_retour">
                                <span class="button gris">
                                    <span class="icon-loop-alt-1"></span>
                                    Allée-retour
                                </span>
                            </label>
                            <input id="input_retour" class="hidden show_retour" type="checkbox" name="input_retour" value="1" <?php if(isset($donnee['retour'])){if($donnee['retour']){ echo 'checked="checked"';}} ?>/>
                        </div>
                        <div class="btn clearfix btn_check">
                            <label class="bouton_contour bouton_gris" for="input_regulier">
                                <span class="button gris">
                                    <span class="icon-back-in-time"></span>
                                    Régulier
                                </span>
                            </label>
                            <input id="input_regulier" class="hidden show_calendar" type="checkbox" name="input_regulier" value="1" <?php if(isset($donnee['regulier'])){if($donnee['regulier']){ echo 'checked="checked"';}} ?>/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	<div id="rechercher" class="btn clearfix">
            <div class="bouton_contour bouton_orange">
                <button type="submit" value="true" class="button orange">
                    Rechercher
                </button>
            </div>
        </div>
        </form>
        <div class="row-fluid">
            <h3><?php echo $soustitre ?> <span class="nb_result"><?php echo $total_annonce ?> résultats</span></h3> 
            <?php if($annonces || $rayons || $parcours){    
                if($annonces){
                   echo '<div class="exact">';
                   foreach($annonces as $annonce): ?>
                       <div class="annonce clearfix">
                           <div class="photo" >
                               <img src="<?php echo base_url().'web/images/membre/thumb/thumb_'; echo $annonce->photo ? $annonce->photo : 'default.jpg' ?>"/>                            
                               <span><?php echo $annonce->conducteur ?></span>
                           </div>
                           <div class="detail">
                               <p class="destination">
                                   <a class="bleu" href="<?php echo base_url().'annonce/fiche/'.$annonce->id ?>">
                                       <span class="ville"><?php echo $annonce->$ville_depart_lang ? $annonce->$ville_depart_lang : $annonce->ville_depart_fr ?></span>
                                       <span class="icon-right-thin"></span>
                                       <span class="ville"><?php echo $annonce->$ville_arrivee_lang ? $annonce->$ville_arrivee_lang : $annonce->ville_arrivee_fr ?></span>
                                   </a>
                               </p>
                               <p class="horaire">
                                   <span class="annonce_date"><?php echo $annonce->date ?></span>
                                    à 
                                   <span class="annonce_heure"><?php echo $annonce->heure ?></span>
                               </p>
                               <p class="places"><?php echo $annonce->places ?> pl. disponibles</p>
                           </div>
                           <div class="prix tooltip" title="Trouvez les trajets au meilleur prix.">
                               <p class="<?php echo $annonce->bestprice ? "orange" : "vert" ?>"><?php echo $annonce->prix ?>€</p>
                           </div>
                           <div class="voir_annonce btn clearfix">
                               <div class="bouton_contour bouton_orange">
                                   <a href="<?php echo base_url().'annonce/fiche/'.$annonce->id ?>">
                                       <span type="submit" value="true" class="button orange">
                                           Voir l'annonce
                                       </span>
                                   </a>
                               </div>
                           </div>
                       </div>
                   <?php endforeach;
                   echo '</div>';
                }
                if($rayons){
                    echo '<div class="rayons">';
                    echo '<h3>Dans un rayon de 25km</h3>';
                    //var_dump($annonces);
                    foreach($rayons as $annonce): ?>
                        <div class="annonce clearfix">
                            <div class="photo" >
                                <img src="<?php echo base_url().'web/images/membre/thumb/thumb_'; echo $annonce->photo ? $annonce->photo : 'default.jpg' ?>"/>                            
                                <span><?php echo $annonce->conducteur ?></span>
                            </div>
                            <div class="detail">
                                <p class="destination">
                                    <a class="bleu" href="<?php echo base_url().'annonce/fiche/'.$annonce->id ?>">
                                        <span class="ville"><?php echo $annonce->$ville_depart_lang ? $annonce->$ville_depart_lang : $annonce->ville_depart_fr ?></span>
                                        <span class="icon-right-thin"></span>
                                        <span class="ville"><?php echo $annonce->$ville_arrivee_lang ? $annonce->$ville_arrivee_lang : $annonce->ville_arrivee_fr ?></span>
                                    </a>
                                </p>
                                <p class="horaire">
                                    <span class="annonce_date"><?php echo $annonce->date ?></span>
                                     à 
                                    <span class="annonce_heure"><?php echo $annonce->heure ?></span>
                                </p>
                                <p class="places"><?php echo $annonce->places ?> pl. disponibles</p>
                            </div>
                            <div class="prix tooltip" title="Trouvez les trajets au meilleur prix.">
                                <p class="<?php echo $annonce->bestprice ? "orange" : "vert" ?>"><?php echo $annonce->prix ?>€</p>
                            </div>
                            <div class="voir_annonce btn clearfix">
                                <div class="bouton_contour bouton_orange">
                                    <a href="<?php echo base_url().'annonce/fiche/'.$annonce->id ?>">
                                        <span type="submit" value="true" class="button orange">
                                            Voir l'annonce
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;
                    echo '</div>';
                }?>
                <?php if($parcours){ ?>
                <div class="parcours">
                    <h3>Passe par chez vous</h3>
                    <?php foreach($parcours as $annonce): ?>
                        <div class="annonce clearfix">
                            <div class="photo" >
                                <img src="<?php echo base_url().'web/images/membre/thumb/thumb_'; echo $annonce->photo ? $annonce->photo : 'default.jpg' ?>"/>                            
                                <span><?php echo $annonce->conducteur ?></span>
                            </div>
                            <div class="detail">
                                <p class="destination">
                                    <a class="bleu" href="<?php echo base_url().'annonce/fiche/'.$annonce->id ?>">
                                        <span class="ville"><?php echo $annonce->$ville_depart_lang ? $annonce->$ville_depart_lang : $annonce->ville_depart_fr ?></span>
                                        <span class="icon-right-thin"></span>
                                        <span class="ville"><?php echo $annonce->$ville_arrivee_lang ? $annonce->$ville_arrivee_lang : $annonce->ville_arrivee_fr ?></span>
                                    </a>
                                </p>
                                <p class="horaire">
                                    <span class="annonce_date"><?php echo $annonce->date ?></span>
                                     à 
                                    <span class="annonce_heure"><?php echo $annonce->heure ?></span>
                                </p>
                                <p class="places"><?php echo $annonce->places ?> pl. disponibles</p>
                            </div>
                            <div class="prix tooltip" title="Trouvez les trajets au meilleur prix.">
                                <p class="<?php echo $annonce->bestprice ? "orange" : "vert" ?>"><?php echo $annonce->prix ?>€</p>
                            </div>
                            <div class="voir_annonce btn clearfix">
                                <div class="bouton_contour bouton_orange">
                                    <a href="<?php echo base_url().'annonce/fiche/'.$annonce->id ?>">
                                        <span type="submit" value="true" class="button orange">
                                            Voir l'annonce
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;
                echo '</div>';    
                }
            }
            else{
                echo '<p>Aucun trajet ne correspont à votre recherche.</p>';
            }?>
            
            <?php if(isset($pagination)){
                echo '<div class="pagination">'.$pagination.'</div>';
            }?>
        </div>
</section>
<script type="text/javascript">
    $(function(){
        $(".tooltip").tooltip({
            position: {
                my: "center bottom+75",
                at: "center top",
                using: function( position, feedback ) {
                    $( this ).css( position );
                    $( "<div>" )
                    .addClass( "arrow" )
                    .addClass( feedback.vertical )
                    .addClass( feedback.horizontal )
                    .appendTo( this );
                }
            }
        });

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
                },$.datepicker.setDefaults($.datepicker.regional["<?php echo $lang ?>"])
            );
    });
</script>
<script type="text/javascript">
    $(function(){
        var villes = <?php echo $villes; ?>;
        var accentMap = {"á": "a", "é": "e", "è": "e", "ê": "e", "ë": "e", "ï": "i", "î": "i", "ö": "o", "ô": "o", "û": "u", "ü": "u" };
        var normalize = function( term ) {
            var ret = "";
            for ( var i = 0; i < term.length; i++ ) {
                ret += accentMap[ term.charAt(i) ] || term.charAt(i);
            }
            return ret;
        };
        $( "#input_depart" ).autocomplete({
            source: function( request, response ) {
                var matcher = new RegExp( $.ui.autocomplete.escapeRegex( request.term ), "i" );
                response( $.grep( villes, function( value ) {
                    value = value.label || value.value || value;
                    return matcher.test( value ) || matcher.test( normalize( value ) );
                }) );
            },
            select: function (event, ui) {  $('#input_departID').val(ui.item.id);
                                            $('#input_depart_lat').val(ui.item.lat);
                                            $('#input_depart_lng').val(ui.item.lng);
                                    }
        });


        $( "#input_arrivee" ).autocomplete({
            source: function( request, response ) {
                var matcher = new RegExp( $.ui.autocomplete.escapeRegex( request.term ), "i" );
                response( $.grep( villes, function( value ) {
                    value = value.label || value.value || value;
                    return matcher.test( value ) || matcher.test( normalize( value ) );
                }) );
            },
            select: function (event, ui) {  $('#input_arriveeID').val(ui.item.id);
                                            $('#input_arrivee_lat').val(ui.item.lat);
                                            $('#input_arrivee_lng').val(ui.item.lng);
                                    }
        });

        $("#map").googleMap();
        <?php if($annonces){
            foreach($annonces as $annonce): ?>
                $("#map").addMarker({
                    coords: [<?php echo $annonce->d_lat ?>, <?php echo $annonce->d_lng ?>], // Coordonnées GPS du point
                    //icon: 'http://www.tiloweb.com/logo.png',
                    url: '#annonce_<?php echo $annonce->id ?>',
                    title: '<?php echo $annonce->$ville_depart_lang ?> - <?php echo $annonce->$ville_arrivee_lang ?>', // Titre du point
                    text: '<?php echo $annonce->date ?> à <?php echo $annonce->heure ?>'
                });
        <?php endforeach; 
        }?>  
    });
</script>
