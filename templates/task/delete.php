<div class="row">
	<h3>Do you want to delete task?</h3>

	<form method="POST" action="/task/delete/<?=$id?>">
		<input type="submit" class="btn btn-success" value="Yes!">
	</form>
	<a class="btn btn-primary" href="/task">No!</a>
</div>