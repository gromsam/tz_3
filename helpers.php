<?php

/**
 * Функция для формирования из файла
 *
 * @param string $data_text_file
 * @return array $temp
 */
function create_data($data_text_file){

    //Удаляем пробелы порядно
    $rows = array_map('trim', file($data_text_file));

    // удаляем первую строку (заголовки таблицы)
    array_shift($rows);

    //Определяем промежуточный массив с формированием оператора по ключу
    $temp = [];

    foreach ($rows as $row) {

        // теперь строку вида 1,User1,18 разделяем по запятой, удаляя лишние пробелы
        $params = array_map('trim', explode(';', $row));

        $phone_start    = (int) ('7'.$params[0].$params[1]);
        $phone_finish    = (int) ('7'.$params[0].$params[2]);

        $temp[$params[4]][] = [
            'phone_start' => $phone_start,
            'phone_finish' => $phone_finish
        ];
    }

    return $temp;
}

/**
 * Функция для слияния номеров масок
 *
 * @param array $temp
 * @return array $temp
 */
function merge_mask($temp){

    $data = [];

    foreach($temp as $key => $operator){

        $d = [];

        foreach($operator as $numbers){
            $d = array_merge($d, createMask($numbers));
        }

        $data[$key] = $d;
    }

    return $data;
}


//=====Приступаем к формированию коротких записей для масок======

//7901160 0000
//7901201 9999

// 790000 00000
// 790002 99999
//на выходе лоджны получить 790000, 790001, 790002

/**
Есть примеры вот таких интервалов
Если проанализировать, то мы видим что в номере телефона явяющимся стартом интервала
присутствуют нули, в номере телефона являющимся окончанием интервара, присутствуют девятки
в этом случае алгоритм будет такой, что интервал от ноля до девятки на одной и той же позиции является
любым числом. Обход на сопоставление 0 и 9 будет начинаться справа налево.
 */


/**
 * Функция для формирования масок по диапазону
 *
 * @param array $intervalPhones
 * @return array
 */

function createMask($intervalPhones){

    $mask = [];

    $level_start = 10;
    $level_finish = 4;

    $phone_start       = (string) $intervalPhones['phone_start'];
    $phone_finish       = (string) $intervalPhones['phone_finish'];

    $phone_start_temp  = (string) $intervalPhones['phone_start'];
    $phone_finish_temp  = (string) $intervalPhones['phone_finish'];

    //Получаем ключ начала маски
    for($i = $level_start; $i > $level_finish; $i--){
        if((int) $phone_start[$i] === 0 && (int) $phone_finish[$i] === 9){
            $phone_start_temp = substr($phone_start_temp,0,-1);
            $phone_finish_temp = substr($phone_finish_temp,0,-1);
        }
    }

    $mask_phone_not_last = substr($phone_start_temp,0,-1);

    //получаем последний символ стартового номера для начала создания диапазона
    $start = (int) substr($phone_start_temp, -1);
    $finish = (int) substr($phone_finish_temp, -1);

    for($i = $start; $i <= $finish; $i++){
        $mask[] = (int) $mask_phone_not_last . $i;
    }

    return $mask;

}