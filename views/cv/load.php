<?php
/* @var $source */

header("Content-Disposition: attachment; filename=" . $source);
header("Content-type: application/octet-stream");

echo file_get_contents($source);
?>