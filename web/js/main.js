/*jshint nonstandard: true, browser: true, boss: true */
/*global jQuery */

( function ( $ ) {
	"use strict";

	// --- global vars
        var baseUrl = location.origin, 
            $slideCompte,
            $lang,
            $edit,
            $editPhoto,
            $autreLang,
            $etapes,
            $inputEtape,
            $new_inputEtape,
            $count_inputEtape,
            $moreStep,
            $input_confort,
            $delete_annonce,
            $cancel_delete_annonce;
	// --- methods
    //INITIALISE SELON PAGE
        
        var controlSession = function(){
            
            $.ajax({
                url:baseUrl+'/PFE-CodeIgniter/ajax/dataSession',
                type:'POST',
                success: function($data){
                var connect;
                    if($.parseJSON($data)){
                        connect = true;
                    }
                    else{
                        connect = false;
                    }
                initialise(connect);
                }
            });
        };
        
        var initialise = function(connect){
            
            if($("body").hasClass('accueil')){ //ACCUEIL
                //recuperer valeur slide conducteur pour ajouter la class
                sliderConducteur();
            }
            if($("body").hasClass('resultat')){ //RESULTAT
                //recuperer valeur slide conducteur pour ajouter la class
                sliderConducteur();
            }
            if($("body").hasClass('ajouter_annonce')){ //AJOUTER ANNONCE
                
                //recuperer valeur slide conducteur pour ajouter la class
                if(connect){
                    sliderConducteur();
                }
                else{
                    $('.nav_compte').find('.slideBlock').slideToggle();
                    $('.nav_compte').toggleClass('ouvert');
                }
                
            }
        };
        
        
    //MENU    
	var loginForm = function(){ //slide connexion menu (portable)
            $(this).parent().next().children('.slideBlock').slideToggle();
            $(this).parent().parent().toggleClass('ouvert');
        };//loginForm
    
    //CHANGER LANGUE
        var changeLang = function(e){
            e.preventDefault();
            //console.log($(this).attr("id"));
            $.ajax({
                    url:baseUrl+'/PFE-CodeIgniter/ajax/lang/'+$(this).attr("id"),
                    type:'POST',
                    success: function($data){
                        location.reload();
                    }
            });
        };//changeLang
    
    //INITIALISE SLIDER CHOIX CONDUCTEUR
        var sliderConducteur = function(){
            var $value = $( "#input_conducteur" ).val();
            $(".choix_conducteur"+$value).addClass('select');
        };//sliderConducteur

    //PROFIL   
        var editProfil = function(){ //editer profil
            $(this).parent().parent().find('.profil_modif').toggle();
            $(this).parent().parent().find(".edit_hidden").toggle();
            $(this).parent().parent().find(".colorPicker-picker").toggle();
	};//editProfil
        
        var uploadPhoto = function(){ //modifier photo profil
            $('#photo').click();
            $('#photo').on('change',function(){
                $('#upload_photo form').submit();
            });
        };//uploadPhoto
        
        var autreLangTextearea = function(){ // autre langue profil
            if($(this).is(':checked')){
                $("#input_autre_lang").show();
            }
            else{
                $("#input_autre_lang").hide();
            }
        };//autreLangTextearea
                
    //AJOUTER ANNONCE
        var addStep = function(){ //ajouter etape annonce
            $count_inputEtape = $etapes.find('.etape');
            if($count_inputEtape.length < 5){
                $new_inputEtape = $inputEtape.clone();
                $new_inputEtape.find('input').val("");
                $new_inputEtape.find('.input_stop').val("1");
                $new_inputEtape.appendTo($etapes);
                $('.nb_etape').empty().append($count_inputEtape.length+1);
                countStep();
            }
        };//addStep
        
        var removeStep = function(){ //supprimer etape annonce
            $count_inputEtape = $etapes.find('.etape');
            if($count_inputEtape.length > 1){
                $(this).parent().parent().remove();
                $('.nb_etape').empty().append($count_inputEtape.length-1);
                countStep();
            }
            else{
                $(this).parent().find('input').val("");
            }
        };//removeStep
        
        var countStep = function(){
            $count_inputEtape = $etapes.find('.etape');
            var i = 0;
            $count_inputEtape.each(function(){
                $(this).find('.input_etape').attr('name','input_etape_'+i);
                $(this).find('.input_etapeID').attr('name','input_etapeID_'+i);
                $(this).find('.input_etape_lat').attr('name','input_etape_lat_'+i);
                $(this).find('.input_etape_lng').attr('name','input_etape_lng_'+i);
                $(this).find('.input_stop').attr('name','input_stop_'+i);
                $(this).find('.input_duree').attr('name','input_duree_'+i);
                i++;
            });
        };//countStep
        
        var btnCheck = function($this,$check){ //bouton checkbox annonce
            if($this.next().is(':checked') && !$check){
                $this.removeClass('bouton_orange').addClass('bouton_gris');
                $this.find('.button').removeClass('orange').addClass('gris');
            }
            else{
                $this.addClass('bouton_orange').removeClass('bouton_gris');
                $this.find('.button').addClass('orange').removeClass('gris');
            }
            
            if($this.next().hasClass('show_calendar')){
                $(".calendar").toggle();
            }
            if($this.next().hasClass('show_retour')){
                $(".table_retour").toggle();
                $(".input_heure_retour").toggle();
                $(".input_date_retour").toggle();
            }
            
        };//btnCheck
        
        var deleteAnnonce = function(){
            var $id = $(this).parent().parent().find('.id_annonce input').val();
            $("#input_id_annonce").val($id);
            $("#overlay").show();
            $("#confirm_delete").show();
        };//deleteAnnonce
        
        var cancelDeleteAnnonce = function(){
            $("#overlay").hide();
            $("#confirm_delete").hide();
        };//cancelDeleteAnnonce
        
        $( function () {

            // --- onload routines
		$slideCompte = $('.slide_compte');
                $lang = $('.btn_lang');
                $edit = $(".edit");
                $editPhoto = $(".edit_photo");
                $autreLang = $("#lang_autre_lang");
                $input_confort = $("input[name='confort']");
                $etapes = $(".etapes");
                $inputEtape = $etapes.find('.etape').first().clone();
                $moreStep = $("#more_step");
                $delete_annonce = $(".supprimer_annonce");
                $cancel_delete_annonce = $("#cancel_delete_annonce");
                
            // --- events
                $slideCompte.on('click',loginForm);
                $lang.on('click',changeLang);
                $edit.on("click", editProfil);
                $editPhoto.on('click',uploadPhoto);
                $moreStep.on('click',addStep);
                $autreLang.on('click',autreLangTextearea);
                $input_confort.select(function(){modifConfort()});
                $(document).on('click',".min_step",removeStep);
                $delete_annonce.on('click',deleteAnnonce);
                $cancel_delete_annonce.on('click',cancelDeleteAnnonce);
                
                
            // --- execute
                controlSession();
                
                if($("#input_retour").is(':checked')){
                   btnCheck($("#input_retour").prev(),"isCheck");
                }
                if($("#input_regulier").is(':checked')){
                   btnCheck($("#input_regulier").prev(),"isCheck");
                }
                $(".btn_check label").on('click',function(){
                    btnCheck($(this))
                });
                
                if($autreLang){
                    autreLangTextearea();
                }
                
            // --- Appel function externe
                
        } );
        
}( jQuery ) );




