<script type="text/javascript" src="jquery.js"></script>
<?php
session_start();
if (!isset($_SESSION['app1_islogged']) || $_SESSION['app1_islogged'] !== true)
	header("Location: http://" . $_SERVER['HTTP_HOST']
                                    . dirname($_SERVER['PHP_SELF']) . ''
                                    . 'login.php');
?>