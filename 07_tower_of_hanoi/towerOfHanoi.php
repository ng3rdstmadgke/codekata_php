<?php
$count = 0;
function towerOfHanoi($cnt,$start="左",$work="中央", $end="右") {
    global $count;
    $count++;
    if ($cnt === 1) {
        printf("%dを%sから%sへ\n", $cnt, $start, $end);
        return;
    }
    towerOfHanoi($cnt-1, $start, $end, $work);
    printf("%dを%sから%sへ\n", $cnt, $start, $end);
    towerOfHanoi($cnt-1, $work, $start, $end);
    return;
}

towerOfHanoi(4);
print "手数 : {$count}\n";
