<?php
include 'auth.php';
if(isset($_POST['deleteUserPost'])){

    $m = new MongoClient(); // connect
	$db = $m->selectDB("teamboard-dev");
	$users = new MongoCollection($db, "users");
	$users->remove(array("email" => $_POST['deleteUserPost']));
	exit();
}
include 'head.php';
?>
<h1>Users</h1>

<script type="text/javascript">

	function deleteUser(email){
		
		var popup = confirm("Haluatko varmasti poistaa käyttäjän "+email+"?");
		
		if(popup == true){
			$.ajax({
			type: "POST",
			url: "users.php",
			data: { deleteUserPost: email }
		}).done(function(data){
			location.reload();
		});
		}
	}
</script>
<?php

try{	
    $m = new MongoClient(); // connect
	$db = $m->selectDB("teamboard-dev");
	$users = new MongoCollection($db, "users");
	$boards = new MongoCollection($db, "boards");
	$tickets = new MongoCollection($db, "tickets");
	echo <<<users
<br/><span>
{$users->count()} Users registered.<br/>
</span>
users;

$emailList[] = NULL;
$passList[] = NULL;
$cursor = $users->find(array(),array("email"=>1, "password"=>1));
$i = 0;
echo '<table>';
foreach($cursor as $doc){
	$emailList[$i] = $doc['email'];
	$passList[$i] = $doc['password'];
	$userboards = $boards->find(array('createdBy' => $doc['_id']));
	echo '</pre>';
	echo <<<tuloste
	 <tr><td><h3 class="deleteheader">$emailList[$i]</h3></td><td>Boardeja: {$userboards->count()}</td><td><input type="submit" value="Delete user" onClick="deleteUser('$emailList[$i]')"></td></tr>
tuloste;
	$i ++;
}
echo '</table>';

//include("mongoDB.php");
}
catch ( MongoConnectionException $e )
{
    echo '<p>Could not connect to MongoDB</p>';
    exit();
}

include("foot.php");
?>
