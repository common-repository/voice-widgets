<?php
defined('ABSPATH') or die("You can't access this file directly.");

?>
<div class="wrap swpm-admin-menu-wrap">
    <div class="vmwpmdp-admin-panel">
      <h2><?php echo esc_html__('Voice Addon Settings Page', 'qcld-wp-voice' ); ?></h2>
    </div>
	
    <?php $action = 'edit.php?post_type=wp_voicemsg_record&page=wpvoice_speech_to_text'; 

    $datasss = get_option('qc_voice_to_speech_stt_allow_voice_control');

    ?>
    <div class="qcld-accordion-box">
        <form  action="<?php echo esc_attr(admin_url($action)); ?>" method="POST" enctype="multipart/form-data">


			<div class="wppt-settings-section text_to_speech_wrap">
				<table class="form-table">

					<tr valign="top">
						<th scope="row"><?php echo esc_html__('Enable Speech To Text ', 'qcld-wp-voice' ); ?></th>
						<td>
							<input type="checkbox" name="qc_voice_to_speech_stt_allow_control" value="on" <?php echo (esc_attr( get_option('qc_voice_to_speech_stt_allow_control') )=='on'?'checked="checked"':''); ?> />
							<i><?php echo esc_html__('Select this option to enable Speech to Text on your voice widgets', 'qcld-wp-voice' ); ?></i>
						</td>
					</tr>

					<tr valign="top">
						<th scope="row"><?php echo esc_html__('Google Project ID', 'qcld-wp-voice' ); ?></th>
						<td>
							<input type="text" name="qc_voice_to_speech_stt_project_id" value="<?php echo get_option('qc_voice_to_speech_stt_project_id'); ?>" />
                            <br>
							<i><?php echo esc_html__('Google project ID.', 'qcld-wp-voice' ); ?> <?php echo esc_html__('Please see this article', 'qcld-wp-voice' ); ?> <a href="<?php echo esc_url('https://dev.quantumcloud.com/wpbot-pro/wpbot-voice-addon-google-api-setup/'); ?>" target="_blank"> <?php echo esc_html__('Voice Addon Google API Setup', 'qcld-wp-voice' ); ?></a></i>
						</td>
					</tr>
					
					<tr valign="top">
						<th scope="row"><?php echo esc_html__('Private Key', 'qcld-wp-voice' ); ?></th>
						<td>
                            <textarea name="qc_voice_to_speech_stt_private_key" rows="10" cols="100">
                                <?php echo esc_attr( get_option('qc_voice_to_speech_stt_private_key') ); ?>
                            </textarea>
                            <br>
							<i><?php echo esc_html__('Private key for the google service account', 'qcld-wp-voice' ); ?> <?php echo esc_html__('Please see this article', 'qcld-wp-voice' ); ?> <a href="<?php echo esc_url('https://dev.dna88.com/voice-widgets/voice-widgets-addon-google-api-setup/'); ?>" target="_blank"><?php echo esc_html__('Voice Addon Google API Setup', 'qcld-wp-voice' ); ?></a></i>
						</td>
					</tr>
					
					<tr valign="top">
						<th scope="row"><?php echo esc_html__('Language Name', 'qcld-wp-voice' ); ?></th>
						<td>
							<input type="text" name="qc_voice_to_speech_stt_lang_name" value="<?php echo ( get_option('qc_voice_to_speech_stt_lang_name') != '' ? get_option('qc_voice_to_speech_stt_lang_name') : 'en-US-Standard-A' ); ?>" />
                            <br>
							<i><?php echo esc_html__('See all supported Language Code here:', 'qcld-wp-voice' ); ?> <a href="<?php echo esc_url('https://cloud.google.com/text-to-speech/docs/voices'); ?>" target="_blank"><?php echo esc_attr__('https://cloud.google.com/text-to-speech/docs/voices', 'qcld-wp-voice' ); ?></a>. <?php echo esc_html__('Leave empty for default', 'qcld-wp-voice' ); ?> <?php echo esc_attr__(' en-US-Standard-A.', 'qcld-wp-voice' ); ?></i>
						</td>
					</tr>

					<tr valign="top">
						<th scope="row"><?php echo esc_html__('Language Code', 'qcld-wp-voice' ); ?></th>
						<td>
							<input type="text" name="qc_voice_to_speech_stt_lang_code" value="<?php echo ( get_option('qc_voice_to_speech_stt_lang_code') != '' ? get_option('qc_voice_to_speech_stt_lang_code') : 'en-US' ); ?>" />
                            <br>
							<i><?php echo esc_html__('See all supported Language Code here:', 'qcld-wp-voice' ); ?> <a href="<?php echo esc_url('https://cloud.google.com/text-to-speech/docs/voices'); ?>" target="_blank"><?php echo esc_attr__('https://cloud.google.com/text-to-speech/docs/voices', 'qcld-wp-voice' ); ?></a>. <?php echo esc_html__('Leave empty for default', 'qcld-wp-voice' ); ?> en-US.</i>
						</td>
					</tr>

					<tr valign="top">
						<th scope="row"><?php echo esc_html__('Use Shortcode', 'qcld-wp-voice' ); ?></th>
						<td>
							<input type="text" name="qc_voice_to_shortcode_code" value="[qcld_stt_form]" />
                            <br>
							<i><?php echo esc_html__('Paste this shortcode anywhere on a page where you want the STT button to show', 'qcld-wp-voice' ); ?> en-US.</i>
						</td>
					</tr>

				</table>
			</div>
			
			<?php submit_button(); ?>
            <?php wp_nonce_field('voice-speech-to-text'); ?>

		</form>
		
	</div>
</div>
