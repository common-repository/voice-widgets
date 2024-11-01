<?php

class Qcld_voice_audio_sttforms{

    public function __construct(){

        add_shortcode( 'qcld_stt_form', [ $this, 'qc_voice_stt_audio_shortcode' ] );

        add_action('wp_ajax_qc_wpvoicemessage_stt_voice_api_ajax', [ $this, 'qc_wpvoicemessage_stt_voice_api_ajax' ] );
        add_action('wp_ajax_nopriv_qc_wpvoicemessage_stt_voice_api_ajax', [ $this, 'qc_wpvoicemessage_stt_voice_api_ajax' ] );

    }

    public function qc_voice_stt_audio_shortcode( $atts = [] ) {

        $atts = shortcode_atts( [
            'id' => '',
            'title' => '',
            'name'  =>  ''
        ], $atts );

        /** Nothing to show without any parameters. */

        //if ( '' === $atts['id'] ) { return ''; }

        global $post;

        wp_enqueue_style( 'qc_audio_font_awesomess', QC_VOICEWIDGET_ASSETS_URL . 'css/font-awesome.min.css', false );
        wp_enqueue_style( 'qc-stt-frontend-css',  QC_VOICEWIDGET_ASSETS_URL . 'css/stt_frontend.css', false );

        wp_enqueue_script( 'qc-voice-widgets-recorders-js', QC_VOICEWIDGET_ASSETS_URL .  'audio/WebAudioRecorder.min.js', ['jquery'], QC_VOICEWIDGET_VERSION, true );

        wp_enqueue_script( 'qc-voice-stt-frontend-js', QC_VOICEWIDGET_ASSETS_URL .  'js/stt_frontend.js', ['jquery', 'qc-voice-widgets-recorders-js'], QC_VOICEWIDGET_VERSION, true );

        $qc_voice_stt_audio_lan_speak_now              =  get_option('qc_voice_stt_audio_lan_speak_now') ? get_option('qc_voice_stt_audio_lan_speak_now'): 'Speak now';
        $qc_voice_stt_audio_lan_stop_save              =  get_option('qc_voice_stt_audio_lan_stop_save')?get_option('qc_voice_stt_audio_lan_stop_save'):'Stop & Save';
        $qc_voice_stt_audio_lan_canvas_not_available   =  get_option('qc_voice_stt_audio_lan_canvas_not_available')?get_option('qc_voice_stt_audio_lan_canvas_not_available'):'Canvas not available.';
        $qc_voice_stt_audio_lan_please_wait            =  get_option('qc_voice_stt_audio_lan_please_wait') ? get_option('qc_voice_stt_audio_lan_please_wait'): 'Please wait while proccsing your request.';
        $convert_recorded_audio                     =  'wav';

        $qc_voice_stt_obj = array(
            'ajax_url'          => admin_url('admin-ajax.php'),
            'capture_duration'  => (get_option('stt_sound_duration') && get_option('stt_sound_duration') != '' ? MINUTE_IN_SECONDS * get_option('stt_sound_duration') : MINUTE_IN_SECONDS * 10 ),
            'post_id'                                   => isset( $post->ID ) ? $post->ID : 0,
            'qc_voice_stt_audio_lan_speak_now'             => $qc_voice_stt_audio_lan_speak_now,
            'qc_voice_stt_audio_lan_stop_save'             => $qc_voice_stt_audio_lan_stop_save,
            'qc_voice_stt_audio_lan_canvas_not_available'  => $qc_voice_stt_audio_lan_canvas_not_available,
            'qc_voice_stt_audio_lan_please_wait'           => $qc_voice_stt_audio_lan_please_wait,
            'QC_VOICEWIDGET_ASSETS_URL'                 => QC_VOICEWIDGET_ASSETS_URL.'audio/',
            'convert_recorded_audio'                    => $convert_recorded_audio,
        );

        wp_localize_script('qc-voice-stt-frontend-js', 'qc_voice_stt_obj', $qc_voice_stt_obj);

        ob_start();

        $qc_voice_stt_audio_lan_record_audio   =  get_option('qc_voice_stt_audio_lan_record_audio');

        ?>
        <div class="qc_voice_stt_audio_wrapper">
            <div class="qc_voice_stt_audio_container">
                <div class="qc_voice_stt_audio_upload_main" id="qc_voice_stt_main">
                    <a class="qc_voice_stt_audio_record_button" id="qc_voice_stt_audio_record" href="#">
                        <span class="dashicons dashicons-microphone"></span> <?php esc_html_e( $qc_voice_stt_audio_lan_record_audio, 'voice-widgets' ); ?></a> 
                </div>

                <div class="qc_voice_stt_audio_recorder" id="qc_voice_stt_audio_recorder" style="display:none">

                </div>
                <div class="qc_voice_stt_audio_display" id="qc_voice_stt_audio_display"  style="display:none">
                    <!-- <audio id="qc-audio" controls src=""></audio> -->
                    <span title="Remove and back to main upload screen." class="qc_voice_stt_remove_btn fa fa-trash"></span>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();

    }

    public function qc_wpvoicemessage_stt_voice_api_ajax(){

        require QC_VOICEWIDGET_PLUGIN_DIR . 'vendor/autoload.php';

        $projectId  = get_option('qc_voice_to_speech_stt_project_id');
        $fileName   = $_FILES["audio_data"]["tmp_name"];
        $language   = ( get_option('qc_voice_to_speech_stt_lang_code') != '' ? get_option('qc_voice_to_speech_stt_lang_code') : 'en-US' );


        // change these variables if necessary
        $encoding           = Google\Cloud\Speech\V1\RecognitionConfig\AudioEncoding::LINEAR16;
        $sampleRateHertz    = 32000;
       // $sampleRateHertz    = 8000;
        $languageCode       = $language;

        // get contents of a file into a string
        $content = file_get_contents( $fileName );

        // set string as audio content
        $audio = (new Google\Cloud\Speech\V1\RecognitionAudio())
            ->setContent($content);

        // set config
        $config = (new Google\Cloud\Speech\V1\RecognitionConfig())
            ->setEncoding($encoding)
            ->setLanguageCode($languageCode)
            ->setEnableAutomaticPunctuation(true);

        // create the speech client
        $client = new Google\Cloud\Speech\V1\SpeechClient(['credentials' => json_decode(get_option('qc_voice_to_speech_stt_private_key'), true)]);

        // make the API call
        $apiresponse    = $client->recognize($config, $audio);
        $results        = $apiresponse->getResults();

        //var_dump( $results );
        //wp_die();

        $response['status']         = 'success';
        $response['message']        = 'Data Not Found!';
        if( !empty($results)){
            foreach ($results as $result) {
                $response['status'] = 'success';
                $alternatives       = $result->getAlternatives();
                $mostLikely         = $alternatives[0];
                $transcript         = $mostLikely->getTranscript();
                $confidence         = $mostLikely->getConfidence();
                $response['message']=  $transcript;
                echo json_encode($response);
                die();
            }

        }
        echo json_encode($response);
        die();
    }


}


new Qcld_voice_audio_sttforms();




