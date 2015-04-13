<?php
include 'auth.php';
include 'head.php';
?>
<h1>Admin Panel</h1>
<input type="submit" value="Backup">
<input type="submit" value="Restore">
<?php
include("mongoDB.php");
include("foot.php");
?>