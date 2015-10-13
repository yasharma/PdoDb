<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	include 'autoload.php';
	$pdo = new DbPDO('learning','root','admin');
	$result = $pdo->save('posts',$_POST);
	header('Location:index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Blogpost</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-primary">
			 	<div class="panel-heading">Add Post</div>
			  	<div class="panel-body">
			    	<form class="form-horizontal" method="post">
			    	  	<div class="form-group">
			    	    	<label class="col-sm-2 control-label">Title</label>
			    	    	<div class="col-sm-10">
			    	      		<input type="text" name="title" class="form-control" placeholder="Title">
			    	    	</div>
			    	  	</div>
			    	  	<div class="form-group">
			    	    	<label class="col-sm-2 control-label">Body</label>
			    	    	<div class="col-sm-10">
			    	      		<textarea class="form-control" name="body" placeholder="body"></textarea>
			    	    	</div>
			    	  	</div>
			    	  	<div class="form-group">
			    	    	<div class="col-sm-offset-2 col-sm-10">
			    	      		<button type="submit" class="btn btn-primary">Add</button>
			    	    	</div>
			    	  	</div>
			    	</form>
			  	</div>
			</div>
		</div>
	</div>
</body>
</html>