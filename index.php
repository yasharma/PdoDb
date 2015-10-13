<?php
include 'autoload.php';
$pdo = new DbPDO('learning','root','admin');
$results = $pdo->get('posts');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Blogposts</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
	<div class="container">	
		
		<div class="row">
			<div class="col-md-6"><h2>Posts</h2></div>
			<div class="col-md-6"><a href="add.php" class="btn btn-default pull-right">Add New Post</a></div>
		</div>
		<table class="table table-bordered table-striped">
			<thead class="bg-primary">
				<tr>
					<th>Id</th>
					<th>Title</th>
					<th>Body</th>
					<th>Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($results as $result): ?>
				<tr>
					<td><?php echo $result['id']; ?></td>
					<td><?php echo $result['title']; ?></td>
					<td><?php echo $result['body']; ?></td>
					<td><?php echo $result['created']; ?></td>
					<td>
						<div class="btn-group">
							<a class="text-muted btn" href="<?php echo 'edit.php?id='.$result['id']; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
							<a class="text-muted btn" href="<?php echo 'delete.php?id='.$result['id']; ?>"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
						</div>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		<a href="playground.php" class="btn btn-lg btn-block btn-success">Enter Into Playground</a>
	</div>
</body>
</html>