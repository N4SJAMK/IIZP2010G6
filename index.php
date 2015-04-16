<?php
include 'auth.php';
include 'head.php';
?>
<h1>Home</h1>
<?php
error_reporting(E_ALL);
	ini_set('display_errors', 1);
	try{	
	$m = new MongoClient();
	$db = $m->selectDB("teamboard-dev");
	$boards = new MongoCollection($db, "boards");
	$tickets = new MongoCollection($db, "tickets");
	$users = new MongoCollection($db, "users");
	$cursor = $boards->find();
	foreach($cursor as $doc){
		$luonut = $users->findone(array('_id' => $doc['createdBy']));
		echo <<<rivi
		Taulun nimi: [{$doc['name']}]
		Luonut: [{$luonut['email']}]
rivi;
		$boardtickets = $tickets->find(array('board' => $doc['_id']));
		echo '<ul>';
		foreach($boardtickets as $ticket){
			echo <<<rivi
	<li style="color:{$ticket['color']};">{$ticket['content']}</li>
rivi;
		}
		echo '</ul>';
		echo '<br/>';
	}

}
catch ( MongoConnectionException $e )
{
    echo '<p>Could not connect to MongoDB</p>';
    exit();
}
include("foot.php");
?>