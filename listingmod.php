<?php
	session_start();
	$lid = $_POST['listid'];
	$conn = "host=csc309instance2.cuw3cz9voftq.us-west-2.rds.amazonaws.com port=5432 dbname=SynergySpace user=CSC309Project password=309kerebe";
	$dbconn = pg_connect($conn);
	pg_query($dbconn, "DELETE FROM postrated WHERE listid = $lid");
	pg_query($dbconn, "DELETE FROM posted WHERE listid = $lid");
	pg_query($dbconn, "DELETE FROM tenant WHERE listid = $lid");
	pg_query($dbconn, "DELETE FROM listings WHERE listid = $lid");
	pg_close($dbconn);
?>