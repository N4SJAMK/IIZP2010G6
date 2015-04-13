<?php
$dateParam = date("-Y-m-d-H-m-s");
exec("mongodump --db teamboard-dev --out /var/www/html/dumps/dump{$dateParam}");
exec("mongodump --db teamboard-dev --out - | gzip > dump.gz");
?>