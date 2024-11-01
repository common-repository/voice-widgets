/** Run jQuery scripts */
( function ( $ ) {

    "use strict";

    /** Document Ready. */
    $( document ).ready( function () {

        window.speechSynthesis.cancel();

        var refreshIntervalId = "";

           
        /*************************************
		* button position content js.
		**************************************/
        $(document).on('click', '.wp_button_text_to_speech-buttons', function (e) {
        	e.preventDefault();
        	var currentDoom = $(this);
        	var text_to_speech_content = currentDoom.attr('data-content');

			window.speechSynthesis.getVoices();
			var refreshIntervalId = "";
              
			window.speechSynthesis.cancel();
			const text_to_speech_val      = new SpeechSynthesisUtterance( text_to_speech_content );
			text_to_speech_val.voice      = window.speechSynthesis.getVoices().find(voice => voice.voiceURI === qcld_tts_ajax.text_to_speech_voice );
			text_to_speech_val.pitch      = qcld_tts_ajax.text_to_speech_pitch;
			text_to_speech_val.rate       = qcld_tts_ajax.text_to_speech_rate;
			text_to_speech_val.volume     = qcld_tts_ajax.text_to_speech_volume;

			if( currentDoom.hasClass("qcld_floating_text_to_speech_loud") ){
				currentDoom.remove("qcld_floating_text_to_speech_loud"); 
				window.speechSynthesis.pause();
			} else {
				currentDoom.addClass("qcld_floating_text_to_speech_loud"); 
				window.speechSynthesis.speak(text_to_speech_val);
			}  
			var synth = window.speechSynthesis;

			refreshIntervalId = setInterval(function(){
				displayHello(synth, currentDoom)
			}, 500);

    
        });

           
        /*************************************
		* button shortcode content js.
		**************************************/
        $(document).on('click', '.wp_button_text_to_speech-button', function (e) {
        	e.preventDefault();
        	var currentDoom = $(this);
        	var text_to_speech_content = currentDoom.attr('data-content');
        	var text_to_text = currentDoom.attr('btn-text');
        	var text_to_stop = currentDoom.attr('btn-stop');

			window.speechSynthesis.getVoices();
			var refreshIntervalId = "";
              
			window.speechSynthesis.cancel();
			const text_to_speech_val      = new SpeechSynthesisUtterance( text_to_speech_content );
			text_to_speech_val.voice      = window.speechSynthesis.getVoices().find(voice => voice.voiceURI === qcld_tts_ajax.text_to_speech_voice );
			text_to_speech_val.pitch      = qcld_tts_ajax.text_to_speech_pitch;
			text_to_speech_val.rate       = qcld_tts_ajax.text_to_speech_rate;
			text_to_speech_val.volume     = qcld_tts_ajax.text_to_speech_volume;

			if( currentDoom.hasClass("qcld_floating_text_to_speech_loud") ){
				currentDoom.remove("qcld_floating_text_to_speech_loud"); 
				currentDoom.find('span').text(text_to_text); 
				window.speechSynthesis.pause();
			} else {
				currentDoom.addClass("qcld_floating_text_to_speech_loud"); 
				currentDoom.find('span').text(text_to_stop); 
				window.speechSynthesis.speak(text_to_speech_val);
			}  
			var synth = window.speechSynthesis;

			refreshIntervalId = setInterval(function(){
				displayHello(synth, currentDoom)
			}, 500);

    
        });

        
        /*************************************
		* button voice_to_speech_voice_box js.
		**************************************/
        $(document).on('click', '.qcld_playbutton', function (e) {
        	e.preventDefault();
        	var currentDoom = $(this);
        	var text_to_speech_content = (jQuery("#qcld_text_to_speech_content").val()) ? jQuery("#qcld_text_to_speech_content").val() : jQuery("#qcld_text_to_speech_content").attr("placeholder");

			window.speechSynthesis.getVoices();
			var refreshIntervalId = "";
              
			window.speechSynthesis.cancel();
			const text_to_speech_val      = new SpeechSynthesisUtterance( text_to_speech_content );
			text_to_speech_val.voice      = window.speechSynthesis.getVoices().find(voice => voice.voiceURI === qcld_tts_ajax.text_to_speech_voice );
			text_to_speech_val.pitch      = qcld_tts_ajax.text_to_speech_pitch;
			text_to_speech_val.rate       = qcld_tts_ajax.text_to_speech_rate;
			text_to_speech_val.volume     = qcld_tts_ajax.text_to_speech_volume;

			if( currentDoom.hasClass("qcld_floating_text_to_speech_loud") ){
				currentDoom.remove("qcld_floating_text_to_speech_loud"); 
				window.speechSynthesis.pause();
			} else {
				currentDoom.addClass("qcld_floating_text_to_speech_loud"); 
				window.speechSynthesis.speak(text_to_speech_val);
			}  
			var synth = window.speechSynthesis;

			refreshIntervalId = setInterval(function(){
				displayHello(synth, currentDoom)
			}, 500);

    
        });


		function displayHello(synth, currentDoom) {
			if (!synth.speaking) {
				var qcld_floating_text_to_buttons = currentDoom;
				currentDoom.removeClass("qcld_floating_text_to_speech_loud"); 
				clearInterval(refreshIntervalId);
			}
		}



    });

} ( jQuery ) );