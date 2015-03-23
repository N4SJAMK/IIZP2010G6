<?php
/*
Connection to mongo database
*/
error_reporting(E_ALL);
ini_set('display_errors', 1);
try{	
    $m = new MongoClient(); // connect
	echo '<br><pre>';
    print_r($m->listDBs());
	echo '</pre>';
	
$m = new MongoClient();
$db = $m->selectDB("teamboard-dev");
$collections = $db->listCollections();

foreach ($collections as $collection) {
    echo "amount of documents in $collection: ";
    echo $collection->count(), "\n<br>";
}
$m = new MongoClient();
$db = $m->selectDB("local");
$collections = $db->listCollections();

foreach ($collections as $collection) {
    echo "amount of documents in $collection: ";
    echo $collection->count(), "\n<br>";
}
/*
echo '<pre>';
$m = new MongoClient();
$db = $m->selectDB("teamboard-dev");
$cl = new MongoCollection($db, "users");
$cursor = $cl->find();
foreach ($cursor as $doc) {
    print_r($doc);
}
echo '</pre>';


echo '<pre>';
$m = new MongoClient();
$db = $m->selectDB("teamboard-dev");
$cl = new MongoCollection($db, "events");
$cursor = $cl->find();
foreach ($cursor as $doc) {
    print_r($doc);
}
echo '</pre>';
*/

}
catch ( MongoConnectionException $e )
{
    echo '<p>Couldn\'t connect to mongodb, is the "mongo" process running?</p>';
    exit();
}
?>
