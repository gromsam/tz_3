<?php

include "helpers.php";

try {

    //Подключаем справочник
    $file = __DIR__ . '/DEF-9xx.csv';

}catch (Exception $e){
//    echo $e->getMessage();
    echo 'Ошибка подключения данных';
    die();
}

//Первый вариант
//include "version_1.php";

//Второй вариант
include "version_2.php";


