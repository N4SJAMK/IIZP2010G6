<?php
include 'auth.php';
include 'head.php';
if(isset($_POST['backup'])){
	$dateParam = date("-Y-m-d-H-m-s");
	exec("mongodump --db teamboard-dev --out /var/www/html/dumps/dump{$dateParam}");
}
if(isset($_POST['restore'])){
	exec("mongorestore /var/www/html/dumps/{$_POST['restore']}");	
}
?>
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
	if(substr($val, 0, 4) == 'dump'){
		echo <<<restoreNappi
		<br/><input onclick="jotain('{$val}')" type='submit' name='restore' value='{$val}' />
restoreNappi;
	}
}
?>
</form>
<pre>
<?php
//include("mongoDB.php");
?>
</pre>
<?php
include("foot.php");
?>