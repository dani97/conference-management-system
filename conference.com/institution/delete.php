<?php
	include 'institution.php';
	$id=$_POST['id'];
	$insname=$_POST['ins'];
	$s=Institution::deleteConference($id,$insname);
	echo $s;
	?>
	