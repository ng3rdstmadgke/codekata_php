<?php
function editArray(array $arr): array {
    for ($i = 1; $i < count($arr); $i++) {
        $arr[$i] = 0;
    }
    return $arr;
}
$a = [3, 4, 2, 7, 6];
$ret = editArray($a);
var_dump($ret);
