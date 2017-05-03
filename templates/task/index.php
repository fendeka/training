<?php
use app\core\Session;
use \app\core\Config;
?>
<?php if(Session::exists('id')) : ?>
    <div class="col-md-3 col-md-offset-1">
        <form method="POST" action="/user/logout">
            <input class="btn btn-default" type="submit" value="Log Out">
        </form>
    </div>
<?php else: ?>
    <div class="col-md-3 col-md-offset-1">
        <form method="POST" action="/user/login">
            <input class="btn btn-default" type="submit" value="Log In">
        </form>
    </div>
<?php endif ?>
<?php if (count($tasks) > 0) : ?>
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <?php if (Session::exists('id')) : ?>
                <th>Status</th>
            <?php endif; ?>
            <th>
                <a href="/task/index/username/<?=$this->data['params']['order']?>">Username</a>
            </th>
            <th>
                <a href="/task/index/body/<?=$this->data['params']['order']?>">Body</a>
            </th>
            <th>
                <a href="/task/index/email/<?=$this->data['params']['order']?>">E-mail</a>
            </th>
            <th>Image</th>
            <?php if (Session::exists('id')) : ?>
                <th colspan="2" class="text-center">Actions</th>
            <?php endif; ?>
        </tr>
        </thead>

        <tbody>

        <?php
        foreach($tasks as $key => $task) : ?>
            <tr>
                <td><?=$key+1?></td>
                <?php if (Session::exists('id')) : ?>
                    <td><input type="checkbox" id="status" name="status" <?php echo ($task['status'] == 1) ? 'checked' : ''; ?>></td>
                <?php endif; ?>
                <td><?=$task['username']?></td>
                <td><?=$task['body']?></td>
                <td><?=$task['email']?></td>
                <td><img src="<?=Config::get('base_path').Config::get('image/path').$task['image']?>" alt="Smiley face" width="32" height="24" ></td>
                <?php if (Session::exists('id')) : ?>
                    <td><a class="btn btn-primary" href="/task/update/<?=$task['id']?>">Update</a></td>
                    <td><a class="btn btn-primary" href="/task/delete/<?=$task['id']?>">Delete</a></td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>

        </tbody>

    </table>
<?php endif; ?>

<div class="text-center">
    <a class="btn btn-primary" href="/task/index/<?=$this->data['params']['column']."/".$this->data['params']['current_order']."/".(int)$this->data['params']['pagination']['prev_page']?>">< prev</a>

    <?php
        for ($i=1; $i<=$this->data['params']['pagination']['all_pages'] ; $i++) { ?>
            <a class="btn btn-primary" href="/task/index/<?=$this->data['params']['column']."/".$this->data['params']['current_order']."/".$i?>"><?=$i?></a>
    <?php } ?>

    <a class="btn btn-primary" href="/task/index/<?=$this->data['params']['column']."/".$this->data['params']['current_order']."/".(int)$this->data['params']['pagination']['next_page']?>">next ></a>
</div>

<div>
    <a class="btn btn-primary" href="/task/create">Create Task</a>
</div>
