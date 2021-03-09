<div class="container-fluid">
    <div class="row">

        <div class="card col-12">

            <div class="card-body">

                <!-- Заголовок контейнера -->
                <div class="card-title">
                    <h3><?php echo $params['feedback_title_form']?></h3>
                </div>

                <!-- Форма обратной связи -->
                <form method="POST">

                    <!-- Имя пользователя -->
                    <div class="form-group">
                        <label for="name" class="control-label">Введите ваше ФИО:</label>
                        <input type="text" id="name" name="feedback_name" class="form-control" required="required" value="" placeholder="Например, Иван Иванович" minlength="2" maxlength="30">
                    </div>

                    <!-- Email пользователя -->
                    <div class="form-group">
                        <label for="email" class="control-label">Введите адрес email:</label>
                        <input type="email" id="email" name="feedback_email" class="form-control" required="required"  value="" placeholder="Например, ivan@mail.ru" maxlength="30">
                    </div>

                    <!-- Тема сообщения -->
                    <div class="form-group">
                        <label for="title" class="control-label">Введите тему сообщения</label>
                        <input type="text" id="title" name="feedback_title" class="form-control" required="required" value="" placeholder="Например, отзыв" minlength="2" maxlength="30">
                    </div>

                    <!-- Сообщение пользователя -->
                    <div class="form-group" >
                        <label for="message" class="control-label">Введите сообщение:</label>
                        <textarea id="message" class="form-control" rows="7" placeholder="Введите сообщение" minlength="20" maxlength="500" required="required"></textarea>
                    </div>

                    <hr>

                    <div class="form-group">
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
                    </div>

                    <hr>

                    <input type="submit" value="Отправить сообщение" class="btn btn-info" name="mod_feedback_submitted" />

                </form><!-- Конец формы -->
            </div>
        </div>
    </div>
</div>