<div class="container-fluid">
    <div class="row">
        <div class="card col-12">
            <div class="card-body">

                <!-- Заголовок -->
                <div class="card-title">
                    <h3><?php echo $params['feedback_title_form']?></h3>
                </div>

                <form method="POST">

                    <!-- Имя пользователя -->
                    <div class="form-group">
                        <label for="name" class="control-label">Введите ваше ФИО:</label>
                        <input
                            type="text"
                            id="name"
                            name="feedback_name"
                            class="form-control"
                            required="required"
                            value=""
                            placeholder="Например, Иван Иванович"
                            minlength="2"
                            maxlength="30"
                            style="font-size: 1.3rem; height: 2.5rem"
                        >
                    </div>

                    <!-- Email пользователя -->
                    <div class="form-group">
                        <label for="email" class="control-label">Введите адрес email:</label>
                        <input
                            type="email"
                            id="email"
                            name="feedback_email"
                            class="form-control"
                            required="required"
                            value=""
                            placeholder="Например, ivan@mail.ru"
                            maxlength="30"
                            style="font-size: 1.3rem; height: 2.5rem"
                        >
                    </div>

                    <!-- Тема сообщения -->
                    <div class="form-group">
                        <label for="title" class="control-label">Введите тему сообщения</label>
                        <input
                            type="text"
                            id="title"
                            name="feedback_title"
                            class="form-control"
                            required="required"
                            value=""
                            placeholder="Например, отзыв"
                            minlength="2"
                            maxlength="30"
                            style="font-size: 1.3rem; height: 2.5rem"
                        >
                    </div>

                    <!-- Сообщение пользователя -->
                    <div class="form-group" >
                        <label for="message" class="control-label">Введите сообщение:</label>
                        <textarea
                            id="message"
                            name="feedback_message"
                            class="form-control"
                            rows="5"
                            placeholder="Ваше сообщение"
                            minlength="10"
                            maxlength="500"
                            required="required"
                            style="font-size: 1.3rem; height: 2.5rem"
                        ></textarea>
                    </div>

                    <hr>

                    <?php

                        $captcha_field_html = '';

                        if ( $c_plugin = JFactory::getApplication()->getCfg('captcha'))
                        {
                            $captcha_obj = JCaptcha::getInstance($c_plugin, array('namespace' => 'mod_feedbackrc_form'));
                            $captcha_field_html = $captcha_obj ? $captcha_obj->display('captcha_field_name', 'captcha_tag_id', ' captcha_outer_class ') : '';
                        }

                        echo $captcha_field_html;

                    ?>

                    <hr>

                    <input
                        type="submit"
                        value="Отправить сообщение"
                        class="btn btn-info"
                        name="mod_feedbackrc_submitted"
                        style="font-size: 1.3rem"
                    />

                </form>

            </div>
        </div>
    </div>
</div>