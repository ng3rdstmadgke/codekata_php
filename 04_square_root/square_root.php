<?php
$n = 1234;
$x = $n / 2.0;
$last_x = 0;
while($x != $last_x){
    $last_x = $x;
    $x = ($x + $n / $x)/2;
}
print $x . "\n";
print $x**2 . "\n";
