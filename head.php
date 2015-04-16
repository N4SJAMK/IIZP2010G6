<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Contriboard</title>
<link rel="stylesheet" type="text/css" href="tyylit.css">
<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="jquery.js"></script>
</head>

<body>

<div id="sivupalkki">
<h2 id="otsikko">Contriboard</h2>

<a href="index.php"><img src="view.png" alt="kuva" style="width:25px;height:25px">Home</a><br/>
<a href="users.php"><img src="users.png" alt="kuva" style="width:25px;height:25px">Users</a><br/>
<a href="databases.php"><img src="db.png" alt="kuva" style="width:25px;height:25px">Database</a><br/>
<a href="login.php?signout=true"><img src="logout.png" alt="kuva" style="width:25px;height:25px" >Log out</a>
<?php
try{	
/*
Counting users, boards, tickets, active users and mongo used space.
*/
    $m = new MongoClient(); // connect
	$db = $m->selectDB("teamboard-dev");
	$users = new MongoCollection($db, "users");
	$boards = new MongoCollection($db, "boards");
	$tickets = new MongoCollection($db, "tickets");
	$events = new MongoCollection($db, "events");
	$time = strtotime('now') - 900;
	$time = new MongoDate($time);
	$query = array('createdAt' => array('$gt' => $time));
	$cursor = $db->command(array(
		"distinct" => "events",
		"key" => "user.id",
		"query" => $query
	));
	$online = sizeof($cursor['values']);
	$space = round($m->listDBs()['totalSize']/1000000, 1);
	echo <<<users
<br/><br/><span>
{$users->count()} Users registered.<br/>
{$boards->count()} Total Boards.<br/>
{$tickets->count()} Total Tickets.<br/>
<br/>
{$online} Users Online.<br/>
<br/>
{$space} MB<br/>Used by Mongo.<br/>

</span>
users;
}
catch ( MongoConnectionException $e )
{
    echo '<p>Could not connect to MongoDB</p>';
    exit();
}

?>

</div>
<div id="block1">
<header>
	<input style="text" value="Search" name="haku">
</header>
<div id="sisalto">