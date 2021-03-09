<?php defined('_JEXEC')  or die('Restricted access');
     
    // Если кнопка нажата, то отправить письмо
	if(isset($_POST['mod_feedback_submitted'])) {

        // Проверяем, установлена и настроена ли капча
        if ($c_plugin = JFactory::getApplication()->getCfg('captcha'))
        {
            // Получаем значение капчи
            $c_value = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : '';

            // Получаем объект капчи
            $captcha_obj = JCaptcha::getInstance($c_plugin);

            // Проверяем капчу

            $result = 0;
            if(strlen($c_value) > 0)
            {
                $result = $captcha_obj->checkAnswer($c_value);
            }

            if (!$result)
            {
                require(ModuleHelper::getLayoutPath('mod_feedbackrc_form', 'error_captcha'));
                return false;
            }
        }
	
		$name = isset($_POST['feedback_name']) ? $_POST['feedback_name'] : 'Не указано';
        $email = isset($_POST['feedback_email']) ? $_POST['feedback_email'] : 'Не указано';
        $title = isset($_POST['feedback_title']) ? $_POST['feedback_title'] : 'Не указано';
		$formmessenge = isset($_POST['feedback_form_messenge']) ? $_POST['feedback_form_messenge'] : 'Не указано';
     
        $name = strip_tags($name); 
        $email = strip_tags($email);
		$title = strip_tags($title);
        $formmessenge = strip_tags($formmessenge); 
     
        $message = "<h2>Текст сообщения:</h2>"; // Текст письма на почте
		$message .= "<p><b>Имя:</b> $name</p>"; // Имя - если не заполнено, покажет "Не указано"
        $message .= "<p><b>E-mail:</b> $email</p>"; // Телефон - если не заполнено, покажет "Не указано"
		$message .= "<p><b>Тема:</b> $title</p>"; // Тема - если не заполнено, покажет "Не указано"
        $message .= "<p>$formmessenge</p>"; // Сообщение - если не заполнено, покажет "Не указано"
     
        $headers= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=utf-8"; // кодировка ставится в зависимости от сервера: utf-8 или windows-1251
     
        // Отправляем письмо на указанный ящик с заголовком
        $send_mail = @mail($params['feedback-email'], $params['feedback_title'], $message, $headers);
     
		// Отправляем письмо на второй ящик с заголовком если ящик был указан
		if($params['feedback-emailsecond']) $send_mailsecond = @mail($params['feedback-emailsecond'], $params['feedback_title'], $message, $headers);
		
		if($send_mail or $send_mailsecond) {
			// Показывает сообщение об успешной отправке из файла success.php
			require(JModuleHelper::getLayoutPath('mod_feedbackrc_form', 'success'));
		} else {
			// Показывает сообщение об ошибке из файла error.php
			require(JModuleHelper::getLayoutPath('mod_feedbackrc_form', 'error'));
		}
    }
    else { 
        // Если кнопка НЕ нажата, то показывать стандартную форму из файла default.php
        require(JModuleHelper::getLayoutPath('mod_feedbackrc_form'));
    }
?>