<div id="rsb" class="panel">
    <div class="congratulation">Привет, <?php echo ucfirst($user['login']); ?>!</div>
    <form action="?controller=user&action=quit" method="POST">
        <input type="submit" name="quit_user" value="Выйти"/>
    </form>
    <div id="projects_list">
        <ul>
            <?php 
                foreach ($projects as $proj){
                    $id = (isset($project['id']))? $project['id']: NULL;
                    $class = ($proj['id'] === $id)? 'active': '';
                    echo "<li class='{$class}' data-id='{$proj['id']}'>{$proj['name']}</li>";
                }
            ?>
        </ul>
    </div>
    <?php if($projects): ?>
        <form action="?controller=user&action=openProject" id="openProject" method="POST">
            <input type="submit" value="Открыть проект"/>
            <input type="hidden" name="opening_project" value=""/>
        </form>
        <form action="?controller=user&action=deleteProject" id="deleteProject" method="POST">
            <input type="submit" value="Удалить проект"/>
            <input type="hidden" name="deleting_project" value=""/>
        </form>
    <?php endif; ?>
    <?php if(isset($project['id'])): ?>
        <form action="?controller=user&action=saveProject" id="saveProject" method="POST">
            <input type="submit" value="Сохранить проект"/>
            <input type="hidden" name="project_data" value=""/>
        </form>
    <?php endif; ?>
    <form action="?controller=user&action=saveAsNewProject" id="saveAsNewProject" method="POST">
        <input type="submit" name="submit" value="Сохранить проект как"/><br/>
        <input type="text" name="new_proj_name" value="<?php echo $entered_name; ?>" placeholder="название проекта" />
        <input type="hidden" name="new_proj_data" value=""/>
    </form>
    <div class="message">
        <ul>
            <?php if(isset($errors) && is_array($errors)): ?>
                <?php foreach ($errors as $err): ?>
                    <li><?php echo $err ?></li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>