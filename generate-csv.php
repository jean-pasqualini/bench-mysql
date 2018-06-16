<?php

$fh = fopen('./test.csv', 'w+');

for($i = 1; $i <= 150000; $i++) {
    fwrite($fh, '"'.'product-'.$i.'"'.PHP_EOL);
}

fclose($fh);
