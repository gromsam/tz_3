<?php


$temp = create_data($file);

//Массив для группировки диапазонов
$data = [];

// Цикл для создания группировки диапазонов
foreach($temp as $key => $operator){
//        $data[$key] =>
//        echo '<pre>';
//        print_r($operator);

        // Текущее начальное и конечное значение диапазонов номеров телефонов в цикле
        // Присваиваем первое значение в массиве
//        $phone_start = $operator[0]['phone_start'];
//        $phone_finish = $operator[0]['phone_finish'];

        // Временное начальное и конечное значение диапазонов номеров телефонов в цикле
        // Присваиваем первое значение в массиве
    $temp_phone_start = $operator[0]['phone_start'];
    $temp_phone_finish = $operator[0]['phone_finish'];

    foreach($operator as $numbers){

//            $phone_start = $numbers['phone_start'];
//            $phone_finish = $numbers['phone_finish'];
//
//            $temp_phone_start = $numbers['phone_start'];
//            $temp_phone_finish = $numbers['phone_finish'];

        /*
         * Если phone_finish в массиве равен первому номеру,
         * то phone_start остаётся без изменения
         * а phone_finish заменяется на текущий
         * и переходим на другую итерацию
         * Иначе добавляем в массив данные и переопределяем
         * временные переменные
        */

        // Если предыдущий $temp_phone_finish равен текцщему phone_start
        // То переопределяем $temp_phone_finish
        if(($temp_phone_finish + 1) === $numbers['phone_start'])
        {
//                $temp_phone_start = $numbers['phone_start'];
            $temp_phone_finish = $numbers['phone_finish'];

        }
        //Иначе интервал закончился и добавляем в массив значения интервалов
        else
        {
            // Исключаем первые данные в массиве
            if(
                $temp_phone_start !== $numbers['phone_start'] &&
                $temp_phone_finish !== $numbers['phone_finish']
            ){
                $data[$key][] = [
                    'phone_start' => $temp_phone_start,
                    'phone_finish' => $temp_phone_finish
                ];
            }

            $temp_phone_start = $numbers['phone_start'];
            $temp_phone_finish = $numbers['phone_finish'];

        }

    }
}

//Справочник масок операторов
$operators_list_mask = merge_mask($data);

echo '<pre>';
print_r($operators_list_mask);
echo '</pre>';






