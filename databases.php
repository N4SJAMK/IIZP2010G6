<?php
include 'auth.php';
//export
if(isset($_POST['backup']) && $_POST['backup'] == "Backup"){
	$dateParam = date("-Y-m-d-H-m-s");
	exec("mongodump --db teamboard-dev --out /var/www/html/dumps/dump{$dateParam}");
}
//import
else if(isset($_POST['restore'])){
	exec("mongorestore /var/www/html/dumps/{$_POST['restore']}");	
}
else if(isset($_POST['trunc']) && $_POST['trunc'] == 'Trunc'){
	$m = new MongoClient();
	$db = $m->selectDB("teamboard-dev");
	$db->drop();
}
if(isset($_POST['fromajax'])){
	exit($_POST['fromajax']);
}
include 'head.php';
?>
<h1>Databases</h1>
<script type="text/javascript">
var temp = 0;
//otetaan talteen backup tunnus
function jotain(dateParam){
	temp = dateParam;
}
//keskeyttävä dialogi
function onkovarma(e){
	if(temp == 0){
		return true;
	}
	var text = "";
	if($('#clean').prop('checked')){
		text = " Database will be truncated to 0."
	}
	var popup = confirm("Restore "+temp+"?"+text);
	if(popup != true){
		temp = 0;
		return false;
	}
	//varatoimenpide
	if($('#current').prop('checked')){
		$.ajax({
			type: "POST",
			url: "databases.php",
			data: { backup: "Backup", fromajax: "ok" }
		}).done(function(data){
			//trunc
			if(data == 'ok' && $('#clean').prop('checked')){
				$.ajax({
					type: "POST",
					url: "databases.php",
					data: { trunc: "Trunc", fromajax: "ok" }
				}).done(function(data2){
					if(data2 == "ok"){
						$.ajax({
							type: "POST",
							url: "databases.php",
							data: { restore: temp, fromajax: "ok" }
						}).done(function(data3){
							alert(data);
							if(data3 == "ok"){
								location.reload();
							}
						});
					}
				});
			}
			else{
			}
		});
	}
	return false;
}
$(document).ready(function(){
	$('#clean').click(function(){
		if($(this).prop('checked')){
			$('#current').prop('checked', true);
		}
	});
});
</script>
<form onsubmit='return onkovarma();' method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
Import options:<br/>
Perform clean import (database will be truncated to 0) <input type="checkbox" name="clean" value="ok" checked id="clean" /><br/>
Export current state before executing Import <input type="checkbox" name="current" id="current" value="ok" checked id="current" /><br/><br/>
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