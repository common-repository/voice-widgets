/** Run jQuery scripts */
( function ( $ ) {

    "use strict";

    /** Document Ready. */
    $( document ).ready( function () {

        const text_to_speech_voice = voice_obj.text_to_speech_voice;
        
        const voiceInEl = document.getElementById('text_to_speech_voice');
        const pitchInEl = document.getElementById('text_to_speech_pitch');
        const rateInEl = document.getElementById('text_to_speech_rate');
        const volumeInEl = document.getElementById('text_to_speech_volume');
        const pitchOutEl = document.querySelector('output[for="text_to_speech_pitch"]');
        const rateOutEl = document.querySelector('output[for="text_to_speech_rate"]');
        const volumeOutEl = document.querySelector('output[for="text_to_speech_volume"]');


        // add UI event handlers
        pitchInEl.addEventListener('change', qcld_updateOutputs );
        rateInEl.addEventListener('change', qcld_updateOutputs );
        volumeInEl.addEventListener('change', qcld_updateOutputs );

        // update voices immediately and whenever they are loaded
        qcld_updateVoices();
        window.speechSynthesis.onvoiceschanged = qcld_updateVoices;

        function qcld_updateOutputs() {
          // display current values of all range inputs
          pitchOutEl.textContent  = pitchInEl.value;
          rateOutEl.textContent   = rateInEl.value;
          volumeOutEl.textContent = volumeInEl.value;
        }

        function qcld_updateVoices() {

          // Fetch the available voices in English US.
          let voices = speechSynthesis.getVoices();
          $("#text_to_speech_voice").empty();
          voices.forEach(function(voice, i) {
            const $option = $("<option>");
            $option.val(voice.name);
            $option.text(voice.name + " (" + voice.lang + ")");
            $option.prop("selected", voice.name === text_to_speech_voice );
            $("#text_to_speech_voice").append($option);
          });

        }


        //Exclude pages to load 
        if($("input[type=radio][name='qcld_page_call_text_to_speech_show_pages']:checked").val()=='off'){
            $('#qcld_page_call_text_to_speech-show-pages-list').show('slow');
        }else{
            $('#qcld_page_call_text_to_speech-show-pages-list').hide('slow');
        }
        //on change.
        $('.qcld_page_call_text_to_speech-show-pages').on('change',function (e) {
            if( $(this).val()=='off'){
                $('#qcld_page_call_text_to_speech-show-pages-list').show('slow');
            }else{
                $('#qcld_page_call_text_to_speech-show-pages-list').hide('slow');
            }
        });

        //Exclude custom post to load 
        if($("input[type=radio][name='qcld_page_call_text_to_speech_show_custom_post']:checked").val()=='off'){
            $('#qcld_page_call_text_to_speech-show-custom_post-list').show('slow');
        }else{
            $('#qcld_page_call_text_to_speech-show-custom_post-list').hide('slow');
        }
        //on change.
        $('.qcld_page_call_text_to_speech-show-custom_post').on('change',function (e) {
            if( $(this).val()=='off'){
                $('#qcld_page_call_text_to_speech-show-custom_post-list').show('slow');
            }else{
                $('#qcld_page_call_text_to_speech-show-custom_post-list').hide('slow');
            }
        });


        //Exclude paages to load 
        if($("input[type=radio][name='text_to_speech_show_pages']:checked").val()=='off'){
            $('#text_to_speech-show-pages-list').show('slow');
        }else{
            $('#text_to_speech-show-pages-list').hide('slow');
        }
        //on change.
        $('.text_to_speech-show-pages').on('change',function (e) {
            if( $(this).val()=='off'){
                $('#text_to_speech-show-pages-list').show('slow');
            }else{
                $('#text_to_speech-show-pages-list').hide('slow');
            }
        });

        
        $('.text_to_speech-bg-color').wpColorPicker();


    });

} ( jQuery ) );