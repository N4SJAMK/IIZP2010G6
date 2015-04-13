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

foreach($cursor as $doc){
	$emailList[$i] = $doc['email'];
	$passList[$i] = $doc['password'];
	echo <<<tuloste
	 <ul style="list-style-type:square"><li>
	 <h3>$emailList[$i]</h3>
	 <ul style="list-style-type:square">
	 <li>Password: $passList[$i]</li>
	 <li><input type="submit" value="Delete user" onClick="deleteUser('$emailList[$i]')"></li>
	 </ul></li></ul>
tuloste;
	$i ++;
}

//include("mongoDB.php");
}
catch ( MongoConnectionException $e )
{
    echo '<p>Could not connect to MongoDB</p>';
    exit();
}

include("foot.php");
?>
