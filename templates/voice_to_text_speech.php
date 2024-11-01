<?php
defined('ABSPATH') or die("You can't access this file directly.");

wp_enqueue_style( 'wp-color-picker' );

wp_enqueue_script( 'qc-voice-text-to-sheech', QC_VOICEWIDGET_ASSETS_URL . '/js/voice-text-to-sheech.js', ['jquery', 'wp-color-picker'], false, true );

$voice_obj = array(
    'ajax_url'              => admin_url('admin-ajax.php'),
    'capture_duration'      => (get_option('stt_sound_duration')    && get_option('stt_sound_duration')     != '' ? get_option('stt_sound_duration') : MINUTE_IN_SECONDS * 10 ),
    'text_to_speech_pitch'  => (get_option('text_to_speech_pitch')  && get_option('text_to_speech_pitch')   != '' ? get_option('text_to_speech_pitch') : 1 ),
    'text_to_speech_rate'   => (get_option('text_to_speech_rate')   && get_option('text_to_speech_rate')    != '' ? get_option('text_to_speech_rate') : 1 ),
    'text_to_speech_volume' => (get_option('text_to_speech_volume') && get_option('text_to_speech_volume')  != '' ? get_option('text_to_speech_volume') : 1 ),
    'text_to_speech_voice'  => (get_option('text_to_speech_voice')  && get_option('text_to_speech_voice')   != '' ? get_option('text_to_speech_voice') : '' ),
);
wp_localize_script('qc-voice-text-to-sheech', 'voice_obj', $voice_obj);


$text_to_speech_palyer_position = get_option('text_to_speech_palyer_position');

?>
<div class="wrap">
    <div class="vmwpmdp-admin-panel">
      <h2><?php esc_html_e( 'Welcome to the Voice Text Speech', 'qcld-wp-voice' ); ?></h2>
    </div>
    <div class="qcld-accordion-box">
        <?php $action = 'edit.php?post_type=wp_voicemsg_record&page=wpvoice_to_text_speech'; ?>
        <form  action="<?php echo esc_attr($action); ?>" method="POST" enctype="multipart/form-data">
            <div class="text_to_speech_wrap">
                <h2><?php esc_html_e( 'Voice Text To Speech Settings', 'qcld-wp-voice' ); ?></h2>
                <table class="form-table">
                    <tbody>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e( 'Enable Voice Text Speech', 'qcld-wp-voice' ); ?></th>
                            <td>
                                <input type="checkbox" name="text_to_speech_enable" size="100" value="<?php echo (get_option('text_to_speech_enable')!=''? esc_attr( get_option('text_to_speech_enable')) : '1' ); ?>" <?php echo (get_option('text_to_speech_enable') == '' ? esc_attr( get_option('text_to_speech_enable')): esc_attr( 'checked="checked"' )); ?>>  
                                <i><?php esc_html_e( 'Select this option to enable Text to Speech on your website', 'qcld-wp-voice' ); ?></i>                         
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e( 'Voice:', 'qcld-wp-voice' ); ?></th>
                            <td>
                                <select id="text_to_speech_voice" name="text_to_speech_voice"></select>
                                <div></div>                        
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e( 'Pitch:', 'qcld-wp-voice' ); ?></th>
                            <td>
                                <input id="text_to_speech_pitch" name="text_to_speech_pitch" type="range" min="0.1" max="2" step="0.1" value="<?php echo (get_option('text_to_speech_pitch')!=''? esc_attr( get_option('text_to_speech_pitch')) : 1 ); ?>">
                                <output for="text_to_speech_pitch"><?php echo (get_option('text_to_speech_pitch')!=''? esc_attr( get_option('text_to_speech_pitch')) : 1 ); ?></output>  
                                <!-- <i><?php esc_html_e( 'If you enable this option Voice Text Speech', 'qcld-wp-voice' ); ?></i>   -->                       
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e( 'Rate:', 'qcld-wp-voice' ); ?></th>
                            <td>
                                <input id="text_to_speech_rate" name="text_to_speech_rate" type="range" min="0.1" max="2" step="0.1" value="<?php echo (get_option('text_to_speech_rate')!=''? esc_attr( get_option('text_to_speech_rate')) : 1 ); ?>">
                                <output for="text_to_speech_rate"><?php echo (get_option('text_to_speech_rate')!=''? esc_attr( get_option('text_to_speech_rate')) : 1 ); ?></output>
                                <!-- <i><?php esc_html_e( 'If you enable this option Voice Text Speech', 'qcld-wp-voice' ); ?></i>    -->                      
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e( 'Volume:', 'qcld-wp-voice' ); ?></th>
                            <td>
                                <input id="text_to_speech_volume" name="text_to_speech_volume" type="range" min="0" max="1" step="0.1" value="<?php echo (get_option('text_to_speech_volume')!=''? esc_attr( get_option('text_to_speech_volume')) : 1 ); ?>">
                                <output for="text_to_speech_volume"><?php echo (get_option('text_to_speech_volume')!=''? esc_attr( get_option('text_to_speech_volume')) : 1 ); ?></output>
                                <!-- <i><?php esc_html_e( 'If you enable this option Voice Text Speech', 'qcld-wp-voice' ); ?></i>   -->                       
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e( 'Button Text', 'qcld-wp-voice' ); ?></th>
                            <td>
                                <input type="text" name="text_to_speech_btn_text" size="30" value="<?php echo (get_option('text_to_speech_btn_text')!=''? esc_attr( get_option('text_to_speech_btn_text')) : 'Listen To This' ); ?>">
                                <br><br><i><?php esc_html_e( 'You can change the Button Text from here.', 'qcld-wp-voice' ); ?></i>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e( 'Player Postion', 'qcld-wp-voice' ); ?></th>
                            <td>
                                <select id="text_to_speech_palyer_position" name="text_to_speech_palyer_position">
                                    <option value=""><?php esc_html_e( 'Select Position', 'qcld-wp-voice' ); ?></option>
                                    <!-- <option value="<?php esc_attr_e( 'top_fixed', 'qcld-wp-voice' ); ?>" <?php selected( $text_to_speech_palyer_position, 'top_fixed' ); ?> ><?php esc_html_e( 'Top Fixed', 'qcld-wp-voice' ); ?></option>
                                    <option value="<?php esc_attr_e( 'bottom_fixed', 'qcld-wp-voice' ); ?>" <?php selected( $text_to_speech_palyer_position, 'bottom_fixed' ); ?> ><?php esc_html_e( 'Bottom Fixed', 'qcld-wp-voice' ); ?></option> -->
                                    <option value="<?php esc_attr_e( 'before_title', 'qcld-wp-voice' ); ?>" <?php selected( $text_to_speech_palyer_position, 'before_title' ); ?> ><?php esc_html_e( 'Before Title', 'qcld-wp-voice' ); ?></option>
                                    <option value="<?php esc_attr_e( 'after_title', 'qcld-wp-voice' ); ?>" <?php selected( $text_to_speech_palyer_position, 'after_title' ); ?> ><?php esc_html_e( 'After Title', 'qcld-wp-voice' ); ?></option>
                                    <option value="<?php esc_attr_e( 'before_content', 'qcld-wp-voice' ); ?>" <?php selected( $text_to_speech_palyer_position, 'before_content' ); ?> ><?php esc_html_e( 'Before Content', 'qcld-wp-voice' ); ?></option>
                                    <option value="<?php esc_attr_e( 'after_content', 'qcld-wp-voice' ); ?>" <?php selected( $text_to_speech_palyer_position, 'after_content' ); ?> ><?php esc_html_e( 'After Content', 'qcld-wp-voice' ); ?></option>
                                </select>  

                            </td>
                        </tr>
                        <tr valign="top" class="qcld-wp-voice-page">
                            <th scope="row"><?php esc_html_e( 'Show on  Pages', 'qcld-wp-voice' ); ?></th>
                            <td>
                                <label class="radio-inline">
                                    <input class="qcld_page_call_text_to_speech-show-pages" type="radio"
                                           name="qcld_page_call_text_to_speech_show_pages"
                                           value="on" <?php echo esc_attr(get_option('qcld_page_call_text_to_speech_show_pages') !== 'off' ? 'checked' : ''); ?>>
                                     <?php  esc_html_e( 'All Pages', 'qcld-wp-voice' ); ?>
                                </label>
                                <label class="radio-inline">
                                    <input class="qcld_page_call_text_to_speech-show-pages" type="radio"
                                           name="qcld_page_call_text_to_speech_show_pages"
                                           value="off" <?php echo(get_option('qcld_page_call_text_to_speech_show_pages') == 'off' ? 'checked' : ''); ?>>
                                    <?php  esc_html_e( 'Selected Pages Only', 'qcld-wp-voice' ); ?></label>
                                <div id="qcld_page_call_text_to_speech-show-pages-list">
                                    <ul class="checkbox-list">
                                        <?php
                                        $qcld_page_call_text_to_speech_pages = get_pages();
                                        $qcld_page_call_text_to_speech_select_pages = unserialize(get_option('qcld_page_call_text_to_speech_show_pages_list'));
                                        if(empty($qcld_page_call_text_to_speech_select_pages)){
                                         $qcld_page_call_text_to_speech_select_pages = array();
                                        }
                                        foreach ($qcld_page_call_text_to_speech_pages as $qcld_page_call_text_to_speech_page) {
                                            ?>
                                            <li>
                                                <input id="qcld_page_call_text_to_speech_show_page_<?php echo $qcld_page_call_text_to_speech_page->ID; ?>"
                                                       type="checkbox"
                                                       name="qcld_page_call_text_to_speech_show_pages_list[]"
                                                       value="<?php echo esc_attr($qcld_page_call_text_to_speech_page->ID); ?>" <?php echo(in_array($qcld_page_call_text_to_speech_page->ID, $qcld_page_call_text_to_speech_select_pages) == true ? 'checked' : ''); ?> >
                                                <label for="qcld_page_call_text_to_speech_show_page_<?php echo $qcld_page_call_text_to_speech_page->ID; ?>"> <?php echo esc_html($qcld_page_call_text_to_speech_page->post_title); ?></label>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>                 
                            </td>
                        </tr>
                        <tr valign="top" class="qcld-wp-voice-page">
                            <th scope="row"><?php esc_html_e( 'Show on Blog Posts', 'qcld-wp-voice' ); ?></th>
                            <td>
                                <label class="radio-inline">
                                    <input class="qcld_page_call_text_to_speech-show-blog_posts" type="radio"
                                           name="qcld_page_call_text_to_speech_show_blog_posts"
                                           value="on" <?php echo esc_attr(get_option('qcld_page_call_text_to_speech_show_blog_posts') !== 'off' ? 'checked' : ''); ?>>
                                     <?php  esc_html_e( 'YES', 'qcld-wp-voice' ); ?>
                                </label>
                                <label class="radio-inline">
                                    <input class="qcld_page_call_text_to_speech-show-blog_posts" type="radio"
                                           name="qcld_page_call_text_to_speech_show_blog_posts"
                                           value="off" <?php echo(get_option('qcld_page_call_text_to_speech_show_blog_posts') == 'off' ? 'checked' : ''); ?>>
                                    <?php  esc_html_e( 'NO', 'qcld-wp-voice' ); ?></label>                
                            </td>
                        </tr>
                        <tr valign="top" class="qcld-wp-voice-page">
                            <th scope="row"><?php esc_html_e( 'Show on Custom Post types', 'qcld-wp-voice' ); ?> </th>
                            <td>
                                <label class="radio-inline">
                                    <input class="qcld_page_call_text_to_speech-show-custom_post" type="radio"
                                           name="qcld_page_call_text_to_speech_show_custom_post"
                                           value="on" <?php echo esc_attr(get_option('qcld_page_call_text_to_speech_show_custom_post') !== 'off' ? 'checked' : ''); ?> disabled>
                                     <?php  esc_html_e( 'None', 'qcld-wp-voice' ); ?>
                                </label>
                                <label class="radio-inline">
                                    <input class="qcld_page_call_text_to_speech-show-custom_post" type="radio"
                                           name="qcld_page_call_text_to_speech_show_custom_post"
                                           value="off" <?php echo(get_option('qcld_page_call_text_to_speech_show_custom_post') == 'off' ? 'checked' : ''); ?> disabled>
                                    <?php  esc_html_e( 'Select Custom Post Types', 'qcld-wp-voice' ); ?> <strong class="text_to_speech-pro-alert"> ( <?php esc_html_e( 'Pro Feature', 'qcld-wp-voice' ); ?> ) </strong></label>
                                <div id="qcld_page_call_text_to_speech-show-custom_post-list">
                                    <ul class="checkbox-list">
                                        <?php

                                        $args = array(
                                                   'public'   => true,
                                                   '_builtin' => false,
                                                );

                                        $output = 'names'; // names or objects
                                        $operator = 'and'; // 'and' or 'or'

                                        $qcld_custom_posts = get_post_types( $args, $output, $operator );

                                        $qcld_page_call_text_to_speech_disable_custom_post = get_pages();
                                        $qcld_disable_custom_posts = unserialize(get_option('qcld_page_call_text_to_speech_disable_custom_post_list'));




                                        if(empty($qcld_disable_custom_posts)){
                                         $qcld_disable_custom_posts = array();
                                        }
                                        foreach ($qcld_custom_posts as $qcld_page_call_text_to_speech_custom_post ) {
                                            ?>
                                            <li>
                                                <input id="qcld_page_call_text_to_speech_show_page_<?php echo $qcld_page_call_text_to_speech_custom_post; ?>"
                                                       type="checkbox"
                                                       name="qcld_page_call_text_to_speech_disable_custom_post_list[]"
                                                       value="<?php echo esc_attr($qcld_page_call_text_to_speech_custom_post); ?>" <?php echo(in_array($qcld_page_call_text_to_speech_custom_post, $qcld_disable_custom_posts) == true ? 'checked' : ''); ?> disabled>
                                                <label for="qcld_page_call_text_to_speech_show_page_<?php echo $qcld_page_call_text_to_speech_custom_post; ?>"> <?php echo esc_html($qcld_page_call_text_to_speech_custom_post); ?></label>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>                 
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e( 'Content Code Shortcode:', 'qcld-wp-voice' ); ?></th>
                            <td>
                                <input type="text" name="text_to_speech_text" size="100" value='[wp_button_voice btn_text="Listen to this" ]'>
                                <br><br><i><?php esc_html_e( 'Use this shortcode anywhere on your page to show the Text to Speech button. Parameter: btn_text="Listen to this"', 'qcld-wp-voice' ); ?></i>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e( '"Listen to this" Shortcode:', 'qcld-wp-voice' ); ?></th>
                            <td>
                                <input type="text" name="text_to_speech_text" size="150" value='[wp_button_text_to_speech buttontext="Play" buttonstop="stop" buttonposition="after" ] your expected text here [/wp_button_text_to_speech]'>
                                <br><br><i><?php esc_html_e( 'Use this shortcode to wrap any text you want the Text to Speech for. Parameter: buttontext="Play", buttonstop="stop", buttonposition="before" or buttonposition="after"', 'qcld-wp-voice' ); ?></i>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e( 'Voice Box Shortcode:', 'qcld-wp-voice' ); ?></th>
                            <td>
                                <input type="text" name="text_to_speech_text" size="100" value='[wp_button_voice_box buttontext="Play"]'>
                                <br><br><i><?php esc_html_e( 'Parameter: buttontext="Play"', 'qcld-wp-voice' ); ?></i>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e( 'Background Color:', 'qcld-wp-voice' ); ?></th>
                            <td>
                                
                                <input type="text" name="text_to_speech_background_color"
                                       value="<?php echo get_option('text_to_speech_background_color'); ?>"
                                       class="text_to_speech-bg-color">
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e( 'Background Hover Color:', 'qcld-wp-voice' ); ?></th>
                            <td>
                                
                                <input type="text" name="text_to_speech_bg_hover_color"
                                       value="<?php echo get_option('text_to_speech_bg_hover_color'); ?>"
                                       class="text_to_speech-bg-color">
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e( 'Text Color:', 'qcld-wp-voice' ); ?></th>
                            <td>
                                
                                <input type="text" name="text_to_speech_font_color"
                                       value="<?php echo get_option('text_to_speech_font_color'); ?>"
                                       class="text_to_speech-bg-color">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="text_to_speech_wrap">
                <h2><?php esc_html_e( 'Voice Text To Speech Floating Button Settings', 'qcld-wp-voice' ); ?> <strong class="text_to_speech-pro-alert"> ( <?php esc_html_e( 'Pro Feature', 'qcld-wp-voice' ); ?> ) </strong></h2>
                <table class="form-table">
                    <tbody>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e( 'Enable Floating Button', 'qcld-wp-voice' ); ?></th>
                            <td>
                                <input type="checkbox" name="text_to_speech_enable_floating_btn" size="100" value="<?php echo (get_option('text_to_speech_enable_floating_btn')!=''? esc_attr( get_option('text_to_speech_enable_floating_btn')) : '1' ); ?>" <?php echo (get_option('text_to_speech_enable_floating_btn') == '' ? esc_attr( get_option('text_to_speech_enable')): esc_attr( 'checked="checked"' )); ?> disabled> <i><?php esc_html_e( 'If you enable this option Voice Text Speech Floating Button', 'qcld-wp-voice' ); ?></i>                         
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e( 'Show on Home Page', 'qcld-wp-voice' ); ?></th>
                            <td>
                                <label class="radio-inline">
                                    <input id="text_to_speech-show-home-page" type="radio" name="text_to_speech_show_home_page" value="on" <?php echo esc_attr(get_option('text_to_speech_show_home_page') == 'on' ? 'checked' : ''); ?> disabled>
                                    <?php  esc_html_e( 'YES', 'qcld-wp-voice' ); ?>
                                </label>

                                <label class="radio-inline">
                                    <input id="text_to_speech-show-home-page" type="radio" name="text_to_speech_show_home_page" value="off" <?php echo esc_attr(get_option('text_to_speech_show_home_page') == 'off' ? 'checked' : ''); ?> disabled>
                                    <?php  esc_html_e( 'NO', 'qcld-wp-voice' ); ?>
                                </label>                     
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e( 'Show on Blog Posts', 'qcld-wp-voice' ); ?></th>
                            <td>

                                <label class="radio-inline">
                                    <input class="text_to_speech-show-posts" type="radio" name="text_to_speech_show_posts" value="on" <?php echo esc_attr(get_option('text_to_speech_show_posts') == 'on' ? 'checked' : ''); ?> disabled>
                                    <?php  esc_html_e( 'YES', 'qcld-wp-voice' ); ?>
                                </label>

                                <label class="radio-inline">
                                    <input class="text_to_speech-show-posts" type="radio" name="text_to_speech_show_posts" value="off" <?php echo esc_attr(get_option('text_to_speech_show_posts') == 'off' ? 'checked' : ''); ?> disabled>
                                    <?php  esc_html_e( 'NO', 'qcld-wp-voice' ); ?>
                                </label>                  
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e( 'Show on  Pages', 'qcld-wp-voice' ); ?></th>
                            <td>
                                <label class="radio-inline">
                                    <input class="text_to_speech-show-pages" type="radio" name="text_to_speech_show_pages" value="on" <?php echo esc_attr(get_option('text_to_speech_show_pages') == 'on' ? 'checked' : ''); ?> disabled>
                                     <?php  esc_html_e( 'All Pages', 'qcld-wp-voice' ); ?>
                                </label>
                                <label class="radio-inline">
                                    <input class="text_to_speech-show-pages" type="radio" name="text_to_speech_show_pages" value="off" <?php echo(get_option('text_to_speech_show_pages') == 'off' ? 'checked' : ''); ?> disabled>
                                    <?php  esc_html_e( 'Selected Pages Only', 'qcld-wp-voice' ); ?></label>              
                            </td>
                        </tr>
                        <tr valign="top" class="qcld-wp-voice-page">
                            <th scope="row"><?php esc_html_e( 'Show on Custom Post types', 'qcld-wp-voice' ); ?> </th>
                            <td>
                                <label class="radio-inline">
                                    <input class="text_to_speech-show-custom_post" type="radio"
                                           name="text_to_speech_show_custom_post"
                                           value="on" <?php echo esc_attr(get_option('text_to_speech_show_custom_post') !== 'off' ? 'checked' : ''); ?> disabled>
                                     <?php  esc_html_e( 'None', 'qcld-wp-voice' ); ?>
                                </label>
                                <label class="radio-inline">
                                    <input class="text_to_speech-show-custom_post" type="radio"
                                           name="text_to_speech_show_custom_post"
                                           value="off" <?php echo(get_option('text_to_speech_show_custom_post') == 'off' ? 'checked' : ''); ?> disabled>
                                    <?php  esc_html_e( 'Select Custom Post Types', 'qcld-wp-voice' ); ?></label>
                                           
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e( 'Listen To This', 'qcld-wp-voice' ); ?></th>
                            <td>
                                <input type="text" name="floating_text_to_speech_btn_text" size="30" value="Listen To This" disabled>
                                <br><br><i><?php esc_html_e( 'You can change the Button Text from here.', 'qcld-wp-voice' ); ?></i>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e( 'Stop to Listen', 'qcld-wp-voice' ); ?></th>
                            <td>
                                <input type="text" name="floating_text_to_speech_btn_text_stop" size="30" value="Stop Listening" disabled>
                                <br><br><i><?php esc_html_e( 'You can change the Button Text from here.', 'qcld-wp-voice' ); ?></i>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e( 'Background Color:', 'qcld-wp-voice' ); ?></th>
                            <td>
                                <input type="text" name="text_to_speech_floating_bg_color"
                                       value="<?php echo get_option('text_to_speech_floating_bg_color'); ?>"
                                       class="text_to_speech-bg-color" disabled>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e( 'Background Hover Color:', 'qcld-wp-voice' ); ?></th>
                            <td>
                                <input type="text" name="text_to_speech_floating_bg_hover_color"
                                       value="<?php echo get_option('text_to_speech_floating_bg_hover_color'); ?>"
                                       class="text_to_speech-bg-color" disabled>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <table class="form-table">
                <tbody>
                    
                    <tr valign="top">
                        <th scope="row"><input type="submit" class="button button-primary" name="submit" id="submit" value="<?php _e('Save Settings', 'qcld-wp-voice'); ?>"/></th>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <?php wp_nonce_field('voice-to-text-speech'); ?>
        </form>


    </div>
</div>

 

 