<div id="rsb" class="panel">
    <div class="congratulation">Привет, <?php echo $user['login'] ?>!</div>
    <form action="?controller=user&action=quit" method="POST">
        <input type="submit" name="quit_user" value="Выйти"/>
    </form>
    <div id="projects_list">
        <ul>
            <?php foreach ($projects as $proj): ?>
                <li><?php echo $proj['name']; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php if($projects): ?>
    <form action="?controller=user&action=openProject" method="POST">
        <input type="submit" value="Открыть проект"/>
        <input type="hidden" name="open_project" value=""/>
    </form>
    <form action="?controller=user&action=deleteProject" method="POST">
        <input type="submit" value="Удалить проект"/>
        <input type="hidden" name="delete_project" value=""/>
    </form>
    <?php endif; ?>
    <form action="?controller=user&action=saveProject" method="POST">
        <input type="submit" value="Сохранить проект"/>
        <input type="hidden" name="save_project" value=""/>
    </form>
    <form action="?controller=user&action=saveAsNewProject" method="POST">
        <input type="submit" value="Сохранить проект как новый"/>
        <input type="hidden" name="save_as_new_project" value=""/>
    </form>