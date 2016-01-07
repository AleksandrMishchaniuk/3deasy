<div id="rsb" class="panel">
    <form action="?controller=user&action=registration" method="POST">
        <div class="caption">Введите данные для регистрации</div>
        <input type="text" name="new_login" placeholder="Введите логин" value="<?php echo $login; ?>" title="Логин" required/><br/>
        <input type="password" name="new_pass1" placeholder="Введите пароль" value="<?php echo $pass1; ?>" title="Введите пароль" required/><br/>
        <input type="password" name="new_pass2" placeholder="Введите пароль еще раз" value="<?php echo $pass2; ?>" title="Введите пароль еще раз" required/><br/>
        <input type="submit" name="submit" value="Зарегистрироваться"/>
    </form>
    <div class="message">
        <ul>
            <?php if(isset($errs) && is_array($errs)): ?>
                <?php foreach ($errs as $err): ?>
                    <li><?php echo $err ?></li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
    <a href="?controller=index" title="Перейти к панели авторизации">Пнель авторизации</a>