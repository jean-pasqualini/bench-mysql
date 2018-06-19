<?php

$fh = fopen('./test.sql', 'w+');

for($i = 1; $i <= 150000; $i++) {
    if ($i == 1) {
        fwrite($fh, 'START TRANSACTION;'.PHP_EOL);
    }
    fwrite($fh, 'INSERT INTO Product (`ean`) VALUES ("'.'product-'.$i.'");'.PHP_EOL);
    if ($i % 50000 == 0) {
        fwrite($fh, 'COMMIT;'.PHP_EOL);
        fwrite($fh, 'START TRANSACTION;'.PHP_EOL);
    }
}


fwrite($fh, 'COMMIT;'.PHP_EOL);
fclose($fh);
