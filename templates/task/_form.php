<?php
use app\core\Helper;
use app\core\Input;
use app\core\Session;
?>

<div id="message"></div>
<div class="row">

	<form id="form" enctype="multipart/form-data" method="POST" class="form-horizontal" action="<?php echo (isset($data)) ? '/task/update/' . $data['id'] : '/task/create';?>">

		<input type="hidden" id="taskId" value="<?php echo (isset($data)) ? $data['id'] : ''; ?>">

        <?php if(Session::exists('id')) : ?>
            <div class="form-group status">
                <label for="username">Done:</label>
                <input type="hidden" name="status" value="0" />
                <input type="checkbox" id="status" name="status" <?php if(isset($data['status'])){echo ($data['status'] == 1) ? 'checked' : '';} ?> value="1">
            </div>
        <?php endif ?>

		<div class="form-group username">
			<?php if (isset($errors)) :
				echo Helper::showErrors($errors, 'username');
			endif; ?>
			<label for="username">UserName:</label>
			<input type="text" class="form-control" id="username" name="username" value="<?php echo (isset($data)) ? $data['username'] : Input::input('username');?>">
		</div>

        <div class="form-group email">
            <?php if (isset($errors)) :
                echo Helper::showErrors($errors, 'email');
            endif; ?>
            <div class="lat-error error"></div>
            <label for="lat">E-mail:</label>
            <input type="text" class="form-control" id="email" name="email" value="<?php echo (isset($data)) ? $data['email'] : Input::input('email');?>">
        </div>

		<div class="form-group body">
			<?php if (isset($errors)) :
				echo Helper::showErrors($errors, 'body');
			endif; ?>
			<label for="body">Body:</label>
			<input type="text" class="form-control" id="body" name="body" value="<?php echo (isset($data)) ? $data['body'] : Input::input('body');?>">
		</div>

        <div class="form-group image">
            <label for="image">Image:</label>
            <input class="btn btn-success" type="file" id="image" name="image" accept="image/*">
        </div>

		<div class="form-group">
			<input class="btn btn-success col-lg-2" type="submit" id="save" value="Save">
		</div>

	</form>

	<a class="btn btn-primary col-lg-1" href="/task">Back</a>
    <button class="btn btn-primary col-lg-1" id="preview" data-toggle="modal" data-target="#modal">Preview</button>
</div>



<div class="modal fade" id="modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Task preview</h4>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tbody>
                    <tr>
                        <th>Username</th>
                        <th>Body</th>
                        <th>E-mail</th>
                        <th>Image</th>
                    </tr>
                    <tr>
                        <td id="preview_username"></td>
                        <td id="preview_body"></td>
                        <td id="preview_email"></td>
                        <td><img id="preview_img"/></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
