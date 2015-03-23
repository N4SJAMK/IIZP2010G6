<?php
/*
Connection to mongo database
*/
error_reporting(E_ALL);
ini_set('display_errors', 1);
try
{
    $m = new MongoClient(); // connect
	echo '<br><pre>';
    print_r($m->listDBs());
	echo '</pre>';
}
catch ( MongoConnectionException $e )
{
    echo '<p>Couldn\'t connect to mongodb, is the "mongo" process running?</p>';
    exit();
}
?>
