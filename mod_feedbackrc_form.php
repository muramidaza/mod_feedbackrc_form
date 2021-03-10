<?php defined('_JEXEC')  or die('Restricted access');

    $document = JFactory::getDocument();
    $document->addStyleSheet(JURI::base() . 'modules/mod_feedbackrc_form/css/bootstrap.min.css');

    // Если кнопка нажата, то отправить письмо
	if(isset($_POST['mod_feedbackrc_submitted'])) {

        // Проверяем, установлена и настроена ли капча
        if ($c_plugin = JFactory::getApplication()->getCfg('captcha'))
        {
            // Получаем ключ капчи
            $c_value = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : '';

            // Проверям пришел ли ключ капчи
            if(strlen($c_value) == 0) {
                // Показывает сообщение об ошибке из файла error_captcha.php
                require(JModuleHelper::getLayoutPath('mod_feedbackrc_form', 'error_captcha'));
                return false;
            }

            // Получаем объект капчи
            $captcha_obj = JCaptcha::getInstance($c_plugin);

            // Проверяем капчу
            if (!$captcha_obj->checkAnswer($c_value))
            {
                // Показывает сообщение об ошибке из файла error_captcha.php
                require(JModuleHelper::getLayoutPath('mod_feedbackrc_form', 'error_captcha'));
                return false;
            }
        }
	
		$name = isset($_POST['feedback_name']) ? $_POST['feedback_name'] : 'Не указано';
        $email = isset($_POST['feedback_email']) ? $_POST['feedback_email'] : 'Не указано';
        $title = isset($_POST['feedback_title']) ? $_POST['feedback_title'] : 'Не указано';
		$message = isset($_POST['feedback_message']) ? $_POST['feedback_message'] : 'Не указано';
     
        $name = strip_tags($name); 
        $email = strip_tags($email);
		$title = strip_tags($title);
        $message = strip_tags($message);
     
        $mail_body = "<h2>Текст сообщения:</h2>"; // Текст письма на почте
		$mail_body .= "<p><b>Имя:</b> $name</p>"; // Имя - если не заполнено, покажет "Не указано"
        $mail_body .= "<p><b>E-mail:</b> $email</p>"; // Телефон - если не заполнено, покажет "Не указано"
		$mail_body .= "<p><b>Тема:</b> $title</p>"; // Тема - если не заполнено, покажет "Не указано"
        $mail_body .= "<p>$message</p>"; // Сообщение - если не заполнено, покажет "Не указано"
     
        $headers= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=utf-8"; // кодировка ставится в зависимости от сервера: utf-8 или windows-1251
     
        // Отправляем письмо на указанный ящик с заголовком
        $send_mail = @mail($params['feedbackrc_email'], $params['feedbackrc_title'], $mail_body, $headers);
     
		// Отправляем письмо на второй ящик с заголовком если ящик был указан
		if($params['feedbackrc_emailsecond']) $send_mailsecond = @mail($params['feedbackrc_emailsecond'], $params['feedbackrc_title'], $mail_body, $headers);
		
		if($send_mail or $send_mailsecond) {
			// Показывает сообщение об успешной отправке из файла success.php
			require(JModuleHelper::getLayoutPath('mod_feedbackrc_form', 'success'));
		} else {
			// Показывает сообщение об ошибке из файла error.php
			require(JModuleHelper::getLayoutPath('mod_feedbackrc_form', 'error'));
		}
    }
    else { 
        // Если кнопка не нажата, то показывать стандартную форму из файла default.php
        require(JModuleHelper::getLayoutPath('mod_feedbackrc_form'));
    }
?>