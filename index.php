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

<a href="url"><img src="view.png" alt="kuva" style="width:25px;height:25px">Boards</a><br>
<a href="url"><img src="users.png" alt="kuva" style="width:25px;height:25px">Users</a><br>
<a href="url"><img src="db.png" alt="kuva" style="width:25px;height:25px">Database</a><br>
<a href="url"><img src="logout.png" alt="kuva" style="width:25px;height:25px">Log out</a>
<p><?php echo $users = 0; ?> users online</p>
</div>

<div id="sisalto">
<h1>Admin Panel</h1>
<?php
echo "tähän tulostuu jotain kivaa";
?>
</div>
</body>
</html>
