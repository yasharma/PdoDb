<?php 
	include 'autoload.php';
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$pdo = new DbPDO('learning','root','admin');
		$result = $pdo->query($_POST['query']);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Playground</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="page-header">
			<h1>Welcome to PHP and Mysql Playground</h1>
		</div>
		<form method="post">
			<div class="form-group">
				<textarea type="text" rows="5" name="query" class="form-control input-lg" placeholder="Enter your query"><?php echo @$_POST['query'] ?></textarea>
			</div>
			<div class="form-group">
				<input type="submit" value="Execute" class="btn btn-success btn-lg btn-block">
			</div>	
		</form>
		<?php if( !empty($result) ): ?>
			<pre><?php print_r($result); ?></pre>	
		<?php else: ?>
			<pre>Run you query and see the output</pre>
		<?php endif; ?>
	</div>
</body>
</html>