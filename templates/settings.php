<?php
defined('ABSPATH') or die("No direct script access!");



?>

  <div class="wrap swpm-admin-menu-wrap" id="tabs">
    <div class="qc-voice-widgets-admin-panel">
      <h2><?php esc_html_e('Welcome to the Voice Widget for Contact Form 7', 'voice-widgets'); ?></h2>
      <h4><?php esc_html_e('Getting Started', 'voice-widgets'); ?></h4>
    </div>
  
    <ul class="nav-tab-wrapper qc_voice_nav_container">
      <li style="margin-bottom:0px"><a class="nav-tab qc_voice_click_handle nav-tab-active" href="#tab-1"><?php esc_html_e('General Settings','voice-widgets') ?></a></li>
      <li style="margin-bottom:0px"><a class="nav-tab qc_voice_click_handle" href="#tab-2"><?php esc_html_e('Help','voice-widgets') ?></a></li>
    </ul>

    <div id="tab-1">

      <form method="post" action="options.php">
      <?php settings_fields( 'qc-voice-widgets-settings-group' ); ?>
      <?php do_settings_sections( 'qc-voice-widgets-settings-group' ); ?>
      <div id="tab-1">
        <table class="form-table">
          <tr valign="top">
            <th scope="row"><?php esc_html_e('Record Audio','voice-widgets') ?></th>
            <td>
              <input type="text" name="qc_voice_widget_lan_record_audio" size="100" value="<?php echo (get_option('qc_voice_widget_lan_record_audio')!=''?esc_attr( get_option('qc_voice_widget_lan_record_audio')):'Record Audio'); ?>"  />
              <br><br><i><?php esc_html_e('You can change the text as your needs.','voice-widgets') ?></i>
            </td>
          </tr>
          <tr valign="top">
            <th scope="row"><?php esc_html_e('Speak now','voice-widgets') ?></th>
            <td>
              <input type="text" name="qc_voice_widget_lan_speak_now" size="100" value="<?php echo (get_option('qc_voice_widget_lan_speak_now')!=''?esc_attr( get_option('qc_voice_widget_lan_speak_now')):'Speak now'); ?>"  />
              <br><br><i><?php esc_html_e('You can change the text as your needs.','voice-widgets') ?></i>
            </td>
          </tr>
          <tr valign="top">
            <th scope="row"><?php esc_html_e('Stop & Save','voice-widgets') ?></th>
            <td>
              <input type="text" name="qc_voice_widget_lan_stop_save" size="100" value="<?php echo (get_option('qc_voice_widget_lan_stop_save')!=''?esc_attr( get_option('qc_voice_widget_lan_stop_save')):'Stop & Save'); ?>"  />
              <br><br><i><?php esc_html_e('You can change the text as your needs.','voice-widgets') ?></i>
            </td>
          </tr>
          <tr valign="top">
            <th scope="row"><?php esc_html_e('Canvas not available','voice-widgets') ?></th>
            <td>
              <input type="text" name="qc_voice_widget_lan_canvas_not_available" size="100" value="<?php echo (get_option('qc_voice_widget_lan_canvas_not_available')!=''?esc_attr( get_option('qc_voice_widget_lan_canvas_not_available')):'Canvas not available'); ?>"  />
              <br><br><i><?php esc_html_e('You can change the text as your needs.','voice-widgets') ?></i>
            </td>
          </tr>
          <tr valign="top">
            <th scope="row"><?php esc_html_e('Please wait while proccsing your request','voice-widgets') ?></th>
            <td>
              <input type="text" name="qc_voice_widget_lan_please_wait" size="100" value="<?php echo (get_option('qc_voice_widget_lan_please_wait')!=''?esc_attr( get_option('qc_voice_widget_lan_please_wait')):'Please wait while proccsing your request.'); ?>"  />
              <br><br><i><?php esc_html_e('You can change the text as your needs.','voice-widgets') ?></i>
            </td>
          </tr>
          <tr valign="top">
            <th scope="row"><?php esc_html_e('Save Audio as','voice-widgets') ?></th>
            <td>
              <select name="convert_recorded_audio">
                <option value=""> <?php esc_html_e('Default (.mp3)','voice-widgets') ?> </option>
                <option value="mp3" <?php echo ( get_option('convert_recorded_audio') =='mp3'? esc_attr( 'selected' ) : '' ); ?> > <?php esc_html_e('MP3 (MPEG-1 Audio Layer III) (.mp3)','voice-widgets') ?> </option>
                <option value="wav" <?php echo ( get_option('convert_recorded_audio') =='wav'? esc_attr( 'selected' ) : '' ); ?> > <?php esc_html_e('Waveform Audio (.wav)','voice-widgets') ?> </option>
                <option value="ogg" <?php echo ( get_option('convert_recorded_audio') =='ogg'? esc_attr( 'selected' ) : '' ); ?> > <?php esc_html_e('Ogg Vorbis (.ogg)','voice-widgets') ?> </option>
              </select>
              <br><br><i><?php esc_html_e('You can change Audio format','voice-widgets') ?></i>
            </td>
          </tr>
          <tr valign="top">
            <th scope="row"><?php esc_html_e('Max Record Duration','voice-widgets') ?></th>
            <td>
              <input type="number" name="stt_sound_duration" size="100" value="<?php echo ( get_option('stt_sound_duration') !='' ? esc_attr( get_option('stt_sound_duration')) : 1 ); ?>"  />  <?php esc_html_e('Minute','voice-widgets') ?>
              <br><br><i><?php esc_html_e('You can change Max Record Duration as your needs. If Empty, Default 10 minutes','voice-widgets') ?></i>
            </td>
          </tr>
          <tr valign="top">
              <th scope="row"><?php esc_html_e( 'Audio Record Zapier Webhook', 'qcld-wp-voice' ); ?></th>
              <td>
                  <input type="checkbox" name="voice_cf7_enable_audio_webhooks" size="100" value="<?php echo (get_option('voice_cf7_enable_audio_webhooks')!=''? esc_attr( get_option('voice_cf7_enable_audio_webhooks')) : '1' ); ?>" <?php echo (get_option('voice_cf7_enable_audio_webhooks') == '' ? esc_attr( get_option('voice_cf7_enable_audio_webhooks')): esc_attr( 'checked="checked"' )); ?>>  
                  <i><?php esc_html_e( 'Audio Record Zapier Webhooks, Send CF7 mail as usually', 'qcld-wp-voice' ); ?></i>                         
              </td>
          </tr>

        </table>
      </div>
      
      <?php submit_button(); ?>

    </form>
</div>
<div id="tab-2">
<div class="qc-voice-widgets-accordion">

  <div class="qc-voice-widgets-accordion-item">
    <input type="checkbox" id="accordion2">
    <label for="accordion2" class="qc-voice-widgets-accordion-item-title"><span class="icon"></span><?php esc_html_e('How can I enter voice message field to my contact forms?', 'voice-widgets'); ?></label>
    <div class="qc-voice-widgets-accordion-item-desc">
        <?php esc_html_e('Navigate to Contact form 7->Add/Edit a form in wp-admin and Press the Voice Message button to insert shortcode in the form.', 'voice-widgets'); ?><br><br>
        <img src="<?php echo esc_url( QC_VOICEWIDGET_ASSETS_URL . 'images/screenshot-1.jpg' );?>"/>
    </div>
  </div>

  <div class="qc-voice-widgets-accordion-item">
    <input type="checkbox" id="accordion3">
    <label for="accordion3" class="qc-voice-widgets-accordion-item-title"><span class="icon"></span><?php esc_html_e('How can I set voice field with Contact from 7 email  setting?', 'voice-widgets'); ?></label>
    <div class="qc-voice-widgets-accordion-item-desc">
        <?php esc_html_e('Navigate to Contact form 7->Add/Edit. Select the Mail tab and add [qcwpvoicemessage] this shortcode with your mail body.', 'voice-widgets'); ?><br><br>
        <img src="<?php echo esc_url( QC_VOICEWIDGET_ASSETS_URL .  'images/screenshot-2.png' );?>"/> 
    </div>
  </div>

  <div class="qc-voice-widgets-accordion-item">
    <input type="checkbox" id="accordion4">
    <label for="accordion4" class="qc-voice-widgets-accordion-item-title"><span class="icon"></span><?php esc_html_e('Where Can I Listen to my Voice Message?', 'voice-widgets'); ?></label>
    <div class="qc-voice-widgets-accordion-item-desc">
     <?php esc_html_e('If a user records a voice message, you will receive a link in the email sent by Contact Form 7.  In the Pro Version, the voice messages can be accessed from a sub menu of voice widgets', 'voice-widgets'); ?>
    </div>
  </div>

  <div class="qc-voice-widgets-accordion-item">
    <input type="checkbox" id="accordion5">
    <label for="accordion5" class="qc-voice-widgets-accordion-item-title"><span class="icon"></span><?php esc_html_e('I received a email but not voice message?', 'voice-widgets'); ?></label>
    <div class="qc-voice-widgets-accordion-item-desc">
    <?php esc_html_e('Make sure you add this [qcwpvoicemessage] shortcode to your contact form 7 mail body. Then if a user records a voice message, you will receive a link in the email sent by Contact Form 7', 'voice-widgets'); ?>
    </div>
  </div>
   
    <div class="qc-voice-widgets-accordion-item">
        <input type="checkbox" id="accordion12">
        <label for="accordion12" class="qc-voice-widgets-accordion-item-title"><span class="icon"></span><?php esc_html_e( 'How can I use CF7 Audio Record with Zapier Webhook', 'voice-widgets' ); ?> </label>
        <div class="qc-voice-widgets-accordion-item-desc">
            <p><?php esc_html_e( 'You can use Zapier Webhook with', 'voice-widgets' ); ?> <a href="<?php echo esc_url('https://wordpress.org/plugins/cf7-to-zapier/'); ?>" target="_blank"><?php esc_html_e( 'CF7 to Webhook', 'voice-widgets' ); ?></a> <?php esc_html_e( 'plugin', 'voice-widgets' ); ?></p>
            <p><strong><?php esc_html_e( 'Please install CF7 to Webhook plugin and following below step', 'voice-widgets' ); ?></strong></p>
            <h4><?php esc_html_e( 'STEP 1', 'voice-widgets' ); ?></h4>
             <?php esc_html_e( 'Enable Audio Record Zapier Webhook from Voice Widgets -> Settings', 'voice-widgets' ); ?>
            <br>
            <br>
            <img src="<?php echo esc_url( QC_VOICEWIDGET_ASSETS_URL . 'images/webhook/webhook-settings.png'); ?>">
            <h4><?php esc_html_e( 'STEP 2', 'voice-widgets' ); ?></h4>
            <?php esc_html_e( 'Set Special Mail Tags Field with', 'voice-widgets' ); ?>  <?php esc_attr_e( '[qcwpvoicemessage]', 'voice-widgets' ); ?>
            <br>
            <br>
            <img src="<?php echo esc_url( QC_VOICEWIDGET_ASSETS_URL . 'images/webhook/webhook-settings-1.png'); ?>">
      </div>
    </div>

</div>
</div>
</div>
   