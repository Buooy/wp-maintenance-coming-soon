(function ( $ ) {
	"use strict";

	$(function () {

		// Update the WP MCS
		$('form#update-wp-mcs').submit(function(e){
			e.preventDefault();
			// Place your administration-specific JavaScript here
			$.post(ajaxurl, $('form#update-wp-mcs').serialize(), function(response) {
				alert('Got this from the server: ' + response.msg);
				if( response.status == 'success' ){
					location.reload();
				}
			}, 'json');
		});

		// Changing the Theme
		$('select#wp-mcs-theme').change(function(){
			update_options($('select#wp-mcs-theme'));
		});

	});

	function update_options(_this){
		var option = _this.find(":selected");
			
		var _name 		= 	option.data('name');
		var _description=	option.data('description');
		var _screen		=	option.data('screen');

		console.log(_name+' + '+_description+' + '+ _screen);

		$('#theme_name').html(_name);
		$('#theme_description').html(_description);
		$('#theme_screen').attr('src',_screen);
	}

	$(document).ready(function(){
		update_options( $('select#wp-mcs-theme') );
	});

}(jQuery));