<?php

$fh = fopen('./extended-insert.sql', 'w+');

$prefix = 'REPLACE INTO Product (`ean`) VALUES ';

$batch = [];
for($i = 1; $i <= 150000; $i++) {
    $batch[] = '("'.'product-'.$i.'")';
    if ($i % 50000 == 0) {
        fwrite($fh, $prefix.implode(', ', $batch).';'.PHP_EOL);
        $batch = [];
    }
}

fclose($fh);
