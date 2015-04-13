<?php
include 'auth.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Contriboard</title>
<link rel="stylesheet" type="text/css" href="tyylit.css">
<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
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
<input type="submit" value="Backup">
<input type="submit" value="Restore">
<?php
include("mongoDB.php");
?>
</div>
</body>
</html>
