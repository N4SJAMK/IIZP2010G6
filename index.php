<?php
include 'auth.php';
include 'head.php';
?>
<h1>Boards</h1>
<?php
error_reporting(E_ALL);
	ini_set('display_errors', 1);
	try{	
	$m = new MongoClient();
	$db = $m->selectDB("teamboard-dev");
	$cl = new MongoCollection($db, "boards");
	$cursor = $cl->find();
	echo '<pre>';
	foreach ($cursor as $doc) {
		print_r($doc);
	}
	echo '</pre>';


}
catch ( MongoConnectionException $e )
{
    echo '<p>Could not connect to MongoDB</p>';
    exit();
}
include("foot.php");
?>