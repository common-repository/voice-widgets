document.addEventListener('DOMContentLoaded', function() {

  URL = window.URL || window.webkitURL; // webkitURL is deprecated but nevertheless
  let gumStream; // Stream from getUserMedia()
  let rec; // Recorder.js object
  let recorder; // Recorder.js object
  let input; // MediaStreamAudioSourceNode we'll be recording
  let AudioContext = window.AudioContext || window.webkitAudioContext;
  let audioContext;
  let audioBlob;
  let drawVisual;
  let draw;
  let timerInterval;
  let countdownInterval;
  let isTimerPaused = false;
  let isCountdownPaused = false;
  let form;
  let sampleRate;
  let encodeAfterRecord = true;
  let recordBtn = document.getElementById( 'qc_voice_stt_audio_record' );
  const cForm = recordBtn.parentNode.parentNode.parentNode;
  //const cForm = document.querySelectorAll( '.qc_voice_stt_audio_wrapper' ); // .main_record_div

  /** Start Recording Button */
  if ( recordBtn !== null ) {
    recordBtn.addEventListener( 'click', (event) => { startRecordingButtonClick(event, cForm ); } );
  }

        
  function addvoicecontainer(cForm){
    let html = '<div class="qc_voice_audio_addon_container qc_voice_stt_audio_record_div" role="alert">'+
                '<div class="qc_voice_audio_addon_wrapper">'+
                  '<div class="qc_voice_audio_animation">'+
                    '<h2>'+qc_voice_stt_obj.qc_voice_stt_audio_lan_speak_now+'</h2>'+
                    '<div class="voice_countdown"></div>'+
                    '<canvas width="384" height="60">'+
                      '<div>'+qc_voice_stt_obj.qc_voice_stt_audio_lan_canvas_not_available+'</div>'+
                    '</canvas>'+
                    '<p style="display:none">'+qc_voice_stt_obj.qc_voice_stt_audio_lan_please_wait+'</p>'+
                    '<button class="qc_voice_stt_audio_record_button" id="qc_voice_audio_stop">'+qc_voice_stt_obj.qc_voice_stt_audio_lan_stop_save+'</button>'+
                  '</div>'+
                  '<div class="wpbot_tts_wrapper"></div>'+
                '</div>'+
              '</div>';
    jQuery('#qc_voice_stt_audio_recorder').append(html);
    //console.log(cForm)
    //var body_playButton_after   = cForm.querySelector( '#qc_voice_stt_audio_recorder' );
    //body_playButton_afters.innerHTML     = html;

  }
  
  function startRecordingButtonClick(event, cForm ) {
      event.preventDefault();
      jQuery( '#qc_voice_stt_main' ).hide();
      jQuery( '.qc_voice_audio_addon_container' ).remove();

      addvoicecontainer(cForm);
      jQuery( '#qc_voice_stt_audio_recorder' ).show();

      var constraints_audio = {
            audio: true,
            video: false
        }

      navigator.mediaDevices.getUserMedia( constraints_audio ).then( function( stream ) {

          jQuery('.qc_voice_audio_addon_wrapper').removeAttr('style');
          jQuery('.qc_voice_audio_addon_wrapper').css("display","flex");
          jQuery('.voice_countdown').html('');
          jQuery('.voice_countdown').show();

          audioContext = new AudioContext();

          sampleRate = audioContext.sampleRate;

          /** Assign to gumStream for later use.  */
          gumStream = stream;

          /** Use the stream. */
          input = audioContext.createMediaStreamSource( stream );

          recorder = new WebAudioRecorder(input, {
            workerDir: qc_voice_stt_obj.QC_VOICEWIDGET_ASSETS_URL, // must end with slash
            encoding: qc_voice_stt_obj.convert_recorded_audio,
            numChannels:1, //2 is the default, mp3 encoding supports only 2
            onEncoderLoading: function(recorder, encoding) {
              // show "loading encoder..." display
              // __log("Loading "+encoding+" encoder...");
            },
            onEncoderLoaded: function(recorder, encoding) {
              // hide "loading encoder..." display
              // __log(encoding+" encoder loaded");
            }
          });

          recorder.onComplete = function(recorder, blob) { 
            //__log("Encoding complete");
            // createDownloadLink(blob,recorder.encoding);
            createPayer( blob, cForm )
            // encodingTypeSelect.disabled = false;
          }

          recorder.setOptions({
            timeLimit: qc_voice_stt_obj.capture_duration,
            encodeAfterRecord:encodeAfterRecord,
              ogg: {quality: 1},
              mp3: {bitRate: 48000}
            });

          // start the recording process
          recorder.startRecording();

          //  console.log( 'Recording started.' );
          createCountdown();
          /** Create Animation. */
          createAnimation( cForm );
          /** Create Timer. */
          createTimer( cForm );

      } ).catch( function( err ) {
          jQuery('.qc_voice_audio_addon_container').remove();
          /** Show Error if getUserMedia() fails. */
          console.log( 'Error connecting with Mic. Please check your Mic.', 'warn', true );
          console.log( err, 'error', true );
          alert( 'Error connecting with Mic. Please check your Mic' );


      } );

  }

  jQuery(document).on('click', '#qc_voice_audio_stop', function(e){
    e.preventDefault();
    /** Stop Recording. */
    //if ( rec.recording ) { rec.stop(); }
    //console.log( 'Recording stopped.' );

    /** Stop timer. */
    clearInterval( timerInterval );

    /** Stop countdown. */
    clearInterval( countdownInterval );

    /** Stop Animation. */
    window.cancelAnimationFrame( drawVisual );
    jQuery('.voice_countdown').hide();

    /** Stop microphone access. */
    gumStream.getAudioTracks()[0].stop();

    
    //tell the recorder to finish the recording (stop recording + encode the recorded audio)
    if ( recorder ) { recorder.finishRecording(); }

  })
  
  function createCountdown(){
    
   /* const countdownElement = document.querySelector( '.voice_countdown' );

    clearInterval( countdownInterval );
    let maxDuration = qc_voice_stt_obj.capture_duration;
    let countdown = qc_voice_stt_obj.capture_duration;
    isCountdownPaused = false;
    let resetMinutes = Math.floor( maxDuration / 60 );
    let resetSeconds = maxDuration - resetMinutes * 60;
    countdownElement.innerHTML = resetMinutes + ':' + resetSeconds;

    countdownInterval = setInterval( function () {

        if ( isCountdownPaused ) { return; } // Pause.

        countdown--;

        if ( maxDuration !== 0 && countdown < 0 ) {
          jQuery('#qc_voice_audio_stop').trigger('click');
        }

        let minutes = Math.floor( countdown / 60 );
        let seconds = countdown - minutes * 60;
        countdownElement.innerHTML = minutes + ':' + seconds;

    }, 1000 );*/

  }
  
  function createTimer( cForm ) {
    let timer = 0;
    let maxDuration = qc_voice_stt_obj.capture_duration;
    /** Reset previously timers. */
    clearInterval( timerInterval );
    isTimerPaused = false;
    /** Start new timer. */
    timerInterval = setInterval( function () {
        if ( isTimerPaused ) { return; } // Pause.
        timer++;
        /** If timer bigger than max-duration Stop recording. */
        if ( maxDuration !== 0 && timer > maxDuration ) {
            jQuery('#qc_voice_audio_stop').trigger('click');
        }
    }, 1000 );
  }
        
    /**
   * Create Animation.
   **/
  function createAnimation( cForm ) {

    jQuery('.qc_voice_audio_animation canvas').show();
    jQuery('.qc_voice_audio_animation h2').show();
    jQuery('#qc_voice_audio_stop').show();
    jQuery('.qc_voice_audio_animation p').hide();

      let analyser = audioContext.createAnalyser();

      /** Connect analyser to audio source. */
      input.connect( analyser );

      /** Array to receive the data from audio source. */
      analyser.fftSize = 2048;
      let bufferLength = analyser.frequencyBinCount;
      let dataArray = new Uint8Array( bufferLength );

      /** Canvas for animation. */
      let animation = document.querySelector( '.qc_voice_audio_animation canvas' );

      let animationCtx = animation.getContext( "2d" );

      /** Clear the canvas. */
      animationCtx.clearRect( 0, 0, animation.width, animation.height );

      draw = function() {

          /** Using requestAnimationFrame() to keep looping the drawing function once it has been started. */
          drawVisual = requestAnimationFrame( draw );

          /** Grab the time domain data and copy it into our array. */
          analyser.getByteTimeDomainData( dataArray );

          /** Fill the canvas with a solid colour to start. */
          animationCtx.clearRect( 0, 0, animation.width, animation.height ); // Clear the canvas.
          animationCtx.fillStyle = 'rgba( 255, 255, 255, 0.01 )'; // Almost transparent
          animationCtx.fillRect( 0, 0, animation.width, animation.height );

          /** Set a line width and stroke colour for the wave we will draw, then begin drawing a path. */
          animationCtx.lineWidth = 2;

          let startColor = '#0274e6';
          let endColor = '#0274e6';

          const gradient = animationCtx.createLinearGradient(0, 0, 384, 0);
          gradient.addColorStop( 0, startColor );
          gradient.addColorStop( .25 , endColor );
          gradient.addColorStop( .75 , endColor );
          gradient.addColorStop( 1, startColor );
          animationCtx.strokeStyle = gradient;

          animationCtx.beginPath();

          let sliceWidth = animation.width * 1.0 / bufferLength;
          let x = 0;

          for ( let i = 0; i < bufferLength; i++ ) {

              let v = dataArray[i] / 128.0;
              let y = v * animation.height/2;

              if ( i === 0 ) {
                  animationCtx.moveTo( x, y );
              } else {
                  animationCtx.lineTo( x, y );
              }

              x += sliceWidth;
          }

          animationCtx.lineTo( animation.width, animation.height/2 );
          animationCtx.stroke();
      };

      /** Call the draw() function to start off the whole process. */
      draw();

  }
        
  /**
   * Get recorded audio create player.
   **/
  function createPayer( blob, cForm ) {
    jQuery('.qc_voice_audio_animation h2').hide();
    jQuery('#qc_voice_audio_stop').hide();
    jQuery('.qc_voice_audio_animation canvas').hide();
    jQuery('.qc_voice_audio_animation p').show();
    jQuery( '#qc_voice_stt_audio_display' ).show();
    jQuery( '#qc_voice_stt_audio_recorder' ).hide();
    jQuery( '.qc_voice_stt_remove_btn' ).hide();
    jQuery( '.qc_voice_record_text' ).remove();

    var form_data = new FormData();  

    //console.log( cForm );

    var body_playButton_after   = cForm.querySelector( '.qc_voice_stt_audio_display' );
    var audio_recored           = document.createElement("div");
    audio_recored.innerHTML     = '';
    audio_recored.className     = "qc_voice_record_text";

    body_playButton_after.appendChild(audio_recored);
    var body_playButton_afters   = cForm.querySelector( '.qc_voice_record_text' );
    body_playButton_afters.innerHTML     = '<div class="qc_voice_record_text_animation"><span></span><span></span><span></span><span></span><span></span></div>';
    
    var form_data = new FormData();
    form_data.append("audio_data", blob);
    form_data.append("action", "qc_wpvoicemessage_stt_voice_api_ajax");
    jQuery.ajax({
    url: qc_voice_stt_obj.ajax_url,
    cache: false,
    contentType: false,
    processData: false,
    data: form_data, 
    type: 'post',
    success: function(response) {
        var obj = jQuery.parseJSON(response);
        jQuery( '.qc_voice_stt_remove_btn' ).show();
        if(obj.status == 'success'){
            //console.log('Done')
           var body_playButton_afters   = cForm.querySelector( '.qc_voice_record_text' );
           body_playButton_afters.innerHTML     = '';
           body_playButton_afters.innerHTML     = '<span>'+obj.message+'</span>';
        }else{
        // console.log(obj.status);
        }
    },
    error: function() {
        alert("An error occured, please try again.");   
    },
    timeout: 30000 // sets timeout to 30 seconds

    })


  }


  jQuery( '.qc_voice_stt_remove_btn' ).on( 'click', function(e) {
    e.preventDefault();
    jQuery( '#qc_voice_stt_audio_display' ).hide();
    jQuery( '#qc_voice_stt_main' ).show();
    jQuery('#qc_voice_stt_url').val( "" );

  });



});
