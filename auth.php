<?php
session_start();
if (!isset($_SESSION['app1_islogged']) || $_SESSION['app1_islogged'] !== true)
	header("Location: login.php");
?>