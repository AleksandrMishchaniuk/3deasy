<div id="rsb" class="panel">
    <form action="?controller=user&action=finishRegistration" method="POST">
        <div class="caption">Введите данные для регистрации</div>
        <input type="text" name="new_login" placeholder="Введите логин" title="Логин" required/><br/>
        <input type="password" name="new_pass1" placeholder="Введите пароль" title="Введите пароль" required/><br/>
        <input type="password" name="new_pass2" placeholder="Введите пароль еще раз" title="Введите пароль еще раз" required/><br/>
        <input type="submit" value="Зарегистрироваться"/>
    </form>
    <div class="message"></div>