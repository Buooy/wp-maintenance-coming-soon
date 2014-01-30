(function ( $ ) {
	"use strict";

	$(function () {

		// Update the WP MCS
		$('form#update-wp-mcs').submit(function(e){
			e.preventDefault();
			// Place your administration-specific JavaScript here
			$.post(ajaxurl, $('form#update-wp-mcs').serialize(), function(response) {
<<<<<<< HEAD
<<<<<<< HEAD
				alert(response.msg);
=======
				alert('Got this from the server: ' + response.msg);
>>>>>>> 88ff9fbb4e83328af51ce241103fecce2d0fc2e6
=======
				alert('Got this from the server: ' + response.msg);
>>>>>>> 88ff9fbb4e83328af51ce241103fecce2d0fc2e6
				if( response.status == 'success' ){
					location.reload();
				}
			}, 'json');
		});
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 88ff9fbb4e83328af51ce241103fecce2d0fc2e6

		// Changing the Theme
		$('select#wp-mcs-theme').change(function(){
			update_options($('select#wp-mcs-theme'));
		});

	});

<<<<<<< HEAD
	// Update Options
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
	// Change Display of settings option
	function change_settings_option(){
		if( $('input[type=radio][name=wp-mcs-type]:checked').val() != 'redirect' ){
			$('#settings-option-redirect').fadeOut('fast', function(){
				$('#settings-option-theme').fadeIn('fast');
			});
		}
		else{
			$('#settings-option-theme').fadeOut('fast', function(){
				$('#settings-option-redirect').fadeIn('fast');
			});	
		}
	}

	$(document).ready(function(){
		// Update Options
		update_options( $('select#wp-mcs-theme') );

		// Swap Options
		change_settings_option();
		$('input[type=radio][name=wp-mcs-type]').click(function(){
			change_settings_option();
		});
=======
>>>>>>> 88ff9fbb4e83328af51ce241103fecce2d0fc2e6

		// Changing the Theme
		$('select#wp-mcs-theme').change(function(){
			update_options($('select#wp-mcs-theme'));
		});

	});

=======
>>>>>>> 88ff9fbb4e83328af51ce241103fecce2d0fc2e6
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