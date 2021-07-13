<?php
    $rootDir = $_SERVER['DOCUMENT_ROOT'];
    $dir = $_REQUEST["dir"];

    include "$rootDir/php/lib/whatInDir.php";
    echo json_encode(whatInDir($rootDir, $dir));
?>
