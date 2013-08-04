<section class="content">
    <div class="row-fluid ajouter_annonce">
        <h1>Publier une annonce</h1>
        <?php echo form_open('accueil/recherche',array('method'=>'post')); ?>
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
                                    echo'<option>'.$i.'</option>';
                                } ?>
                            </select>
                            <span>jour(s)</span>
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <div class="clearfix">
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
            <div class="bouton_contour bouton_gris">
                <button type="submit" value="true" class="button gris">
                    Rechercher
                </button>
            </div>
        </div>
        <?php echo form_close(); ?>
        <div class="row-fluid clearfix">
            
        </div>
    </div>
    <script type="text/javascript">
        $(function(){
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
        });
    </script>
</section>
