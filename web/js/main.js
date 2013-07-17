/*jshint nonstandard: true, browser: true, boss: true */
/*global jQuery */

( function ( $ ) {
	"use strict";

	// --- global vars
	
	// --- methods
	var loginForm = function(){
            $(this).parent().next().children('.slideBlock').slideToggle();
            $(this).parent().parent().toggleClass('ouvert');
        }
        
        
        var editProfil = function(){
            $(this).parent().parent().find('.profil_modif').toggle();
            $(this).toggleClass('editor');
            if($(this).hasClass('editor')){
                $(this).find('span:first-child').text("Annuler");
            }
            else{
                $(this).find('span:first-child').text("Modifier");
            }
            $(this).parent().parent().find(".edit_hidden").toggle();
            
            $(this).parent().parent().find(".colorPicker-picker").toggle();
	};
        
        var uploadPhoto = function(){
            $('#photo').click();
            $('#photo').on('change',function(){
                $('#upload_photo form').submit();
            });
        };
        
        var autreLangTextearea = function(){
            if($(this).is(':checked')){
                $("#input_autre_lang").show();
            }
            else{
                $("#input_autre_lang").hide();
            }
        };
        
        var modifConfort = function(){
            console.log("a");
            //var for_confort = $(this).attr('for');
           // var input_confort = $('#'+ for_confort).val();
            //console.log(input_confort);
            //$("#img_confort").css("background-position", (5-input_confort)*-20+"px 0");
        };
	
	$( function () {

		// --- onload routines
		var slideCompte = $('.slide_compte');
		var edit = $(".edit");
                var editPhoto = $(".edit_photo");
                var autreLang = $("#lang_autre_lang");
                
                slideCompte.on('click',loginForm);
                edit.on("click", editProfil);
                editPhoto.on('click',uploadPhoto);
                
                if(autreLang){
                    autreLangTextearea();
                }
                autreLang.on('click',autreLangTextearea);
                
                var input_confort = $("input[name='confort']");
                input_confort.select(function(){modifConfort()});
	} );

}( jQuery ) );




