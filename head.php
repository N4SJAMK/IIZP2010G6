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
<header>
<div id="haku">
<input style="text" value="Search" name="haku">
</div>
</header>

<div id="sivupalkki">
<h2 id="otsikko">Contriboard</h2>

<a href="index.php"><img src="view.png" alt="kuva" style="width:25px;height:25px">Boards</a><br/>
<a href="users.php"><img src="users.png" alt="kuva" style="width:25px;height:25px">Users</a><br/>
<a href="databases.php"><img src="db.png" alt="kuva" style="width:25px;height:25px">Database</a><br/>
<a href="login.php?signout=true"><img src="logout.png" alt="kuva" style="width:25px;height:25px" >Log out</a>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


try{	
    $m = new MongoClient(); // connect
	$db = $m->selectDB("teamboard-dev");
	$users = new MongoCollection($db, "users");
	$boards = new MongoCollection($db, "boards");
	$tickets = new MongoCollection($db, "tickets");
	$events = new MongoCollection($db, "events");
	$aika = strtotime('now') - 900;
	$aika = new MongoDate($aika);
	$kysely = array('createdAt' => array('$gt' => $aika));
	$cursor = $db->command(array(
		"distinct" => "events",
		"key" => "user",
		"query" => $kysely
	));
	$online = sizeof($cursor['values']);
	echo <<<users
<br/><br/><span>
{$users->count()} Users registered.<br/>
{$boards->count()} Total Boards.<br/>
{$tickets->count()} Total Tickets.<br/>
<br/>
{$online} Users Online.<br/>

</span>
users;
	/*
	$collections = $db->listCollections();
	foreach ($collections as $collection) {
		echo "amount of documents in $collection: ";
		echo $collection->count(), "\n<br/>";
	}
	echo '<pre>';
	$m = new MongoClient();
	$db = $m->selectDB("teamboard-dev");
	$cl = new MongoCollection($db, "users");
	$cursor = $cl->find();
	foreach ($cursor as $doc) {
		print_r($doc);
	}
	echo '</pre>';
	*/

}
catch ( MongoConnectionException $e )
{
    echo '<p>Could not connect to MongoDB</p>';
    exit();
}

?>

</div>

<div id="sisalto">