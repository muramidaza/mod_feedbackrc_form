<div id="connect_form">
	<form method="POST">

		<div style="font-size: 11px; font-weight: bold; color: #949494;">
			<?php echo $params['feedback_title_form']?>
		</div>
 
		<input type="text" name="feedback_name" placeholder="Ваше имя" required='required' />
		<br>
		
		<input type="email" name="feedback_email" placeholder="Ваш e-mail" required='required' />
		<br>
		
		<input type="text" name="feedback_title" placeholder="Тема сообщения" required='required' />
		<br>
		
		<textarea name="feedback_form_messenge" placeholder="Сообщение"></textarea>
		<hr>
		
		<?php 
		
			$captcha_field_html = '';

			// Use configured captcha plugin
			if ( $c_plugin = JFactory::getApplication()->getCfg('captcha'))
			{
				// Try to load the configured captcha plugin, (check if disabled or uninstalled)
				// Joomla will enqueue an error message if needed
				$captcha_obj = JCaptcha::getInstance($c_plugin, array('namespace' => 'mod_feedbackrc_form'));
			 
				$captcha_field_html = $captcha_obj ? $captcha_obj->display('captcha_field_name', 'captcha_tag_id', ' captcha_outer_class ') : '';
			}
			
			echo $captcha_field_html;
		?>
		
		<hr>
		
		<input type="submit" value="Отправить сообщение" name="mod_feedback_submitted" />
 
	</form>
</div>
	
	