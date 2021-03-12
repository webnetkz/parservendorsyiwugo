<?php



require_once 'db.php';
$x = file_get_contents('yiwugoSitemapxml.php');



function getMaxNum($url, $x) {

    $search = substr($url, 0, 42);
    $search = '='.$search.'(.*).html=';
    preg_match_all($search, $x, $out);


foreach($out as $k => $v) {
    foreach($v as $k => $v) {
        $x = substr($v, 42, -5);
        $y[] = $x;
        
    }}
    $y = @max($y);
    $res = substr($url, 0, 42).$y.'.html';
    
    return $res;
}


$sql = 'SELECT * FROM firstpagevendors;';
$res = $pdo->query($sql);
$res = $res->fetchAll(PDO::FETCH_ASSOC);

foreach($res as $k => $v) {
    $sql = 'INSERT INTO last_page_vendors(`url`) VALUES("'.getMaxNum($v['url'], $x).'")';
    $res = $pdo->query($sql);
}