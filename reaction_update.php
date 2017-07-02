<?php
	require_once 'postb.php';
	$x=$_POST['value'];
	$y=$_POST['pid'];
	$z=$_POST['uname'];
	update_reaction($y,$z,$x);
?>