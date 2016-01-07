<div id="rsb" class="panel">
    <form action="?controller=user&action=enter" method="POST">
        <input type="text" name="login" placeholder="Логин" required/><br/>
        <input type="password" name="pass" placeholder="Пароль" required/><br/>
        <input type="submit" value="Войти"/>
    </form>
    <a href="?controller=user&action=registration">Зарегистрироваться</a>
    <div class="message">
        <?php 
            if(isset($message)) {echo $message;}
        ?>
    </div>