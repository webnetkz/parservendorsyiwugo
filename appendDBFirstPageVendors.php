<?php

require_once 'db.php';


 //Читаем полученный файл
 $res = file_get_contents('firstPageVendors.txt'); 
 //Разбиваем на массив использую 
 //как разделитель символы переноса строки 
 $lines = explode("\n", $res);
 //В цикле выводим и нумеруем 
 //строки нашего документа
 foreach ($lines as $key=>$v)
 {
    $sql = 'INSERT INTO firstPageVendors(`url`) VALUES("'.$v.'")';
    $res = $pdo->query($sql);
 }

