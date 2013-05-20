var firstname = $("#firstname");
var lastname = $("#lastname");
var age = $("#age");
var docid = $("#docid");
var allFields = $([]).add(firstname).add(lastname).add(age).add(docid);
var tips = $(".validateTips");

$("#dialog-form").dialog({
	autoOpen: false,
	height: 400,
	width: 350,
	modal: true,
	position: { my: "center", at: "center", of: '#slide' },
	buttons: {
		"Continuar": function() {
			var bValid = true;
			allFields.removeClass( "ui-state-error" );
			bValid = bValid && checkLength( firstname, "nombre", 3, 16 );
			bValid = bValid && checkLength( lastname, "apellido", 3, 16 );
			bValid = bValid && checkLength( age, "edad", 1, 3 );
			bValid = bValid && checkLength( docid, "cedula", 1, 16 );
			//bValid = bValid && checkRegexp( name, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
			// From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
			//bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
			//bValid = bValid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
			
			if ( bValid ) {
				// save data in variables
				testData.firstname = firstname.val();
				testData.lastname = lastname.val();
				testData.age = age.val();
				testData.docid = docid.val();

				// enable close button
				$("#dialog-form").dialog( { 
					beforeClose: function(event, ui) { return true; } });
				$("#dialog-form").dialog("close");
			}
		},
		/*Cancel: function() {
			$( this ).dialog( "close" );
		}*/
	},
	open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); },
	close: function() {
		allFields.val("").removeClass( "ui-state-error" );
	},
	beforeClose: function(event, ui) { return false; }
});
