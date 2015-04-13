<?php
include 'auth.php';
if(isset($_POST['backup'])){
	require_once("mongodump.php");
}
if(isset($_POST['restore'])){
	echo $_POST['restore'];
}
?>
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

<a href="index.php"><img src="view.png" alt="kuva" style="width:25px;height:25px">Boards</a><br>
<a href="users.php"><img src="users.png" alt="kuva" style="width:25px;height:25px">Users</a><br>
<a href="databases.php"><img src="db.png" alt="kuva" style="width:25px;height:25px">Database</a><br>
<a href="login.php?signout=true"><img src="logout.png" alt="kuva" style="width:25px;height:25px" >Log out</a>
<p><?php echo $users = 0; ?> users online</p>

</div>

<div id="sisalto">
<h1>Admin Panel</h1>
<script type="text/javascript">
var temp = 0;
function jotain(dateParam){
	temp = dateParam;
}
function onkovarma(){
	if(temp == 0){
		return true;
	}
	var popup = confirm("Palautetaanko "+temp+"?");
	if(popup != true){
		temp = 0;
	}
	var otanko = confirm("Tallennetaanko tietokannan nykyinen tila?");
	if(otanko == true){
		$.ajax({
			type: "POST",
			url: "databases.php",
			data: { backup: "Backup" }
		});
	}
	return popup;
}
</script>
<form onsubmit='return onkovarma();' method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<input type="submit" name="backup" value="Backup">
<?php	
foreach(scandir("./dumps") as $val){
	if(substr($val, 0, 4) == dump){
		echo <<<restoreNappi
		<br/><input onclick="jotain('{$val}')" type='submit' name='restore' value='{$val}' />
restoreNappi;
	}
}
?>
</form>
<pre>
<?php
print_r($_POST);
//include("mongoDB.php");
?>
</pre>
</div>
</body>
</html>
