<h1>Тестовое задание</h1>

Имеется база с номерами

https://opendata.digital.gov.ru/registry/numeric/downloads/

Необходимо написать функционал, который из данных диапазонов сделает список префиксов (уникальных масок) только по операторам (по регионам не надо).
Префикс это уникальная маска номера, к примеру 7911ХХХХХХХ, где Х - любое число.
Постараться свести кол-во префиксов к минимуму.

<p>Как ожидаемый итог - скрипт который может обработать файл и предоставить результат в виде массива (пример ['оператор 1'=>[7911,791222,791223],'оператор 2'=>[7921,792222,792223]])</p>

======================
Выполнение задания
======================

<p>Первый вариант имеет ошибку, его нужно доработать, это связано с объединением интервалов</p>
<p>Второй вариант рабочий, но нужно ещё оптимизировать. Сделать группировку.</p>