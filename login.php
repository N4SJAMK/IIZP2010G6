<?php
session_start();
$username = 'admin';
$password = 'root';
$page = 'index.php';

$errmsg = '';
if (isset($_GET['signout']) && $_GET['signout'] == 'true'){
	if (isset($_SESSION['app1_islogged'])) {
		unset($_SESSION['app1_islogged']);
	}
}
else if (isset($_POST['uid']) AND isset($_POST['passwd'])) {
    // Kovakoodatut tunnus ja salasana
    if ($_POST['uid'] === $username AND $_POST['passwd'] === $password) {
        // Kirjautuminen ok, merkintä sessiotauluun
        $_SESSION['app1_islogged'] = true;
        $_SESSION['uid'] = $_POST['uid']; // Tässä mukavuussyistä, voidaan tulostella yms.
         header("Location: " . $page);
        exit;
    } else {
		if (isset($_SESSION['app1_islogged'])) {
			unset($_SESSION['app1_islogged']);
		}
        $errmsg = '<span style="background: yellow;">Authentication error. Check login value';
    }
}

?>
<head>
<meta charset="UTF-8">
<title>Contriboard</title>
<link rel="stylesheet" type="text/css" href="tyylit.css">
<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="jquery.js"></script>
</head>
<div id="block1">

<header>
<h3>Login page</h3>
</header>
<div id="sisalto" class="nonabs">
<span>Please login</span>
<?php
if ($errmsg != '') echo $errmsg;
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
Tunnus:<br/><input autofocus type="text" name="uid" size="30"><br/>
Salasana:<br/><input type="password" name="passwd" size="30"><br/>
<input type='submit' name='action' value='Kirjaudu'>
<br/>
</form>
</div>
</div>
