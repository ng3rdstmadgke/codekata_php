<?php
$nums_arr = range(3, 100000);
$prime_arr = array(2);
foreach ($nums_arr as $i){
    $flg = true;
    foreach ($prime_arr as $j) {
        if ($i % $j == 0) {
            $flg = false;
            break;
        }
    }
    if ($flg == true) {
        $prime_arr[] = $i;
    }
}
foreach ($prime_arr as $i){
    print "$i" . " ";
}
