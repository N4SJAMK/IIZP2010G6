<?php
$dateParam = date("-Y-m-d-H-m-s");
exec("mongodump --db teamboard-dev --out /var/www/dumps/dump{$dateParam}");
?>