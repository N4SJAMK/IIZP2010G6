<?php
$asd = date("-Y-m-d-H-m-s");
exec("mongodump --db teamboard-dev --out /var/www/html/dumps/dump{$asd}");
exec("mongodump --db teamboard-dev --out - | gzip > dump.gz");
?>