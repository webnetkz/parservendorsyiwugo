<?php

require_once 'db.php';

$x = file_get_contents('yiwugoSitemapxml.php');


$f = fopen('firstPageVendors.txt', 'a+');
preg_match_all("=https://en.yiwugo.com/shopdetail/1/(.*)_1.html=", $x, $out);


foreach($out as $k => $v) {
    foreach($v as $k => $v) {
        //var_dump($v.$i++);

        // $sql = 'INSERT INTO urls(res) VALUES ("'.$v.'")';
        // $pdo->query($sql);

        fwrite($f, $v."\n");

}}
fclose($f);