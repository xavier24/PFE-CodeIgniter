<section id="col1">
    <h1>Publier une annonce</h1>
        <?php echo form_open('annonce/poster',array('method'=>'post')); ?>
        <div id="recherche" class="formulaire">
            <p>Je suis </p>
            
            <div id="" class="">
                <p><span class=""><img src="<?php echo base_url(); ?>web/images/passager.png" title="" alt=""/></span></p>
                <input type="hidden" id="input_conducteur" name="input_conducteur" />
                <div id="slider_conducteur">
                </div>
            </div>
            
            <label>voyageant de
                <input type="text" class="champ" name="input_depart" id="input_depart" placeholder="ville de départ" />
                <input id="input_departID" name="input_departID" type="hidden" />
            </label>
            <label>à
                <input type="text" class="champ" name="input_arrivee" id="input_arrivee" placeholder="ville d'arrivée"/>
                <input id="input_arriveeID" name="input_arriveeID" type="hidden" />
            </label>
            <div>
                <label for="input_description_depart">Infos lieu rendez-vous</label>
                <textarea id="input_description_depart" name="input_description_depart"></textarea>
            </div>
            <div>
                <label for="input_description_arrivee">Infos lieu arrivée</label>
                <textarea id="input_description_arrivee" name="input_description_arrivee"></textarea>
            </div>
            <label>le
                <input id="input_date" name="input_date" class="champ" type="date" placeholder="JJ/MM/AAAA" />
            </label>
            <label>+/- 
                <select name="input_flexibilite">
                    <?php for($i=0;$i<15;$i++){ 
                     echo'<option>'.$i.'</option>';
                    } ?>
                </select>
                jour(s)
            </label>
            <div class="heure">
                <input id="input_heure" class="" type="text" value="" name="input_heure" placeholder="HH:MM" />
            </div>
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
    
    <div id="map" style="width: 100%; height: 300px"></div>
    <div id="way"></div>    
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
        
        var depart_lat,depart_lng,arrivee_lat,arrivee_lng,map;
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
            select: function (event, ui) { $('#input_departID').val(ui.item.id);
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
            select: function (event, ui) { $('#input_arriveeID').val(ui.item.id);
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
        
        function maps(){
            if(depart_lat && depart_lng && arrivee_lat && arrivee_lng){
                $("#map").googleMap();
                $("#map").addWay({
                    start: [depart_lat, depart_lng], // Adresse postale du départ (obligatoire)
                    waypoints: ["50.419456,4.447975","namur"],
                    optimizeWaypoints: true,
                    end:  [arrivee_lat, arrivee_lng], // Coordonnées GPS ou adresse postale d'arrivée (obligatoire)
                    route : 'way', // ID du bloc dans lequel injecter le détail de l'itinéraire (optionnel)
                    langage : 'french' // Langue du détail de l'itinéraire (optionnel, en anglais)
                });
            }
        }
    </script>
</section>