jQuery(document).ready(function ($) {
    "use strict";

    /**
     * TinyMCE Custom Control
     *
     * @author Zeddy Emmanuel <https://zeddyemy.github.io/>
     * @license http://www.gnu.org/licenses/gpl-2.0.html
     */

    $('.customize-control-tinymce-editor').each(function () {
        // Get the toolbar strings that were passed from the PHP Class
        var tinyMCEToolbar1String = _wpCustomizeSettings.controls[$(this).attr('id')].clarusmodtinymcetoolbar1;
        var tinyMCEToolbar2String = _wpCustomizeSettings.controls[$(this).attr('id')].clarusmodtinymcetoolbar2;
        var tinyMCEMediaButtons = _wpCustomizeSettings.controls[$(this).attr('id')].clarusmodmediabuttons;

        wp.editor.initialize($(this).attr('id'), {
            tinymce: {
                wpautop: true,
                toolbar1: tinyMCEToolbar1String,
                toolbar2: tinyMCEToolbar2String,
                content_css: '../wp-content/themes/clarusmod/inc/customizer/assets/css/custom-controls/tinymce.css'
            },
            quicktags: true,
            mediaButtons: tinyMCEMediaButtons
        });
    });
    $(document).on('tinymce-editor-init', function (event, editor) {
        editor.on('change', function (e) {
            tinyMCE.triggerSave();
            $('#' + editor.id).trigger('change');
        });
    });

    /**
     * Url Custom Control
     *
     * @author Zeddy Emmanuel <https://zeddyemy.github.io/>
     * @license http://www.gnu.org/licenses/gpl-2.0.html
     */
    
    // Listen for changes in the input field and apply the "invalid" class
    $('.customize-control-url input[type="url"]').on('input', function () {
        var url = $(this).val();
        var isValid = isValidUrl(url);
        $('.customize-control-url p.input-msg').toggleClass('invalid', !isValid);
        $(this).toggleClass('invalid', !isValid);
		changePublishState(isValid);
    });


	/**
	 * Text URL Custom Control
	 *
	 * Handles real-time updates for text url inputs.
	 */
	$('.customize-control-text_url').each(function () {
		const textInput = $(this).find(".customize-txt-url-t-input");
		const urlInput = $(this).find(".customize-txt-url-u-input");
		const errMsg = $(this).find("p.input-msg");


		// Listen for input changes and update Customizer settings
		textInput.on('input', function () {
			
		});

		urlInput.on('input', function () {
			var url = $(this).val();
			// Check if the input field is empty
			if (url.trim() !== '') {
				var isValid = isValidUrl(url);
	
				
				errMsg.toggleClass('invalid', !isValid);
				$(this).toggleClass("invalid", !isValid);
				changePublishState(isValid);
				
			} else {
				errMsg.toggleClass("invalid", false);
				$(this).toggleClass("invalid", false);
				changePublishState(true);
			}
			
		});
	});
	

	/**
	 * Numeric Input Custom Control
	 *
	 * @author Zeddy Emmanuel <https://zeddyemy.github.io/>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 */
	// Listen for changes in the input field and apply the "invalid" class
	$('.customize-control-numeric_input input[type="number"]').on('input', function () {
		let msg = '';
		let isValid = true;
		const val = parseFloat($(this).val());
		const min = parseFloat($(this).attr('min'));
		const max = parseFloat($(this).attr('max'));
		const msgBox = $(this).siblings('p.input-msg'); // select the message box

		if (isNaN(val)) {
			isValid = false;
			msg = 'Please enter a number';
		} else if (!isNaN(min) && val < min) {
			isValid = false;
			msg = 'Number must be greater than or equal to ' + min;
		} else if (!isNaN(max)  && val > max){
			isValid = false;
			msg = 'Number must be less than or equal to ' + max;
		}
		msgBox.text(msg); // set the text content of the message

		// toggle the 'invalid' class based on validation
		msgBox.toggleClass('invalid', !isValid);
		$(this).toggleClass('invalid', !isValid);

		// change state of publish based on validation
		changePublishState(isValid);
	});

    /**
     * Searchable Select Control
     * 
     * @author Zeddy Emmanuel <https://zeddyemy.github.io/>
     * @license http://www.gnu.org/licenses/gpl-2.0.html
     */
    
    $('.customize-ctrl-searchable-select').each(function(){
		$('.custom-searchable-select').select2({
			allowClear: true
		});
	});

	$(".custom-searchable-select").on("change", function() {
		var select2Val = $(this).val();
		$(this).parent().find('.customize-ctrl-searchable-select').val(select2Val).trigger('change');
	});


    

    /**
	 * Repeater Custom Control
	 *
	 * @author Zeddy Emmanuel <https://zeddyemy.github.io/>
     * @license http://www.gnu.org/licenses/gpl-3.0.html
	 */

	// cache frequently accessed DOM elements
	const theRepeater = $(this).find('.theRepeater');
	const inputType = theRepeater.data('input-type');
	
	// Update the values for all our input fields and initialize the repeater
	$('.repeater_control').each(function() {
		// If there is an existing customizer value, populate our rows
		var defaultValuesArray = $(this).find('.customize-control-repeater').val().split(',');
		var numRepeaterItems = defaultValuesArray.length;

		if(numRepeaterItems > 0) {
			// Add the first item to our existing input field
			$(this).find('.repeater-input').val(defaultValuesArray[0]);
			// Create a new row for each new value
			if(numRepeaterItems > 1) {
				var i;
				for (i = 1; i < numRepeaterItems; ++i) {
					clarusmodAddNewRow($(this), defaultValuesArray[i]);
				}
			}
		}
	});

	// Make the Repeater fields sortable
	if (theRepeater.hasClass('sortable')) {
		theRepeater.sortable({
			update: function(event, ui) {
				clarusmodGetAllInputs($(this).parent());
			}
		});
	}

	// Remove item starting from it's parent element
	theRepeater.on('click', '.customize-control-repeater-delete', function(event) {
		event.preventDefault();
		var numItems = $(this).parent().parent().find('.repeater').length;

		if(numItems > 1) {
			$(this).parent().slideUp('fast', function() {
				var parentContainer = $(this).parent().parent();
				$(this).remove();
				clarusmodGetAllInputs(parentContainer);
			})
		}
		else {
			$(this).parent().find('.repeater-input').val('');
			clarusmodGetAllInputs($(this).parent().parent().parent());
		}
	});

	// Add new item
	$('.customize-control-repeater-add').click(function(event) {
		event.preventDefault();
		clarusmodAddNewRow($(this).parent());
		clarusmodGetAllInputs($(this).parent());
	});

	// Refresh our hidden field if any fields change
	$('.theRepeater').change(function() {
		clarusmodGetAllInputs($(this).parent());
	})

	// URL Validation Check Based on input_type
	if (inputType === 'url') {
		theRepeater.on('input', '.repeater-input', function () {
			var url = $(this).val();
			var isValid = isValidUrl(url);
			$('.customize-control-repeater p.input-msg').toggleClass('invalid', !isValid);
			$(this).toggleClass('invalid', !isValid);
			// change state of publish based on validation
			changePublishState(isValid);
		});
		theRepeater.on('blur', '.repeater-input', function () {
			var input = $(this);
			var val = input.val();
	
			// Add https:// to the start of the URL if it doesn't have it
			if (val && !hasHTTPS(val)) {
				// trigger change event so Customizer knows it has to save the field
				input.val('https://' + val).trigger('change');
			}
		});
	}

	// Append a new row to our list of elements
	function clarusmodAddNewRow($element, defaultValue = '') {
		var newRow = $element.find('.repeater:first').clone();
		newRow.find('.repeater-input').val('');

		$element.find('.theRepeater').append(newRow);
		$element.find('.theRepeater').find('.repeater:last').slideDown('slow', function(){
			$(this).find('.repeater-input').focus();
		});
	}

	// Get the values from the repeater input fields and add to our hidden field
	function clarusmodGetAllInputs($element) {
		var inputValues = $element.find('.repeater-input').map(function() {
			return $(this).val();
		}).filter(function(index, value) {
			return $.trim(value) !== ''; // filter out empty values
		}).toArray();

		// Add all the values from our repeater fields to the hidden field (which is the one that actually gets saved)
		$element.find('.customize-control-repeater').val(inputValues);
		// Important! Make sure to trigger change event so Customizer knows it has to save the field
		$element.find('.customize-control-repeater').trigger('change');
	}

	/**
	 * Help Functions
	 * 
	 * @author Zeddy Emmanuel <https://zeddyemy.github.io/>
     * @license http://www.gnu.org/licenses/gpl-3.0.html
	 */
	
	// check if the URL is valid
	function isValidUrl(url) {
		return url && /^(https?:\/\/)?([\da-z.-]+)\.([a-z.]{2,6})(\/([^\s\/?#]+)?)?(\?([^\s\/?#]*))?(#([^\s\/?#]*))?$/i.test(url);
	}
	// check if url has 'http://' Or 'https://'
	function hasHTTPS(url) {
		return url.startsWith("http://") || url.startsWith("https://");
	}

	function changePublishState(valid) {
		// get publish button
		const publishBtn = $('#customize-header-actions .button-primary.save');
		publishBtn.prop('disabled', !valid);
	}
});