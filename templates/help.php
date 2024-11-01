<?php
defined('ABSPATH') or die("No direct script access!");
?>
<div class="qc-voice-widgets-admin-panel">
  <h2><?php esc_html_e('Welcome to the Voice Widget for Contact Form 7', 'voice-widgets'); ?></h2>
  <h4><?php esc_html_e('Getting Started', 'voice-widgets'); ?></h4>
</div>
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
   