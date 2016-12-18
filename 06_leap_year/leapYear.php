<?php
/*
* グレゴリオ暦 : 1582年以降
* 1. 西暦年が4で割り切れる年は閏年。
* 2. ただし、西暦年が100で割り切れる年は平年。
* 3. ただし、西暦年が400で割り切れる年は閏年。
* 今回はグレゴリオ暦におけるうるう年の算出を行う。
*/
function leepYear(int $year): bool {
    if ($year % 400 === 0) {
        return true;
    }elseif ($year % 100 === 0) {
        return false;
    }elseif ($year % 4 === 0) {
        return true;
    }else {
        return false;
    }
}

do {
    print "年を入力してください : ";
    $year = trim(fgets(STDIN));
    if (leepYear($year)) {
        printf("%d年はうるう年です。\n", $year);
    }else {
        printf("%d年はうるう年ではありません。\n", $year);
    }
    print "Continue(1)/Exit(0) : ";
    $flg = trim(fgets(STDIN));
    if ((int) $flg === 1) {
        continue;
    }else {
        break;
    }
} while (true);
