<?php
include 'autoload.php';
$pdo = new DbPDO('learning','root','admin');
$result = $pdo->delete('posts',$_GET['id']);
header('Location:index.php');