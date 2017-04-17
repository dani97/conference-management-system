<?php
	include 'institution.php';
	$name=$_POST['name'];
	$venue=$_POST['venue'];
	$comments=$_POST['comments'];
	$url=$_POST['url'];
	$date=$_POST['date'];
	$fields = array($name,$venue,$date,$url,$comments);
	$s=Institution::addConference($fields);
	echo $s;
?>