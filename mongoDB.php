<?php
/*
Connection to mongo database
*/

try
{
    $m = new Mongo(); // connect
    $db = $m->selectDB("example");
}
catch ( MongoConnectionException $e )
{
    echo '<p>Couldn\'t connect to mongodb, is the "mongo" process running?</p>';
    exit();
}
?>
