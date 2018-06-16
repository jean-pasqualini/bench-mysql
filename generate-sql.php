<?php

$fh = fopen('./test.sql', 'w+');

for($i = 1; $i <= 150000; $i++) {
    fwrite($fh, 'INSERT INTO Product (`ean`) VALUES ("'.'product-'.$i.'");'.PHP_EOL);
}

fclose($fh);
