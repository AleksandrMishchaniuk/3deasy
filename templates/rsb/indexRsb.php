    <form action="?controller=user&action=enter" method="POST">
        <input type="text" name="login" placeholder="Логин" required/><br/>
        <input type="password" name="pass" placeholder="Пароль" required/><br/>
        <input type="submit" value="Войти"/>
    </form>
    <a href="?controller=user&action=registration">Зарегистрироваться</a>
    <?php if(isset($message)):?>
    <div class="message alert alert-danger">
        <?php echo $message; ?>
    </div>
    <?php endif; ?>