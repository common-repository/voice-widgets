<?php 
defined('ABSPATH') or die("You can't access this file directly.");


add_action('wp_enqueue_scripts', 'qcld_add_voice_to_speech_listen_floating_button_enqueue_scripts');
if ( ! function_exists( 'qcld_add_voice_to_speech_listen_floating_button_enqueue_scripts' ) ) {
    function qcld_add_voice_to_speech_listen_floating_button_enqueue_scripts() {

        wp_enqueue_style( 'qc-voice-text-to-sheech-frontend-css', QC_VOICEWIDGET_ASSETS_URL . '/css/voice-text-to-sheech-frontend.css' );
        wp_enqueue_script( 'qc-voice-text-to-sheech-frontend', QC_VOICEWIDGET_ASSETS_URL . '/js/voice-text-to-sheech-frontend.js', ['jquery'], false, true );

        $text_to_speech_pitch  = (get_option('text_to_speech_pitch')  && get_option('text_to_speech_pitch')   != '' ? get_option('text_to_speech_pitch') : 1 );
        $text_to_speech_rate   = (get_option('text_to_speech_rate')   && get_option('text_to_speech_rate')    != '' ? get_option('text_to_speech_rate') : 1 );
        $text_to_speech_volume = (get_option('text_to_speech_volume') && get_option('text_to_speech_volume')  != '' ? get_option('text_to_speech_volume') : 1 );
        $text_to_speech_voice  = (get_option('text_to_speech_voice')  && get_option('text_to_speech_voice')   != '' ? esc_js(get_option('text_to_speech_voice')) : 'Microsoft David - English (United States)' );

        $floating_btn_text      = (get_option('floating_text_to_speech_btn_text')  && get_option('floating_text_to_speech_btn_text')   != '' ? esc_js(get_option('floating_text_to_speech_btn_text')) : 'Listen To This' );
        $floating_btn_text_stop  = (get_option('floating_text_to_speech_btn_text_stop')  && get_option('floating_text_to_speech_btn_text_stop')   != '' ? esc_js(get_option('floating_text_to_speech_btn_text_stop')) : 'Stop Listening' );

        $qcld_tts_ajax = array(
            'text_to_speech_pitch'      => $text_to_speech_pitch,
            'text_to_speech_rate'       => $text_to_speech_rate,
            'text_to_speech_volume'     => $text_to_speech_volume,
            'text_to_speech_voice'      => $text_to_speech_voice,
            'floating_btn_text'         => $floating_btn_text,
            'floating_btn_text_stop'    => $floating_btn_text_stop
        );
        wp_localize_script( 'qc-voice-text-to-sheech-frontend', 'qcld_tts_ajax', $qcld_tts_ajax );



        $style_color        = "";
        $bg_color           = (get_option('text_to_speech_floating_bg_color')  && get_option('text_to_speech_floating_bg_color')   != '' ? esc_attr(get_option('text_to_speech_floating_bg_color')) : '' );

        if( !empty( $bg_color ) ){
            $style_color        .= " .qcld_floating_text_to_speech_button { background-color:". $bg_color." !important; }";
        }

        $bg_hover_color         = (get_option('text_to_speech_floating_bg_hover_color')  && get_option('text_to_speech_floating_bg_hover_color')   != '' ? esc_attr(get_option('text_to_speech_floating_bg_hover_color')) : '' );

        if( !empty( $bg_hover_color ) ){
            $style_color        .= ".qcld_floating_text_to_speech_button.qcld_floating_text_to_speech_loud, .qcld_floating_text_to_speech_button:hover { background-color:". $bg_hover_color." !important; }";
        }

        $text_to_speech_background_color     = (get_option('text_to_speech_background_color')  && get_option('text_to_speech_background_color')   != '' ? esc_attr(get_option('text_to_speech_background_color')) : '' );

        if( !empty( $text_to_speech_background_color ) ){
            $style_color        .= ".wp_button_text_to_speech-buttons, .wp_button_text_to_speech-button, .qcld_playbutton { background-color:". $text_to_speech_background_color." !important; }";
        }

        $text_to_speech_bg_hover_color     = (get_option('text_to_speech_bg_hover_color')  && get_option('text_to_speech_bg_hover_color')   != '' ? esc_attr(get_option('text_to_speech_bg_hover_color')) : '' );

        if( !empty( $text_to_speech_bg_hover_color ) ){
            $style_color        .= ".wp_button_text_to_speech-buttons:hover, .wp_button_text_to_speech-button:hover, .qcld_playbutton:hover { background-color:". $text_to_speech_bg_hover_color." !important; }";
        }

        $text_to_speech_font_color           = (get_option('text_to_speech_font_color')  && get_option('text_to_speech_font_color')   != '' ? esc_attr(get_option('text_to_speech_font_color')) : '' );

        if( !empty( $text_to_speech_font_color ) ){
            $style_color        .= ".wp_button_text_to_speech-buttons, .wp_button_text_to_speech-button, .qcld_playbutton { color:". $text_to_speech_font_color." !important; }";
        }

        wp_add_inline_style( 'qc-voice-text-to-sheech-frontend-css',  $style_color );

        

    }

}

// BBCode shortcodes
add_shortcode('wp_button_text_to_speech', 'wpvoicemessage_add_voice_to_speech_listen_callback');
add_shortcode('Wp_Button_Text_To_Speech', 'wpvoicemessage_add_voice_to_speech_listen_callback');

// Voicebox shortcodes
add_shortcode('wp_button_voice_box', 'wpvoicemessage_add_voice_to_speech_voice_box_callback');
add_shortcode('WpButtonVoiceBox', 'wpvoicemessage_add_voice_to_speech_voice_box_callback');
add_shortcode('WpTextBox', 'wpvoicemessage_add_voice_to_speech_voice_box_callback');

// "Listen to this" shortcodes
add_shortcode('wp_button_voice', 'qcld_add_voice_to_speech_listen_button');
add_shortcode('wpButtonListenToPost', 'qcld_add_voice_to_speech_listen_button');
add_shortcode('wpButtonListen', 'qcld_add_voice_to_speech_listen_button');

if ( ! function_exists( 'qcld_add_voice_to_speech_listen_button' ) ) {
    function qcld_add_voice_to_speech_listen_button( $attributes ) {

        static $id_voice_to_text_btn = 0;
        $id_voice_to_text_btn++;

        $text_to_speech_content = get_the_content();
        $text_to_speech_content = apply_filters('wpvoicemessage_text_to_speech_content_before_cleaning', $text_to_speech_content );
        $text_to_speech_content = wpvoicemessage_add_voice_to_speech_clean_text( $text_to_speech_content );
        $text_to_speech_content = apply_filters('wpvoicemessage_text_to_speech_content_after_cleaning', $text_to_speech_content );

        extract( shortcode_atts( array(
            'voice'      => 'Microsoft David - English (United States)',
            'btn_text'   => 'Listen to this'
        ), $attributes) );

        // Sanitize attributes
        $voice                      = esc_js( $voice );
        $text_to_speech_btn_text    = esc_js( $btn_text );


        $text_to_speech_pitch  = (get_option('text_to_speech_pitch')  && get_option('text_to_speech_pitch')   != '' ? get_option('text_to_speech_pitch') : 1 );
        $text_to_speech_rate   = (get_option('text_to_speech_rate')   && get_option('text_to_speech_rate')    != '' ? get_option('text_to_speech_rate') : 1 );
        $text_to_speech_volume = (get_option('text_to_speech_volume') && get_option('text_to_speech_volume')  != '' ? get_option('text_to_speech_volume') : 1 );
        $text_to_speech_voice  = (get_option('text_to_speech_voice')  && get_option('text_to_speech_voice')   != '' ? esc_js(get_option('text_to_speech_voice')) : $voice );
        

        $text_to_speech_speaker_icon = "&#128266;";
        // The script can be multiline, but the button should be in a single line, otherwise it can mess up a user's layout.
        $text_to_speech_button = '<button id="text_to_speech_' . $id_voice_to_text_btn . '" class="wp_button_text_to_speech-buttons" type="button" value="Play" title="Tap to Start/Stop Speech"><span>' . $text_to_speech_speaker_icon . ' ' . $text_to_speech_btn_text . '</span></button>';
        

        return $text_to_speech_button;

    }
}


if ( ! function_exists( 'wpvoicemessage_add_voice_to_speech_listen_callback' ) ) {
    function wpvoicemessage_add_voice_to_speech_listen_callback( $attributes, $content = "" ) {

        static $id_voice_to_text_btn = 0;
        $id_voice_to_text_btn++;

        $text_to_speech_content = apply_filters('wpvoicemessage_text_to_speech_content_before_cleaning', $content);
        $text_to_speech_content = wpvoicemessage_add_voice_to_speech_clean_text( $text_to_speech_content );
        $text_to_speech_content = apply_filters('wpvoicemessage_text_to_speech_content_after_cleaning', $text_to_speech_content);

        extract(shortcode_atts(array(
            'voice'          => 'Microsoft David - English (United States)',
            'buttontext'     => 'Play',
            'buttonstop'     => 'Stop',
            'buttonposition' => 'before'
        ), $attributes));

        // Sanitize attributes
        $voice      = esc_js($voice);
        $buttontext = esc_js($buttontext);
        $buttonstop = esc_js($buttonstop);

        $text_to_speech_pitch  = (get_option('text_to_speech_pitch')  && get_option('text_to_speech_pitch')   != '' ? get_option('text_to_speech_pitch') : 1 );
        $text_to_speech_rate   = (get_option('text_to_speech_rate')   && get_option('text_to_speech_rate')    != '' ? get_option('text_to_speech_rate') : 1 );
        $text_to_speech_volume = (get_option('text_to_speech_volume') && get_option('text_to_speech_volume')  != '' ? get_option('text_to_speech_volume') : 1 );
        $text_to_speech_voice  = (get_option('text_to_speech_voice')  && get_option('text_to_speech_voice')   != '' ? esc_js(get_option('text_to_speech_voice')) : $voice );

        $text_to_speech_speaker_icon = "&#128266;";

        $voice_to_text_speech = '<div class="wp_button_text_to_speech_wrapper"><button id="id_voice_to_text_btn_' . $id_voice_to_text_btn . '" type="button" value="'.esc_attr($buttontext).'" btn-text="'.esc_attr($buttontext).'" btn-stop="'.esc_attr($buttonstop).'" class="wp_button_text_to_speech-button" data-content="'.esc_js( $text_to_speech_content ).'">' . $text_to_speech_speaker_icon . ' <span> ' . $buttontext . ' </span></button>'.esc_js($content).'</div>';

        return $buttonposition === 'after' ?  $voice_to_text_speech : $voice_to_text_speech;
    }
}

if ( ! function_exists( 'wpvoicemessage_add_voice_to_speech_clean_text' ) ) {
    function wpvoicemessage_add_voice_to_speech_clean_text( $text ) {

        $wpvoicemessage_voice_to_speech_quotation_marks = array(
            "'"       => "\'",
            '"'       => '\"',
            '&#8216;' => "\'",
            '&#8217;' => "\'",
            '&rsquo;' => "\'",
            '&lsquo;' => "\'",
            '&#8218;' => '',
            '&#8220;' => '\"',
            '&#8221;' => '\"',
            '&#8222;' => '\"',
            '&ldquo;' => '\"',
            '&rdquo;' => '\"',
            '&quot;'  => '\"',
        );

        $wpvoicemessage_voice_to_speech_other_marks = array(
            '&auml;'  => 'ä',
            '&Auml;'  => 'Ä',
            '&ouml;'  => 'ö',
            '&Ouml;'  => 'Ö',
            '&uuml;'  => 'ü',
            '&Uuml;'  => 'Ü',
            '&szlig;' => 'ß',
            '&euro;'  => '€',
            '&copy;'  => '©',
            '&trade;' => '™',
            '&reg;'   => '®',
            '&nbsp;'  => '',
            '&mdash;' => '—',
            '&amp;'   => '&',
            '&gt;'    => 'greater than',
            '&lt;'    => 'less than',
            '&#8211;' => '-',
            '&#8212;' => '—',
        );

        $text = strip_shortcodes($text);
        $text = wp_strip_all_tags($text, true);

        $text = str_replace(array_keys($wpvoicemessage_voice_to_speech_quotation_marks), array_values($wpvoicemessage_voice_to_speech_quotation_marks), $text);
        $text = str_replace(array_keys($wpvoicemessage_voice_to_speech_other_marks), array_values($wpvoicemessage_voice_to_speech_other_marks), $text);

        $text = preg_replace('/\\\\{2,}"/', '\"', $text);
        $text = preg_replace("/\\\\{2,}'/", "\'", $text);

        $text = preg_replace('/\s+/', ' ', trim($text));

        return $text;
    }
}


if ( ! function_exists( 'wpvoicemessage_add_voice_to_speech_voice_box_callback' ) ) {
    function wpvoicemessage_add_voice_to_speech_voice_box_callback(){

        $text_to_speech_pitch  = (get_option('text_to_speech_pitch')  && get_option('text_to_speech_pitch')   != '' ? get_option('text_to_speech_pitch') : 1 );
        $text_to_speech_rate   = (get_option('text_to_speech_rate')   && get_option('text_to_speech_rate')    != '' ? get_option('text_to_speech_rate') : 1 );
        $text_to_speech_volume = (get_option('text_to_speech_volume') && get_option('text_to_speech_volume')  != '' ? get_option('text_to_speech_volume') : 1 );
        $text_to_speech_voice  = (get_option('text_to_speech_voice')  && get_option('text_to_speech_voice')   != '' ? esc_js(get_option('text_to_speech_voice')) : 'Microsoft David - English (United States)' );

        $voiceBox = '
            <div style="float:left border: 1px solid #ffffff" id="voicetestdiv">
                <textarea style="-webkit-input-placeholder: color: #555;" placeholder="Paste or type-in a block of text." id="qcld_text_to_speech_content" cols="45" rows="3"></textarea>
                <br>
                <button id="qcld_playbutton" class="qcld_playbutton" type="button" value="Play">Play</button>
            </div>';

        return $voiceBox;
    }
}





if ( ! function_exists( 'qcld_add_voice_to_speech_with_position_content_callback' ) ) {
    function qcld_add_voice_to_speech_with_position_content_callback( $content ) {

        static $id_voice_to_text_btn = 0;
        $id_voice_to_text_btn++;

        $get_the_id = get_the_ID();

        if ( in_the_loop() && ! ( is_singular( ) ) ) { return $content; }

        $text_to_speech_content = get_the_content();
        $text_to_speech_content = apply_filters('wpvoicemessage_text_to_speech_content_before_cleaning', $text_to_speech_content );
        $text_to_speech_content = wpvoicemessage_add_voice_to_speech_clean_text( $text_to_speech_content );
        $text_to_speech_content = apply_filters('wpvoicemessage_text_to_speech_content_after_cleaning', $text_to_speech_content );

        // Sanitize attributes
        $voice                      = esc_js( 'Microsoft David - English (United States)' );
        $text_to_speech_btn_text    = get_option('text_to_speech_btn_text'); 


        $text_to_speech_pitch  = (get_option('text_to_speech_pitch')  && get_option('text_to_speech_pitch')   != '' ? get_option('text_to_speech_pitch') : 1 );
        $text_to_speech_rate   = (get_option('text_to_speech_rate')   && get_option('text_to_speech_rate')    != '' ? get_option('text_to_speech_rate') : 1 );
        $text_to_speech_volume = (get_option('text_to_speech_volume') && get_option('text_to_speech_volume')  != '' ? get_option('text_to_speech_volume') : 1 );
        $text_to_speech_voice  = (get_option('text_to_speech_voice')  && get_option('text_to_speech_voice')   != '' ? esc_js(get_option('text_to_speech_voice')) : $voice );
        

        $text_to_speech_speaker_icon = "&#128266;";

        $text_to_speech_button = wp_sprintf( '<div class="qcld_floating_text_to_speech_boxs"><button id="qcld_content_text_to_speech_' . $id_voice_to_text_btn . '" class="wp_button_text_to_speech-buttons" type="button" value="Play" title="Tap to Start/Stop Speech"><span> %s  %s </span></button></div>',
            $text_to_speech_speaker_icon,
            $text_to_speech_btn_text,
            ''
        );

        if ( get_option('text_to_speech_enable') == 1 && qcld_page_position_text_to_speech_load_controlling() == true ) {


            $text_to_speech_palyer_position = get_option('text_to_speech_palyer_position');

            if( isset($text_to_speech_palyer_position ) && ( $text_to_speech_palyer_position == 'after_content' ) ){

                return $content . $text_to_speech_button;
                
            }else{

                return $text_to_speech_button . $content;
                
            }
        }

        return $content;

    }


}

if ( ! function_exists( 'qcld_add_voice_to_speech_with_position_title_callback' ) ) {
    function qcld_add_voice_to_speech_with_position_title_callback( $title, $id ) {

        static $id_voice_to_text_btn = 0;
        $id_voice_to_text_btn++;

        $get_the_id = get_the_ID();

        $post = get_post( $get_the_id );

        if ( in_the_loop() && ! ( is_singular( ) ) ) { return $title; }

        if ( is_archive() ) { return $title; }

        $text_to_speech_content = isset( $post->post_content ) ? trim( $post->post_content ) : '';
        $text_to_speech_content = apply_filters('wpvoicemessage_text_to_speech_content_before_cleaning', $text_to_speech_content );
        $text_to_speech_content = wpvoicemessage_add_voice_to_speech_clean_text( $text_to_speech_content );
        $text_to_speech_content = apply_filters('wpvoicemessage_text_to_speech_content_after_cleaning', $text_to_speech_content );

        // Sanitize attributes
        $voice                      = esc_js( 'Microsoft David - English (United States)' );
        $text_to_speech_btn_text    = get_option('text_to_speech_btn_text'); 

        $text_to_speech_pitch  = (get_option('text_to_speech_pitch')  && get_option('text_to_speech_pitch')   != '' ? get_option('text_to_speech_pitch') : 1 );
        $text_to_speech_rate   = (get_option('text_to_speech_rate')   && get_option('text_to_speech_rate')    != '' ? get_option('text_to_speech_rate') : 1 );
        $text_to_speech_volume = (get_option('text_to_speech_volume') && get_option('text_to_speech_volume')  != '' ? get_option('text_to_speech_volume') : 1 );
        $text_to_speech_voice  = (get_option('text_to_speech_voice')  && get_option('text_to_speech_voice')   != '' ? esc_js(get_option('text_to_speech_voice')) : $voice );
        
        $text_to_speech_speaker_icon = "&#128266;";

        $text_to_speech_button = wp_sprintf( '<div class="qcld_floating_text_to_speech_boxs"><button id="qcld_title_text_to_speech_%s" class="wp_button_text_to_speech-buttons" type="button" value="Play" title="Tap to Start/Stop Speech"><span> %s %s </span></button></div>',
            $get_the_id,
            $text_to_speech_speaker_icon,
            $text_to_speech_btn_text
        );

        if ( get_option('text_to_speech_enable') == 1 && qcld_page_position_text_to_speech_load_controlling() == true ) {

            $text_to_speech_palyer_position = get_option('text_to_speech_palyer_position');

            if( isset( $text_to_speech_palyer_position ) && ( $text_to_speech_palyer_position == 'before_title' ) ){

                return $text_to_speech_button . $title;

            }else{

                return $title . $text_to_speech_button;
                
            }

        }

        return $title;

    }


}

if ( ! function_exists( 'qcld_add_voice_to_speech_with_position_title_loop_start' ) ) {
    function qcld_add_voice_to_speech_with_position_title_loop_start() {
       add_filter( 'the_title', 'qcld_add_voice_to_speech_with_position_title_callback', 10, 2 );
    }
}


add_action( 'init', 'qcld_add_voice_to_speech_with_position_callback' );
if ( ! function_exists( 'qcld_add_voice_to_speech_with_position_callback' ) ) {
    function qcld_add_voice_to_speech_with_position_callback( $content ) {

        $text_to_speech_palyer_position = get_option('text_to_speech_palyer_position');

        switch ( $text_to_speech_palyer_position ) {

            case 'before_title':
            case 'after_title':
                add_action( 'loop_start', 'qcld_add_voice_to_speech_with_position_title_loop_start' );
                break;

            case 'before_content':
            case 'after_content':
                add_filter( 'the_content', 'qcld_add_voice_to_speech_with_position_content_callback' );
                break;

        }

    }

}


// Checking the floating button load controlling.
if ( ! function_exists( 'qcld_page_position_text_to_speech_load_controlling' ) ) {
    function qcld_page_position_text_to_speech_load_controlling(){
        $text_to_speech_load = false;

        if(get_option('qcld_page_call_text_to_speech_show_pages') == 'off' ){
            $text_to_speech_select_pages=unserialize(get_option('qcld_page_call_text_to_speech_show_pages_list'));
            if(is_page() && !empty($text_to_speech_select_pages) && !is_home() ){
                if(in_array(get_the_ID(), $text_to_speech_select_pages) == true){
                    $text_to_speech_load = true;
                }else{
                    $text_to_speech_load = false;
                }
            }
        }

        if(get_option('qcld_page_call_text_to_speech_show_pages') == 'on' ){
            $text_to_speech_load = true;
        }

        if( get_option('qcld_page_call_text_to_speech_show_blog_posts') == 'off' && 'post' == get_post_type() ){
            $text_to_speech_load = false;
        }

        if( get_option('qcld_page_call_text_to_speech_show_custom_post') !== 'off' ){

            if( is_single() && !is_home() && 'post' !== get_post_type() ){
                $text_to_speech_load = false;
            }

        }

        if( is_admin() ){
            $text_to_speech_load = false;
        }

        return $text_to_speech_load;

    }
}
