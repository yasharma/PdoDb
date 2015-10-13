<?php
include 'autoload.php';
$pdo = new DbPDO('learning','root','admin');
$result = $pdo->find('posts',$_GET['id']);
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
			 	<div class="panel-heading"><?php echo $result->title; ?></div>
			  	<div class="panel-body">
			    	<form class="form-horizontal" action="update.php" method="post">
			    		<input type="hidden" name="id" value="<?php echo $result->id; ?>">
			    	  	<div class="form-group">
			    	    	<label class="col-sm-2 control-label">Title</label>
			    	    	<div class="col-sm-10">
			    	      		<input type="text" name="title" class="form-control" placeholder="Title" value="<?php echo $result->title; ?>">
			    	    	</div>
			    	  	</div>
			    	  	<div class="form-group">
			    	    	<label class="col-sm-2 control-label">Body</label>
			    	    	<div class="col-sm-10">
			    	      		<textarea class="form-control" name="body" placeholder="body"><?php echo $result->body; ?></textarea>
			    	    	</div>
			    	  	</div>
			    	  	<div class="form-group">
			    	    	<div class="col-sm-offset-2 col-sm-10">
			    	      		<button type="submit" class="btn btn-primary">Update</button>
			    	    	</div>
			    	  	</div>
			    	</form>
			  	</div>
			</div>
		</div>
	</div>
</body>
</html>