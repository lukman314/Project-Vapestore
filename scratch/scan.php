<?php
function scanRec($dir) {
    $files = glob($dir . '/*');
    if ($files) {
        foreach ($files as $f) {
            if (is_dir($f)) {
                scanRec($f);
            } else {
                echo $f . PHP_EOL;
            }
        }
    }
}
scanRec('public/images/produk');
scanRec('storage/app/public/images/produk');
