<?php

$temp = create_data($file);

//Справочник масок операторов
$operators_list_mask = merge_mask($temp);

echo '<pre>';
print_r($operators_list_mask);
echo '</pre>';










