/*jshint nonstandard: true, browser: true, boss: true */
/*global jQuery */

( function ( $ ) {
	"use strict";

	// --- global vars
	
	// --- methods
	var modifProfil = function(){
		$(".profil_input").show();
		$("label span").hide();
	}
	
	$( function () {

		// --- onload routines
		var modif = $("#modif");
		modif.on("click", modifProfil);
	} );

}( jQuery ) );




