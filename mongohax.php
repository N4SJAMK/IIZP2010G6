<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

/*
Connection to mongo database
*/

try{	
	
	

}
catch ( MongoConnectionException $e )
{
    echo '<p>Couldn\'t connect to mongodb, is the "mongo" process running?</p>';
    exit();
}
?>
