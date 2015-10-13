<?php
include 'autoload.php';
$pdo = new DbPDO('learning','root','admin');
$result = $pdo->update('posts',$_POST);
header('Location:index.php');