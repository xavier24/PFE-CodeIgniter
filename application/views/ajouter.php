<section class="content">
    <div class="row-fluid ajouter_annonce">
    <h1>Publier une annonce</h1>
        <?php echo form_open('annonce/poster',array('method'=>'post')); ?>
        <div id="recherche" class="formulaire">
            <p>Je suis </p>
            
            <div class="choix_conducteur">
                <p><span class=""><img src="<?php echo base_url(); ?>web/images/passager.png" title="" alt=""/></span></p>
                <input type="hidden" id="input_conducteur" name="input_conducteur" />
                <div id="slider_conducteur">
                </div>
            </div>
            <div class="clearfix row-fluid">
                <div class="span6">
                    <h2>De</h2>
                    <div class="depart clearfix">
                        <label class="ico-depart"></label>
                        <div class="input">
                            <input type="text" class="champ" name="input_depart" id="input_depart" placeholder="ville de départ" />
                        </div>
                        <input id="input_departID" name="input_departID" type="hidden" />
                        <input id="coord_depart_lat" name="coord_depart" type="hidden" />
                        <input id="coord_depart_lng" name="coord_depart" type="hidden" />
                        <div class="description">
                            <label for="input_description_depart">Infos lieu rendez-vous</label>
                            <textarea id="input_description_depart" name="input_description_depart"></textarea>
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <h2>à</h2>
                    <div class="arrivee clearfix">
                        <label class="ico-arrivee"></label>
                        <div class="input">
                            <input type="text" class="champ" name="input_arrivee" id="input_arrivee" placeholder="ville d'arrivée"/>
                        </div>
                        <input id="input_arriveeID" name="input_arriveeID" type="hidden" />
                        <input id="coord_arrivee_lat" name="coord_arrivee" type="hidden" />
                        <input id="coord_arrivee_lng" name="coord_arrivee" type="hidden" />
                        <div class="description">
                            <label for="input_description_arrivee">Infos lieu arrivée</label>
                            <textarea id="input_description_arrivee" name="input_description_arrivee"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="etapes">
                <h3>etapes</h3>
                <p id="more_etape">++++</p>
                <input class="input_etape" type="text"/>
            </div>
            <div class="row-fluid date_heure">
                <div class="span6">
                    <div class="date clearfix">
                        <label class="ico-date" for="input_date"></label>
                        <input id="input_date" name="input_date" class="champ" type="date" placeholder="JJ/MM/AAAA" />
                    </div>
                </div>
                <div class="span6">
                    <div class="heure clearfix">
                        <label class="ico-heure" for="input_heure"></label>
                        <input id="input_heure" class="" type="text" value="" name="input_heure" placeholder="HH:MM" />
                    </div>
                </div>
            </div>
            <label>+/- 
                            <select name="input_flexibilite">
                                <?php for($i=0;$i<15;$i++){ 
                                 echo'<option>'.$i.'</option>';
                                } ?>
                            </select>
                            jour(s)
                        </label>
            <div class="avancee">
                <label>Avec 
                    <select name="input_places">
                        <?php for($i=1;$i<8;$i++){ 
                         echo'<option>'.$i.'</option>';
                        } ?>
                    </select>
                    place(s) et +
                </label>
            </div>
            <div>
                <label for="input_commentaire">Commentaire sur le trajet</label>
                <textarea id="input_commentaire" name="input_commentaire"></textarea>
            </div>
            <div>
                <label for="input_retour">Aller-retour</label>
                <input id="input_retour" type="checkbox" name="input_retour" value="1"/>
            </div>
            <div>
                <label for="input_regulier">Régulier</label>
                <input id="input_regulier" type="checkbox" name="input_regulier" value="1"/>
            </div>
            <div>
                <input id="input_coord" type="text" name="input_coord" />
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
        
        
    </div>
    <script>
        $(function() {
            $( "#slider_conducteur" ).slider({
                value:1,
                min: 0,
                max: 2,
                step: 1,
                slide: function( event, ui ) {
                    var $oldvalue = $( "#input_conducteur" ).val();
                    $( "#input_conducteur" ).val(ui.value );
                    //$("label[class*='pref_"+this_id+"']").removeClass('pref_'+this_id+ $oldvalue).addClass('pref_'+this_id+ui.value);
                }
            });
            $( "#input_conducteur" ).val($( "#slider_conducteur" ).slider( "value" ) );
        });
    </script>
    <script type="text/javascript">
        
        var depart_lat = $("#coord_depart_lat").val(),
            depart_lng = $("#coord_depart_lng").val(),
            arrivee_lat = $("#coord_arrivee_lat").val(),
            arrivee_lng = $("#coord_arrivee_lng").val(),
            map;
            
        var villes =[
            <?php foreach ($villes as $ville) : 
                echo '{"label":"'.$ville->fr_FR.'('.$ville->code_postal.')'.'", "id":'.$ville->id.', "lat":'.$ville->latitude.', "lng":'.$ville->longitude.'},';
            endforeach; ?>
            ];

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
        $( "#input_depart" ).autocomplete({
            source: function( request, response ) {
                var matcher = new RegExp( $.ui.autocomplete.escapeRegex( request.term ), "i" );
                response( $.grep( villes, function( value ) {
                    value = value.label || value.value || value;
                    return matcher.test( value ) || matcher.test( normalize( value ) );
                }) );
            },
            select: function (event, ui) {  $('#input_departID').val(ui.item.id);
                                            $('#coord_depart_lat').val(ui.item.lat);
                                            $('#coord_depart_lng').val(ui.item.lng);
                                            depart_lat = ui.item.lat;
                                            depart_lng = ui.item.lng;
                                            maps();
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
                                            $('#coord_arrivee_lat').val(ui.item.lat);
                                            $('#coord_arrivee_lng').val(ui.item.lng);
                                            arrivee_lat = ui.item.lat;
                                            arrivee_lng = ui.item.lng;
                                            maps();
                                        }
        });
        
        $("#input_date").datepicker({
                        autoSize: true,
                        minDate: 0,
                        constrainInput: true
                        },$.datepicker.regional[ "fr" ]
                    );
        $('#input_heure').timepicker({
                        minuteGrid: 10,
                        timeFormat: 'hh:mm tt',
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
        
        $(document).ready(function() {
            maps();
        });
        
        function maps(){
            if(depart_lat && depart_lng && arrivee_lat && arrivee_lng){
                
                var input_etape = $(".input_etape");
                var etapes = new Array();
                for(var i=0;i<input_etape.length;i++){
                    if(input_etape[i].value != ""){
                        etapes.push(input_etape[i].value);
                    }
                }
                if(etapes.length == 0){
                    etapes = false;
                }
                console.log(input_etape);
                console.log(etapes);
                $("#map").googleMap();
                $("#map").addWay({
                    start: [depart_lat, depart_lng], // Adresse postale du départ (obligatoire)
                    waypoints: etapes,
                    optimizeWaypoints: true,
                    end:  [arrivee_lat, arrivee_lng], // Coordonnées GPS ou adresse postale d'arrivée (obligatoire)
                    route : 'way', // ID du bloc dans lequel injecter le détail de l'itinéraire (optionnel)
                    langage : 'french' // Langue du détail de l'itinéraire (optionnel, en anglais)
                });
            }
        }
    </script>
</section>